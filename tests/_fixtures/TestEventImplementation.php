<?php

    use TelegramBot\Api\Interfaces\EventInterface;

    use TelegramBot\Api\Types\Update;

    class TestEventImplementation implements EventInterface
    {
        public function executeAction(Update $update)
        {
            return true;
        }

        public function executeChecker(Update $update)
        {
            return true;
        }

    }
