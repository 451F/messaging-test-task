<?php

namespace Models\Message;

use Models\User\User;
use Models\User\UserType;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{

    /**
     * @dataProvider provideSaveData
     * @param MessageInterface $message
     * @param bool $result
     * @return void
     */
    public function testSave(MessageInterface $message, bool $result): void
    {
        $this->assertEquals($result, $message->save());
    }

    public function provideSaveData(): iterable
    {
        $userStudent = new User('', '', '', UserType::Student);
        $userTeacher = new User('', '', '', UserType::Teacher);
        $userParent = new User('', '', '', UserType::Parent);
        yield 'Ok, Teacher -> Teacher Manual' => [
            new Message($userTeacher, $userTeacher, MessageType::Manual, ''),
            true
        ];
        yield 'Ok, Teacher -> Parent Manual' => [
            new Message($userTeacher, $userParent, MessageType::Manual, ''),
            true
        ];
        yield 'Ok, Teacher -> Student Manual' => [
            new Message($userTeacher, $userStudent, MessageType::Manual, ''),
            true
        ];
        yield 'Ok, Parent -> Teacher Manual' => [
            new Message($userParent, $userTeacher, MessageType::Manual, ''),
            true
        ];
        yield 'Ok, Student -> Teacher Manual' => [
            new Message($userStudent, $userTeacher, MessageType::Manual, ''),
            true
        ];
        yield 'Ok, Teacher -> Student System' => [
            new Message($userTeacher, $userStudent, MessageType::System, ''),
            true
        ];
        yield 'Fail, Teacher -> Parent System' => [
            new Message($userTeacher, $userParent, MessageType::System, ''),
            false
        ];
        yield 'Fail, Teacher -> Teacher System' => [
            new Message($userTeacher, $userTeacher, MessageType::System, ''),
            false
        ];
        yield 'Fail, Student -> Teacher System' => [
            new Message($userStudent, $userTeacher, MessageType::System, ''),
            false
        ];
        yield 'Fail, Student -> Student System' => [
            new Message($userStudent, $userStudent, MessageType::System, ''),
            false
        ];
        yield 'Fail, Student -> Parent System' => [
            new Message($userStudent, $userParent, MessageType::System, ''),
            false
        ];
        yield 'Fail, Parent -> Teacher System' => [
            new Message($userParent, $userTeacher, MessageType::System, ''),
            false
        ];
        yield 'Fail, Parent -> Student System' => [
            new Message($userParent, $userStudent, MessageType::System, ''),
            false
        ];
        yield 'Fail, Parent -> Parent System' => [
            new Message($userParent, $userParent, MessageType::System, ''),
            false
        ];
        yield 'Fail, Student -> Student Manual' => [
            new Message($userStudent, $userStudent, MessageType::Manual, ''),
            false
        ];
        yield 'Fail, Student -> Parent Manual' => [
            new Message($userStudent, $userParent, MessageType::Manual, ''),
            false
        ];
        yield 'Fail, Parent -> Student Manual' => [
            new Message($userParent, $userStudent, MessageType::Manual, ''),
            false
        ];
        yield 'Fail, Parent -> Parent Manual' => [
            new Message($userParent, $userParent, MessageType::Manual, ''),
            false
        ];
    }
}
