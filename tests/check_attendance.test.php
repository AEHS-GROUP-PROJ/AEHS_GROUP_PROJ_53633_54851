<?php
use PHPUnit\Framework\TestCase;

class CheckAttendanceTest extends TestCase
{
    public function testAccessDeniedForNonLecturer()
    {
        // Arrange
        $_USER = ['is_lecturer' => false];

        // Act
        // Assuming message function throws an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Access denied');

        include 'check_attendance.php';
    }

    public function testPayloadMissing()
    {
        // Arrange
        $_USER = ['is_lecturer' => true];
        $_POST = [];

        // Act
        // Assuming message function throws an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Payload missing');

        include 'check_attendance.php';
    }

    public function testNotActualLecturer()
    {
        // Arrange
        $_USER = ['is_lecturer' => true, 'id' => '1'];
        $_POST = [
            'lecture' => '1',
            'student' => '1',
            'attendance' => '1'
        ];

        // Act
        // Assuming sql function returns false if user is not the actual lecturer
        // and message function throws an exception
        $this->expectException(Exception::class);

        include 'check_attendance.php';
    }
}