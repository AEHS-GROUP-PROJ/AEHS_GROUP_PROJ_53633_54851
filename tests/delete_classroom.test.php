<?php
use PHPUnit\Framework\TestCase;

class DeleteClassroomTest extends TestCase
{
    protected function setUp(): void
    {
        // Mock $_USER and $_POST superglobals
        global $_USER, $_POST;
        $_USER = ['is_admin' => true];
        $_POST = ['classroom' => '1'];
    }

    public function testAccessDeniedForNonAdmins()
    {
        // Arrange
        global $_USER;
        $_USER['is_admin'] = false;

        // Act and Assert
        $this->expectOutputString('Access denied');
        require 'delete_classroom.php';
    }

    public function testPayloadMissing()
    {
        // Arrange
        global $_POST;
        $_POST = [];

        // Act and Assert
        $this->expectOutputString('Payload missing');
        require 'delete_classroom.php';
    }

    public function testClassroomDeletion()
    {
        // Arrange
        global $_POST;
        $_POST['classroom'] = '1';

        // Mock sql function to return true
        $mock = $this->getFunctionMock('namespace', 'sql');
        $mock->expects($this->once())->willReturn(true);

        // Act and Assert
        $this->expectOutputString('Classroom successfully deleted');
        require 'delete_classroom.php';
    }
}