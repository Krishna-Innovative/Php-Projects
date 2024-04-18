<?php

class FriendController extends ApiController
{

    /**
     * Display a listing of the Account friends.
     *
     * @return Response
     */
    public function index()
    {
        try {

            $account = Sentry::getUser();
            $contacts = $account->contactFor()->get();
            $contacts = json_decode(json_encode($contacts), true);
            $members = $account->members()->get();
            $members = json_decode(json_encode($members), true);
            foreach($members as $key=>$value){
                if($value['id']==$value['account_id']){
                    unset($members[$key]);
                    break;
                }
            }
            return Response::json([

                'guardians' => $account->guardianFor()->get(),

                'contacts' => array_merge($members, $contacts),

            ]);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Delete Guardian relationship.
     *
     * @param $accountId
     * @return \Illuminate\Support\Facades\Response
     */
    public function deleteGuardian($accountId)
    {
        try {

            $account = Sentry::getUser();

            $account->guardianFor()->detach($accountId);

            Event::fire('friend.guardian.deleted', [$account, $accountId]);

            return Response::make('', 204);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

    /**
     * Delete Contact relationship.
     *
     * @param $memberId
     * @return \Illuminate\Support\Facades\Response
     */
    public function deleteContact($memberId)
    {
        try {

            $account = Sentry::getUser();

            $account->contactFor()->detach($memberId);

            Event::fire('friend.contact.deleted', [$account, $memberId]);

            return Response::make('', 204);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

}
