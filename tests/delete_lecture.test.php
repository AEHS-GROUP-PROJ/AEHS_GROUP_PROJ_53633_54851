<?php
use PHPUnit\Framework\TestCase;

class DeleteLectureTest extends TestCase
{
    protected function setUp(): void
    {
        // Mock $_USER and $_POST superglobals
        global $_USER, $_POST;
        $_USER = ['is_admin' => true, 'is_lecturer' => true];
        $_POST = ['lecture' => '1'];
    }

    public function testAccessDeniedForNonAdminsAndNonLecturers()
    {
        // Arrange
        global $_USER;
        $_USER['is_admin'] = false;
        $_USER['is_lecturer'] = false;

        // Act and Assert
        $this->expectOutputString('Access denied');
        require 'delete_lecture.php';
    }

    public function testPayloadMissing()
    {
        // Arrange
        global $_POST;
        $_POST = [];

        // Act and Assert
        $this->expectOutputString('Payload missing');
        require 'delete_lecture.php';
    }

    public function testLectureAttended()
    {
        // Arrange
        // Mock sql function to return true
        function sql($query, $return) {
            return true;
        }

        // Act and Assert
        $this->expectOutputString('Can\'t cancel a lecture with attendance records');
        require 'delete_lecture.php';
    }

    public function testLectureDeletion()
    {
        // Arrange
        // Mock sql function to return false for the first call (no attendance records)
        // and true for the second call (successful deletion)
        function sql($query, $return) {
            static $call = 0;
            $call++;
            return $call == 2;
        }

        // Act and Assert
        $this->expectOutputString('Lecture successfully canceled');
        require 'delete_lecture.php';
    }
}