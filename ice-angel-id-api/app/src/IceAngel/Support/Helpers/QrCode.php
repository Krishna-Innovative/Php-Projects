<?php namespace IceAngel\Support\Helpers;

use Config;

class QrCode {

    /**
     * @var \PHPQRCode\QRcode
     */
    private $generator;

    /**
     * @var string
     */
    private $alertUrl;

    /**
     * @var string
     */
    private $covidUrl;

    /**
     * @var string
     */
    private $vaccineUrl;

    /**
     * @var string
     */
    private $tempPath = '/tmp';

    /**
     * @var string
     */
    private $prefix = 'iCE_';

    /**
     * @param \PHPQRCode\QRcode $generator
     */
    function __construct(\PHPQRCode\QRcode $generator)
    {
        $this->generator = $generator;

        $this->alertUrl = web_app_url('trigger_alert', \App::getLocale(), ['query' => '']);

        $this->covidUrl = web_app_url('covid_alert', \App::getLocale(), ['token' => '']);

        $this->vaccineUrl = web_app_url('vaccine_alert', \App::getLocale(), ['token' => '']);
    }

    /**
     * Get the application url to trigger an alert
     *
     * @return string
     */
    public function getAlertUrl()
    {
        return $this->alertUrl;
    }

    /**
     * Get the application url to covid trigger an alert
     *
     * @return string
     */
    public function getCovidUrl()
    {
        return $this->covidUrl;
    }

     /**
     * Get the application url to covid trigger an alert
     *
     * @return string
     */
    public function getVaccineUrl()
    {
        return $this->vaccineUrl;
    }

    /**
     * Set trigger an alert url
     *
     * @param string $alertUrl
     */
    public function setAlertUrl($alertUrl)
    {
        $this->alertUrl = $alertUrl;
    }

    /**
     * Set trigger an covid alert url
     *
     * @param string $alertUrl
     */
    public function setCovidUrl($covidUrl)
    {
        $this->covidUrl = $covidUrl;
    }

    /**
     * Set trigger an covid alert url
     *
     * @param string $alertUrl
     */
    public function setVaccineUrl($vaccineUrl)
    {
        $this->vaccineUrl = $vaccineUrl;
    }

    /**
     * Generate a QrCode link to trigger an alert with memberId appended
     *
     * @param string $memberId
     * @param null $path
     * @return string the path to the generated QrCode
     */
    public function generateMemberId($memberId, $path = null)
    {
        $url = $this->getAlertUrl() . "?memberId=" . $memberId;

        return $this->generate($url, $path);
    }

    /**
     * Generate a QrCode link to trigger an alert with memberId appended
     *
     * @param string $publicKey
     * @param null $path
     * @return string the path to the generated QrCode
     */
    public function generateCovidPublicKey($public_key, $path = null)
    {
        $url = $this->getCovidUrl() .  $public_key;

        return $this->generate($url, $path);
    }

    /**
     * Generate a QrCode link to trigger an alert with memberId appended
     *
     * @param string $publicKey
     * @param null $path
     * @return string the path to the generated QrCode
     */
    public function generateVaccinePublicKey($public_key, $path = null)
    {
        $url = $this->getVaccineUrl() .  $public_key;

        return $this->generate($url, $path);
    }

    /**
     * Generate a QrCode and save it in the given path if provided
     *
     * @param $content
     * @param null $path
     * @return null|string
     */
    public function generate($content, $path = null)
    {
        $path = $path ?: $this->tempPath . '/qr_' . uniqid() . '.png';

        $this->generator->png($content, $path, 'L', 4, 2);

        return $path;
    }

    public function generateAndUploadCovidQR($publicKey, $path = null){

        // clean up existing codes
        $files = glob($this->tempPath . '/qr_*');
        foreach($files as $qr_file){ 
          if(is_file($qr_file))
            unlink($qr_file); 
        }

        if (getenv('FLYSYSTEM_DRIVER') === 'local'){
            return array(null, $this->generateCovidPublicKey($publicKey, $path));
        }

        // checks if online
        $url = $this->getUrl($publicKey);

        if ($url){
            return array($url, null);
        }

        $localFile = $this->generateCovidPublicKey($publicKey, $path);

        $input = array('file' => $localFile, 'type' => 'qr_code', 'filename' => $this->prefix . $publicKey . '.png');

        \Input::merge($input);

        $response = \App::make('FileController')->upload()->getData();

        // uploaded
        if (isset($response->url))
            return array($response->url, $localFile);

        return array($url, $localFile);
    }

    public function generateAndUploadVaccineQR($publicKey, $path = null){

        // clean up existing codes
        $files = glob($this->tempPath . '/qr_*');
        foreach($files as $qr_file){ 
          if(is_file($qr_file))
            unlink($qr_file); 
        }

        if (getenv('FLYSYSTEM_DRIVER') === 'local'){
            return array(null, $this->generateVaccinePublicKey($publicKey, $path));
        }

        // checks if online
        $url = $this->getUrl($publicKey);

        if ($url){
            return array($url, null);
        }

        $localFile = $this->generateVaccinePublicKey($publicKey, $path);

        $input = array('file' => $localFile, 'type' => 'qr_code', 'filename' => $this->prefix . $publicKey . '.png');

        \Input::merge($input);

        $response = \App::make('FileController')->upload()->getData();

        // uploaded
        if (isset($response->url))
            return array($response->url, $localFile);

        return array($url, $localFile);
    }

    public function generateAndUpload($memberId, $path = null){

        // clean up existing codes
        $files = glob($this->tempPath . '/qr_*');
        foreach($files as $qr_file){ 
          if(is_file($qr_file))
            unlink($qr_file); 
        }

        if (getenv('FLYSYSTEM_DRIVER') === 'local'){
            return array(null, $this->generateMemberId($memberId, $path));
        }

        // checks if online
        $url = $this->getUrl($memberId);

        if ($url){
            return array($url, null);
        }

        $localFile = $this->generateMemberId($memberId, $path);

        $input = array('file' => $localFile, 'type' => 'qr_code', 'filename' => $this->prefix . $memberId . '.png');

        \Input::merge($input);

        $response = \App::make('FileController')->upload()->getData();

        // uploaded
        if (isset($response->url))
            return array($response->url, $localFile);

        return array($url, $localFile);
    }

    /**
     * Generate and verify QR url, null if invalid
     *
     * @param $memberId
     * @return null|string
     */
    public function getUrl ($memberId){

        $url = getenv('FLYSYSTEM_CLOUDFRONT_URL') . '/' . Config::get('services.awss3.folders.qr_code') . $this->prefix . $memberId . '.png';

        return $this->isValid($url) ? $url : null;

    }

    public function isValid($imageUrl){

        stream_context_set_default(array(
            'http' => array(
                'method' => 'HEAD'
            )
        ));

        $headers = get_headers($imageUrl, 1);

        if (strpos($headers[0], '200') === false) {
            return false;
        }

        if (isset($headers['Content-Type']) && 0 === strncmp($headers['Content-Type'], 'image/', 6)) {
            return true;
        } else {
            return false;
        }
    }


}