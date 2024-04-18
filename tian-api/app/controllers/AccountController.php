<?php

use IceAngel\Security\Throttling\RegisterThrottle;
use Chrisbjr\ApiGuard\Controllers\ApiGuardController;

/**
 * Class AccountController
 */
class AccountController extends ApiController {

    /**
     * @var RegisterThrottle
     */
    private $throttler;

    /**
     * @param RegisterThrottle $throttler
     */
    function __construct(RegisterThrottle $throttler)
    {
        $this->throttler = $throttler;
    }

 /**
     * listNewAccounts monthly.
     *
     * @return Response
     */

    public function listAccounts(){

        $from = date("Y-m-01 00:00:00", strtotime("first day of previous month"));
        $to =  date("Y-m-j 00:00:00", strtotime("last day of previous month"));

        //$from = date("Y-m-01 00:00:00");
        //$to =  date("Y-m-j 00:00:00");

        $records  = User::whereBetween('created_at', [$from, $to])->get();
        $data = "Email,First Name,Last Name,Created on,Ice-Id\n";
        foreach ($records as $key => $value) {

            //print_r($value->email);
            $data .= $value->email.",".$value->first_name.",".$value->last_name.",".$value->created_at.",".$value->ice_id."\n";
            # code...
        }

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="filename.csv"');

        $last_month = date('F-Y', strtotime('last month'));

        $fname = $last_month.'_'.rand(111111,999999);

        $path = storage_path().'/'.$fname.'.csv';

        $fp = fopen($path,'a');

        fwrite($fp,$data);

        fclose($fp);

        Event::fire('account.monthlyusers', $path);

        echo 'Email Sent';

    } 


     /**
     * topartner
     *
     * @return Response
     */

    public function topartner(){

        try{

            $email  = Input::get("email");

            $account = Sentry::findUserByLogin($email);
            
            if($account->is_partner == 0) {
            
            $account->is_partner = 1;
            $birth_date = array('year' => '' , 'month' => '', 'day' => '');
            $account->birth_date = $birth_date;
            $plans = Plans::where(['is_default'=> 1])->first();
            $account->plan_id = $plans->id;

	    $account->pass_update = 0;
	    $account->terms_conditions =0;

            if ($account->save())
            {

		// PTN as ECP code
		//$account->contactFor()->attach($account->id);

                $apiKey = Chrisbjr\ApiGuard\Models\ApiKey::where('user_id', $account->id)->first();

                if (!isset($apiKey)){

                    $apiKey                = new Chrisbjr\ApiGuard\Models\ApiKey;
                    $apiKey->user_id       = $account->id;
                    $apiKey->level         = 10;
                    $apiKey->ignore_limits = 1;

                }

                $apiKey->key = $apiKey->generateKey();

                $apiKey->save();

                return Response::json([
                    'key' => $apiKey->key,
                    'updated_at' => $apiKey->updated_at,
                ]);

                //email sending
                //Event::fire('account.updated', $account);

                //return Response::json(Account::find($account->id)->toArray());
            }
            else
            {
                echo "NO Saved"; die; 
            }

        }else{

        return Response::json(Account::find($account->id)->toArray());
            
        } 

        }catch (Exception $e) {

            \Log::info('PTN:', (array)$e);

            echo "Error"; die; 
        }
    }


    public function termsconditions(){

        $account = Sentry::getUser();
        
        try{
              $account->terms_conditions = 1;

                if ($account->save())
                {
                    return Response::json([
                        'status' => '1',
                        'message' => 'Terms and Conditions are successfully updated'
                    ]);
                }else{
                    return Response::json([
                        'status' => '0',
                        'message' => 'Sorry, unable to accept terms and Conditions'
                    ]);
                }

        }catch(Exception $e){
                
                \Log::info('Terms and Conditions:', (array)$e);

                echo "Error While accepting terms and Conditions"; 

                die; 
        }

    }

    /**
     * listNewAccounts monthly.
     *
     * @return Response
     */

    public function listAllAccounts(){

        $records  = User::all(); 

        $data = "Email,First Name, Last Name, Created On, Ice-Id\n";

        foreach ($records as $key => $value) {
            $data .= $value->email.",".$value->first_name.",".$value->last_name.",".$value->created_at.",".$value->ice_id."\n";            
        }

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="filename.csv"');

        $last_month = date('FY', strtotime('last month'));

        $fname = 'All ('.$last_month.')';

        $path = storage_path().'/'.$fname.'.csv'; 

        $fp = fopen($path,'a');

        fwrite($fp,$data);

        fclose($fp);

        Event::fire('account.alluserlist', $path);

        echo 'Email Sent';
    } 

