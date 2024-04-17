<?php
namespace App\Services;

use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Config;
use Exception;

use ReceiptValidator\GooglePlay\Validator as PlayValidator;

class GooglePaymentHandlerService
{
    private $productId;
    private $purchaseToken;

     function __construct($productId, $purchaseToken) {
        $this->productId = $productId;
        $this->purchaseToken = $purchaseToken;
    }

    public function verify()
    {
		
        /* $client = new \Google_Client();
        $client->setApplicationName('Myndfullness');
        $client->setAuthConfig(base_path('pc-api-6500737776379995251-982-8a53026e793b.json'));

        $validator = new PlayValidator(new \Google\Service\AndroidPublisher($client)); */
		 $googleClient = new \Google_Client();
		 $googleClient->setScopes([\Google_Service_AndroidPublisher::ANDROIDPUBLISHER]);
		 $googleClient->setApplicationName('Myndfullness');
		 $googleClient->setAuthConfig(base_path('pc-api-6500737776379995251-982-8a53026e793b.json'));
	
			
        try {
			$googleAndroidPublisher = new \Google_Service_AndroidPublisher($googleClient);
		 $validator = new \ReceiptValidator\GooglePlay\Validator($googleAndroidPublisher);

		 $validator = new PlayValidator(new \Google_Service_AndroidPublisher($googleClient));
		  $response = $googleAndroidPublisher->purchases_subscriptions->get('app.myndfulness', $this->productId, $this->purchaseToken);

          //print_r( $response);
                if (is_null($response)) { 
                    // query returned no data
                    throw new Exception('Error validating transaction.', 500);
                } elseif (isset($response['error']['code'])) { 
                    // query returned an error
                    throw new Exception('Error validating transaction.', 500);
                } elseif (!isset($response['expiryTimeMillis'])) { 
                    // query did not return a subscription expiration time
                    throw new Exception('Error validating transaction.', 500);
                }
                // convert expiration time milliseconds since Epoch to seconds since Epoch
                $start_seconds = $response['startTimeMillis'] / 1000;
                $expiry_seconds = $response['expiryTimeMillis'] / 1000;
                // format seconds as a datetime string and create a new UTC Carbon time object from the string
               $start_date = date("Y-m-d H:i:s", $start_seconds);
               $end_date = $after_grace_period_date = date("Y-m-d H:i:s", $expiry_seconds);
             $end_date = $after_grace_period_date = date("Y-m-d H:i:s", strtotime($end_date.'+2 days'));
                $datetime = new Carbon($end_date);
				
			
                // check if the expiration date is in the past
                if (Carbon::now()->gt($datetime)) {  
                    throw new Exception('Error validating transaction.', 500);
                }
                return $response;

        } catch (Exception $e){
            logger($e);
            return false;
        }
    }

}
