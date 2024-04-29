<?php
use PHPUnit\Framework\TestCase;

class CreateLectureTest extends TestCase
{
    public function testEmptyTitle()
    {
        // Arrange
        $_POST['title'] = '';

        // Act
        $result = str_len(str_wash($_POST['title']));

        // Assert
        $this->assertEquals(0, $result);
    }

    public function testLectureStartsEarlierThanTomorrow()
    {
        // Arrange
        $_POST['starts_at'] = date('Y-m-d\TH:i', strtotime('00:00'));

        // Act
        $result = $_POST['starts_at'] < date('Y-m-d\TH:i', strtotime('00:00 +1 day'));

        // Assert
        $this->assertTrue($result);
    }

    public function testInvalidCourse()
    {
        // Arrange
        $_POST['course'] = 'invalid-course';

        // Act
        $result = str_fit('[1-9]\d{0,15}', $_POST['course']);

        // Assert
        $this->assertFalse($result);
    }

    public function testCourseAlreadyHasLectureAtThisTime()
    {
        // Arrange
        $_POST['course'] = '1';
        $_POST['starts_at'] = date('Y-m-d\TH:i', strtotime('00:00'));

        // Act
        // Assuming sql function returns true if a lecture already exists at this time
        $result = sql('
            SELECT 1 FROM `lectures` WHERE
                `lectures`.course_id='.$_POST['course'].' AND
                `lectures`.starts_at>\''.date('Y-m-d\TH:i', strtotime($_POST['starts_at'].' -90 minute')).'\' AND
                `lectures`.starts_at<\''.date('Y-m-d\TH:i', strtotime($_POST['starts_at'].' +90 minute')).'\'
            LIMIT 1', 1);

        // Assert
        $this->assertTrue($result);
    }
}