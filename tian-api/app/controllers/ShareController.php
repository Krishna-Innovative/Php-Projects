<?php

use IceAngel\Support\Helpers\Pdf;

class ShareController extends ApiController {

    use \IceAngel\Traits\NotificationHelpersTrait;

    /**
     * @var Pdf
     */
    private $pdfGenerator;

    function __construct(Pdf $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    /**
     * Show the contact permissions to access the member's profile
     *
     * @param int $mid the member id
     * @param int $cid the contact id
     * @return mixed
     */
    public function showContactPermission($mid, $cid)
    {
        $permissions = MemberContactPermission::findByRelation($mid, $cid);

        if ( ! is_null($permissions)) {
            return $permissions;
        }

        $member = Member::find($mid);

        return Response::json(['permissions' => $member->defaultPermissions()]);
    }

    /**
     * Update the contact permissions to access the member's profile
     *
     * @param $mid
     * @param $cid
     * @return mixed
     */
    public function updateContactPermission($mid, $cid)
    {
        $permissions = MemberContactPermission::findByRelation($mid, $cid);

        if (is_null($permissions)) {
            $permissions = MemberContactPermission::create([
                'member_id' => $mid,
                'contact_id' => $cid,
                'permissions' => [],
            ]);
        }

        $permissions->permissions = Input::get('permissions', []);
        $permissions->save();

        Event::fire('member.contact.update-permissions', Member::find($mid));

        return $permissions;
    }

    /**
     * Handle different share methods
     *
     * @param $mid
     * @return array|\Illuminate\Support\Facades\Response
     */
    public function share($mid)
    {

        /** @var Member $member */
        $member = Member::findOrFail($mid);

        if (Input::has('contact_id') && !$member->hasContact(Input::get('contact_id'))) {
            return $this->respondWithError('Unacceptable', trans('errors.contact.not_allowed_operation'), 406);
        }

        switch (Input::get('type')) {
            case 'email':
                return $this->shareViaEmail($member);
                break;

            case 'download-member-id':
                return $this->downloadMemberId($member);
                break;

            case 'download-member-profile':
                return $this->downloadMemberProfile($member);
                break;

            case 'print':
                return $this->previewMemberProfile($member);
                break;
            case 'download-wechat-member-id':
                return $this->downloadWeChatMemberId($member);
                break;

            default:
                return Response::make('', 406);
                break;
        }
    }

    /**
     * Handle printer
     *
     * @param $mid
     * @return array|\Illuminate\Support\Facades\Response
     */
    public function printProfile($token)
    {
        $sharedProfile = MemberSharedProfile::findByTokenOrFail($token);
        
        $member = Member::findOrFail($sharedProfile->member_id);
        
        return $this->previewMemberProfile($member);
    }

    /**
     * forwardByEmail
     *
     * @param $mid
     * @return array|\Illuminate\Support\Facades\Response
     */
    public function forwardProfile($token)
    {
        $sharedProfile = MemberSharedProfile::findByTokenOrFail($token);
        
        if (!is_null($email = Input::get('email'))) {

             $member = Member::findOrFail($sharedProfile->member_id);

            $data = [
                'url' => $sharedProfile->publicProfileUrl(),
                'member' => $member->fullName(),
            ];

            if (!in_array($language = Input::get('language'), Config::get('app.supported_languages'))) {
                $language = $member->account->language;
            }

            $this->notifyViaEmail(
                $email,
                'share-profile',
                'share-profile',
                $data,
                $language
            );

            return Response::json(['success' => true]);
        }

        return $this->respondWithError('MissingEmailException', trans('validation.required', ['attribute' => 'email']), 406);
    }

    /**
     * Show the member's shared profile with 3rd party
     *
     * @param string $token
     * @return mixed
     */
    public function showProfile($token)
    {
        try {
            $profile = MemberSharedProfile::findByTokenOrFail($token);

            Event::fire('member.share.view-profile', [Member::find($profile->member_id)]);

            return $profile->profile;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->respondWithError('ForbiddenException', trans('errors.share.forbidden'), 403);
        }
    }

    /**
     * Handle share profile via email
     *
     * @param $member
     * @return array
     * @internal param $email
     * @internal param $sharedProfile
     */
    private function shareViaEmail($member)
    {
        if (!is_null($email = Input::get('email'))) {
            $sharedProfile = MemberSharedProfile::create([
                'member_id' => $member->id,
                'contact_id' => Input::get('contact_id', null),
                'profile' => Input::get('profile', null),
            ]);

            $data = [
                'url' => $sharedProfile->publicProfileUrl(),
                'member' => $member->fullName(),
            ];

            $language = Sentry::getUser()->language;

            if (Input::has('contact_id')) {
                $language = Account::find('contact_id')->language;
            }

            $this->notifyViaEmail(
                $email,
                'share-profile',
                'share-profile',
                $data,
                $language
            );

            Event::fire('member.share.email', [$member]);

            return Response::json(['success' => true]);
        }

        return $this->respondWithError('MissingEmailException', trans('validation.required', ['attribute' => 'email']), 406);
    }

    /**
     * Download the Member's Card
     *
     * @param $member
     * @return \Illuminate\Http\Response
     */
    private function downloadMemberId($member)
    {
        Event::fire('member.share.download-member-id', [$member]);

        return Response::make($this->pdfGenerator->downloadMemberCard($member),
                              200, array('Content-Type' => 'application/pdf'));
    }
    /**
     * Download the Member's Card
     *
     * @param $member
     * @return \Illuminate\Http\Response
     */
    private function downloadWeChatMemberId($member)
    {
        Event::fire('member.share.download-member-id', [$member]);

        $filePath =  $this->pdfGenerator->downloadWeChatMemberCard($member);
        return Response::make(['url' =>  $filePath], 200);
        
    }

    /**
     * Download the Member's profile
     *
     * @param Member $member
     * @return \Illuminate\Http\Response|\Illuminate\Support\Facades\Response
     */
    private function downloadMemberProfile($member)
    {
        if (Input::has('profile')) {
            Event::fire('member.share.download-member-profile', [$member]);

            // Transform submitted profile to a valid array
            $profile = is_array(Input::get('profile')) ? Input::get('profile') : json_decode(Input::get('profile'), true);

            App::setLocale(Input::get('language'));

            return Response::make($this->pdfGenerator->downloadMemberProfile($member, $profile),
                                  200, array('Content-Type' => 'application/pdf'));
        }

        return $this->respondWithError('MissingProfileException', trans('validation.required', ['attribute' => 'profile']), 406);
    }

    /**
     * Print the Member's profile
     *
     * @param Member $member
     * @return \Illuminate\Http\Response|\Illuminate\Support\Facades\Response
     */
    private function previewMemberProfile($member)
    {
        if (Input::has('profile')) {
            Event::fire('member.share.print-member-profile', [$member]);

            // Transform submitted profile to a valid array
            $profile = is_array(Input::get('profile')) ? Input::get('profile') : json_decode(Input::get('profile'), true);

            App::setLocale(Input::get('language'));

            return $this->pdfGenerator->previewMemberProfile($member, $profile);
        }

        return $this->respondWithError('MissingProfileException', trans('validation.required', ['attribute' => 'profile']), 406);
    }
}
