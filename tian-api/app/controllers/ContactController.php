<?php

class ContactController extends ApiController {

    /**
     * Display a listing of the Account's members contacts.
     *
     * @return Response
     */
    public function index()
    {
        $account = Sentry::getUser();

        return Response::json($account->contacts());
    }

    /**
     * Requests a contact relationship.
     *
     * @return Response
     */
    public function request()
    {

        try {
            $account = Sentry::getUser();

            $member = $account->members()->findOrFail(Input::get('member_id'));

            if ($member->contacts()->count() >= 2) {

                return $this->respondWithError('Unacceptable', trans('errors.contact.reached_max_allowed_contacts'), 406);
            }

            // Handle case where the Contact ID is given.
            if (Input::has('contact_id')) {

                return $this->attemptWithId($member, Input::get('contact_id'));

            }

            // Handle case where the Contact Email is given.
            if (Input::has('contact_email')) {

                return $this->attemptWithEmail($member, Input::get('contact_email'));

            }

            return $this->respondWithError('InvalidArgumentException', trans('errors.contact.requested_account_identifier_missing'), 406);

        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.contact.member_not_found'), 404);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.contact.member_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Request a contact by his given ID.
     *
     * @param Member $member
     * @param int $contactId
     * @return Response
     */
    protected function attemptWithId($member, $contactId)
    {
        try {

            $exists = false;
            $status = null;

            $member->contacts()->each(function ($contact) use (&$exists, &$status, $contactId) {
                if ($contact['id'] && $contact['id'] == $contactId) {
                    $exists = true;
                    $status = $contact['status'];
                }
            });

            if ($exists) {

                if ($status == 'accepted'){
                    return $this->respondWithError('ContactExistsException', trans('errors.contact.contact_exists'), 403);
                }else{
                    return $this->respondWithError('PendingRequestExistsException', trans('errors.contact.request_exists'), 406);
                }

            }

            if ($member->id == $contactId) {

                return $this->respondWithError('Unacceptable', trans('errors.contact.not_allowed_operation'), 406);

            }

            // Find the Account group
            $accountGroup = Sentry::findGroupByName('Account');

            $contact = Sentry::findUserById($contactId);

            if ($contact->inGroup($accountGroup)) {

                $request = PendingRequest::createRequestById($member->id, $contact->id, $contact->email, 'contact');

                Event::fire('contact.requested', [$request]);

                return Response::json([

                    'id' => $contact->id,

                    'email' => $contact->email,

                    'first_name' => $contact->first_name,

                    'last_name' => $contact->last_name,

                    'middle_name' => $contact->middle_name,

                    'status' => 'pending',

                    'photo' => $contact->photo,

                ], 201);

            }
            else {

                return $this->respondWithError('Unacceptable', trans('errors.contact.requested_account_is_member'), 406);

            }

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('AccountNotFoundException', trans('errors.contact.requested_account_not_found'), 404);

        } catch (PendingRequestExistsException $e) {

            return $this->respondWithError('PendingRequestExistsException', trans('errors.contact.request_exists'), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Request a contact by his given email.
     *
     * @param Member $member
     * @param string $contactEmail
     * @return \Illuminate\Support\Facades\Response
     */
    protected function attemptWithEmail($member, $contactEmail)
    {
        try {

            $contact = Sentry::findUserByLogin($contactEmail);

            return $this->attemptWithId($member, $contact->id);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            try {

                $request = PendingRequest::createRequestByEmail($member->id, $contactEmail, 'contact');

                Event::fire('contact.requested', [$request]);

                return Response::json([

                    'id' => null,

                    'email' => $contactEmail,

                    'status' => 'pending',

                ], 201);

            } catch (PendingRequestExistsException $e) {

                return $this->respondWithError('PendingRequestExistsException', trans('errors.contact.request_exists'), 406);

            } catch (Exception $e) {

                return $this->respondWithError('SystemError', $e->getMessage(), 500);

            }

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Accept a contact request.
     *
     * @param int $requestId
     * @return \Illuminate\Support\Facades\Response
     */
    public function accept($requestId)
    {
        try {

            $contact = Sentry::getUser();

            $request = PendingRequest::findOrFail($requestId);

            if ($contact->id == $request->requested_id) {

                $member = Member::find($request->requester_id);

                $account = $member->account;

                $contact->contactFor()->attach($member->id);

                $request->delete();

                Event::fire('contact.accepted', [$request]);

                return Response::json([

                    'photo' => $member->photo,

                    'message' => trans('messages.contact.accept.to_contact', ['member' => $member->fullName()]),

                ], 200);

            }

            return $this->respondWithError('Forbidden', trans('errors.contact.not_allowed_operation'), 403);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('AccountNotFoundException', trans('errors.contact.requester_not_found'), 404);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('PendingRequestNotFoundException', trans('errors.contact.request_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Decline a contact request.
     *
     * @param int $requestId
     * @return \Illuminate\Support\Facades\Response
     */
    public function decline($requestId)
    {

        try {

            $account = Sentry::getUser();

            $request = PendingRequest::findOrFail($requestId);

            if ($request->requested_id == $account->id) {

                $request->delete();

                $request->reason = Input::get('reason', '');

                Event::fire('contact.declined', [$request]);

                return Response::make('', 204);

            }

            return $this->respondWithError('Forbidden', trans('errors.contact.not_allowed_operation'), 403);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('PendingRequestNotFoundException', trans('errors.contact.request_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Cancel a Contact request.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function cancel()
    {

        try {

            $account = Sentry::getUser();

            $member = $account->members()->findOrFail(Input::get('member_id'));

            $request = PendingRequest::findByEmailOrFail($member->id, Input::get('contact_email'), 'contact');

            $request->delete();

            Event::fire('contact.cancelled', [$request]);

            return Response::make('', 204);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('PendingRequestNotFoundException', trans('errors.contact.request_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Delete a member's contact.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete()
    {

        try {

            $account = Sentry::getUser();

            $member = $account->members()->findOrFail(Input::get('member_id'));

            $contact = Sentry::findUserById(Input::get('contact_id'));

            // Validate the Contact relationship.
            $contact->contactFor()->findOrFail($member->id);

            $contact->contactFor()->detach($member->id);

            Event::fire('contact.deleted', [$member, $contact]);

            return Response::make('', 204);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.contact.member_not_found'), 404);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('AccountNotFoundException', trans('errors.account.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Resend contact nomination
     *
     * @return mixed
     */
    public function resend()
    {
        try {
            if (Input::has(['member_id', 'contact_email'])) {
                $request = PendingRequest::findByEmailOrFail(Input::get('member_id'), Input::get('contact_email'), 'contact');

                Event::fire('contact.resend', [$request]);
            }

            return Response::make('', 204);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('NotFoundException', trans('errors.contact.request_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }
} 
