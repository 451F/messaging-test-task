<?php

namespace Models\Message;

use Models\User\UserInterface;

interface MessageInterface
{
    const DATETIME_FORMAT = '';

    public function getSender(): UserInterface;
    public function getReceiver(): UserInterface;

    public function getType(): MessageType;
}