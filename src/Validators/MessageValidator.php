<?php

namespace Validators;

use Models\Message\MessageInterface;
use Models\Message\MessageType;
use Models\User\UserType;

class MessageValidator
{
    private const VALID_MANUAL_MESSAGES = [
        [UserType::Teacher, UserType::Teacher],
        [UserType::Teacher, UserType::Student],
        [UserType::Teacher, UserType::Parent],
        [UserType::Student, UserType::Teacher],
        [UserType::Parent, UserType::Teacher],
    ];

    /**
     * @param MessageInterface $message
     * @return bool
     */
    public static function validate(MessageInterface $message): bool
    {
        $senderType = $message->getSender()->getType();
        $receiverType = $message->getReceiver()->getType();
        $messageType = $message->getType();

        return match ($messageType) {
            MessageType::System => $senderType === UserType::Teacher && $receiverType === UserType::Student,
            MessageType::Manual => in_array([$senderType, $receiverType], self::VALID_MANUAL_MESSAGES),
            default => false,
        };
    }
}