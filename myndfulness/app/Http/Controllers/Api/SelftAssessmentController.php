<?php

namespace App\Http\Controllers\Api;

use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SelfAssessmentStoreRequest;
use App\Models\SelfAssessmentResponse;
use App\Services\QuestionService;
use DB;
use Illuminate\Http\Response;

class SelftAssessmentController extends Controller
{
    public function index()
    {
        $per_page = request("per_page", 20);
        $user     = auth("sanctum")->user();
        $response = SelfAssessmentResponse::query()
            ->userFilter($user->id)
            ->with("transactions")
            ->latest()
            ->paginate($per_page);
        return response()
            ->json($response);
    }
    public function store(SelfAssessmentStoreRequest $request)
    {
        try {
            $final_data = $request->prepareData();
        } catch (\Throwable$th) {
            report($th);
            abort(500, "Data preparation failed.");
        }
        /**
         * @var \App\Models\User $user
         */
        $user   = $request->user();
        $is_already_entered_today = SelfAssessmentResponse::userFilter($user->id)
            ->whereDate("created_at", date("Y-m-d"))
            ->exists();
        if($is_already_entered_today){
            return CommonHelper::badRequestResponse("Self-assessment is already submitted for today.");
        }
        DB::beginTransaction();
        try {
			$set_id = SelfAssessmentResponse::setFilter($final_data[0]["question_id"]);
            $self_assessment = SelfAssessmentResponse::create([
                "user_id"   => $user->id,
				"question_set_id" => $set_id,
                "response_date"   => now()->format("Y-m-d"),
                "json_response"   => $request->all()
            ]);
            $transactions_data = [];
            foreach ($final_data as $key => $data) {
                $transactions_data[] = [
                    "question_id"   => $data["question_id"],
                    "question"      => $data["question"],
                    "question_type" => $data["type"],
                    "option_ids"    => $request->filterOptionIds($data["answers"]),
                    "options"       => collect($data["answers"])->pluck("text"),
                ];
            }
            $self_assessment->transactions()->createMany($transactions_data);
            $total_reward = SelfAssessmentResponse::MIN_COIN_PER_RESPONSE;
            $reward_type = ($user->self_assessment_coins_current + $total_reward) >= SelfAssessmentResponse::COIN_LIMIT_FOR_MEDAL ? 'medal' : 'coin';
            $self_assessment->rewards()->create([
                'user_id' => $user->id,
                'rewarded_at' => date('Y-m-d'),
                'total_reward' => $total_reward,
                'type' => $reward_type
            ]);
        } catch (\Throwable$th) {
            report($th);
            DB::rollback();
            return response()
                ->json([
                    "message"   => "Whoops! something went wrong."
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $user->is_onboard_completed = true;
        $user->save();
        DB::commit();
        $self_assessment->load("transactions");
        return response()
            ->json([
                "message"   => "Self-assessment is submitted successfully.",
                "data"      => $self_assessment
            ], Response::HTTP_OK);
    }
	
	public function storeQueAns(SelfAssessmentStoreRequest $request)
    { 
		
		//print_r($request->prepareData()); die("nbbhhh");
		
        try {
            $final_data = $request->prepareData();
        } catch (\Throwable $th) {
            report($th);
            abort(500, "Data preparation failed.");
        }
        /**
         * @var \App\Models\User $user
         */

        $user                     = $request->user();
        $is_already_entered_today = SelfAssessmentResponse::userFilter($user->id)
            ->whereDate("created_at", date("Y-m-d"))
            ->exists();
        
        DB::beginTransaction();
        try {
            $is_450_charcter_condition_passed = false;
			$set_id = SelfAssessmentResponse::setFilter($final_data[0]["question_id"]);
            $self_assessment = SelfAssessmentResponse::create([
                "user_id"       => $user->id,
				"question_set_id"       => $set_id,
                "response_date" => now()->format("Y-m-d"),
                "json_response" => $request->all(),
            ]);
            $transactions_data = [];
            foreach ($final_data as $key => $data) {
			
                $transactions_data[] = [
                    "user_id"       => $user->id,
                    "question_id"   => $data["question_id"],
                    "question"      => $data["question"],
                    "question_type" => $data["type"],
                    "option_ids"    => $request->filterOptionIds($data["answers"]),
                    "options"       => collect($data["answers"])->pluck("text"),
                ];
                foreach($data["answers"] as $row){
                    $text_without_spaces = str_replace(" ", "", $row["text"]);
                    if(strlen($text_without_spaces) >= 300){
                        $is_450_charcter_condition_passed = true;
                    }
                }
				
            }
			
            $self_assessment->transactions()->createMany($transactions_data);
            if (!$is_already_entered_today) {
                $total_reward = SelfAssessmentResponse::MIN_COIN_PER_RESPONSE;
                if($is_450_charcter_condition_passed){
                    $total_reward += 1;
                }
                $reward_type = ($user->self_assessment_coins_current + $total_reward) >= SelfAssessmentResponse::COIN_LIMIT_FOR_MEDAL ? 'medal' : 'coin';
                $self_assessment->rewards()->create([
                    'user_id'      => $user->id,
                    'rewarded_at'  => date('Y-m-d'),
                    'total_reward' => $total_reward,
                    'type'         => $reward_type,
                ]);

            }

        } catch (\Throwable $th) {
            report($th);
            DB::rollback();
            return response()
                ->json([
                    "message" => "Whoops! something went wrong.",
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        DB::commit();
        $self_assessment->load("transactions");
		
        return response()
            ->json([
                "message" => "Self-assessment is submitted successfully.",
                "data"    => $self_assessment,
            ], Response::HTTP_OK);
    }
    public function questions()
    {
        return response()
            ->json([
                "data"    => QuestionService::selfAssessmentQuestions(),
            ], 200);
    }
	public function dailySubmit(SelfAssessmentStoreRequest $request)
    { 
	    $user = $request->user();
		
	    $posts= SelfAssessmentResponse::dailySubmit($user->id); 
		
		return response()
            ->json([
                "data" => QuestionService::selfAssessmentNextQuestions($posts["next_set_id"]),
            ], 200);
		
		
    }
}
