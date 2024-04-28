<?php
use PHPUnit\Framework\TestCase;

class EditClassroomTest extends TestCase
{
    protected function setUp(): void
    {
        // Mock $_POST superglobal
        global $_POST;
        $_POST = ['classroom' => 1, 'title' => 'Test Classroom', 'location' => 'Test Location'];
    }

    public function testClassroomAlreadyExists()
    {
        // Arrange
        global $_POST;
        $_POST['title'] = 'Existing Classroom';

        // Mock sql function to return true
        $mock = $this->getFunctionMock('namespace', 'sql');
        $mock->expects($this->once())->willReturn(true);

        // Act and Assert
        $this->expectOutputString('Classroom with such title already exists');
        require 'edit_classroom.php';
    }

    public function testClassroomUpdate()
    {
        // Arrange
        global $_POST;
        $_POST['title'] = 'Updated Classroom';

        // Mock sql function to return false for the first call (classroom doesn't exist)
        // and true for the second call (classroom update successful)
        $mock = $this->getFunctionMock('namespace', 'sql');
        $mock->expects($this->at(0))->willReturn(false);
        $mock->expects($this->at(1))->willReturn(true);

        // Act and Assert
        $this->expectOutputString('Classroom successfully updated');
        require 'edit_classroom.php';
    }
}