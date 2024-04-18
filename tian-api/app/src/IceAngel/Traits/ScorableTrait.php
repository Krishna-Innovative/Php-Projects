<?php namespace IceAngel\Traits;

use User;
use Carbon\Carbon;
use IceAngel\PointsSystem\Score;
use DB;

trait ScorableTrait {

    /**
     * Redeem the user's score
     *
     * @param string $event
     * @param string $customEvent
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function redeemScore($event, $customEvent = null)
    {
        // Set the custom event if null
        $customEvent = $customEvent ?: $event;

        // If the user already redeemed his score we do nothing.
        if ($this->hasRedeemedScore($customEvent)) {
            return false;
        }

        if ($this->updateAccountScore($event, $this->id)) {
            $this->recordScoreHistory($customEvent, $this->id);
        }
    }

    /**
     * Check if the user has redeemed his score
     *
     * @param string $event
     * @param int $memberId
     * @return bool
     */
    public function hasRedeemedScore($event, $memberId = null)
    {
        return DB::table('score_history')
            ->where('event', $event)
            ->where('user_id', $memberId ?: $this->id)
            ->count();
    }

    /**
     * Update the account score
     *
     * @param $event
     * @return bool
     */
    private function updateAccountScore($event)
    {
        $score = Score::make($event);

        if ($score->isAccount && !$this->isAccount()) {
            return false;
        }

        // @FIXME: find better way to resolve recursive calls
        if ($this->isAccount()) {
            $account = \Account::find($this->id);
            $account->family_score += $score->familyScore;
            $account->profile_score += $score->profileScore;
            $account->profile_score = $account->profile_score > 100 ? 100 : $account->profile_score;

            $account->save();
        }
        else {
            $member = \Member::find($this->id);
            $member->profile_score += $score->profileScore;
            $member->profile_score = $member->profile_score > 100 ? 100 : $member->profile_score;

            $member->save();

            $account = \Account::find($member->account_id);
            $account->family_score += $score->familyScore;
            $account->save();
        }

        return true;
    }

    /**
     * Log the score for future check
     *
     * @param $event
     * @param int $memberId
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function recordScoreHistory($event, $memberId = null)
    {
        return DB::table('score_history')->insert([
            'event' => $event,
            'user_id' => $memberId ?: $this->id,
            'redeemed_at' => Carbon::now(),
        ]);
    }

}