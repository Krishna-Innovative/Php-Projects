<?php namespace IceAngel\Support\Helpers;

use IceAngel\Support\Pdf\MemberProfileTcpdf;
use Illuminate\Support\Str;
use Input;
use TCPDF;
use TCPDF_FONTS;
use Knp\Snappy\Pdf as sPdf;

use Config, View;


class Pdf {

    /**
     * @var QrCode
     */
    private $qrCodeGenerator;

    /**
     * @var \TCPDF
     */
    private $pdfGenerator;

    /**
     * @var string
     */
    private $memberCardTemplate = 'pdf.member_id';

    /**
     * @var string
     */
    private $memberProfileTemplate = 'pdf.member';

    /**
     * @var string
     */
    private $memberCardTrans = 'pdf.card';

    /**
     * @var string
     */
    private $memberProfileTrans = 'pdf.profile';

    /**
     * @var string
     */
    private $language;

    /**
     * @param QrCode $qrCodeGenerator
     */
    function __construct(QrCode $qrCodeGenerator)
    {
        $this->qrCodeGenerator = $qrCodeGenerator;
        $this->language = Config::get('app.locale', 'en');
    }

    /**
     * Download the Member's card
     *
     * @param $member
     * @return \Illuminate\Http\Response
     */
    public function downloadMemberCard($member)
    {
        // Generate Qr Code [url, localFile]
        $qrCode = $this->qrCodeGenerator->generateAndUpload($member->ice_id);

        $name = $member->fullName();
        if (strlen($name) > 26){
            $name = substr($name, 0, 26).'...';
        }
        $data = [
            'fullName' => $name,
            'memberId' => $member->ice_id,
            'qrCode' => $qrCode[1] ? $qrCode[1] : $qrCode[0],
            'language' => \Sentry::getUser()->language,
            'url' => Config::get('front.short_trigger_alert'),
        ];

        $decoration = $this->getDecorations();

        $content = $this->buildMemberCardPdf($data);

        $filename = "iCE_card_{$member->ice_id}.pdf";
        $snappy = new sPdf('/usr/local/bin/wkhtmltopdf');

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename='.$filename);

        $settings = array( 'title' => $decoration['sitename'],
                           'margin-top' => 2,
                           'margin-bottom' => 2,
                           'margin-left' => 8,
                           'margin-right' => 5,
                           );

        return $snappy->getOutputFromHtml($content, $settings);

    }

    public function downloadWeChatMemberCard($member)
    {
        // Generate Qr Code [url, localFile]

        $qrCode = $this->qrCodeGenerator->generateAndUpload($member->ice_id);

        $data = [
            'fullName' => $member->fullName(),
            'memberId' => $member->ice_id,
            'qrCode' => $qrCode[1] ? $qrCode[1] : $qrCode[0],
            'language' => \Sentry::getUser()->language,
            'url' => Config::get('front.short_trigger_alert'),
        ];

        $decoration = $this->getDecorations();

        $content = $this->buildMemberCardPdf($data);  

        $fullFilePath = '/home/iceangel/apps/files/';
        $filename = \Carbon\Carbon::now()->format('YmdHis')."_iCE_card_{$member->ice_id}.pdf";

        $snappy = new sPdf('/usr/local/bin/wkhtmltopdf');
      
        //header('Content-Type: application/pdf');
        //header('Content-Disposition: attachment; filename='.$filename);
              
        $settings = array( 'title' => $decoration['sitename'],
                           'margin-top' => 2,
                           'margin-bottom' => 2,
                           'margin-left' => 8,
                           'margin-right' => 5,
                           );


        $ss =  $snappy->getOutputFromHtml($content, $settings);

        file_put_contents($fullFilePath.$filename, $ss); 
        $input = array('file' => $fullFilePath.$filename, 'type' => 'document', 'filename' => $filename);

        \Input::merge($input);

        $response = \App::make('FileController')->upload()->getData();
        if(file_exists($fullFilePath.$filename))
            unlink($fullFilePath.$filename);
        if (isset($response->url))
            return $response->url;

    }

    private function getDecorations(){
        $language = Input::get('lang', $this->language);
        $sitename = $language === 'zh' ? '天使救援™' : 'iCE Angel - ID™';
        $website = \Config::get('app.url', "https://www.iceangelid.com");
        $logo = $language === 'zh' ? 'logo_print_zh' : 'logo_print';
        $logo = "http://desxv5gnug0kt.cloudfront.net/static/images/{$logo}.png";
        $date = \Carbon\Carbon::now()->format('Y-m-d h:i');

        return compact('sitename', 'website', 'logo', 'date');
    }

