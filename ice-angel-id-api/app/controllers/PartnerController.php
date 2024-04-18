<?php


use Chrisbjr\ApiGuard\Controllers\ApiGuardController;

class PartnerController extends ApiGuardController {

	protected $apiMethods = [
		'key' => [
			'keyAuthentication' => false
		],
		'updateKey' => [
			'keyAuthentication' => false
		],
	];


	/**
	 * Retrieve basic info for any user given an ice id, requires X-Authorization header
	 *
	 * @return Response
	 */
	public function member($iceId)
	{
		App::setLocale(Request::header('Accept-Language'), 'en');

		try{

			$account = Account::findByIceId((string)$iceId);

			return Response::json([
				'first_name' => $account->first_name,
				'last_name' => $account->last_name,
				'display_name' => full_name($account->first_name, $account->last_name, $account->middle_name, null, false, false),
				'ice_id' => $account->ice_id,
				//'qr_code' => Config::get('front.cdn') . "/media/qr/iCE_{$account->ice_id}.png"
			]);

		}catch (\Exception $e) {

			return $this->response->errorNotFound(trans('errors.member.not_found'));
		}

	}

	public function getUserDetails() {
		$user = $this->apiKey->user;

		return isset($user) ? $user : $this->response->errorNotFound();
	}

	/**
	 * Retrieve api key if account is partner account and exists
	 *
	 * @return Response
	 */
	public function key(){

		try{

			$account = Sentry::getUser();

			if ($account->is_partner){

				$apiKey = Chrisbjr\ApiGuard\Models\ApiKey::where('user_id', $account->id)->first();

				if (!isset($apiKey)){

					return $this->response->errorNotFound();

				}

				return Response::json([
					'key' => $apiKey->key,
					'updated_at' => $apiKey->updated_at,
				]);

			}

			return $this->response->errorForbidden(trans('errors.account.not_partner'));

		}catch (\Exception $ex) {

			return $this->response->errorNotFound(trans('errors.member.not_found'));

		}
	}

