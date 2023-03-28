<?php

namespace Models\Message;

use DateTime;
use Models\BaseModel;
use Models\User\UserInterface;

class Message extends BaseModel implements MessageInterface
{

    private int $createdAt;

    /**
     * @param UserInterface $sender
     * @param UserInterface $receiver
     * @param MessageType $messageType
     * @param string $text
     */
    public function __construct(
        private readonly UserInterface  $sender,
        private readonly UserInterface  $receiver,
        private readonly MessageType    $messageType,
        private readonly string         $text
    )
    {
        $this->createdAt = time();
        parent::__construct();
    }

    /**
     * @return string
     */
    final public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return MessageType
     */
    final public function getType(): MessageType
    {
        return $this->messageType;
    }

    /**
     * @return UserInterface
     */
    final public function getSenderFullName(): UserInterface
    {
        return $this->sender->getFullName();
    }

    /**
     * @return UserInterface
     */
    final public function getReceiverFullName(): UserInterface
    {
        return $this->receiver->getFullName();
    }

    /**
     * @return string
     */
    final public function getCreatedAt(): string
    {
        return DateTime::createFromFormat('U', $this->createdAt)->format(self::DATETIME_FORMAT);
    }

    public function getSender(): UserInterface
    {
        return $this->sender;
    }

    public function getReceiver(): UserInterface
    {
        return $this->receiver;
    }
}