    /**
     * Download the Member's profile
     *
     * @param \Member $member
     * @param array $sharedProfile
     * @return \Illuminate\Http\Response
     */
    public function downloadMemberProfile($member, $sharedProfile)
    {
        $data = [
            'profile' => $sharedProfile,
        ];

        $decoration = $this->getDecorations();

        $pdfProfile = $this->buildMemberProfilePdf($member, $data);
        $filename = full_name($member->first_name, $member->last_name, $member->middle_name, null, false, false);

        $filename .= ' '.$decoration['sitename'];
        $filename = str_replace(' ', '_', $filename);

        $snappy = new sPdf('/usr/local/bin/wkhtmltopdf');

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename='.$filename.'.pdf');
        $header = View::make('pdf.header', array('title' =>  $decoration['sitename'], 'logo' => $decoration['logo']))->render();

        $settings = array( 'title' => $decoration['sitename'],
                           'margin-top' => 40,
                           'margin-bottom' => 20,
                           'header-html' => $header,
                           'footer-right' => '[page]/[toPage]',
                           'footer-spacing' => 8,
                           'footer-center' => $decoration['website']);

        return $snappy->getOutputFromHtml($pdfProfile, $settings);

    }

    /**
     * Download the Member's profile
     *
     * @param \Member $member
     * @param array $sharedProfile
     * @return \Illuminate\Http\Response
     */
    public function previewMemberProfile($member, $sharedProfile)
    {
        $data = [
            'profile' => $sharedProfile,
        ];

        $data['profile']['fullname'] = full_name($sharedProfile['first_name'],
                                                 $sharedProfile['last_name'],
                                                 $sharedProfile['middle_name'], null, false);
        header('Content-Type: text/html');
        return $this->buildMemberProfilePdf($member, $data, true);
    }

    /**
     * Generate and download a pdf file
     *
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    private function download($filename = null)
    {
        $filename = $filename ?: Str::quickRandom();

        $this->pdfGenerator->output($filename . '.pdf', 'D');

        ob_end_clean();

        die;
    }

    /**
     * Generate PDF for the Member's card
     *
     * @param $data
     * @return TCPDF
     */
    private function buildMemberCardPdf($data) {

        $trans = trans($this->memberCardTrans, ['short_url' => $data['url']], 'messages', $data['language']);

        $data['memberId'] = trim(chunk_split($data['memberId'], 3, ' '));

        $content = View::make($this->memberCardTemplate, $data, $trans)->render();

        return $content;
    }

    private function buildMemberProfilePdf($member, $data, $preview=false)
    {
        
        // set member profile fullname
        $data['profile']['fullname'] = $member->fullName();

        // decorate data
        $decorated = $this->decorate($data, $preview);

        $content = View::make($this->memberProfileTemplate, $decorated, trans($this->memberProfileTrans, [], 'messages'))->render();

        return $content;
    }

    private function hasFields (array $section){

        $uniqueKeys  = [];

        foreach ($section as $key => $value) {

            foreach ($value as $k => $v) {

                if (is_array($v)){
                    $uniqueKeys = array_merge($uniqueKeys, array_diff_key($v, array('id' => null)));
                }else{
                    $uniqueKeys = array_merge($uniqueKeys, array_diff_key((array)$value, array('id' => null)));
                }
            }
        }

        return count((array)$uniqueKeys) > 0;

    }

    private function hasNonEmptyObjects (array $section){

        $result = array();

        for ($i=0; $i < count($section); $i++) {

            //remove null
            $obj =  array_filter((array)$section[$i], function($var){

                        if (is_array($var)){
                            return !empty(array_filter($var));
                        }
                        return !is_null($var);
                    });


            // id field 
            if (count($obj) > 1){
                $result[] = $section[$i];
                break;
            }
        }

        return count($result) > 0;
    }



