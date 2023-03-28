<?php

namespace Models\User;

enum UserType
{
    case Student;
    case Parent;
    case Teacher;
}
