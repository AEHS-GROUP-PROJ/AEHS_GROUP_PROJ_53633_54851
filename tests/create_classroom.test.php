<?php
use PHPUnit\Framework\TestCase;

class CreateClassroomTest extends TestCase
{
    protected function setUp(): void
    {
        // Mock $_USER and $_POST superglobals
        global $_USER, $_POST;
        $_USER = ['is_admin' => true];
        $_POST = ['title' => 'Test Classroom', 'location' => 'Test Location', 'capacity' => '30'];
    }

    public function testAccessDeniedForNonAdmins()
    {
        // Arrange
        global $_USER;
        $_USER['is_admin'] = false;

        // Act and Assert
        $this->expectOutputString('Access denied');
        require 'create_classroom.php';
    }

    public function testPayloadMissing()
    {
        // Arrange
        global $_POST;
        $_POST = [];

        // Act and Assert
        $this->expectOutputString('Payload missing');
        require 'create_classroom.php';
    }

    public function testTitleValidation()
    {
        // Arrange
        global $_POST;
        $_POST['title'] = '';

        // Act and Assert
        $this->expectOutputString('Please provide classroom\'s title');
        require 'create_classroom.php';
    }

    public function testLocationValidation()
    {
        // Arrange
        global $_POST;
        $_POST['location'] = '';

        // Act and Assert
        $this->expectOutputString('Please provide classroom\'s location');
        require 'create_classroom.php';
    }
}