    /**
     * Decorate member profile to pdf data.
     *
     * @param $profile
     * @return array
     */
    private function decorate($profile, $preview) {
        $profile = $profile['profile'];

        $profile['birth_date'] = $profile['birth_date']['year'] . '-' . $profile['birth_date']['month'] . '-' . $profile['birth_date']['day'];

        $contacts = [];

        foreach ($profile['contacts'] as $contact) {
            if ($contact['status'] == 'accepted'){
                $contacts[] = $contact;
            }
        }

        // decorate additional information.

        $personal = $profile['additional_information']['personal'];

        foreach ($personal as $key => $value) {
            if (empty($value)){
                unset($personal[$key]);
            }
        }

        if (isset($personal['address']) && is_array($personal['address'])){
            ksort($personal['address']);
        }
        $personal['home_address'] = isset($personal['address']) ? call_user_func('full_address', $personal['address']) : '';
        if (empty($personal['home_address'])){
            unset($personal['home_address']);
            unset($personal['address']);
        } 
        $insurances = $profile['additional_information']['insurances'];

        foreach ($insurances as $key => $insurance) {
            if (count($insurance) == 1 && isset($insurance['id'])){
                $insurances[$key] = null;
            }
        }

        $hasInsurances = $this->hasNonEmptyObjects($insurances);

        $medical = $profile['additional_information']['medical'];

        if (isset($medical['medications'])){
            foreach ($medical['medications'] as $key => $med) {
                if (empty($med)){
                    unset($medical[$key]);
                }else{

                    if (isset($med['dosage_unit']) && empty($med['dosage_unit'])){
                        unset($med['dosage_unit']);
                        unset($med['dosage']);
                    }

                    // medication name is mandatory
                    if (isset($med['frequency_unit']) && isset($med['frequency']) && !isset($med['name']) && $med['frequency_unit'] >= 6 && empty($med['frequency'])){
                        unset($med['frequency_unit']);
                        unset($med['frequency']);
                    }

                }
            }
        }
         if(isset($medical['hospital_records'])){
            for ($j=0; $j < count($medical['hospital_records']); $j++) {
                if (isset($medical['hospital_records'][$j]['file'])){
                    $medical['hospital_records'][$j]['file'] = str_replace(getenv('FLYSYSTEM_CLOUDFRONT_URL'), getenv('FRONT_CDN'), $medical['hospital_records'][$j]['file']);
                }
            }
        }
        if (isset($medical['organ_donor']['card'])){
            $medical['organ_donor']['card'] =
                str_replace(getenv('FLYSYSTEM_CLOUDFRONT_URL'), getenv('FRONT_CDN'), $medical['organ_donor']['card']);
        }

        $hasDoctors       = $this->hasNonEmptyObjects($medical['doctors']);
        $hasBlood         = $this->hasNonEmptyObjects(array($medical['blood']));
        $hasAllergies     = $this->hasNonEmptyObjects($medical['allergies']);
        $hasMedications   = $this->hasNonEmptyObjects($medical['medications']);
        $hasCovidReports     = $this->hasNonEmptyObjects($medical['covid_reports']);
        $hasImmunizations = $this->hasNonEmptyObjects($medical['immunizations']);
        $hasConditions    = $this->hasNonEmptyObjects($medical['medical_conditions']);
        $hasSurgical      = $this->hasNonEmptyObjects($medical['surgical_history']);
        $hasFamilyHistory = $this->hasNonEmptyObjects($medical['family_medical_history']);
        $hasHospitalRecords     = $this->hasNonEmptyObjects($medical['hospital_records']);
        $hasOrgan         = $this->hasNonEmptyObjects(array($medical['organ_donor']));

        $hasMedical = $hasDoctors || $hasBlood || $hasAllergies || $hasMedications || $hasCovidReports || $hasImmunizations || $hasConditions || $hasSurgical || $hasFamilyHistory || $hasHospitalRecords || $hasOrgan;

        $records = $profile['additional_information']['records'];

        for ($i=0; $i < count($records['emergency_messages']); $i++) {
            if (isset($records['emergency_messages'][$i]['file'])){
                $records['emergency_messages'][$i]['file'] = str_replace(getenv('FLYSYSTEM_CLOUDFRONT_URL'), getenv('FRONT_CDN'), $records['emergency_messages'][$i]['file']);
            }
        }

        if (isset($records['living_will']['document'])){

            if (empty($records['living_will']['document'])){
                unset($records['living_will']['document']);
            }else{
                $records['living_will']['document'] =
                    str_replace(getenv('FLYSYSTEM_CLOUDFRONT_URL'), getenv('FRONT_CDN'), $records['living_will']['document']);
            }

        }

        if (isset($records['living_will']['date']) && empty($records['living_will']['date']['year'])){
            unset($records['living_will']['date']);
        }

        if (isset($records['living_will']['notes']) && empty($records['living_will']['notes'])){
            unset($records['living_will']['notes']);
        }


        /*for ($j=0; $j < count($records['hospital_records']); $j++) {
            if (isset($records['hospital_records'][$j]['file'])){
                $records['hospital_records'][$j]['file'] = str_replace(getenv('FLYSYSTEM_CLOUDFRONT_URL'), getenv('FRONT_CDN'), $records['hospital_records'][$j]['file']);
            }
        }*/

        $hasLivingWill          = $this->hasNonEmptyObjects(array($records['living_will']));
        $hasEmergencyMessages   = $this->hasNonEmptyObjects($records['emergency_messages']);
        //$hasHospitalRecords     = $this->hasNonEmptyObjects($records['hospital_records']);

        $hasRecords = $hasLivingWill || $hasEmergencyMessages;

        $hasAdditional = count($personal) > 0 || count($insurances) > 0 || $hasMedical || $hasRecords;

        unset($profile['additional_information']);
        unset($profile['contacts']);

        $decoration = $preview ? $this->getDecorations() : null;

        return compact('profile', 'contacts', 'personal', 'insurances', 'medical', 
                       'hasAdditional',
                       'hasInsurances',
                       'hasMedical', 
                       'hasDoctors',
                       'hasBlood',
                       'hasAllergies',
                       'hasMedications',
                       'hasCovidReports',
                       'hasImmunizations',
                       'hasConditions',
                       'hasSurgical',
                       'hasFamilyHistory',
                       'hasOrgan',
                       'records', 
                       'hasRecords',
                       'hasLivingWill',
                       'hasEmergencyMessages',
                       'hasHospitalRecords', 
                       'decoration');

    }

    /**
     * Get header setting
     * @return array
     */
    private function getHeaderSetting() {
        return [
            "logo" => 'pdf_logo.png',
            "width" => 552,
            "title" => '',
            "header_string" => ''
        ];
    }
}