	/**
	 * Create or replace partner account API key
	 *
	 * @return Response
	 */
	public function updateKey(){

		try{

			$account = Sentry::getUser();

			if ($account->is_partner){

				$apiKey = Chrisbjr\ApiGuard\Models\ApiKey::where('user_id', $account->id)->first();

				if (!isset($apiKey)){

					$apiKey 			   = new Chrisbjr\ApiGuard\Models\ApiKey;
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

			}

			return $this->response->errorForbidden(trans('errors.account.not_partner'));

		}catch (\Exception $ex) {

			return $this->response->errorNotFound(trans('errors.member.not_found'));

		}
	}

	/**
	 * Remove FIN from partner account
	 *
	 * @return Response
	 */
	public function removeFin($iceId){

		App::setLocale(Request::header('Accept-Language'), 'en');

		try{

			$account = Account::findByIceId((string)$iceId);

			$partner = Sentry::findUserById($this->apiKey['attributes']['user_id']);

			$partner->contactFor()->detach($account->id);

			Event::fire('friend.contact.deleted', [$partner, $account->id]);

			return Response::make('', 204);

		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

			return $this->response->errorWrongArgs(trans('errors.member.not_found'));

		}catch(\Exception $e) {

			return $this->response->errorInternalError(trans('errors.system_error'));
		}
	}

	private function addAccount($data){

		try{

			$first_name = $data[0];
			$last_name = $data[1];
			if(empty($data[2]) || empty($data[3]) || empty($data[4]) || trim($data[2]) == '' || trim($data[3]) == '' || trim($data[4]) == '' ){
				$birth_date = array('year' => null , 'month' => null, 'day' => null);
			}
			else{
				$birth_date = array('year' => $data[2] , 'month' => $data[3], 'day' => $data[4]);
			}



			$nationality = $data[5];
			$gender = $data[6];
			$language = $data[7];
			$mobile = array('code'=>intval($data[8]), 'number'=>$data[9]);
			$email = $data[10];
			$password = empty($data[11]) ? ''.$data[2].$data[3].$data[4] : $data[11];
			if(trim($email) == ''){
				throw new \Exception("Email address is empty", 1);
			}
			$check_email_add = (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
			if(!$check_email_add){
				throw new \Exception("Invalid Email address", 1);
			}
			if(trim($first_name) == ''){
				throw new \Exception("First Name is empty", 1);
			}
			if(trim($last_name) == ''){
				throw new \Exception("Last Name is empty", 1);
			}
			if(empty($data[8]) ){
				throw new \Exception("Country Code is empty", 1);
			}
			if(trim($mobile['number']) =='' || empty($mobile['number'])){
				throw new \Exception("Mobile Number is empty", 1);
			}
			$channels = array('emergency_channel1' 
				=> array('id' => 1,
					'value' => $email,
					'type' => 'email',
					'name' => 'Email'));

			$partner = Sentry::findUserById($this->apiKey['attributes']['user_id']);
			$user = array(
				'email' => $email,			/* mandatory */
				'password' => $password,		/* mandatory  but default to DoB YYYYMMDD*/
				'birth_date' => $birth_date, 	/* mandatory */
				'first_name' => $first_name,
				'last_name' => $last_name,
				'language' => $language,
				'security_question_1' => null,
				'security_question_2' => null,
				'nationality' => $nationality,
				'gender' => $gender,
				'phone' => $mobile,
				  // 'photo' => '',
				'emergency_channels' => $channels,
				'account_id' => $partner->id
			);

				// Create the Account
			$account = Member::create($user);
			$accountGroup = Sentry::findGroupByName('Member');
			$account->addGroup($accountGroup);


			$memberPersonal = new MemberPersonal(array('member_id' => $account->id,
				'home_phone' => array('code' => null, 'number' => null),
				'workplace_phone' => array('code' => null, 'number' => null)));

			$account->attemptActivation($account->getActivationCode());

			$memberPersonal->save();

			    //pre-generate qr code after
			$gen = new \PHPQRCode\QRcode();
			$qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen) ;
			$qrGenerator->generateAndUpload($account->ice_id);

			Event::fire('account.registered', $account);

				//$partner->contactFor()->attach($account->id);

			\Log::info('New Account Pre-registered', $data);

				// insurance_type, company_name, phone(code, number) are required
			if (!empty($data[12]) && !empty($data[13]) && !empty($data[16]) && !empty($data[17])){

				$insurance = array(
					'member_id' => $account->account_id, 
					'insurance_type' => $data[12],
					'company_name' => $data[13],
					'number' => !empty($data[14]) ? trim($data[14]) : '', 
					'plan_type' => !empty($data[15]) ? $data[15] : null, 
					'company_phone' => !empty($data[16]) && !empty($data[17]) ? array('code'=> intval($data[16]), 'number'=>trim($data[17])) : null, 
					'notes' => !empty($data[21]) ? $data[21] : null
				);

				$memberInsurance = new MemberInsurance($insurance);

				if (!empty($data[18]) && !empty($data[19]) && !empty($data[20])){

					$memberInsurance->expiry_date = array( 'year'  => intval($data[18]), 'month' => intval($data[19]), 'day' => intval($data[20]));
				}

				$memberInsurance->save();

				\Log::info('Insurance info saved (pre-registered)', array($email, $data[13]));
			}

			return true;

		} 
		catch (\Cartalyst\Sentry\Users\UserExistsException $e) {

			//return $data[10];
			return $data[10];

		} catch (\Exception $e) {

				// \Log::info('error>>>>>>>>>>>.', (array)$e);
				//return $data[10];
			//return (array)$e;
			if($e->getMessage()=="ValidationException"){
				return $data[10]."(".$e->getErrors().")";  
			}else{
				return $data[10]."(".$e->getMessage().")"; 
			}
		}
	}

	/**
	 * Create Account and (optionally) add partner as ECP
	 *
	 * @return Response
	 */
	public function createAccount(){

		try{

			App::setLocale(Request::header('Accept-Language'), 'en');

			$data = Input::all();


			if (isset($data['birth_date'])){
				
				$data['password'] = ''.$data['birth_date']['year'].$data['birth_date']['month'].$data['birth_date']['day'];

			}

			with(new RegisterAccountValidator())->validate($data);

			$partner = Sentry::findUserById($this->apiKey['attributes']['user_id']);

			$channels = array('emergency_channel1' 
				=> array('id' => 1,
					'value' => $data['email'],
					'type' => 'email',
					'name' => 'Email'));

			$user = array(
				'email' => $data['email'],			/* mandatory */
				'password' => $data['password'],		/* mandatory  but default to DoB YYYYMMDD*/
				'birth_date' => $data['birth_date'], 	/* mandatory */
				'first_name' => isset($data['first_name']) ? $data['first_name'] : null ,
				'last_name' =>  isset($data['last_name']) ? $data['last_name'] : null,
				'language' => null,
				'security_question_1' => null,
				'security_question_2' => null,
				'nationality' =>  isset($data['nationality']) ? intval($data['nationality']) : null,
				'gender' => isset($data['gender']) ? intval($data['gender']) : null,
				'referrer' => isset($data['referrer']) ? $data['referrer'] : $partner->id,
					  // 'phone' => $mobile,
					  // 'photo' => '',
				'emergency_channels' => $channels,);

	            // Create the Account
			$account = Sentry::createUser($user);

			$account->account_id = $partner->id;

			$account->save();

			$accountGroup = Sentry::findGroupByName('Account');
			$account->addGroup($accountGroup);

            //pre-generate qr code after
			$gen = new \PHPQRCode\QRcode();
			$qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen) ;
			$qrGenerator->generateAndUpload($account->ice_id);

			$memberPersonal = new MemberPersonal(array('member_id' => $account->id,
				'home_phone' => array('code' => null, 'number' => null),
				'workplace_phone' => array('code' => null, 'number' => null)));

			$account->attemptActivation($account->getActivationCode());

			$memberPersonal->save();

			Event::fire('account.registered', $account);

			if ( isset($data['partner_ecp']) && ($data['partner_ecp'] === true)){

				//$partner->contactFor()->attach($account->id);

			}

			return Response::json([

				"email" => $account->email,

				"first_name" => $account->first_name,

				"last_name" => $account->last_name,

			], 201);


		} catch (ValidationException $e) {

			return $this->response->errorWrongArgs($e->getMessage());


		} catch (\Exception $e){

			return $this->response->errorInternalError(trans('errors.system_error'));

		}
	}

