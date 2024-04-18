<?php

use Stripe as Stripe;
// use Stripe_Coupon as Coupon;
use Stripe_InvalidRequestError as Stripe_InvalidRequestError;

use Requests;

// use \Stripe\Stripe as Stripe;
// use \Stripe\Coupon as Coupon;

// use \Stripe\Charge as Charge;
// use \Stripe\Customer as Customer;

class PurchasesController extends ApiController {

	/**
     * @var private key
     */
    private $privateKey;

    /**
     * @param SyncDevice $syncDevice
     */
    function __construct()
    {

		Account::setStripeKey(Config::get('services.stripe.secret'));

		\Stripe::setApiVersion("2015-02-10");

    }

     /**
     * Subscribe to premium for one year
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function subscribeYearly()
    {

		$data = Input::all();

		try{

			$couponCode = $data['coupon'];

			$token = $data['token'];


			$isCouponBin = $this->isCouponBin($couponCode);

			if (!empty($couponCode)){

				if ($isCouponBin){

					$couponCode = $this->createCouponFromBin($couponCode);

				}else{

			        if(!$this->isCouponValid($couponCode)){

						return $this->respondWithError('CouponNotFoundException', trans('errors.payment.coupon_not_found'), 404);

					}

				}

			}

			$account = Account::find($data['member_id']);
			$full_name = full_name($account->first_name, $account->last_name, $account->middle_name, null, false, false);

			// $sub_params = array('plan' => Config::get('services.stripe.yearly_plan'), 'billing' => 'send_invoice', 'days_until_due' => 8);

			// free year with coupon
			if (isset($data['is_free']) && $data['is_free'] == true && is_null($data['token'])){

				$coupon = $this->getCoupon($couponCode);

				if (!is_null($coupon) && $coupon['valid'] && $coupon['percent_off'] == 100){

					$stripe_customer = Stripe_Customer::create(array(
						"description" => "Account: {$account->id} | Name: {$full_name} | iCE ID: {$account->ice_id}",
						'email'  =>	$account->email,
						'plan' => Config::get('services.stripe.yearly_plan'),
						'coupon' => $couponCode
					));

					$subscription_id = $account->subscription(Config::get('services.stripe.yearly_plan'))
										->getStripeCustomer($stripe_customer->id)['subscriptions']['data'][0]['id'];
					$account
						->setStripeId($stripe_customer->id)
						->setStripeSubscription($subscription_id)
						->setStripePlan(Config::get('services.stripe.yearly_plan'))
						->setLastFourCardDigits(null)
						->setStripeIsActive(true)
						->setSubscriptionEndDate(null)
						->saveBillableInstance();

					$this->storeCoupon($couponCode, $account->id);

					// Stripe_Customer::retrieve($account->stripe_id)->updateSubscription($sub_params)->save();

					\Log::info(":money_with_wings: Coupon redeemed ", array('coupon' => $couponCode, 'stripe ID' => $stripe_customer->id));

					return Response::json(array('success' => $account->subscribed(), 'promo' =>  !empty($couponCode) ? 'coupon' : null ));

				}else{
					
					return $this->respondWithError('CouponNotFoundException', trans('errors.payment.coupon_not_found'), 404);

				}
			}


			//regular subscription
			if (empty($couponCode)){

				$account->subscription(Config::get('services.stripe.yearly_plan'))->create($token['id'], array(
						"description" => "Account: {$account->id} | Name: {$full_name} | iCE ID: {$account->ice_id}",
						'email'  =>	$account->email,
						));
			}else{

				$account->subscription(Config::get('services.stripe.yearly_plan'))->withCoupon($couponCode)->create($token['id'], array(
					"description" => "Account: {$account->id} | Name: {$full_name} | iCE ID: {$account->ice_id}",
					'email'  =>	$account->email,
					));

				$this->storeCoupon($couponCode, $account->id);
			}

			// subscription billing from auto recur `charge_automatically` to recurrent with user invoice `send_invoice`
			// Stripe_Customer::retrieve($account->stripe_id)->updateSubscription($sub_params)->save();

			$retCode = $isCouponBin ? 'bin' : (!empty($couponCode) ? 'coupon' : null);

			return Response::json(array('success' => $account->subscribed(), 'promo' => $retCode));

		} catch (Exception $e) {

            return $this->respondWithError('SystemErrorException', trans('errors.system_error'), 500);

        }

    }

     public function subscribeYearlyByPostman()
    {

		$data = Input::all();

		try{

			$key = $data['key'];

			if($key !== '5rperauABIQ6*KNFkrUFMoRFS'){

				return Response::json(array('success' =>false, 'message' => 'Key Not found/matched'),201);
			}
			
			$couponCode = $data['coupon'];		

			$token = $data['token'];

			$isCouponBin = $this->isCouponBin($couponCode);

			if (!empty($couponCode)){

				if ($isCouponBin){

					$couponCode = $this->createCouponFromBin($couponCode);
					
				}else{
					
					
			        if(!$this->isCouponValid($couponCode)){

						return $this->respondWithError('CouponNotFoundException', trans('errors.payment.coupon_not_found'), 404);

					}

				}

			}

			//$account = Account::find($data['member_id']);
			$email = $data['email'];
			$partner = Sentry::findUserByLogin($email);
			
			$account = Account::find($partner->id);
			
			$full_name = full_name($account->first_name, $account->last_name, $account->middle_name, null, false, false);

			// $sub_params = array('plan' => Config::get('services.stripe.yearly_plan'), 'billing' => 'send_invoice', 'days_until_due' => 8);

			// free year with coupon
			if (isset($data['is_free']) && $data['is_free'] == true && is_null($data['token'])){

				$coupon = $this->getCoupon($couponCode);
				
				if (!is_null($coupon) && $coupon['valid'] && $coupon['percent_off'] == 100){

					$stripe_customer = Stripe_Customer::create(array(
						"description" => "Account: {$account->id} | Name: {$full_name} | iCE ID: {$account->ice_id}",
						'email'  =>	$account->email,
						'plan' => Config::get('services.stripe.yearly_plan'),
						'coupon' => $couponCode
					));

					$subscription_id = $account->subscription(Config::get('services.stripe.yearly_plan'))
										->getStripeCustomer($stripe_customer->id)['subscriptions']['data'][0]['id'];
					$account
						->setStripeId($stripe_customer->id)
						->setStripeSubscription($subscription_id)
						->setStripePlan(Config::get('services.stripe.yearly_plan'))
						->setLastFourCardDigits(null)
						->setStripeIsActive(true)
						->setSubscriptionEndDate(null)
						->saveBillableInstance();

					$this->storeCoupon($couponCode, $account->id);

					// Stripe_Customer::retrieve($account->stripe_id)->updateSubscription($sub_params)->save();

					//\Log::info(":money_with_wings: Coupon redeemed ", array('coupon' => $couponCode, 'stripe ID' => $stripe_customer->id));

					return Response::json(array('success' => $account->subscribed(), 'promo' =>  !empty($couponCode) ? 'coupon' : null ));

				}else{
					
					return $this->respondWithError('CouponNotFoundException', trans('errors.payment.coupon_not_found'), 404);

				}
			}


			//regular subscription
			if (empty($couponCode)){

				$account->subscription(Config::get('services.stripe.yearly_plan'))->create($token['id'], array(
						"description" => "Account: {$account->id} | Name: {$full_name} | iCE ID: {$account->ice_id}",
						'email'  =>	$account->email,
						));
			}else{

				$account->subscription(Config::get('services.stripe.yearly_plan'))->withCoupon($couponCode)->create($token['id'], array(
					"description" => "Account: {$account->id} | Name: {$full_name} | iCE ID: {$account->ice_id}",
					'email'  =>	$account->email,
					));

				$this->storeCoupon($couponCode, $account->id);
			}

			// subscription billing from auto recur `charge_automatically` to recurrent with user invoice `send_invoice`
			// Stripe_Customer::retrieve($account->stripe_id)->updateSubscription($sub_params)->save();

			$retCode = $isCouponBin ? 'bin' : (!empty($couponCode) ? 'coupon' : null);

			return Response::json(array('success' => $account->subscribed(), 'promo' => $retCode));

		} catch (Exception $e) {
			//\Log::info('Coupon check Exception', array($e));
            return $this->respondWithError('SystemErrorException', trans('errors.system_error'), 500);
        }
    }


    private function storeCoupon($couponCode, $accountId, $partnerId = null){

		$couponRecord = Coupon::findByCode($couponCode);

		if (is_null($couponRecord)){
			$values = array('code' => $couponCode,
							'partner_id' => $partnerId,
							'account_id' => $accountId);

			$couponRecord = Coupon::create($values);
		
		}else{
			$couponRecord->account_id = $accountId;
			$couponRecord->save();
		}
    }

    public function cancelYearly()
    {
		try{

			$account = Sentry::getUser();

			if ($account->is_lifetime){

				return Response::json(array('on_grace' => $account->onGracePeriod(), 'ends_at' => null));
			}

			$account->subscription(Config::get('services.stripe.yearly_plan'))->cancel();

			$ends_at = null;

			if (!is_null($account->getSubscriptionEndDate())){

                $ends_at =  $account->getSubscriptionEndDate();

				$ends_at = array('year'=> $ends_at->year, 'month'=> $ends_at->month, 'day'=> $ends_at->day);
			}
			
			return Response::json(array('on_grace' => $account->onGracePeriod(), 'ends_at' => $ends_at));

		} catch(Exception $e){

			return $this->respondWithError('SystemErrorException', trans('errors.system_error'), 500);

		}

	}


    public function resumeYearly()
	{
		try{

			$account = Sentry::getUser();

			if ($account->is_lifetime){

				return Response::json(array('on_grace' => $account->onGracePeriod(), 'ends_at' => null));
			}

			$account->subscription(Config::get('services.stripe.yearly_plan'))->resume();

			$ends_at = null;

			if (!is_null($account->getSubscriptionEndDate())){
		
                $ends_at =  $account->getSubscriptionEndDate();

				$ends_at = array('year'=> $ends_at->year, 'month'=> $ends_at->month, 'day'=> $ends_at->day);
		
			}

			return Response::json(array('on_grace' => $account->onGracePeriod(), 'ends_at' => $ends_at));

		} catch(Exception $e){

			return $this->respondWithError('SystemErrorException', trans('errors.system_error'), 500);

		}

	}

	public function checkCoupon(){

		$couponCode = Input::get('coupon');

		try{

			if ($this->isCouponBin($couponCode)){
				$couponCode = $this->createCouponFromBin($couponCode);
			}

			$coupon = $this->getCoupon($couponCode);

			if (!is_null($coupon)){

				return Response::json(array(
					'id' => $coupon['id'],
					'amount_off' => $coupon['amount_off'],
					'duration' => $coupon['duration'],
					'duration_in_months' => $coupon['duration'] == 'once' ? 12 : $coupon['duration_in_months'],
					'percent_off' => $coupon['percent_off'],
					'valid' => $coupon['valid']
				));

			}

			return Response::make('', 404);
		
		}catch(Exception $e) {

			\Log::info('Coupon check Exception', array($e));
			return $this->respondWithError('SystemErrorException', trans('errors.system_error'), 500);

		}

	}

	private function getCoupon($code){
		
		Stripe::setApiKey(Config::get('services.stripe.secret'));

		try {

			$coupon = Stripe_Coupon::retrieve($code);

			return $coupon;

		} catch(Exception $e) {

			return null;

		}

	}


	private function isCouponValid($coupon)
	{
		if (empty($coupon)){

			return false;
		}

		return !is_null($this->getCoupon($coupon));
	
	}

	private function isCouponBin($bin){
		
		$binCodes = array();

		return in_array(trim($bin), $binCodes);
	}

	private function createCouponFromBin($bin, $prefix = 'VC') {

		try{

			Stripe::setApiKey(Config::get('services.stripe.secret'));

			\Stripe::setApiVersion("2015-02-10");


			//VC: Visa China
			$coupon_id = $prefix . generate_code();

			// $redeem_date = \Carbon\Carbon::now()->addDays(30);

			//TODO: bind to visa account id
			$partner_id = null;

			$params = array('percent_off' => 100,
							'duration' => 'once',
							'max_redemptions' => 1,
							// 'redeem_by' => $redeem_date->timestamp,
							'metadata' => array('partner_id' => $partner_id, 'promo_prefix' => $prefix),
							'id' => $coupon_id);

			$stripe_coupon = Stripe_Coupon::create($params);
			$stripe_coupon->save();
			$values = array('code' => $coupon_id,
							'partner_id' => $partner_id,
							'account_id' => null);

			$coupon = Coupon::create($values);

			return $coupon->code;

		}catch(Exception $e){

			return $this->respondWithError('SystemErrorException', trans('errors.system_error'), 500);

		}

	}
	
	/**
     * Make payment through Alipay
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function chargeAlipay()
    {

		try{
			$request = Input::all();
			$sourceObj = $request['data']['object'];
			$amountToBeCharged = $sourceObj['amount'];
			$currencyToCharge = $sourceObj['currency'];
			$source = $sourceObj['id'];
			$email = $sourceObj['owner']['email'];

			\Requests::register_autoloader();

			$url = "https://api.stripe.com/v1/charges";
			$headers = array();
			$data = array(
				'amount' => $amountToBeCharged,
				'currency' => $currencyToCharge,
				'source' => $source
			);
			$options = array('auth' => array(Config::get('services.stripe.secret'), ''));
			$charge = \Requests::post($url, $headers, $data, $options);
			$chargeResponse = \json_decode($charge->body);

			$chargeStatus = $chargeResponse->status;
			$chargePaid = $chargeResponse->paid;
			$chargeAmount = $chargeResponse->amount;
			$chargeCurrency = $chargeResponse->currency;

			if($chargePaid==true && $chargeStatus=="succeeded" && $chargeAmount==$amountToBeCharged && $chargeCurrency==$currencyToCharge){

				$subscriptionEnds = \Carbon\Carbon::now()->addYear();

				$user = \Member::findByEmail($email);
				$user->stripe_id =  $chargeResponse->id;
				$user->stripe_subscription = $chargeResponse->balance_transaction;
				$user->stripe_plan = Config::get('services.stripe.yearly_plan');
				$user->subscription_ends_at = $subscriptionEnds;
				$user->save();

				$sub_params = array('plan' => Config::get('services.stripe.yearly_plan'), 'billing' => 'send_invoice', 'days_until_due' => 8);

				Stripe_Customer::retrieve($user->stripe_id)->updateSubscription($sub_params)->save();

				\Log::info(':yen:Alipay payment complete', array($email));

				return Response::make('', 200);
			}

		} catch(Exception $e){
			\Log::info('Alipay error', array($e));
			return $this->respondWithError('SystemErrorException', trans('errors.system_error'), 500);
		}
	}

	public function failedAlipay(){
		$request = Input::all();
                $email = $request['data']['object']['owner']['email'];
                \Log::info(':yen:Alipay payment failed', array($email));
		return Response::make('', 200);
	}

	public function canceledAlipay(){
		$request = Input::all();
                $email = $request['data']['object']['owner']['email'];
 		\Log::info(':yen:Alipay payment canceled', array($email));
		return Response::make('', 200);
	}
	public function gettingCovidDetail(){
		try{
			$request = Input::all();
			if(isset($request['url'])){
				$url = $request['url'];
				$headers = isset($request['headers']) ? $request['headers']: array();
				$data = isset($request['data']) ? $request['data']: array();
				$options = isset($request['options']) ? $request['options']: array();
				$charge = \Requests::get($url, $headers, $data, $options);
				if(isset($charge) && !empty($charge) && isset($charge->body)){
					 return Response::json([$charge->body]);
				}
				else{
					return Response::json(['data'=>'']);
				}
			}
		}
		catch(Exception $e){
			return $this->respondWithError('InvalidURL', trans('validation.active_url',['attribute' => $request['url']]), 403);
		}	
	}


}
