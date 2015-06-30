<?php

namespace TelegramBot\Api\Test;

use TelegramBot\Api\Types\Document;
use TelegramBot\Api\Types\Location;
use TelegramBot\Api\Types\Audio;
use TelegramBot\Api\Types\Contact;
use TelegramBot\Api\Types\GroupChat;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\PhotoSize;
use TelegramBot\Api\Types\Sticker;
use TelegramBot\Api\Types\User;
use TelegramBot\Api\Types\Video;

class MessageTest extends \PHPUnit_Framework_TestCase
{

    public function testSetMessageId()
    {
        $item = new Message();
        $item->setMessageId(1);
        $this->assertAttributeEquals(1, 'messageId', $item);
    }

    public function testGetMessageId()
    {
        $item = new Message();
        $item->setMessageId(1);
        $this->assertEquals(1, $item->getMessageId());
    }

    public function testSetDate()
    {
        $item = new Message();
        $item->setDate(1234567);
        $this->assertAttributeEquals(1234567, 'date', $item);
    }

    public function testGetDate()
    {
        $item = new Message();
        $item->setDate(1234567);
        $this->assertEquals(1234567, $item->getDate());
    }

    public function testSetForwardDate()
    {
        $item = new Message();
        $item->setForwardDate(1234567);
        $this->assertAttributeEquals(1234567, 'forwardDate', $item);
    }

    public function testGetForwardDate()
    {
        $item = new Message();
        $item->setForwardDate(1234567);
        $this->assertEquals(1234567, $item->getForwardDate());
    }

