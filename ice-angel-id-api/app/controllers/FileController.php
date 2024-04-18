<?php

use GrahamCampbell\Flysystem\FlysystemManager;
use Intervention\Image\ImageManagerStatic as ImageManager;

use IceAngel\Support\Helpers\QrCode;

class FileController extends ApiController {

    /**
     * @var FlysystemManager
     */
    private $flysystem;

    /**
     * @var array
     */
    private $folders;


    function __construct(FlysystemManager $flysystem)
    {
        $this->flysystem = $flysystem;

        if ($this->flysystem->getDefaultConnection() === 'awss3') {
            $this->folders = Config::get('services.awss3.folders');
        }
    }

    /**
     * Upload a media file: file | photo | qr_code
     *
     * @return Response
     */
    public function upload()
    {
        try {

            $filename = isset($this->folders) ? $this->folders[Input::get('type', 'file')] : '';

            if (Input::hasFile('file') || Input::get('filename')) {

                try {

                    if (Input::hasFile('file') ){

                        $file = Input::file('file');
                        $filename .= uniqid('', true) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                    }else{

                        $file = Input::get('file');
                        $filename .= Input::get('filename');
                    }

                    $stream = file_get_contents($file);

                    if (Input::get('type') === 'photo'){

                        $stream = Image::make(file_get_contents($file))->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->stream()->__toString();

                    }

                    $this->flysystem->write($filename, $stream);

                } catch (Exception $e) {

                    return $this->respondWithError('SystemErrorException', $e->getMessage(), 501);

                }

                return Response::json([
                    'url' => $this->asset($filename)
                ]);

            }
            else {

                return $this->respondWithError('InvalidArgumentException', trans('errors.file.no_file_uploaded'), 406);

            }

        } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $e) {

            return $this->respondWithError('FileException', $e->getMessage(), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemErrorException', $e->getMessage(), 500);

        }

    }

    /**
     * Generate and download an emergency wallpaper
     *
     * @return Response
     */
    public function generateLockscreen()
    {
        try {

	    $id = Input::get('memberid');

	    if(!empty( $id )){
            $account = Sentry::findUserById($id);
	    }else{
 	    $account = Sentry::getUser();
	    }

            App::setLocale(Request::header('Accept-Language'), 'en');

            $gen = new \PHPQRCode\QRcode();

            $qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen) ;

            $qr_url = $qrGenerator->getUrl($account->ice_id);

            $name = full_name($account->first_name, $account->last_name, $account->middle_name, null, false, false);

            $img = Image::make(public_path('assets/images/wp_template.png'));

            $instruction = trans('lockscreen.instructions.emergency');

            $instruction_scan = trans('lockscreen.instructions.scan');

            $instruction_enter = trans('lockscreen.instructions.enter');

            $short_web = getenv('SHORT_TRIGGER_ALERT');

            $site_name = Request::header('Accept-Language') == 'zh' ? '天使救援™' : 'iCE Angel - ID™';

            if (strlen($name) > 26){
                $name = substr($name, 0, 26).'...';
            }

            $text_y = 1150;

            $left_margin = 60;

            $img->text($name, $left_margin, $text_y - 30, function($font) {
                    $font->file(public_path('assets/fonts/ARIALUNI.TTF'));
                    $font->size(50);
                    $font->color('#fff');
                    $font->align('left');
                    // $font->valign('bottom');
            });

            $img->text($instruction, $left_margin, $text_y + 80, function($font) {
                    $font->file(public_path('assets/fonts/ARIALUNI.TTF'));
                    $font->size(45);
                    $font->color('#fff');
                    $font->align('left');
            });

            $img->text($instruction_scan, $left_margin, $text_y + 160, function($font) {
                    $font->file(public_path('assets/fonts/ARIALUNI.TTF'));
                    $font->size(45);
                    $font->color('#fff');
                    $font->align('left');
            });

            $img->text($short_web, $left_margin, $text_y + 240, function($font) {
                    $font->file(public_path('assets/fonts/ARIALUNI.TTF'));
                    $font->size(60);
                    $font->color('#014064');
                    $font->align('left');
            });

            $img->text($instruction_enter, $left_margin, $text_y + 320, function($font) {
                    $font->file(public_path('assets/fonts/ARIALUNI.TTF'));
                    $font->size(45);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('bottom');
            });

            $img->text(format_id((string)$account->ice_id), $left_margin, $text_y + 400, function($font) {
                    $font->file(public_path('assets/fonts/ARIALUNI.TTF'));
                    $font->size(60);
                    $font->color('#014064');
                    $font->align('left');
                    $font->valign('bottom');
            });

            /*$img->text($site_name, 450, $text_y + 480, function($font) {
                    $font->file(public_path('assets/fonts/ARIALUNI.TTF'));
                    $font->size(45);
                    $font->color('#fff');
                    $font->align('left');
                    $font->valign('top');
            });*/
            $sos_image_path = Request::header('Accept-Language') == 'zh' ? 'assets/images/sos_zh_image_arr.png' : 'assets/images/sos_en_image_arr.png';
            $sos_arr = Image::make(public_path($sos_image_path));


            $logo = Image::make(getenv('FLYSYSTEM_CLOUDFRONT_URL') . '/' . $this->folders['static'] . 'images/white_logo.png');

            $logo->resize(null, 60, function ($constraint) {
                    $constraint->aspectRatio();
            });

        $img_y = 380;

            //$img->insert($logo, 'bottom-left', 375, $text_y - $img_y - 110);
            $img->insert($sos_arr, 'top-left', 0,0);

            if(!is_null($qr_url)){

                $qr_code = Image::make($qr_url);

                $qr_code->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->insert($qr_code, 'bottom-right', 60, $text_y - $img_y);

            }

            $download = $img->encode('jpg');

            $filename = isset($this->folders) ? $this->folders['lockscreen'] : '';

            $filename .= 'lock_'.$account->ice_id.'.jpg';

            $this->flysystem->put($filename, $download->stream('jpg', 60));

            //bypass CDN
            return Response::json([
                    'url' => 'https://s3-'. getenv('FLYSYSTEM_S3_BUCKET_REGION') . '.amazonaws.com/' . getenv('FLYSYSTEM_S3_BUCKET') . '/' . $filename
                ]);

        } catch (Exception $e) {

            return $this->respondWithError('SystemErrorException', $e->getMessage(), 500);

        }
    }

    /**
     * Generate an asset path for the uploaded file.
     *
     * @param $filename
     * @param bool $secure
     * @return string
     */
    private function asset($filename, $secure = false)
    {
        if ($this->flysystem->getDefaultConnection() === 'local') {

            return asset('uploads/' . $filename, $secure);

        } else {
            // assumes awss3
            return getenv('FLYSYSTEM_CLOUDFRONT_URL') . '/' . $filename;

        }
    }

}
