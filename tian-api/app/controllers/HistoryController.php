<?php

class HistoryController extends ApiController {

    /**
     * Show paginated list of members history.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {

            $account = Sentry::getUser();

            $member = $account->members()->findOrFail($id);

            Event::fire('member.view.history', $member);

            return $member->history()->latest()->paginate();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $this->respondWithError('MemberNotFoundException', trans('errors.member.not_found'), 404);

        } catch (Exception $e) {

            return $this->respondWithError('SystemError', $e->getMessage(), 500);

        }
    }

}