    public function testSetFrom()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setFrom($user);
        $this->assertAttributeEquals($user, 'from', $item);
    }

    public function testGetFrom()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setFrom($user);
        $this->assertEquals($user, $item->getFrom());
        $this->assertInstanceOf('\TelegramBot\Api\Types\User', $item->getFrom());
    }

    public function testSetForwardFrom()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setForwardFrom($user);
        $this->assertAttributeEquals($user, 'forwardFrom', $item);
    }

    public function testGetForwardFrom()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setForwardFrom($user);
        $this->assertEquals($user, $item->getForwardFrom());
        $this->assertInstanceOf('\TelegramBot\Api\Types\User', $item->getForwardFrom());
    }

    public function testSetChatGroup()
    {
        $item = new Message();
        $chat = GroupChat::fromResponse(array(
            'id' => 1,
            'title' => 'test chat'
        ));
        $item->setChat($chat);
        $this->assertAttributeEquals($chat, 'chat', $item);
    }

    public function testGetChatGroup()
    {
        $item = new Message();
        $chat = GroupChat::fromResponse(array(
            'id' => 1,
            'title' => 'test chat'
        ));
        $item->setChat($chat);
        $this->assertEquals($chat, $item->getChat());
        $this->assertInstanceOf('\TelegramBot\Api\Types\GroupChat', $item->getChat());
    }

    public function testSetChatUser()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setChat($user);
        $this->assertAttributeEquals($user, 'chat', $item);
    }

    public function testGetChatUser()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setChat($user);
        $this->assertEquals($user, $item->getChat());
        $this->assertInstanceOf('\TelegramBot\Api\Types\User', $item->getChat());
    }

    public function testSetContact()
    {
        $item = new Message();
        $contact = Contact::fromResponse(array(
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'phone_number' => '123456',
            'user_id' => 'iGusev'
        ));
        $item->setContact($contact);
        $this->assertAttributeEquals($contact, 'contact', $item);
    }

    public function testGetContact()
    {
        $item = new Message();
        $contact = Contact::fromResponse(array(
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'phone_number' => '123456',
            'user_id' => 'iGusev'
        ));
        $item->setContact($contact);
        $this->assertEquals($contact, $item->getContact());
        $this->assertInstanceOf('\TelegramBot\Api\Types\Contact', $item->getContact());
    }

    public function testSetDocument()
    {
        $item = new Message();
        $document = Document::fromResponse(array(
            'file_id' => 'testFileId1',
            'file_name' => 'testFileName',
            'mime_type' => 'audio/mp3',
            'file_size' => 3,
            'thumb' => array(
                'file_id' => 'testFileId1',
                'width' => 5,
                'height' => 6,
                'file_size' => 7
            )
        ));
        $item->setDocument($document);
        $this->assertAttributeEquals($document, 'document', $item);
    }

    public function testGetDocument()
    {
        $item = new Message();
        $document = Document::fromResponse(array(
            'file_id' => 'testFileId1',
            'file_name' => 'testFileName',
            'mime_type' => 'audio/mp3',
            'file_size' => 3,
            'thumb' => array(
                'file_id' => 'testFileId1',
                'width' => 5,
                'height' => 6,
                'file_size' => 7
            )
        ));
        $item->setDocument($document);
        $this->assertEquals($document, $item->getDocument());
        $this->assertInstanceOf('\TelegramBot\Api\Types\Document', $item->getDocument());
    }

    public function testSetLocation()
    {
        $item = new Message();
        $location = Location::fromResponse(array('latitude' => 55.585827, 'longitude' => 37.675309));
        $item->setLocation($location);
        $this->assertAttributeEquals($location, 'location', $item);
    }

    public function testGetLocation()
    {
        $item = new Message();
        $location = Location::fromResponse(array('latitude' => 55.585827, 'longitude' => 37.675309));
        $item->setLocation($location);
        $this->assertEquals($location, $item->getLocation());
        $this->assertInstanceOf('\TelegramBot\Api\Types\Location', $item->getLocation());
    }

    public function testSetAudio()
    {
        $item = new Message();
        $audio = Audio::fromResponse(array(
            'file_id' => 'testFileId1',
            'duration' => 1,
            'mime_type' => 'audio/mp3',
            'file_size' => 3
        ));
        $item->setAudio($audio);
        $this->assertAttributeEquals($audio, 'audio', $item);
    }

    public function testGetAudio()
    {
        $item = new Message();
        $audio = Audio::fromResponse(array(
            'file_id' => 'testFileId1',
            'duration' => 1,
            'mime_type' => 'audio/mp3',
            'file_size' => 3
        ));
        $item->setAudio($audio);
        $this->assertEquals($audio, $item->getAudio());
        $this->assertInstanceOf('\TelegramBot\Api\Types\Audio', $item->getAudio());
    }

    public function testSetVideo()
    {
        $item = new Message();
        $video = Video::fromResponse(array(
            'file_id' => 'testFileId1',
            'width' => 1,
            'height' => 2,
            'duration' => 3,
            'mime_type' => 'video/mp4',
            'file_size' => 4,
            'caption' => 'testcaption',
            'thumb' => array(
                'file_id' => 'testFileId1',
                'width' => 5,
                'height' => 6,
                'file_size' => 7
            )
        ));
        $item->setVideo($video);
        $this->assertAttributeEquals($video, 'video', $item);
    }

    public function testGetVideo()
    {
        $item = new Message();
        $video = Video::fromResponse(array(
            'file_id' => 'testFileId1',
            'width' => 1,
            'height' => 2,
            'duration' => 3,
            'mime_type' => 'video/mp4',
            'file_size' => 4,
            'caption' => 'testcaption',
            'thumb' => array(
                'file_id' => 'testFileId1',
                'width' => 5,
                'height' => 6,
                'file_size' => 7
            )
        ));
        $item->setVideo($video);
        $this->assertEquals($video, $item->getVideo());
        $this->assertInstanceOf('\TelegramBot\Api\Types\Video', $item->getVideo());
    }

    public function testSetSticker()
    {
        $item = new Message();
        $sticker = Sticker::fromResponse(array(
            "file_id" => 'testFileId1',
            'width' => 1,
            'height' => 2,
            'file_size' => 3,
            'thumb' => array(
                "file_id" => 'testFileId1',
                'width' => 1,
                'height' => 2,
                'file_size' => 3
            )
        ));
        $item->setSticker($sticker);
        $this->assertAttributeEquals($sticker, 'sticker', $item);
    }

    public function testGetSticker()
    {
        $item = new Message();
        $sticker = Sticker::fromResponse(array(
            "file_id" => 'testFileId1',
            'width' => 1,
            'height' => 2,
            'file_size' => 3,
            'thumb' => array(
                "file_id" => 'testFileId1',
                'width' => 1,
                'height' => 2,
                'file_size' => 3
            )
        ));
        $item->setSticker($sticker);
        $this->assertEquals($sticker, $item->getSticker());
        $this->assertInstanceOf('\TelegramBot\Api\Types\Sticker', $item->getSticker());
    }

    public function testSetGroupChatCreated()
    {
        $item = new Message();
        $item->setGroupChatCreated(true);

        $this->assertAttributeEquals(true, 'groupChatCreated', $item);
    }

    public function testIsGroupChatCreated()
    {
        $item = new Message();
        $item->setGroupChatCreated(true);

        $this->assertTrue($item->isGroupChatCreated());
    }

    public function testSetDeleteChatPhoto()
    {
        $item = new Message();
        $item->setDeleteChatPhoto(true);

        $this->assertAttributeEquals(true, 'deleteChatPhoto', $item);
    }

    public function testIsDeleteChatPhoto()
    {
        $item = new Message();
        $item->setDeleteChatPhoto(true);

        $this->assertTrue($item->isDeleteChatPhoto());
    }

    public function testSetLeftChatParticipant()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setLeftChatParticipant($user);


        $this->assertAttributeEquals($user, 'leftChatParticipant', $item);
    }

    public function testGetLeftChatParticipant()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setLeftChatParticipant($user);

        $this->assertEquals($user, $item->getLeftChatParticipant());
        $this->assertInstanceOf('\TelegramBot\Api\Types\User', $item->getLeftChatParticipant());
    }

    public function testSetNewChatParticipant()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setNewChatParticipant($user);


        $this->assertAttributeEquals($user, 'newChatParticipant', $item);
    }

    public function testGetNewChatParticipant()
    {
        $item = new Message();
        $user = User::fromResponse(array(
            'id' => 1,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ));
        $item->setNewChatParticipant($user);

        $this->assertEquals($user, $item->getNewChatParticipant());
        $this->assertInstanceOf('\TelegramBot\Api\Types\User', $item->getNewChatParticipant());
    }

    public function testSetNewChatTitle()
    {
        $item = new Message();
        $item->setNewChatTitle('testtitle');

        $this->assertAttributeEquals('testtitle', 'newChatTitle', $item);
    }

    public function testGetNewChatTitle()
    {
        $item = new Message();
        $item->setNewChatTitle('testtitle');

        $this->assertEquals('testtitle', $item->getNewChatTitle());
    }

    public function testSetPhoto()
    {
        $item = new Message();
        $photo = array(
            PhotoSize::fromResponse(array(
                'file_id' => 'testFileId1',
                'width' => 5,
                'height' => 6,
                'file_size' => 7
            ))
        );

        $item->setPhoto($photo);

        $this->assertAttributeEquals($photo, 'photo', $item);
    }

    public function testGetPhoto()
    {
        $item = new Message();
        $photo = array(
            PhotoSize::fromResponse(array(
                'file_id' => 'testFileId1',
                'width' => 5,
                'height' => 6,
                'file_size' => 7
            ))
        );

        $item->setPhoto($photo);

        $this->assertEquals($photo, $item->getPhoto());

        foreach ($item->getPhoto() as $photoItem) {
            $this->assertInstanceOf('\TelegramBot\Api\Types\PhotoSize', $photoItem);
        }
    }

    public function testGetNewChatPhoto()
    {
        $item = new Message();
        $photo = array(
            PhotoSize::fromResponse(array(
                'file_id' => 'testFileId1',
                'width' => 5,
                'height' => 6,
                'file_size' => 7
            ))
        );

        $item->setNewChatPhoto($photo);
        $this->assertAttributeEquals($photo, 'newChatPhoto', $item);
    }

    public function testSetNewChatPhoto()
    {
        $item = new Message();
        $photo = array(
            PhotoSize::fromResponse(array(
                'file_id' => 'testFileId1',
                'width' => 5,
                'height' => 6,
                'file_size' => 7
            ))
        );

        $item->setNewChatPhoto($photo);
        $this->assertEquals($photo, $item->getNewChatPhoto());

        foreach ($item->getNewChatPhoto() as $photoItem) {
            $this->assertInstanceOf('\TelegramBot\Api\Types\PhotoSize', $photoItem);
        }
    }

    /**
     * @expectedException \TelegramBot\Api\InvalidArgumentException
     */
    public function testSetMessageIdException()
    {
        $item = new Message();
        $item->setMessageId('s');
    }

    /**
     * @expectedException \TelegramBot\Api\InvalidArgumentException
     */
    public function testSetDateException()
    {
        $item = new Message();
        $item->setDate('s');
    }

    /**
     * @expectedException \TelegramBot\Api\InvalidArgumentException
     */
    public function testSetForwardDateException()
    {
        $item = new Message();
        $item->setForwardDate('s');
    }
}