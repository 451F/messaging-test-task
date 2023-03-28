<?php

namespace Models\User;

interface UserInterface
{
    public const DEFAULT_PROFILE_PHOTO = 'somephoto.jpg';

    public function save(): bool;
}