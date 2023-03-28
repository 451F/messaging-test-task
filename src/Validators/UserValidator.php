<?php

namespace Validators;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Models\User\UserInterface;

class UserValidator
{
    private const IMAGE_PATTERN = '.jpg';

    /**
     * @param UserInterface $user
     * @return bool
     */
    public static function validate(UserInterface $user): bool
    {
        return
            (new EmailValidator())->isValid($user->getEmail(), new RFCValidation())
            && str_contains(strtolower($user->getProfilePhoto()), self::IMAGE_PATTERN);
    }
}