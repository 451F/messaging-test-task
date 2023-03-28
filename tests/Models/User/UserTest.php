<?php

namespace Models\User;

use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Models\User\User
 */
class UserTest extends TestCase
{


    /**
     * @covers       \Models\User\User::getFullName
     * @dataProvider provideGetFullNameData
     * @param UserInterface $user
     * @param string $result
     * @return void
     */
    public function testGetFullName(UserInterface $user, string $result): void
    {
        $this->assertEquals($result, $user->getFullName());
    }

    /**
     * @dataProvider provideSaveData
     * @param UserInterface $user
     * @param bool $result
     * @return void
     */
    public function testSave(UserInterface $user, bool $result): void
    {
        $this->assertEquals($result, $user->save());
    }

    public function provideGetFullNameData(): iterable
    {
        $firstName = Factory::create()->firstName;
        $lastName = Factory::create()->lastName;
        $salutation = Factory::create()->title;
        $email = Factory::create()->email;

        yield 'Student full name' => [
            new User($firstName,
                $lastName,
                $email,
                UserType::Student,
                false,
                $salutation),
            trim($firstName . ' ' . $lastName)
        ];
        yield 'teacher full name' => [
            new User($firstName,
                $lastName,
                $email,
                UserType::Teacher,
                false,
                $salutation),
            trim($salutation . ' ' . $firstName . ' ' . $lastName)
        ];
        yield 'Parent full name' => [
            new User($firstName,
                $lastName,
                $email,
                UserType::Parent,
                false,
                $salutation),
            trim($salutation . ' ' . $firstName . ' ' . $lastName)
        ];
    }

    public function provideSaveData(): iterable
    {
        yield 'Ok with default photo and valid email' => [
            new User(
                Factory::create()->firstName,
                Factory::create()->lastName,
                Factory::create()->email,
                UserType::Student
            ),
            true
        ];
        yield 'Ok with valid photo and valid email' => [
            new User(
                Factory::create()->firstName,
                Factory::create()->lastName,
                Factory::create()->email,
                UserType::Student,
                Factory::create()->filePath() . '.jpg'
            ),
            true
        ];
        yield 'Fail with default photo and not valid email' => [
            new User(
                Factory::create()->firstName,
                Factory::create()->lastName,
                'not_valid_email',
                UserType::Student,
            ),
            false
        ];
        yield 'Fail with not valid photo and not valid email' => [
            new User(
                Factory::create()->firstName,
                Factory::create()->lastName,
                'not_valid_email',
                UserType::Student,
                'not_an_image'
            ),
            false
        ];
    }


}
