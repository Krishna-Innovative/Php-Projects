<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\UserHabitRoutine;
use App\Services\RewardService;
use DB;
class RewardController extends Controller
{
    public function leaderboard(RewardService $service)
    {
		//print_r($service);
        return response()
            ->json([
                "message" => "Success",
                "data"    => $service->leaderboard(),
            ]);
    }
    public function achievement()
    {
        /* $user = request()->user();
         $data = Reward::query()
            ->select(\DB::raw("sum(total_reward) as total_reward"), "rewardable_id", "rewardable_type", "type")
            ->with("rewardable:id,habit_id,habit,habit_description,active_status")
            ->where("rewardable_type", "App\Models\DailyJournalReponse")
            ->groupBy("rewardable_id","rewardable_type","type")
            ->userFilter($user->id)
            // ->latest()
            ->get();
			return response()
            ->json([
                "message" => "Success",
                "data"    => $data,
            ]); 
			*/
		 $user = request()->user();
		 $user_id=$user->id;
		 $userhabit=UserHabitRoutine::class;
		
		
		$data=DB::select("select rewards.total_reward,rewards.rewardable_id, rewards.rewardable_type, rewards.type, rout.id, rout.habit_id, rout.habit, rout.habit_description, rout.active_status, rout.user_id from rewards LEFT JOIN user_habit_routines as rout ON rewards.user_id = rout.user_id");  
		
		
         return response()
            ->json([
                "message" => "Success",
                "data"    => $data,
            ]);  
    }
}
