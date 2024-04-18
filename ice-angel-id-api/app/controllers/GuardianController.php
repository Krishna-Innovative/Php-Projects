<?php

/**
 * Class GuardianController
 */
class GuardianController extends ApiController {

    /**
     * Display a listing of the Account's guardians.
     *
     * @return Response
     */
    public function index()
    {
        $account = Sentry::getUser();

        return Response::json($account->guardians());
    }

    /**
     * Requests a guardian relationship.
     *
     * @return Response
     */
    public function request()
    {
        $account = Sentry::getUser();

        if ($account->guardians()->count() >= 2) {

            return $this->respondWithError('Unacceptable', trans('errors.guardian.reached_max_allowed_guardians'), 406);

        }

        // Handle case where the Account ID is given.
        if (Input::has('guardian_id')) {

            if (Input::get('guardian_id') == $account->id) {

                return $this->respondWithError('Unacceptable', trans('errors.guardian.requested_account_not_allowed'), 406);

            }
            else {

                return $this->attemptWithId(Input::get('guardian_id'));

            }

        }

        // Handle case where the Account Email is given.
        if (Input::has('guardian_email')) {

            if (Input::get('guardian_email') == $account->email) {

                return $this->respondWithError('Unacceptable', trans('errors.guardian.requested_account_not_allowed'), 406);

            }
            else {

                return $this->attemptWithEmail(Input::get('guardian_email'));

            }

        }

        return $this->respondWithError('InvalidArgumentException', trans('errors.guardian.requested_account_identifier_missing'), 406);

    }

    /**
     * Request a guardian by his given ID.
     *
     * @param int $guardianId
     * @return Response
     */
    protected function attemptWithId($guardianId)
    {
        try {

            $account = Sentry::getUser();
            $guardians = $account->guardians();

           if (!empty($guardians)) {
                foreach ($guardians as $key => $guardian) {
                    if ($guardian['id'] == $guardianId && $guardian['status'] == 'accepted'){
                        return $this->respondWithError('Unacceptable', trans('errors.guardian.requested_account_exists'), 406);
                    }
                }
           }

            // Find the Account group
            $accountGroup = Sentry::findGroupByName('Account');

            $guardian = Sentry::findUserById($guardianId);

            if ($guardian->inGroup($accountGroup)) {

                $request = PendingRequest::createRequestById($account->id, $guardian->id, $guardian->email, 'guardian');

                Event::fire('guardian.requested', [$request]);

                return Response::json([

                    'id' => $guardian->id,

                    'email' => $guardian->email,

                ], 201);

            }
            else {

                return $this->respondWithError('Unacceptable', trans('errors.guardian.requested_account_is_member'), 406);

            }

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('AccountNotFoundException', trans('errors.guardian.requested_account_not_found'), 404);

        } catch (PendingRequestExistsException $e) {

            return $this->respondWithError('PendingRequestExistsException', trans('errors.guardian.request_exists'), 406);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Request a guardian by his given email.
     *
     * @param string $guardianEmail
     * @return \Illuminate\Support\Facades\Response
     */
    protected function attemptWithEmail($guardianEmail)
    {
        $account = Sentry::getUser();

        try {

            $guardian = Sentry::findUserByLogin($guardianEmail);

            return $this->attemptWithId($guardian->id);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            try {

                $request = PendingRequest::createRequestByEmail($account->id, $guardianEmail, 'guardian');

                Event::fire('guardian.requested', [$request]);

                return Response::json([

                    'id' => null,

                    'email' => $guardianEmail,

                ], 201);

            } catch (PendingRequestExistsException $e) {

                return $this->respondWithError('PendingRequestExistsException', trans('errors.guardian.request_exists'), 406);

            } catch (Exception $e) {

                return $this->respondWithError('SystemError', $e->getMessage(), 500);

            }

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Accept a guardianship request.
     *
     * @param int $requestId
     * @return \Illuminate\Support\Facades\Response
     */
    public function accept($requestId)
    {
        try {

            $guardian = Sentry::getUser();

            $request = PendingRequest::findOrFail($requestId);

            if ($request->requested_id == $guardian->id) {

                $account = Sentry::findUserById($request->requester_id);

                $guardian->guardianFor()->attach($account->id);

                $request->delete();

                Event::fire('guardian.accepted', [$request]);

                return Response::json([

                    'photo' => $account->photo,

                    'message' => trans('messages.guardian.accept.to_guardian', [

                        'account' => $account->fullName(),

                    ]),

                ], 200);

            }

            return $this->respondWithError('Forbidden', trans('errors.guardian.not_allowed_operation'), 403);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('AccountNotFoundException', trans('errors.guardian.requester_not_found'), 404);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('PendingRequestNotFoundException', trans('errors.guardian.request_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Decline a guardianship request.
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

                Event::fire('guardian.declined', [$request]);

                return Response::make('', 204);

            }

            return $this->respondWithError('Forbidden', trans('errors.guardian.not_allowed_operation'), 403);


        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('PendingRequestNotFoundException', trans('errors.guardian.request_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Cancel a guardianship request.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function cancel()
    {

        try {

            $account = Sentry::getUser();

            $request = PendingRequest::findByEmailOrFail($account->id, Input::get('guardian_email'), 'guardian');

            $request->delete();

            Event::fire('guardian.cancelled', [$request]);

            return Response::make('', 204);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('PendingRequestNotFoundException', trans('errors.guardian.request_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Delete a guardian.
     *
     * @param int $guardianId
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete($guardianId)
    {

        try {

            $account = Sentry::getUser();

            $guardian = Sentry::findUserById($guardianId);

            // Validate the Guardianship.
            $guardian->guardianFor()->findOrFail($account->id);

            $guardian->guardianFor()->detach($account->id);

            Event::fire('guardian.deleted', [$account, $guardian]);

            return Response::make('', 204);

        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return $this->respondWithError('AccountNotFoundException', trans('errors.guardian.requester_not_found'), 404);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('Forbidden', trans('errors.guardian.not_allowed_operation'), 403);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }

    }

    /**
     * Resend guardian nomination
     *
     * @return mixed
     */
    public function resend()
    {
        try {
            if (Input::has('email')) {

                $account = Sentry::getUser();

                $request = PendingRequest::findByEmailOrFail($account->id, Input::get('email'), 'guardian');

                Event::fire('guardian.resend', [$request]);
            }

            return Response::make('', 204);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('NotFoundException', trans('errors.guardian.request_not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }
} 