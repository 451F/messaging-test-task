<?php

namespace Models;
use Models\Message\Message;
use Models\User\User;
use RuntimeException;
use Validators\MessageValidator;
use Validators\UserValidator;

abstract class BaseModel
{
    private UserValidator|MessageValidator $validator;

    public function __construct()
    {
        $this->validator = $this->getValidator();
    }

    final public function save(): bool
    {
        return $this->validator->validate($this);
    }

    /**
     * @throws RuntimeException
     */
    private function getValidator(): UserValidator|MessageValidator
    {
        return match ($this::class) {
            User::class => new UserValidator(),
            Message::class => new MessageValidator(),
            default => throw new RuntimeException('Not implemented validator for ' . $this::class),
        };
    }
}