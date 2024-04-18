<?php

class MessageController extends ApiController {

    /**
     * Display a listing of Account's messages.
     *
     * @return Response
     */
    public function index()
    {
        try {

            $account = Sentry::getUser();
            $viewed = Input::get('viewed');

            if (isset($viewed)){
                return Response::json($account->viewedMessages($viewed)->paginate()); 
            }


            return Response::json($account->messages()->orderBy('id', 'desc')->paginate());

        } catch (Exception $e) {

            return $this->respondWithError('SystemErrorException', $e->getMessage(), 500);

        }
    }

    /**
     * Update the status for the messages.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function updateMessageStatus()
    {
        try {

            $account = Sentry::getUser();

            $messageIds = explode(',', Input::get('id', ''));

            Message::setAsViewed($messageIds);

            return Response::json('', 204);

        } catch (Exception $e) {

            return $this->respondWithError('SystemErrorException', $e->getMessage(), 500);

        }
    }

    /**
     * Update the status for the messages.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function updateMessageViewedAll()
    {
        try {

            $account = Sentry::getUser();

            $messageIds = $account->viewedMessages()->lists('id');

            Message::setAsViewed($messageIds);

            return Response::json('', 204);

        } catch (Exception $e) {

            return $this->respondWithError('SystemErrorException', $e->getMessage(), 500);

        }
    }
}