    /**
     * Register a new Account holder.
     *
     * @return Response
     */
    public function register()
    {
        try {

            App::setLocale(Request::header('Accept-Language'));


	    $throttle = $this->throttler->findByIpAddress();

            if ($throttle) {
                $throttle->check();
                $throttle->addRegisterAttempt();
            }
	


            // Transfer member to account
            if (Input::has('id')) {
                $account = Sentry::findUserById(Input::get('id'));

                return $this->attemptToTransferMemberToAccount($account);
            }

   	    if(!empty(Input::get('email')))
                 {
                    $mbaccount = Sentry::findUserByLogin(Input::get('email'));
                    if(!empty($mbaccount)){ 
    
                        if(!$mbaccount->isActivated() && $mbaccount->isAccount()){
                            return Response::json('inactive', 406);
                        }else if($mbaccount->isActivated() && $mbaccount->isAccount()) {
                            return Response::json('account', 406);
                        }else if(!$mbaccount->isAccount()){
                            return Response::json('member', 406);
                        }
                 }
            }

            $account = Sentry::findUserByLogin(Input::get('email'));

            // Allow to use the same email address to register if the account is not activated yet
            if ($account->isAccount() && !$account->isActivated()) {
                $account->delete();

                return $this->registerNewAccount();
            }

            return $this->respondWithError('ValidationException', trans('validation.unique', ['attribute' => 'email address']), 406);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->registerNewAccount();

        } catch (IceAngel\Security\Throttling\IPBlockedException $e) {

            return $this->respondWithError('IPBlockedException', trans('errors.auth.ip_blocked'), 403);
        }

    }

    /**
     * Display a message and alert badges.
     *
     * @return Response
     */
    public function badges()
    {
        try {

            $account = Sentry::getUser();
            $response = \App::make('MemberController')->getAlerts($account->id)->getData();

            $badges = [
                "messages" => $account->viewedMessages()->count(),
                "alerts" => count($response->alerts)
            ];

            return Response::json($badges);

        } catch (Exception $e) {

            return $this->respondWithError('SystemErrorException', $e->getMessage(), 500);

        }
    }


