<?php

namespace TelegramBot\Api\Events;

use Closure;
use ReflectionFunction;
use TelegramBot\Api\Botan;
use TelegramBot\Api\Types\Update;

use TelegramBot\Api\Interfaces\EventInterface;

use TelegramBot\Api\InvalidArgumentException;

class EventCollection
{
    /**
     * Array of events.
     *
     * @var EventInterface[]
     */
    protected $events;

    /**
     * Botan tracker
     *
     * @var \TelegramBot\Api\Botan
     */
    protected $tracker;

    /**
     * EventCollection constructor.
     *
     * @param string $trackerToken
     */
    public function __construct($trackerToken = null)
    {
        if ($trackerToken) {
            $this->tracker = new Botan($trackerToken);
        }
    }


    /**
     * Add new event to collection
     *
     * @param Closure|EventInterface $event
     * @param Closure|null $checker
     *
     * @return \TelegramBot\Api\Events\EventCollection
     */
    public function add($event, $checker = null)
    {
        if ($event instanceof EventInterface) {
            $this->events[] = $event;
        } elseif ($event instanceof Closure) {
            $this->events[] = !is_null($checker) ? new Event($event, $checker) : new Event($event, function () {});
        } else {
            throw new InvalidArgumentException(
                '$event for ' . __CLASS__ . " must be instanceof " . EventInterface::class ." or " . Closure::class
            );
        }
        
        return $this;
    }

    /**
     * @param \TelegramBot\Api\Types\Update
     */
    public function handle(Update $update)
    {
        foreach ($this->events as $event) {
            /* @var \TelegramBot\Api\Events\Event $event */
            if ($event->executeChecker($update) === true) {
                if (false === $event->executeAction($update)) {
                    if (!is_null($this->tracker)) {
                        $checker = new ReflectionFunction($event->getChecker());
                        $this->tracker->track($update->getMessage(), $checker->getStaticVariables()['name']);
                    }
                    break;
                }
            }
        }
    }
}
