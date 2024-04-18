<?php

class AnalyticsController extends ApiController {

    public function handle()
    {
        $account = Sentry::getUser();

        $event = Input::get('event');
        $params = array_merge([$account], Input::get('options', []));

        Event::fire($event, $params);

        return Response::make('', 204);
    }

}