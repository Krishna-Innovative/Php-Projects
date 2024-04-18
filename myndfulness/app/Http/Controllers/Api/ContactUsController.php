<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsStoreRequest;
use App\Models\ContactUs;
use DB;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailContact;


class ContactUsController extends Controller
{

    public function store(ContactUsStoreRequest $request)
    {
        /**
         * @var \App\Models\User $user
         */
        $user   = $request->user();
        DB::beginTransaction();
        try {
			if($user->email==""){
				 return response()
                ->json([
                    "message"   => "Please enter your email in your profile to get us back to you"
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
			}
            $contact_us = ContactUs::create([
                "user_id"   => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "text" => $request->text
            ]);
			if($contact_us){
				$email = $user->email;
				$mailData = [
					'name' => $user->name,
					'email' => $user->email,
					'text' => $request->text
				];
				
				try {
					Mail::to('support@myndfulness.app')->send(new EmailContact($mailData));
				} catch (\Throwable$th) {
					report($th);
					return response()
					->json([
						"message"   => "Whoops! something went wrong."
					], Response::HTTP_INTERNAL_SERVER_ERROR);
				
				}
			}
			
        } catch (\Throwable$th) {
            report($th);
            DB::rollback();
            return response()
                ->json([
                    "message"   => "Whoops! something went wrong."
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        DB::commit();
        return response()
            ->json([
                "message"   => "Contact us is submitted successfully.",
            ], Response::HTTP_OK);
    }
}
