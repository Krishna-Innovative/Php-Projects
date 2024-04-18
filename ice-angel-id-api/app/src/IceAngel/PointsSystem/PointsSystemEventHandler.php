<?php namespace IceAngel\PointsSystem;

class PointsSystemEventHandler {

    /**
     * @var Score
     */
    private $scores;

    /**
     * @param Score $scores
     */
    function __construct(Score $scores)
    {
        $this->scores = $scores;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        // $this->registerAttributeEvents($events);

        $events->listen('eloquent.attribute.saved*', '\IceAngel\PointsSystem\PointsSystemEventHandler@onAttributeUpdated');

        $events->listen(['contact.accepted', 'guardian.accepted',], '\IceAngel\PointsSystem\PointsSystemEventHandler@onRequestAccepted');

        $events->listen('*', function () use ($events) {
            if ($this->scores->exists($events->firing())) {
                $this->handle($events->firing(), func_get_args());
            }
        });
    }

    /**
     * Handle attribute updated score
     *
     * @param \User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @return mixed
     */
    public function onAttributeUpdated($user, $model, $attribute)
    {
        return $user->redeemScore('attribute.updated', $this->makeEventName($user, $model, $attribute));
    }

    /**
     * Make the event name
     *
     * @param \User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @return string
     */
    private function makeEventName($user, $model, $attribute)
    {
        $userModelName = get_class($user);
        $modelName = get_class($model);

        // Basic information for the Account's member profile should be scored once
        if ($model instanceof \Member && $user->isAccount()) {
            $userModelName = 'Account';
            $modelName = 'Account';
        }

        // Custom events for insurances
        if ($model instanceof \MemberInsurance) {
            $attribute .= ".{$model->insurance_type}";
        }

        $eventName = "attribute.updated.{$userModelName}.{$modelName}.{$attribute}";

        return $eventName;
    }

    /**
     * Handle Contact/Guardian requests score
     *
     * @param \PendingRequest $request
     */
    public function onRequestAccepted($request)
    {
        switch (\Event::firing()) {
            case 'contact.accepted':
                $requester = \Member::find($request->requester_id);
                $requested = \Account::find($request->requested_id);

                $requesterEventName = 'member.add.contact-' . $requester->contacts()->count();
                $requestedEventName = 'account.accept.friend-in-need';

                break;

            case 'guardian.accepted':
                $requester = \Account::find($request->requester_id);
                $requested = \Account::find($request->requested_id);

                $requesterEventName = 'account.add.guardian';
                $requestedEventName = 'account.accept.friend-in-need';
                break;
        }

        $requester->redeemScore($requesterEventName);
        $requested->redeemScore($requestedEventName);
    }

    /**
     * @param string $event
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function handle($event, array $params)
    {
        $user = array_shift($params);

        return $user->redeemScore($event);
    }

    /**
     * Listen to eloquent fired events and fire a custom event per attribute.
     *
     * @param $events
     * @deprecated
     */
    private function registerAttributeEvents($events)
    {
        $events->listen(['eloquent.saved: Account', 'eloquent.saved: Member'], function ($model) use ($events) {
            $attributes = $model->getDirty();
            unset($attributes['updated_at']);

            $name = get_class($model);

            foreach ($attributes as $attribute => $value) {
                $events->fire("eloquent.attribute.saved: {$name}.{$attribute}", [$model, $model, $attribute]);
            }
        });
    }
}