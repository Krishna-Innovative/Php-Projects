<?php

class MemberController extends ApiController {

    use \IceAngel\Traits\NotificationHelpersTrait;

    /**
     * Add a new Member.
     *
     * @return Response
     */
    public function store()
    {
        try {

           $data = Input::all();

            // Set the Account holder.
           $account = Sentry::getUser();

	   if($account->is_partner == 1){
		with(new RegisterAccountValidator())->validate($data);
	   }else{
                with(new AddMemberValidator())->validate($data);
	   }

            if( isset($data['use_account_email']) && $data['use_account_email'] == true ){
            }
            else{

                    if(!empty($data['email']))
                    {
                    $saccount = DB::table('users')->where('email', '=', $data['email'])->first();
                    
                    
                  if(!empty($saccount)){     
                        if(!$saccount->activated && ($saccount->id==$saccount->account_id) ){
                            return Response::json('inactive', 406);
                        }else if($saccount->activated && ($saccount->id==$saccount->account_id)) {
                            return Response::json('account', 406);
                        }else if(!$saccount->activated && ($saccount->id!=$saccount->account_id)){
                            return Response::json('member', 406);
                        }
                    }
                }
            }       


	    if( isset($data['use_account_phone']) && $data['use_account_phone'] == true ){

	    }else{
	    	
            $ccode = DB::table('countries')->where('id', $data['phone']['code'])->pluck('phonecode');

            $uphone['number1'] = base64_encode(serialize([
                    'code' => $data['phone']['code'],
                    'number' => $data['phone']['number'],
                ]));  

            $uphone['number2'] = base64_encode(serialize([
                    'code' => $data['phone']['code'],
                    'number' => '+'.$ccode.' '.$data['phone']['number'],
                ])); 

            //$this->numbervalidate($uphone);

            $user1 = DB::table('users')->where('phone', '=', $uphone['number1'])->get();

            $user2 = DB::table('users')->where('phone', '=', $uphone['number2'])->get();

	    if (!empty($user1) || !empty($user2)) {
	    //throw new ValidationException('ValidationException', trans('validation.unique', ['attribute' => 'phone number']));
            return Response::json(array('error'=> array('type'=>'ValidationException', 'message'=>'The phone number has already been taken.')), 406);
	    }

            }

            $data['account_id'] = $account->id;

            if (Input::has('email')) {
                unset($data['use_account_email']);
            }

            $member = Member::create($data);
            // Add PTN as ECP
            //if($account->is_partner == 1){
                //$account->contactFor()->attach($member->id);
            //}

            if (isset($data['additional_information'])) {
                $member->processAdditionalInformation($data['additional_information']);
            }

            // Find the Member group
            $memberGroup = Sentry::findGroupByName('Member');

            // Add to Member group
            $member->addGroup($memberGroup);

            //pre-generate qr code
            $gen = new \PHPQRCode\QRcode();

            $qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen) ;

            $qrGenerator->generateAndUpload($member->ice_id);

            Event::fire('member.added', $member);

            return Response::json($member->toArray(), 201);

        } catch (ValidationException $e) {

            return $this->respondWithError('ValidationException', $e->getErrors()->first(), 406);

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {

            return $this->respondWithError('LoginRequiredException', $e->getMessage(), 406);

        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {

            return $this->respondWithError('PasswordRequiredException', $e->getMessage(), 406);

        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {

            return $this->respondWithError('UserExistsException', $e->getMessage(), 403);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Display the Member.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {

        try {

            $member = Sentry::getUser()->members()->findOrFail($id);

            return Response::json($member->toArray());

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Update the Member.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {

        try {

            $data = Input::all();

            with(new UpdateMemberValidator())->validate($data);

	    $member = Sentry::getUser()->members()->findOrFail($id); 

          
            if($data['use_account_email'] === false )
                {
                    //$mbaccount = Sentry::findUserByLogin($data['email']);
                    $saccount = DB::table('users')->where('id', '<>', $id)->where('email', '=', $data['email'])->first();
                    
                    if(!empty($saccount)){     
                        if(!$saccount->activated && ($saccount->id==$saccount->account_id) ){
                            return Response::json('inactive', 406);
                        }else if($saccount->activated && ($saccount->id==$saccount->account_id)) {
                            return Response::json('account', 406);
                        }else if(!$saccount->activated && ($saccount->id!=$saccount->account_id)){
                            return Response::json('member', 406);
                        }
                    }
                }

	 	if (Input::has('email')) {
                $data['use_account_email'] = 0;
            	}

            $ccode = DB::table('countries')->where('id', $data['phone']['code'])->pluck('phonecode');

            $phone['number1'] = base64_encode(serialize([
                    'code' => $data['phone']['code'],
                    'number' => $data['phone']['number'],
                ]));  

            $phone['number2'] = base64_encode(serialize([
                    'code' => $data['phone']['code'],
                    'number' => '+'.$ccode.' '.$data['phone']['number'],
                ])); 
            

	    if($data['use_account_phone']==false){
            
		$this->numbervalidate($phone, $id); 

	    }

            $member->update($data);

            if (isset($data['additional_information'])) {
                $member->processAdditionalInformation($data['additional_information']);
            }

            Event::fire('member.updated', $member);

		if($member->account_id == $member->id){

                $mem = DB::table('users')->where('account_id', $member->id)->where('use_account_phone', 1)->update(['phone' => $phone['number1'] ]);

           }

            return Response::json($member->toArray());

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

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
    public function numbervalidate($phone, $id)
    { 
        $user1 = DB::table('users')->where('phone', '=', $phone['number1'])->where('id', '<>', $id)->where('use_account_phone','=', 0)->get();

        $user2 = DB::table('users')->where('phone', '=', $phone['number2'])->where('id', '<>', $id)->where('use_account_phone','=', 0)->get();        

        if (!empty($user1) || !empty($user2)) {
            throw new ValidationException('ValidationException', trans('validation.unique', ['attribute' => 'phone number']));
        }

        return true;
    }

    /**
     * Remove the Member.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {

            App::setLocale(Request::header('Accept-Language'));
            $member = Sentry::getUser()->members()->findOrFail($id);
            $contacts = $member->contacts();

            if (count($contacts) != 0){
                return $this->respondWithError('MemberHasContactsException', trans('errors.member.has_contacts'), 403);
            }

            $member->delete();

            Event::fire('member.deleted', [$member, $contacts]);

            return Response::make(null, 204);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Return the member and friends alerts history.
     *
     * @param $id
     * @return \Illuminate\Support\Facades\Response
     */
    public function getAlerts($id)
    {
        try {

            $user = Sentry::getUser();
                    //->members()
                    //->findOrFail($id);

            $alerts = $user
                    ->alerts()
                    ->Last48Hours()
                    ->get()
                    ->map(function ($alert) use ($user) {
                        return array_merge($alert->toArray(), ["url" => $this->getSharedProfileUrl($alert, $user->id)]);
                    })
                    ->toArray();

            $friends = Sentry::getUser()
                    ->contactFor()
                    ->get();

            foreach ($friends as $friend) {

                $friendAlerts = $friend->alerts()->last48Hours()->get()->map(function ($alert) use ($user) {
                    $url = $this->getSharedProfileUrl($alert, $user->id);
                    if ($url)
                        return array_merge($alert->toArray(), ["url" => $url, "origin" => 'friend']);
                    return [];
                })->toArray();
                $alerts = array_merge($alerts, $friendAlerts);
            }

            return Response::json([
                'alerts' => $alerts,
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Get the link to the member's profile
     *
     * @param \Alert $alert
     * @param int $contactId
     * @return string
     */
    protected function getSharedProfileUrl($alert, $contactId)
    {
        $member = $alert->member;
        // Link to member's profile page
        if ($member->account_id == $contactId) {
            return web_app_url('member-profile', $member->account->language, ['memberId' => $member->id, 'query' => '']);
        }

        $sharedProfile = MemberSharedProfile::findByAlert($alert->id, $contactId);
        if (!$sharedProfile){
            return null;
        }

        $contact = \Account::find($contactId);
        $expires = $sharedProfile->expires_at;
        $timestamp = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expires->toDateTimeString(),  $expires->timezoneName);
        $timestamp = $timestamp->setTimezone('UTC')->toISO8601String();

        return web_app_url('shared_profile', $contact->language, ['token' => $sharedProfile->token]) . "?expireDate={$timestamp}";
    }

    /**
     * Show temporary shared profile.
     *
     * @param $token
     * @return \Illuminate\Support\Facades\Response
     * @deprecated
     */
    public function showShared($token)
    {
        try {
            $member = AlertToken::with('alert.member')
                ->byToken($token)
                ->last48Hours()
                ->firstOrFail()
                ->alert
                ->member;

            if ($account = Sentry::getUser()) {
                Event::fire('member.view-profile.ecp', [$member, $account]);
            }
            else {
                Event::fire('member.view-profile.third-party', [$member]);
            }

            return Response::json($member);

        } catch (Exception $e) {
            return $this->respondWithError('ForbiddenException', 'Not Allowed to view this profile', 403);
        }

    }

    /**
     * Transfer Member to an account.
     *
     * @param $id
     * @return \Illuminate\Support\Facades\Response
     */
    public function transferToAccount($id)
    {
        try {
            $account = Sentry::getUser();

            /** @var Member $member */
            $member = $account->members()->findOrFail($id);

            if ($member->id == $member->account_id) {
                return $this->respondWithError('InvalidOperationException', trans('errors.member.transfer_is_account'), 400);
            }

            $email = Input::get('email');

            $user = \Member::findByEmail($email);

            if ($user && strval($user->id) !== $id){
                return $this->respondWithError('InvalidOperationException', trans('errors.member.transfer_email_in_use'), 400);
            }

            $data = [
                'member' => $member->fullName(),
                'account' => $account->fullName(),
                'transferLink' => $member->generateTransferLink($email)
            ];

            $this->notifyViaEmail($email, 'member-transfer', 'account-invitation', $data, $account->language);

            Event::fire('member.send.transfer-invitation', $member);

            return Response::json(['success' => true, 'message' => trans('messages.member.transfer.success', ['name' => $member->first_name])]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Securely share Member's profile
     *
     * @param $id
     * @return array|\Illuminate\Support\Facades\Response
     * @deprecated
     */
    public function share($id)
    {

        try {
            $account = Sentry::getUser();
            $member = $account->members()->findOrFail($id);

            // Save additional info
            $member->additional_information = Input::get('additional_information');
            $member->save();

            $claims = [
                'type' => Input::get('type'),
                'member' => $member->id
            ];

            switch (Input::get('type')) {
                case 'download':
                    $claims['exp'] = \Carbon\Carbon::now()->addMinutes(1)->timestamp;
                    break;

                case 'email':
                    $claims['exp'] = \Carbon\Carbon::now()->addHours(48)->timestamp;
                    break;

                case 'print':
                case 'view':
                default:
                    $claims['exp'] = \Carbon\Carbon::now()->addMinutes(10)->timestamp;
                    break;

            }

            // Generate custom token
            $token = \IceAngel\Auth\JWT::encrypt($claims);

            return [
                route('pdf.profile', ['token' => $token]),
            ];

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    public function getCovidPublicKeyRecord($public_key){
        $rec = \MemberCovid::where('public_key', $public_key)->get();
        if(count($rec))
            return Response::json(['success' => true, 'data' => $rec ]);
        else
            return Response::json(['success' => false, 'data' => [] ]);
    }
    public function getImmunicationsPublicKeyRecord($public_key){
        $rec = MemberImmunization::where('public_key', $public_key)->get();
        if(count($rec))
            return Response::json(['success' => true, 'data' => $rec ]);
        else
            return Response::json(['success' => false, 'data' => [] ]);
    }
    public function getCovidMemberRecord($member_id){
        $rec = \MemberCovid::where('member_id', $member_id)->get();
        return Response::json(['success' => true, 'data' => $rec ]);

    }
    public function validateCovidRecord(){
        try{
            $data = Input::all();
            App::setLocale(Request::header('Accept-Language'));
            if(isset($data['manufacturer']) && !empty($data['manufacturer']) && isset($data['productname']) && !empty($data['productname']) && isset($data['pcategory']) && !empty($data['pcategory']) && isset($data['srnumber']) && !empty($data['srnumber'])){
                $data['manufacturer'] = trim($data['manufacturer']);
                $data['productname'] = trim($data['productname']);       
                 $check_pro_mf = ManufacturerProdName::getmfprdname($data['manufacturer'],$data['productname']);
                if(!count($check_pro_mf)){
                    return $this->respondWithError('InvalidManuFProdName', trans('errors.covid.wrong_category'), 400);
                }
                if(!ctype_lower($data['pcategory'])){
                    return $this->respondWithError('InvalidCategoryException', trans('errors.covid.wrong_category'), 400);
                }
                $check_cat = Covid::where(['value'=>$data['pcategory']])->get();
                if(!count($check_cat)){
                    return $this->respondWithError('InvalidCategoryException', trans('errors.covid.wrong_category'), 400);
                    //throw new WrongCategoryException('WrongCategoryException', trans('validation.wrongcategory', ['attribute' => 'category']));
                }
                if($data['srnumber'] != '-'){
                    $count = \MemberCovid::where(['pcategory'=>$data['pcategory'],'srnumber'=>$data['srnumber']])->get();
                        if(count($count)>=1){
                            return $this->respondWithError('InvalidSerialNumber', trans('errors.covid.wrong_serialnumber'), 400);
                        }
                        else{
                            return Response::json(['exist' => false]);  
                        }
                }
                else{
                    return Response::json(['exist' => false]);
                }
                
            }
            else{
                throw new ValidationException('ValidationException', trans('validation.required', ['attribute' => 'pcategory,srnumber']));
            }
        }catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors(), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    public function validateCovidRecordWeb(){
        try{
            $data = Input::all();
            App::setLocale(Request::header('Accept-Language'));
            if(isset($data['pcategory']) && !empty($data['pcategory']) && isset($data['srnumber']) && !empty($data['srnumber'])){
                /*if(!ctype_lower($data['pcategory'])){
                    return Response::json(['exist' => true]);
                }
                $check_cat = Covid::where(['value'=>$data['pcategory']])->get();
                if(!count($check_cat)){
                    return Response::json(['exist' => true]);
                }*/
                if($data['srnumber'] != '-'){
                    $count = \MemberCovid::where(['pcategory'=>$data['pcategory'],'srnumber'=>$data['srnumber']])->get();
                        if(count($count)>=1){
                            return Response::json(['exist' => true]);
                        }
                        else{
                            return Response::json(['exist' => false]);  
                        }
                }
                else{
                    return Response::json(['exist' => false]);
                }
                
            }
            else{
                return Response::json(['exist' => true]);
            }
        }catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors(), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    public function validateVaccineRecord(){
        try{
            $data = Input::all();
            App::setLocale(Request::header('Accept-Language'));
            if(isset($data['manufacturer']) && !empty($data['manufacturer']) && isset($data['productname']) && !empty($data['productname']) && isset($data['pcategory']) && !empty($data['pcategory']) && isset($data['srnumber']) && !empty($data['srnumber'])){
                $data['manufacturer'] = trim($data['manufacturer']);
                $data['productname'] = trim($data['productname']);       
                $check_pro_mf = ManufacturerProdName::getmfprdname($data['manufacturer'],$data['productname']);
                if(!count($check_pro_mf)){
                    return $this->respondWithError('InvalidManuFProdName', trans('errors.covid.wrong_category'), 400);
                }
                if($data['pcategory'] ==='covid19'){
                    $check_cat = Immunization::where(['name_en'=>'Covid-19 vaccine'])->get();
                    if(!count($check_cat)){
                        return $this->respondWithError('InvalidCategoryException', trans('errors.covid.wrong_category'), 400);
                        //throw new WrongCategoryException('WrongCategoryException', trans('validation.wrongcategory', ['attribute' => 'category']));
                    }
                }
                else{
                    return $this->respondWithError('InvalidCategoryException', trans('errors.covid.wrong_category'), 400);
                }
                if($data['srnumber'] != '-'){
                    $mem_rec_vac_dt = DB::table('member_immunizations')
                            ->select('member_immunizations.*')
                            ->join('immunizations','immunizations.id','=','member_immunizations.name')
                            ->where(['immunizations.name_en' => 'Covid-19 vaccine','member_immunizations.srnumber'=>$data['srnumber']])
                            ->get();

                    $count = json_decode(json_encode($mem_rec_vac_dt), true);
                    if(count($count)>=1){
                        return $this->respondWithError('InvalidSerialNumber', trans('errors.covid.wrong_serialnumber'), 400);
                    }
                    else{
                        return Response::json(['exist' => false]);  
                    }
                }
                else{
                    return Response::json(['exist' => false]);
                }
                
            }
            else{
                throw new ValidationException('ValidationException', trans('validation.required', ['attribute' => 'manufacturer,pcategory,srnumber,productname']));
            }
        }catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors(), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    public function validateVaccineRecordWeb(){
        try{
            $data = Input::all();
            App::setLocale(Request::header('Accept-Language'));
            if(isset($data['pcategory']) && !empty($data['pcategory']) && isset($data['srnumber']) && !empty($data['srnumber'])){
                /*if($data['pcategory'] ==='vaccine'){
                    $check_cat = Immunization::where(['name_en'=>'Covid-19 vaccine'])->get();
                    if(!count($check_cat)){
                        return Response::json(['exist' => true]);
                    }
                }
                else{
                    return Response::json(['exist' => true]);
                }*/
                if($data['srnumber'] != '-'){
                    $mem_rec_vac_dt = DB::table('member_immunizations')
                            ->select('member_immunizations.*')
                            ->join('immunizations','immunizations.id','=','member_immunizations.name')
                            ->where(['immunizations.name_en' => 'Covid-19 vaccine','member_immunizations.srnumber'=>$data['srnumber']])
                            ->get();

                    $count = json_decode(json_encode($mem_rec_vac_dt), true);
                    if(count($count)>=1){
                        return Response::json(['exist' => true]);
                    }
                    else{
                        return Response::json(['exist' => false]);  
                    }
                }
                else{
                    return Response::json(['exist' => false]);
                }
                
            }
            else{
                return Response::json(['exist' => true]);
            }
        }catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors(), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    public function covidButtonDetail() {

        $buttonDetail = array(
            'title_text' => Request::header('Accept-Language')=='en' ?  'COVID-19' : '新型冠状病毒肺炎',
            'sub_title_text' => Request::header('Accept-Language')=='en' ? 'Smart Pass' : '智能通行证',
            'button_background' => '#6CB616',
            'title_color' => '#FFFFFF',
            'sub_title_color' => '#750400',
            'image_icon_url' => 'https://iceangelid.s3-ap-northeast-1.amazonaws.com/static/images/covid_image.png',
            'global_tracker' => array('text'=>Request::header('Accept-Language')=='en' ? 'COVID-19\nGlobal Tracker':'全球新冠状病毒肺炎\n追踪器','ishide'=>false,'text_color'=>'#FFFFFF','background_color'=>'#F17225','image_url'=>'https://iceangelid.s3-ap-northeast-1.amazonaws.com/static/images/global_tracker.png'),
            'add_certificate_button'=> array('text'=>Request::header('Accept-Language')=='en' ?  'Add\nCertificate' : '创建\n电子检测证明' ,'ishide'=>false,'text_color'=>'#FFFFFF','background_color'=>'#52C139','image_url'=>'https://iceangelid.s3-ap-northeast-1.amazonaws.com/static/images/add_certificate.png'),
            'isShowCovidButton' => true,
            'pages' => array('faq_page'=>Request::header('Accept-Language')=='zh' ? getenv('FRONT_HOME_BASE').'faq?logout=1&lang=zh-CN' : getenv('FRONT_HOME_BASE').'faq?logout=1&lang=en-US' )
        );
        return Response::json(['success' => true, 'data' => $buttonDetail ]);
    }
    public function memberAddCovidRecord(){
        try{
            $data = Input::all(); 
            App::setLocale(Request::header('Accept-Language'));
            if(isset($data['mfname']) && !empty($data['mfname']) && isset($data['pname']) && !empty($data['pname']) && isset($data['pcategory']) && !empty($data['pcategory']) && isset($data['srnumber']) && !empty($data['srnumber'])){
                $data['mfname'] = trim($data['mfname']);
                $data['pname'] = trim($data['pname']);       
                 $check_pro_mf = ManufacturerProdName::getmfprdname($data['mfname'],$data['pname']);
                if(!count($check_pro_mf)){
                    return $this->respondWithError('InvalidManuFProdName', trans('errors.covid.wrong_category'), 400);
                }
                if(!ctype_lower($data['pcategory'])){
                    return $this->respondWithError('InvalidCategoryException', trans('errors.covid.wrong_category'), 400);
                }
                $check_cat = Covid::where(['value'=>$data['pcategory']])->get();
                if(!count($check_cat)){
                    return $this->respondWithError('InvalidCategoryException', trans('errors.covid.wrong_category'), 400);
                }
                if($data['srnumber'] != '-'){
                    $count = \MemberCovid::where(['pcategory'=>$data['pcategory'],'srnumber'=>$data['srnumber']])->get();
                        if(count($count)>=1){
                            return $this->respondWithError('InvalidSerialNumber', trans('errors.covid.wrong_serialnumber'), 400);
                        }
                        else{
                            $exist = false;  
                        }
                }
                else{
                    $exist = false;  
                }
                
            }
            else{
                throw new ValidationException('ValidationException', trans('validation.required', ['attribute' => 'manufacturer,pcategory,srnumber,productname']));
            }
            $member = Member::findOrFail($data['member_id']);
            $gen = new \PHPQRCode\QRcode();
            $qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen);
            $data['public_key'] = md5(rand(100,10000).date('Y-m-d H:i:s').$data['member_id']);
            $qrcodeurl = $qrGenerator->generateAndUploadCovidQR($data['public_key']);
            $data['qrcode'] = $qrcodeurl[0];
            $data['scanned'] = 1;
            $data['fullname'] = $member->fullName();
            \MemberCovid::create($data);
            return Response::json(['success' => true, 'data' => $data]);
                
        }catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors(), 406);
        }
        catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }
    public function memberAddVaccineRecord(){
        try{
            $data = Input::all(); 
            App::setLocale(Request::header('Accept-Language'));
            if(isset($data['mfname']) && !empty($data['mfname']) && isset($data['pname']) && !empty($data['pname']) && isset($data['pcategory']) && !empty($data['pcategory']) && isset($data['srnumber']) && !empty($data['srnumber'])){
                $data['mfname'] = trim($data['mfname']);
                $data['pname'] = trim($data['pname']);       
                $check_pro_mf = ManufacturerProdName::getmfprdname($data['mfname'],$data['pname']);
                if(!count($check_pro_mf)){
                    return $this->respondWithError('InvalidManuFProdName', trans('errors.covid.wrong_category'), 400);
                }
                if($data['pcategory'] ==='covid19'){
                    $check_cat = Immunization::where(['name_en'=>'Covid-19 vaccine'])->get();
                    if(!count($check_cat)){
                        return $this->respondWithError('InvalidCategoryException', trans('errors.covid.wrong_category'), 400);
                    }
                }
                else{
                    return $this->respondWithError('InvalidCategoryException', trans('errors.covid.wrong_category'), 400);
                }
                if($data['srnumber'] != '-'){
                    $mem_rec_vac_dt = DB::table('member_immunizations')
                            ->select('member_immunizations.*')
                            ->join('immunizations','immunizations.id','=','member_immunizations.name')
                            ->where(['immunizations.name_en' => 'Covid-19 vaccine','member_immunizations.srnumber'=>$data['srnumber']])
                            ->get();

                    $count = json_decode(json_encode($mem_rec_vac_dt), true);
                    if(count($count)>=1){
                        return $this->respondWithError('InvalidSerialNumber', trans('errors.covid.wrong_serialnumber'), 400);
                    }
                    else{
                        $exist = false; 
                        unset($data['pcategory']);
                    }
                }
                else{
                    $exist = false;
                    unset($data['pcategory']);
                }
            
            }
            else{
                throw new ValidationException('ValidationException', trans('validation.required', ['attribute' => 'manufacturer,pcategory,srnumber,productname']));
            }
            $member = Member::findOrFail($data['member_id']);
            $immunization = Immunization::where(['name_en'=>'Covid-19 vaccine'])->first();
            $gen = new \PHPQRCode\QRcode();
            $data["name"] = $immunization->id;
            $qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen) ;
            $data['public_key'] = md5(rand(100,10000).date('Y-m-d H:i:s').$data['member_id']);
            $qrcodeurl = $qrGenerator->generateAndUploadVaccineQR($data['public_key']);
            $data['qrcode'] = $qrcodeurl[0];
            $data['scanned'] = 1;
            $data['fullname'] = $member->fullName();
            MemberImmunization::create($data);
            return Response::json(['success' => true, 'data' => $data]);
                
        }catch (ValidationException $e) {
            return $this->respondWithError('ValidationException', $e->getErrors(), 406);
        }
        catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }
    public function deletecovidvaccinerec(){
        try{
            $data = Input::all();
            $deleted_rec = [];
            foreach ($data['deleterec'] as $key => $value) {
                //$member = Member::findOrFail($value['member_id']);
                if($value['type']==='covid19' && $value['isDelete']){
                    $vaccine_rec = MemberImmunization::findOrFail($value['id']);
                    $vaccine_rec->delete();
                    $deleted_rec [] = $value['id'];
                }
                elseif($value['isDelete']){
                    $covid_rec = MemberCovid::findOrFail($value['id']);
                    $covid_rec->delete();
                    $deleted_rec [] = $value['id'];
                }   
            }
            if(count($deleted_rec)){
                return Response::json(['success' => true, 'data' => $deleted_rec]);
            }
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('RecordsNotFound', 'No record', 404);
        }catch (Exception $e) {
            return $this->respondWithError('SystemError', $e->getMessage(), 500);
        }
    }
    public function memberUpdatePhotoID(){
        try {
            $data = Input::all(); 
            $member = Member::findOrFail($data['member_id']);
            $member->photoID = isset($data['photoID']) ? $data['photoID'] : null;
            $member->save();
            return Response::json($member->toArray());

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }
}
