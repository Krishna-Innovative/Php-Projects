<?php namespace IceAngel\Twitter;

use Log;
use Thujohn\Twitter\Twitter as TTwitter;

class Twitter extends TTwitter {

    /**
     * Send mass messages to recipients.
     *
     * @param $text
     * @param array $recipientScreenNames
     * @throws \Exception
     */
    public function sendDirectMessage($text, array $recipientScreenNames)
    {
        foreach ($recipientScreenNames as $screenName) {
            $this->postDm([
                'text' => $text,
                'screen_name' => $screenName
            ]);

            Log::info(sprintf(':bird: Twitter to [%s]', $screenName));
        }
    }

}