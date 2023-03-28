<?php

namespace Models\User;

use Models\BaseModel;

class User extends BaseModel implements UserInterface
{

    /**
     * @var string
     */
    private string $id;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param UserType $userType
     * @param string $profilePhoto
     * @param string $salutation
     */
    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $email,
        private readonly UserType $userType,
        private readonly string $profilePhoto = self::DEFAULT_PROFILE_PHOTO,
        private readonly string $salutation = ''
    )
    {
        $this->id = uniqid('', true);
        parent::__construct();
    }

    /**
     * @return string
     */
    final public function getFullName(): string
    {
        return trim(
            ($this->userType === UserType::Student ?: ($this->salutation . ' '))
            . $this->lastName . ' ' . $this->firstName
        );

    }

    /**
     * @return string
     */
    final public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    final public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    final public function getProfilePhoto(): string
    {
        return $this->profilePhoto;
    }

    /**
     * @return UserType
     */
    final public function getType(): UserType
    {
        return $this->userType;
    }
}