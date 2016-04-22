<?php

namespace TelegramBot\Api\Test\Types\Events;

use TelegramBot\Api\Client;
use TelegramBot\Api\Events\EventCollection;
use TelegramBot\Api\Types\Update;

use TelegramBot\Api\Interfaces\EventInterface;

include_once(__DIR__ . '/../../_fixtures/TestEventImplementation.php');

class EventCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function data()
    {
        return [
            [
                function ($update) {
                    return false;
                },
                function ($update) {
                    return true;
                },
                Update::fromResponse([
                    'update_id' => 123456,
                    'message' => [
                        'message_id' => 13948,
                        'from' => [
                            'id' => 123,
                            'first_name' => 'Ilya',
                            'last_name' => 'Gusev',
                            'username' => 'iGusev',
                        ],
                        'chat' => [
                            'id' => 123,
                            'type' => 'private',
                            'first_name' => 'Ilya',
                            'last_name' => 'Gusev',
                            'username' => 'iGusev',
                        ],
                        'date' => 1440169809,
                        'text' => 'testText',
                    ],
                ]),
            ]
        ];
    }

    protected $collection;

    public function setUp()
    {
        $this->collection = new EventCollection();
    }

    public function tearDown()
    {
        $this->collection = null;
    }

    public function testConstructor1()
    {
        $item = new EventCollection();

        $this->assertAttributeEmpty('tracker', $item);
        $this->assertAttributeEmpty('events', $item);
    }

    public function testConstructor2()
    {
        $item = new EventCollection('testToken');

        $this->assertAttributeInstanceOf('\TelegramBot\Api\Botan', 'tracker', $item);
        $this->assertAttributeEmpty('events', $item);
    }

    protected function eventsCheck() {

        $reflection = new \ReflectionClass($this->collection);
        $reflectionProperty = $reflection->getProperty('events');
        $reflectionProperty->setAccessible(true);
        $innerItem = $reflectionProperty->getValue($this->collection);
        $reflectionProperty->setAccessible(false);

        $this->assertAttributeInternalType('array', 'events', $this->collection);
        /* @var \TelegramBot\Api\Events\Event $event */
        foreach($innerItem as $event) {
            $this->assertInstanceOf(EventInterface::class, $event);
        }
    }

    /**
     * @param \Closure $action
     * @param \Closure $checker
     *
     * @dataProvider data
     */
    public function testAdd1($action, $checker)
    {
        $this->collection->add($action, $checker);
        $this->eventsCheck();
    }

    /**
     * @param \Closure $action
     *
     * @dataProvider data
     */
    public function testAdd2($action)
    {
        $this->collection->add($action);
        $this->eventsCheck();
    }

    public function testAdd3()
    {
        $event = new \TestEventImplementation();
        $this->collection->add($event);
        $this->eventsCheck();
    }

    /**
     * @param \Closure $action
     * @param \Closure $checker
     * @param Update $update
     *
     * @dataProvider data
     */
    public function testHandle1($action, $checker, $update) {
        $item = new EventCollection('testToken');
        $name = 'test';
        $item->add($action, function ($update) use ($name) {
            return true;
        });
        $item->add(new \TestEventImplementation());

        $mockedTracker = $this->getMockBuilder('\TelegramBot\Api\Botan')
            ->disableOriginalConstructor()
            ->getMock();

        // Configure the stub.

        $mockedTracker->expects($this->once())->method('track')->willReturn(null);

        $reflection = new \ReflectionClass($item);
        $reflectionProperty = $reflection->getProperty('tracker');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($item, $mockedTracker);
        $reflectionProperty->setAccessible(false);

        $item->handle($update);
    }

    /**
     * @param \Closure $action
     * @param \Closure $checker
     * @param Update $update
     *
     * @dataProvider data
     */
    public function testHandle2($action, $checker, $update) {
        $item = new EventCollection();
        $name = 'test';
        $item->add($action, function ($update) use ($name) {
            return true;
        });

        $mockedTracker = $this->getMockBuilder('\TelegramBot\Api\Botan')
            ->disableOriginalConstructor()
            ->getMock();

        $mockedEvent = $this->getMockBuilder('\TelegramBot\Api\Events\Event')
            ->disableOriginalConstructor()
            ->getMock();

        // Configure the stub.
        $mockedTracker->expects($this->exactly(0))->method('track')->willReturn(null);
        $mockedEvent->expects($this->once())->method('executeChecker')->willReturn(true);
        $mockedEvent->expects($this->once())->method('executeAction')->willReturn(true);

        $reflection = new \ReflectionClass($item);
        $reflectionProperty = $reflection->getProperty('events');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($item, [$mockedEvent]);
        $reflectionProperty->setAccessible(false);

        $item->handle($update);
    }

}