    /**
     * @param $accountId
     * @param $activationCode
     * @return mixed
     */
    public function activate($accountId, $activationCode)
    {
        try {
            // Find the account
            $account = Sentry::findUserById($accountId);

            // Attempt to activate the user
            if ($account->attemptActivation($activationCode)) {

                Event::fire('account.activated', $account);

                \Log::info(':hatching_chick: Account Activated ', array('email' => $account->email, 'server' => getenv("APP_URL")));

                return Redirect::away(web_app_url('activate', $account->language, ['status' => 1, 'logout' => 1]));

            }
            else {

                return Redirect::away(web_app_url('activate', $account->language, ['status' => 0, 'logout' => 1]));

            }

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return Redirect::away(web_app_url('activate', App::getLocale(), ['status' => -1, 'logout' => 1]));

        } catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e) {

            $account = Sentry::findUserById($accountId);

            return Redirect::away(web_app_url('activate', $account->language, ['status' => 2, 'logout' => 1]));

        }

    }

    /**
     * Request reactivation link
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function reActivate()
    {
        try {

            $data = Input::only('email');

            App::setLocale(Request::header('Accept-Language'));

            with(new ReActivateAccountValidator())->validate($data);

            $email = Input::get('email');

            $account = Sentry::findUserByLogin($email);

            if ($account->isActivated()) {
                return $this->respondWithError('AccountAlreadyActivatedException', trans('errors.auth.user_already_activated'), 406);
            }

            Event::fire('account.activation.requested', [$account]);

            return Response::json(["success" => true, "message" => trans('errors.account.activation_sent')]);

        } catch (ValidationException $e) {

            return $this->respondWithError('ValidationException', $e->getErrors()->first(), 406);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('AccountNotFoundException', trans('errors.account.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Display the Account.
     *
     * @return Response
     */
    public function show()
    {
        $account = Sentry::getUser();

        return Response::json(Account::find($account->id)->toArray());
    }

    /**
     * Display the Account with id.
     *
     * @return Response
     */
    public function accountMemberInfo($id)
    {
        //$account = Sentry::getUser();
        try{
            App::setLocale(Request::header('Accept-Language'));
            $account = Account::find($id);
            $rec = $account->members;
            if(!count($rec) || $account->is_partner)
            {
               $rec = Account::find($id)->toArray();
               $record = Account::find($rec['account_id'])->members;
               foreach($record as $key=>$value ){
                    if($value['id']==$id){
                        $rec = [$record[$key]];
                        break;
                    }
               }
            }
            return Response::json($rec);
        }catch(Exception $e){
            echo "Error"; die; 
        }
        
    }

    /**
     * Update the logged in Account.
     *
     * @return Response
     */
    public function update()
    {

        try {

            App::setLocale(Request::header('Accept-Language'));

            $data = Input::all();

            with(new UpdateAccountValidator())->validate($data);

            $account = Sentry::getUser();

 	    $ccode = DB::table('countries')->where('id', $data['phone']['code'])->pluck('phonecode');

            $userphone['number1'] = base64_encode(serialize([
                    'code' => $data['phone']['code'],
                    'number' => $data['phone']['number'],
                ])); 

            $userphone['number2'] = base64_encode(serialize([
                    'code' => $data['phone']['code'],
                    'number' => '+'.$ccode.' '.$data['phone']['number'],
                ]));               
            
            $this->validatenumber($userphone, $account->id);

            if ($account->haveSecurityQuestionsChanged($data)){

                Event::fire('account.securityQuestionsUpdated', $account);

            }

            $account->update($data);

            Event::fire('account.updated', $account);	

            DB::table('users')->where('account_id', $account->id)->where('use_account_phone', 1)->update(['phone' => $userphone['number1']]);		
		
            return Response::json(Account::find($account->id)->toArray());

        } catch (ValidationException $e) {

            return $this->respondWithError('ValidationException', $e->getErrors(), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

     /**
     * Override the validate method to validate phone number
     *
     * @return bool
     * @throws ValidationException
     */
    public function validatenumber($userphone, $id)
    {        

        $user1 = DB::table('users')->where('phone', '=', $userphone['number1'])->where('id', '<>', $id)->where('use_account_phone','=', 0)->get();

        $user2 = DB::table('users')->where('phone', '=', $userphone['number2'])->where('id', '<>', $id)->where('use_account_phone','=', 0)->get();

       if (!empty($user1) || !empty($user2)) {
            throw new ValidationException('ValidationException', trans('validation.unique', ['attribute' => 'phone number']));
        }

        return true;
    }
    


    /**
     * Remove the Account.
     *
     * @return Response
     */
    public function destroy()
    {
        try {
            /** @var Account $account */
            $account = Sentry::getUser();

            if ($account->checkPassword(Input::get('password'))) {
                if ($account->hasMembers()) {
                    return $this->respondWithError('AccountHasMembersException', trans('errors.account.has_members'), 403);
                }
                elseif ($account->hasFriendsInNeed()) {
                    return $this->respondWithError('AccountHasFriendsInNeedException', trans('errors.account.has_fin'), 403);
                }
                elseif ($account->hasGuardians()) {
                    return $this->respondWithError('AccountHasGuardiansException', trans('errors.account.has_guardians'), 403);
                }
                else {
                    if($account->subscribed() && is_null($account->subscription_ends_at)){
                        $account->subscription(Config::get('services.stripe.yearly_plan'))->cancel();
                    }
                    $account->delete();

                    Event::fire('account.deleted', [$account]);

                    return Response::make(null, 204);
                }
            }
            else {
                return $this->respondWithError('Unauthorized', trans('errors.account.settings.wrong_password'), 406);
            }
        } catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }

    /**
     * Check if the given password matches the Account password.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function checkPassword()
    {
        $account = Sentry::getUser();
        App::setLocale(Request::header('Accept-Language'));
        $isDelete = Input::get('isDelete') ? Input::get('isDelete') : false;
        if ($account->checkPassword(Input::get('password'))) {
            if (($account->hasMembers() || $account->hasFriendsInNeed() || $account->hasGuardians() || $account->hasContactsWithPendingRequest()) && $isDelete) {
                    if($account->hasContactsWithPendingRequest()){
                        $listOfContacts [] =trans('errors.account.has_ecps');
                    }
                    if($account->hasMembers()){
                        $listOfContacts [] =trans('errors.account.has_member');
                    }
                    if ($account->hasFriendsInNeed()) {
                        $listOfContacts [] =trans('errors.account.has_fins');
                    }
                    if ($account->hasGuardians()) {
                        $listOfContacts [] =trans('errors.account.has_guardian');
                    }
                    $comma = Request::header('Accept-Language') == 'zh' ? '，':',';
                    return $this->respondWithError('AccountHasMembersException', trans('errors.account.pre_msg').implode($comma, $listOfContacts), 403);
            }
            else{
                return Response::json([
                    'success' => true,
                    'message' => trans('errors.account.password_match'),
                ]);
            }
        }
        else {
            return $this->respondWithError('PasswordMismatchException', trans('errors.account.password_mismatch'), 406);
        }
    }

    /**
     * Register a device token for push notification.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function registerDeviceToken()
    {
        try {

            $data = Input::only('token', 'type', 'onesignal_id', 'jpush_id');

            with(new RegisterDeviceTokenValidator())->validate($data);

            $account = Sentry::getUser();

            $data['token'] =  $data['token'] !== '' ?: null;
            $data['onesignal_id'] =  $data['onesignal_id'] !== '' ?: null;
            $data['jpush_id'] =  $data['jpush_id'] !== '' ?: null;

            $device = PushDevice::updateOrCreate($data, array_merge($data, ['account_id' => $account->id]));

            return Response::make('', 201);

        } catch (ValidationException $e) {

            return $this->respondWithError('ValidationException', $e->getErrors()->first(), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Attempt to transfer an existing member to be an account holder.
     *
     * @param $account
     * @return \Illuminate\Support\Facades\Response
     */
    protected function attemptToTransferMemberToAccount($account)
    {

        $accountGroup = Sentry::findGroupByName('Account');

        if (!$account->inGroup($accountGroup)) {

            $account->update(Input::all());

            // Make the Account as a member
            $account->referrer = $account->account_id;
            $account->account_id = $account->id;
            $account->use_account_email = 0;
            $account->use_account_phone = 0;
            $account->save();

            // Add to Account group
            $account->addGroup($accountGroup);

            // Remove from Member group
            $memberGroup = Sentry::findGroupByName('Member');
            $account->removeGroup($memberGroup);

            Event::fire('account.registered', $account);

            return Response::json([

                "email" => $account->email,

                "first_name" => $account->first_name,

                "last_name" => $account->last_name,

            ], 201);
        }
        else {
            return $this->respondWithError('UserExistsException', 'Account already registered', 406);
        }

    }

    /**
     * Attempt to register new user.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    protected function registerNewAccount()
    {
        try {
            $data = Input::all();

            with(new RegisterAccountValidator())->validate($data);

            // Create the Account
            $account = Sentry::createUser($data);

            // Make the Account as a member
            $account->account_id = $account->id;
            $account->save();

            // Find the Account group
            $accountGroup = Sentry::findGroupByName('Account');

            // Add to Account group
            $account->addGroup($accountGroup);

            Event::fire('account.registered', $account);

            return Response::json([

                "email" => $account->email,

                "first_name" => $account->first_name,

                "last_name" => $account->last_name,

            ], 201);

        } catch (ValidationException $e) {

            return $this->respondWithError('ValidationException', $e->getErrors()->first(), 406);

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {

            return $this->respondWithError('LoginRequiredException', $e->getMessage(), 406);

        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {

            return $this->respondWithError('PasswordRequiredException', $e->getMessage(), 406);

        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {

            return $this->respondWithError('UserExistsException', $e->getMessage(), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Check if the email address has already been registered
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function checkEmail()
    {
        try {
            $id = Input::get('id');
            $email = Input::get('email');
            App::setLocale(Request::header('Accept-Language'));

	    if(empty($email)){
                return Response::json('Empty email', 406);
            }

            // Checking the email in case of transfer member to account
            if ($id) {
                $member = Member::findOrFail($id);
                if ($member->email === $email) {
                    return Response::make('', 204);
                }
            }

            $user = Sentry::findUserByLogin($email);

            if ($user->isAccount()){

                return Response::json($user->isActivated() ? 'account' : 'inactive', 200);
            }

            return Response::json('member', 200);

        } catch (Exception $e) {

            return Response::make('', 204);

        }
    }


	    /**
     * Check if the phone has already been registered
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function validatePhone()
    {
        try {            
        $id = Input::get('id');
        $code = Input::get('code');
        $number = Input::get('number');
        $ccode = Input::get('ccode'); 
        App::setLocale(Request::header('Accept-Language'));

         $phoneBlob1 = base64_encode(serialize([
                'code' =>  (int)$code,
                'number' => $number,
            ]));

         $phoneBlob2 = base64_encode(serialize([
                'code' =>  (int)$code,
                'number' => $ccode.' '.$number,
            ]));

         
        if(!empty($id)){
        
        $user1 = DB::table('users')->where('phone', '=', $phoneBlob1)->where('id', '<>', $id)->where('use_account_phone','=', 0)->get();

        $user2 = DB::table('users')->where('phone', '=', $phoneBlob2)->where('id', '<>', $id)->where('use_account_phone','=', 0)->get();

        }else{

        $user1 = DB::table('users')->where('phone', '=', $phoneBlob1)->get();

        $user2 = DB::table('users')->where('phone', '=', $phoneBlob2)->get();

        }


     	    if(empty($user1) && empty($user2)){

        $userphone = DB::table('users')->where('id', '=', $id)->pluck('phone');   

        $userphone = unserialize(base64_decode($userphone)); 

        $code = DB::table('countries')->where('id', '=', $userphone['code'])->pluck('phonecode');  

        $phonenumber = '+'.$code.' '.$userphone['number'];      

        $pbuser = DB::table('devices')->where('phone_number', '=', $phonenumber)->get();

		if(!empty($pbuser) && ($userphone['number'] != $number)) {

		    return Response::json(array('exist'=>'2'), 200);

		}else{

                 return Response::json(array('exist'=>'0'), 200);

                 }

	    }else{ 
		return Response::json(array('exist'=>'1'), 200);
	    }
    }
    catch (Exception $e) {
            Log::info($e->getMessage(), array());
            return Response::make('', 204);
        }
    }
	public function recentCovidDetail($id){
        try{
            App::setLocale(Request::header('Accept-Language'));
            $mem_rec_cov_dt = MemberCovid::select(DB::raw('*'))    
                            ->where(['member_id'=>$id,'scanned'=>1])
                            ->orderBy('coviddate', 'desc')
                            ->get()
                            ->toArray();
            $new_arry['testList'] = [];
            $before_sort = [];
            $account = Sentry::findUserById($id);
            $fullname = $account->fullName();
            $collection_array = ['antigen','antibody','nucleicacid'];
            $datenow = date("Y-m-d");
            foreach ($mem_rec_cov_dt as $key => $value) {
                $category = strtolower($value['pcategory']);
                
                $record_date = $value['coviddate']['year'].'-'.sprintf("%02d", $value['coviddate']['month']).'-'.sprintf("%02d", $value['coviddate']['day']);
                $diff = strtotime($datenow) - strtotime($record_date);
                $days =  abs(round($diff / 86400));
                if (($key_arr = array_search($category, $collection_array)) !== false && (($days <= 5 && ($category =='antigen'||$category =='nucleicacid')) || ($category == 'antibody' && $days <=5 ))) {

                    $chK_mem_rec_cov_dt = MemberCovid::select(DB::raw('*'))    
                            ->where(['member_id'=>$id,'scanned'=>1,'pcategory'=>$category,'coviddate'=>$record_date])
                            ->orderBy('id', 'desc')
                            ->get()
                            ->toArray();
                    if(count($chK_mem_rec_cov_dt)>1){
                       // return Response::json($chK_mem_rec_cov_dt);
                        $mem_rec_cov_dt[$key] = $chK_mem_rec_cov_dt[0];
                    }
                    if($category =='antigen' || $category =='nucleicacid'){
                        if(strtolower($mem_rec_cov_dt[$key]['result'])=='positive'){
                            unset($collection_array[$key_arr]);
                            continue;
                        }
                    }

                    $covid_cat = Covid::where(['value'=>$collection_array[$key_arr]])->first();
                    if(Request::header('Accept-Language') == 'zh'){
                        $result_str = (strtolower($mem_rec_cov_dt[$key]['result'])=='positive') ? '阳性' : '阴性';
                    }
                    else{
                        $result_str = (strtolower($mem_rec_cov_dt[$key]['result'])=='positive') ? 'Positive' : 'Negative';
                    }
                    $mem_rec_cov_dt[$key]['days'] = $days;
                    $mem_rec_cov_dt[$key]['fullname'] = $fullname;
                    $mem_rec_cov_dt[$key]['type'] = $collection_array[$key_arr];
                    $mem_rec_cov_dt[$key]['name_cat'] = $covid_cat->getName();
                    $mem_rec_cov_dt[$key]['result'] = $result_str;
                    $mem_rec_cov_dt[$key]['covid_date_sort'] = $record_date;
                    //$new_arry["testList"][] = $mem_rec_cov_dt[$key];
                    $before_sort[] = $mem_rec_cov_dt[$key];
                    unset($collection_array[$key_arr]);
                }
            }
            $mem_rec_vac_dt = DB::table('member_immunizations')
                            ->select('member_immunizations.*')
                            ->join('immunizations','immunizations.id','=','member_immunizations.name')
                            ->where(['immunizations.name_en' => 'Covid-19 vaccine','member_immunizations.member_id'=>$id,'member_immunizations.scanned'=>1])
                            ->orderBy('member_immunizations.date', 'desc')
                            ->get();
            $mem_rec_vac_dt = json_decode(json_encode($mem_rec_vac_dt), true);
            foreach ($mem_rec_vac_dt as $key => $value) {
                $record_date = $value['date'];
                $diff = strtotime($datenow) - strtotime($record_date);
                $days =  abs(round($diff / 86400));
                if($days <= 365){
                    $rec_date = explode(" ",$value['date']);
                    $rec_format_date = explode("-",$rec_date[0]);
                    
                    
                    $chk_mem_rec_vac_dt = DB::table('member_immunizations')
                            ->select('member_immunizations.*')
                            ->join('immunizations','immunizations.id','=','member_immunizations.name')
                            ->where(['immunizations.name_en' => 'Covid-19 vaccine','member_immunizations.member_id'=>$id,'member_immunizations.scanned'=>1,'member_immunizations.date'=>$record_date])
                            ->orderBy('member_immunizations.id', 'desc')
                            ->get();
                    $chk_mem_rec_vac_dt = json_decode(json_encode($chk_mem_rec_vac_dt), true);
                    if(count($chk_mem_rec_vac_dt)>1){
                       // return Response::json($chK_mem_rec_cov_dt);
                        $mem_rec_vac_dt[$key] = $chk_mem_rec_vac_dt[0];
                    }
                    $mem_rec_vac_dt[$key]['date'] =  [
                        "year"=>$rec_format_date[0],
                        "month"=>$rec_format_date[1],
                        "day"=>$rec_format_date[2]
                    ];
                    $vaccine_cat = Immunization::where(['id'=>$value['name']])->first();
                    $mem_rec_vac_dt[$key]['days'] = $days;
                    $mem_rec_vac_dt[$key]['fullname'] = $fullname;
                    $mem_rec_vac_dt[$key]['type'] = 'covid19';
                    $mem_rec_vac_dt[$key]['name_cat'] = $vaccine_cat->getName();
                    $mem_rec_vac_dt[$key]['covid_date_sort'] = $rec_date[0];
                    //$new_arry["testList"][] = $mem_rec_vac_dt[$key];
                    $before_sort[] = $mem_rec_vac_dt[$key];
                    break;
                }
            }
            $covid_date_sort = array();
            foreach ($before_sort as $key => $row)
            {
                $covid_date_sort[$key] = $row['covid_date_sort'];
            }
            array_multisort($covid_date_sort, SORT_DESC, $before_sort);
            $new_arry['testList'] = $before_sort;
            return Response::json($new_arry);
            
        }catch(Exception $e){
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }   

    public function allVaccineDetail($id){
        try{
            App::setLocale(Request::header('Accept-Language'));
            $new_arry['testList'] = [];
            $track_dates = [];
            $datenow = date("Y-m-d");
            $mem_rec_vac_dt = DB::table('member_immunizations')
                            ->select('member_immunizations.*')
                            ->join('immunizations','immunizations.id','=','member_immunizations.name')
                            ->where(['immunizations.name_en' => 'Covid-19 vaccine','member_immunizations.member_id'=>$id,'member_immunizations.scanned'=>1])
                            ->orderBy('member_immunizations.date', 'desc')
                            ->get();
            $mem_rec_vac_dt = json_decode(json_encode($mem_rec_vac_dt), true);
            
            foreach ($mem_rec_vac_dt as $key => $value) {
                if($value['date']===null || trim($value['date']) == ''){
                    continue;
                }
                $record_date = $value['date'];
                $diff = strtotime($datenow) - strtotime($record_date);
                $days =  abs(round($diff / 86400));
                if($days <= 365){
                    $track_rec_date = DB::table('member_immunizations')
                            ->select('member_immunizations.*')
                            ->join('immunizations','immunizations.id','=','member_immunizations.name')
                            ->where(['immunizations.name_en' => 'Covid-19 vaccine','member_immunizations.member_id'=>$id,'member_immunizations.scanned'=>1,'member_immunizations.date'=>$record_date])
                            ->orderBy('member_immunizations.id', 'desc')
                            ->get();
                    $track_rec_date = json_decode(json_encode($track_rec_date), true);
                    if(count($track_rec_date)>1){
                       if(!in_array($record_date, $track_dates)){
                            foreach($track_rec_date as $k_vac=>$val_vac){
                                $rec_date = explode(" ",$val_vac['date']);
                                $rec_format_date = explode("-",$rec_date[0]);
                                $track_rec_date[$k_vac]['date'] =  [
                                    "year"=>$rec_format_date[0],
                                    "month"=>$rec_format_date[1],
                                    "day"=>$rec_format_date[2]
                                ];
                                $vaccine_cat = Immunization::where(['id'=>$val_vac['name']])->first();
                                if($val_vac['info']!==null && trim($val_vac['info']) != '' && $val_vac['info'] != 5 ){
                                    $vaccine_dosage = VaccineDosage::where(['id'=>$val_vac['info']])->first();
                                     $track_rec_date[$k_vac]['series'] = $vaccine_dosage->getName();
                                }
                                $track_rec_date[$k_vac]['days'] = $days;
                                $track_rec_date[$k_vac]['name_cat'] = $vaccine_cat->getName();
                                $new_arry['testList'][] = $track_rec_date[$k_vac];
                            }
                       }
                       $track_dates [] = $record_date;
                       continue;
                    }
                    
                    $rec_date = explode(" ",$value['date']);
                    $rec_format_date = explode("-",$rec_date[0]);
                    $mem_rec_vac_dt[$key]['date'] =  [
                        "year"=>$rec_format_date[0],
                        "month"=>$rec_format_date[1],
                        "day"=>$rec_format_date[2]
                    ];
                    $vaccine_cat = Immunization::where(['id'=>$value['name']])->first();
                    if($value['info']!==null && trim($value['info']) != '' && $value['info'] != 5 ){
                        $vaccine_dosage = VaccineDosage::where(['id'=>$value['info']])->first();
                         $mem_rec_vac_dt[$key]['series'] = $vaccine_dosage->getName();
                    }
                    $mem_rec_vac_dt[$key]['days'] = $days;
                    $mem_rec_vac_dt[$key]['name_cat'] = $vaccine_cat->getName();
                    $new_arry['testList'][] = $mem_rec_vac_dt[$key];
                }  
            }
            return Response::json($new_arry);
        }catch(Exception $e){
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }
    public function allCovidDetail(){
        try{
            App::setLocale(Request::header('Accept-Language'));
            $account = Sentry::getUser();
            if($account->is_partner){
                $members = $account->members;
                $new_arry['testList'] = [];
                $before_sort = [];
                $antigen_total = 0;$antigen_neg_total = 0;$antigen_pos_total = 0;
                $nucleicacid_total = 0; $nucleicacid_neg_total = 0; $nucleicacid_pos_total = 0 ;
                $antibody_total = 0; $antibody_neg_total = 0; $antibody_pos_total = 0 ;
                $vaccine_total = 0; $vaccine_first_dose = 0; $vaccine_second_dose = 0; $vaccine_other = 0;
                $fullname = $account->fullName();
                $collection_array = ['antigen','antibody','nucleicacid'];
                $datenow = date("Y-m-d");
                foreach ($members as $key_mem => $member) {
                    if($member->id!=$member->account_id){
                        $id = $member->id;
                        $mem_rec_cov_dt = MemberCovid::select(DB::raw('*'))    
                            ->where(['member_id'=>$id])
                            ->orderBy('coviddate', 'desc')
                            ->get()
                            ->toArray();
                        foreach ($mem_rec_cov_dt as $key => $value) {
                            $category = strtolower($value['pcategory']);
                            $record_date = $value['coviddate']['year'].'-'.sprintf("%02d", $value['coviddate']['month']).'-'.sprintf("%02d", $value['coviddate']['day']);
                            if (($key_arr = array_search($category, $collection_array)) !== false ) {
                                $covid_cat = Covid::where(['value'=>$collection_array[$key_arr]])->first();
                                if(Request::header('Accept-Language') == 'zh'){
                                    $result_str = (strtolower($mem_rec_cov_dt[$key]['result'])=='positive') ? '阳性' : '阴性';
                                }
                                else{
                                    $result_str = (strtolower($mem_rec_cov_dt[$key]['result'])=='positive') ? 'Positive' : 'Negative';
                                }
                                $mem_rec_cov_dt[$key]['type'] = $collection_array[$key_arr];
                                $mem_rec_cov_dt[$key]['name_cat'] = $covid_cat->getName();
                                $mem_rec_cov_dt[$key]['result'] = $result_str;
                                $mem_rec_cov_dt[$key]['covid_date_sort'] = $record_date;
                                $mem_rec_cov_dt[$key]['first_name'] = $member->first_name;
                                $mem_rec_cov_dt[$key]['last_name'] = $member->last_name;
                                $mem_rec_cov_dt[$key]['middle_name'] = $member->middle_name;
                                if($key_arr==0){
                                    $antigen_total++;
                                    strtolower($mem_rec_cov_dt[$key]['result'])=='positive' ? $antigen_pos_total++ : $antigen_neg_total++;
                                }
                                if($key_arr==1){
                                    $antibody_total++;
                                    strtolower($mem_rec_cov_dt[$key]['result'])=='positive' ? $antibody_pos_total++ : $antibody_neg_total++;
                                }
                                if($key_arr==2){
                                    $nucleicacid_total++;
                                    strtolower($mem_rec_cov_dt[$key]['result'])=='positive' ? $nucleicacid_pos_total++ : $nucleicacid_neg_total++;
                                }
                                $before_sort[] = $mem_rec_cov_dt[$key];
                            }
                        }
                        $mem_rec_vac_dt = DB::table('member_immunizations')
                            ->select('member_immunizations.*')
                            ->join('immunizations','immunizations.id','=','member_immunizations.name')
                            ->where(['immunizations.name_en' => 'Covid-19 vaccine','member_immunizations.member_id'=>$id])
                            ->orderBy('member_immunizations.date', 'desc')
                            ->get();
                        $mem_rec_vac_dt = json_decode(json_encode($mem_rec_vac_dt), true);
                        foreach ($mem_rec_vac_dt as $key => $value) {
                            $record_date = $value['date'];
                            $rec_date = explode(" ",$value['date']);
                            $rec_format_date = explode("-",$rec_date[0]);
                            
                            $mem_rec_vac_dt[$key]['date'] =  [
                                "year"=>$rec_format_date[0],
                                "month"=>$rec_format_date[1],
                                "day"=>$rec_format_date[2]
                            ];
                            $vaccine_cat = Immunization::where(['id'=>$value['name']])->first();
                            $mem_rec_vac_dt[$key]['type'] = 'covid19';
                            $mem_rec_vac_dt[$key]['name_cat'] = $vaccine_cat->getName();
                            if($value['info'] && $value['info']!=5){
                                $value['info'] = (int)$value['info'];
                                $mem_rec_vac_dt[$key]['info'] = VaccineDosage::where(['id'=>$value['info']])->first()->getName();
                            }
                            else{
                                $mem_rec_vac_dt[$key]['info'] = $value['series'];
                            }
                            $mem_rec_vac_dt[$key]['covid_date_sort'] = $rec_date[0];
                            $mem_rec_vac_dt[$key]['first_name'] = $member->first_name;
                            $mem_rec_vac_dt[$key]['last_name'] = $member->last_name;
                            $mem_rec_vac_dt[$key]['middle_name'] = $member->middle_name;
                            if($value['info']==1){
                                $vaccine_first_dose ++;
                            }elseif ($value['info']==2) {
                                $vaccine_second_dose ++;
                            }else{
                                $vaccine_other ++;
                            }
                            $vaccine_total ++;
                            $before_sort[] = $mem_rec_vac_dt[$key];
                        }
                    }
                }
                $covid_date_sort = array();
                foreach ($before_sort as $key => $row)
                {
                    $covid_date_sort[$key] = $row['covid_date_sort'];
                }
                array_multisort($covid_date_sort, SORT_DESC, $before_sort);
                $new_arry['testList'] = $before_sort;
                $new_arry['antigen_rec'] = array(
                    'total' => $antigen_total,
                    'total_negative'=>$antigen_neg_total,
                    'total_positive'=>$antigen_pos_total
                );
                $new_arry['antibody'] = array(
                    'total' => $antibody_total,
                    'total_negative'=>$antibody_neg_total,
                    'total_positive'=>$antibody_pos_total
                );
                $new_arry['nucleicacid_rec'] = array(
                    'total' => $nucleicacid_total,
                    'total_negative'=>$nucleicacid_neg_total,
                    'total_positive'=>$nucleicacid_pos_total
                );
                $new_arry['vaccine_rec'] = array(
                    'total' => $vaccine_total,
                    'first_dose'=>$vaccine_first_dose,
                    'second_dose'=>$vaccine_second_dose,
                    'others'=> $vaccine_other
                );
                return Response::json($new_arry);
            }
            return $this->respondWithError('AccountNotFoundException', trans('errors.account.not_partner'), 400);
            
        }catch(Exception $e){
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }
    public function getMemberPhotoIdDetail($id){
        try {
            
            $member = Member::findOrFail($id);
            return Response::json(['photoIDUrl'=>$member->photoID]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    } 
    public function assignPartnerPlan(){
        try{
            $data = Input::all();
            if(!isset($data['email']) || empty($data['email']) || !isset($data['plan_id']) || empty($data['plan_id'])){
                throw new ValidationException('ValidationException', trans('validation.required', ['attribute' => 'email,plan_id']));
            }
            $account = Account::where('email', '=', $data['email'])->firstOrFail();
            if($account->id==$account->account_id && $account->is_partner){
                $account->plan_id = $data['plan_id'];
                $account->save();
                return Response::json('Plan ID updated successfully', 200);
            }
            else{
                return $this->respondWithError('AccountNotFoundException', trans('errors.account.not_partner'), 400);
            }
            

        } catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors(), 406);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('MemberNotFoundException', trans('errors.contact.member_not_found'), 404);
        } catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }
    public function updatefeatures(){
        try{
            $data = Input::all();
            if(!isset($data['email']) || empty($data['email']) || !isset($data['features']) || empty($data['features']) || !isset($data['action']) || empty($data['action']) ){
                throw new ValidationException('ValidationException', trans('validation.required', ['attribute' => 'email,features,action']));
            }
            $action = $data['action'];
            $features = $data['features'];
            $account = Account::where('email', '=', $data['email'])->firstOrFail();
            if($account->id==$account->account_id && $account->is_partner){
                if($data['features']=='request'){
                    $getFeatures = $account->features;
                    if($action == 'show'){
                        if($getFeatures && !empty($getFeatures)){
                            $getFeatures = json_decode($getFeatures,true);
                            $getFeatures['request'] = 1;
                            $account->features = json_encode($getFeatures);
                        }
                        else{
                            $account->features = json_encode(array('request'=>1));
                        }
                        $account->save();
                        return Response::json('Show request feature successfully', 200);
                    }
                    elseif($action == 'hide'){
                        if($getFeatures && !empty($getFeatures)){
                            $getFeatures = json_decode($getFeatures,true);
                            $getFeatures['request'] = 0;
                            $account->features = json_encode($getFeatures);
                        }
                        else{
                            $account->features = json_encode(array('request'=>0));
                        }
                        $account->save();
                        return Response::json('Hide request feature successfully', 200);
                    }
                    else{
                        return $this->respondWithError('ActionNotFoundException', trans('errors.account.not_partner'), 400);
                    }
                }
                else{
                    return $this->respondWithError('FeatureNotFoundException', trans('errors.account.not_partner'), 400);
                }

            }
            else{
                return $this->respondWithError('AccountNotFoundException', trans('errors.account.not_partner'), 400);
            }
            

        } catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors(), 406);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('MemberNotFoundException', trans('errors.contact.member_not_found'), 404);
        } catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }
    public function checkSubscriptionDate(){
        try{
            $account = Sentry::getUser();
            $end_subscription = $account->checkSubscriptionDate();
            if($end_subscription){
                $date = \Carbon\Carbon::parse($end_subscription);
                $now = \Carbon\Carbon::now();
                $diff = $date->diffInDays($now);
                $data = ['pending_days'=>$diff,'end_subscription'=>$date->format('Y-m-d')];
                return Response::json(["success" => true, "end_subscription" => $data]);        
            }
            return Response::json(["success" => true, "end_subscription" => $end_subscription]);
        }catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }    
} 