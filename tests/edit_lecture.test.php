<?php
use PHPUnit\Framework\TestCase;

class EditLectureTest extends TestCase
{
    public function testAccessDeniedForNonAdminNonLecturer()
    {
        // Arrange
        $_USER = ['is_admin' => false, 'is_lecturer' => false];

        // Act
        // Assuming message function throws an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Access denied');

        include 'edit_lecture.php';
    }

    public function testPayloadMissing()
    {
        // Arrange
        $_USER = ['is_admin' => true];
        $_POST = [];

        // Act
        // Assuming message function throws an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Payload missing');

        include 'edit_lecture.php';
    }

    public function testEmptyTitle()
    {
        // Arrange
        $_USER = ['is_admin' => true];
        $_POST = [
            'lecture' => '1',
            'title' => '',
            'starts_at' => '2022-01-01T15:30',
            'course' => '1',
            'lecturer' => '1',
            'location' => 'Room 101'
        ];

        // Act
        // Assuming message function throws an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Please provide lecture\'s title');

        include 'edit_lecture.php';
    }
}