	 /**
     * Upload a csv file with new account information
     *
     * @return Response
     */

	 public function createAccountsFromFile()
	 {

	 	try {

	 		$path = Request::file('csvfile')->getRealPath();

	 		$file = file($path);
	 		$header_csv_file = array('First Name','Last Name','DOB Year','DOB Month','DOB Day','Nationality','Gender','Language','Country Code','Mobile','Email','Password','Insurance Type','Company Name','Insurance Number','Plan Type','Country Code','Phone Number','Ins Exp Year','Ins Exp Month','Ins Exp Day','Notes');

	 		$created = 0; $failed = [];
			//skip first row of uploaded csv file & matching headers
	 		$uploader_header_str = array_shift($file);
	 		$uploader_header = explode(",",$uploader_header_str);
	 		$uploader_header = array_map('trim', $uploader_header);
	 		$result = array_diff($header_csv_file,$uploader_header);
	 		if(!empty($result)){
	 			return Response::json(array('type'=>'ValidationException', 'data'=>['message'=>'Wrong File Pattern.','created'=>$created]), 200);
	 		}
	 		$partner = Sentry::findUserById($this->apiKey['attributes']['user_id']);
	 		$total_member_limit = isset($partner->plans->member_count) && $partner->plans->member_count > 0 ? $partner->plans->member_count : Plans::where(['is_default'=>1])->pluck('member_count');
	 		$already_added_members = $partner->members->count()-1;
	 		if($already_added_members >= $total_member_limit){
	 			return Response::json(array('type'=>'ExceedLimit', 'data'=>['message'=>'You have already exceeded your limit.','created'=>$created]), 200);
	 		}
	 		foreach ($file as $line) {

	 			$data = str_getcsv($line);

	 			if (count($data) > 1){

	 				$response = $this->addAccount($data);

	 				if($response === true){
	 					$created = $created + 1;
	 					$total_added_members = $already_added_members+ $created;
	 					if($total_added_members >= $total_member_limit){
	 						return Response::json(array('type'=>'ExceedLimit','data'=>['message'=>'You have reached at your limit.','created'=>$created ]), 200);
	 					}
	 				}
	 				else{
	 					$failed[] = $response;
	 				}

	 			}

	 		}

	 		return Response::json(['type'=>'Success','data'=>['created' => $created, 'failed'  => $failed]], 201);

	 	} catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $e) {

	 		return $this->response->errorWrongArgs($e->getMessage());

	 	} catch (Exception $e) {

			// \Log::info('error', (array)$e);

	 		return $this->response->errorInternalError(trans('errors.system_error'));

	 	}
	 }

	 /**
     * Delete a member's contact.
     *
     * @return \Illuminate\Support\Facades\Response
     */

	 public function removeAsEcp($finIceId)
	 {

	 	App::setLocale(Request::header('Accept-Language'), 'en');



	 	try {


	 		$apiKey = Chrisbjr\ApiGuard\Models\ApiKey::where('apiKey', $this->apiKey)->first();

	 		$account = Account::find($apiKey->user_id);

	 		$member = $account->members()->findByIceId($finIceId);

            // $contact = Sentry::findUserById(Input::get('contact_id'));

            // Validate the Contact relationship.
	 		$account->contactFor()->findOrFail($member->id);

	 		$account->contactFor()->detach($member->id);

	 		Event::fire('contact.deleted', [$member, $account]);

	 		return Response::make('', 204);

	 	} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

	 		return $this->respondWithError('MemberNotFoundException', trans('errors.contact.member_not_found'), 404);

	 	} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

	 		return $this->respondWithError('AccountNotFoundException', trans('errors.account.not_found'), 404);

	 	} catch (Exception $e) {

	 		return $this->respondWithError('SystemError', $e->getMessage(), 500);
	 	}

	 }

	 public function createCoupon(){

	 	App::setLocale(Request::header('Accept-Language'), 'en');

	 	Stripe::setApiKey(Config::get('services.stripe.secret'));

	 	try{

	 		$redeem_date = \Carbon\Carbon::now()->addDays(30);

	 		$params = array('percent_off' => 100, 
	 			'duration' => 'once', 
	 			'max_redemptions' => 1, 
	 			'redeem_by' => $redeem_date->timestamp,
	 			'metadata' => array('partner_id' => $this->apiKey->user_id),
	 			'id' => generate_code());

	 		$stripe_coupon = Stripe_Coupon::create($params);

	 		$stripe_coupon->save();

	 		$data = array(
	 			'code' => $params['id'],
	 			'partner_id' => $this->apiKey->user_id,
	 			'account_id' => null);

			//set coupon account when is used

	 		$coupon = Coupon::create($data);

	 		return Response::json([

	 			"coupon" => $stripe_coupon->id,

	 			"valid" => $stripe_coupon->valid,

	 			"times_redeemed" => $stripe_coupon->times_redeemed,

	 			"redeem_by" => $redeem_date->toDateTimeString()

	 		], 201);

	 	}catch(Exception $e){

	 		return $this->respondWithError('SystemError', $e->getMessage(), 500);			

	 	}


	 }

	}
