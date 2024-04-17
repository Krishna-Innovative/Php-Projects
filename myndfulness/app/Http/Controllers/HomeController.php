<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserSubscription;
use DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = new User;
        $online_users = User::whereHas("tokens",
            function($query){
                $query->where("last_used_at", ">=", now()->subMinute(3));
            }
        )->count();
        return view('dashboard', compact('online_users'));
    }
	  public function planlist()
    {
          // $user = UserSubscription::where('name','Free')->get();
           // $user->user_id  ;

         // $free_users = DB::table('user_subscriptions')->where('name', 'Free')->get();
       $free_users =  DB::table('users')
       ->select('users.email','users.name as uname','user_subscriptions.name as pname','user_subscriptions.price','user_subscriptions.start_date as sdate','user_subscriptions.end_date as edate')
       ->join('user_subscriptions','user_subscriptions.user_id','=','users.id')
       ->where(['user_subscriptions.name' => 'Free'])
        ->orderBy('user_subscriptions.start_date', 'DESC')
       ->Paginate(30);

       $paid_users =  DB::table('users')
       ->select('users.email','users.name as uname','user_subscriptions.name as pname','user_subscriptions.price','user_subscriptions.start_date as sdate','user_subscriptions.end_date as edate')
       ->join('user_subscriptions','user_subscriptions.user_id','=','users.id')
       ->where('user_subscriptions.name' ,'<>', 'Free')
       ->orderBy('user_subscriptions.start_date', 'DESC')
        ->Paginate(30);

       return view('plan',['users'=>$free_users,'paidusers'=>$paid_users]);
   }
    public function changePassword()
    {
        return view("auth.change-password");
    }
    public function changePasswordPost(AdminChangePasswordRequest $request)
    {
        // dd($request->all());
        /**
         * @var $user \App\Models\Admin
         */
        $user = auth()->user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()
                ->back()
                ->with("success", "Password successfully changed.");
        } else {
            return redirect()
                ->back()
                ->with("error", "old password does not matched.");
        }
    }
}
