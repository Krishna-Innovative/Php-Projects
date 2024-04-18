<?php

class PdfController extends ApiController
{

    /**
     * Print the member's iCE Angel - ID
     *
     * @param $memberId
     * @return \Illuminate\Support\Facades\Response
     */
    public function printIceId($memberId)
    {
        try {

            $token = Input::get('token');

            $decryptedToken = IceAngel\Auth\JWT::decrypt($token);

            $account = Sentry::findUserById($decryptedToken->uid);

            $member = $account->members()->findOrFail($memberId);

            // Generate QR code for specific ice id.
            $qr_image = public_path(\Config::get('app.qrcode', "tmp/qrcode.png"));

            \PHPQRCode\QRcode::png(web_app_url('trigger_alert', $account->language, ['query' => "?memberId={$member->ice_id}"]), $qr_image, 'L', 4, 0);

            ob_start();

            $html = View::make('pdf.member_id', ['member' => $member->toArray(), 'qr_code' => $qr_image])->render();

            Event::fire('member.print.iceangel_id', [$member]);

            return PDF::load($html, 'A4', 'portrait')->download($member->ice_id);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * View member's profile.
     *
     * @param $memberId
     * @return \Illuminate\Support\Facades\Response
     * @deprecated
     */
    public function viewProfile($memberId)
    {
        try {

            $token = Input::get('token');

            $decryptedToken = IceAngel\Auth\JWT::decrypt($token);

            $account = Sentry::findUserById($decryptedToken->uid);

            $member = $account->members()->findOrFail($memberId);

            ob_start();

            $html = View::make('pdf.member', ['member' => $member->toArray()])->render();

            return PDF::load($html, 'A4', 'portrait')->show($member->ice_id);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Download member's profile.
     *
     * @param $memberId
     * @return \Illuminate\Support\Facades\Response
     * @deprecated
     */
    public function downloadProfile($memberId)
    {
        try {

            $token = Input::get('token');

            $decryptedToken = IceAngel\Auth\JWT::decrypt($token);

            $account = Sentry::findUserById($decryptedToken->uid);

            $member = $account->members()->findOrFail($memberId);

            ob_start();

            $html = View::make('pdf.member', ['member' => $member->toArray()])->render();

            return PDF::load($html, 'A4', 'portrait')->download($member->ice_id);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Securily show/print Member's profile
     *
     * @param $token
     * @return mixed
     */
    public function profile($token)
    {
        try {
            $decryptedToken = \IceAngel\Auth\JWT::decrypt($token);

            $type = $decryptedToken->type;
            $member = Member::findOrFail($decryptedToken->member);

            ob_start();

            // Load Profile template
            $content = View::make('pdf.member', ['member' => $member->toArray()])->render();

            $pdf = PDF::load($content, 'A4', 'portrait');

            switch ($type) {
                case 'download':
                case 'save':
                    return $pdf->download($member->ice_id);
                    break;

                case 'print':
                case 'view':
                case 'email':
                default:
                    return $pdf->show($member->ice_id);
                    break;

            }

        } catch (Exception $e) {
            return Response::make('forbidden', 403);
        }

    }

} 