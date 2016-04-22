<?php

    namespace TelegramBot\Api\Interfaces;

    use TelegramBot\Api\Types\Update;

    /**
     *
     * @author vladimir
     */
    interface EventInterface
    {
        /**
         * @param \TelegramBot\Api\Types\Update
         *
         * @return mixed
         */
        public function executeChecker(Update $update);


        /**
         * @param \TelegramBot\Api\Types\Update
         *
         * @return mixed
         */
        public function executeAction(Update $update);
    }
