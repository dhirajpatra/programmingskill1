<?php
/**
 * Created by PhpStorm.
 * User: dhiraj
 * Date: 6/7/16
 * Time: 9:37 PM
 */

use PHPUnit\Framework\TestCase;
// include the test class
require_once ('CodeExam.php');

class CodeExamTest extends PHPUnit_Framework_TestCase
{
    /**
     * This will test dateCalculation result with given date time
     */
    public function testDateCalculationAssert()
    {
        // Code Exam
        $codeExamObj = new CodeExam();
        $expectedDate = '2016-07-13 20:00:00';

        // Assert next draw date
        $this->assertEquals($expectedDate, $codeExamObj->dateCalculation('2016-07-09 20:00:00'));
    }

    /**
     * This will test dateCalculation result with default date time
     */
    public function testDateCalculationDefaultDateAssert()
    {
        // Code Exam
        $codeExamObj = new CodeExam();
        $expectedDate = '2016-07-09 20:00:00';

        // Assert next draw date
        $this->assertEquals($expectedDate, $codeExamObj->dateCalculation());
    }

    /**
     * This will test the result from anagram list
     */
    public function testFindAnagramListAssert()
    {
        // Code Exam
        $codeExamObj = new CodeExam();
        $word = 'python';
        $list = array(
            'good', 'again', 'tyophn', 'something', 'typnn', 'nohpty'
        );
        $expectedResult = array(
            'tyophn', 'nohpty'
        );

        // Assert the result list after anagram test
        $this->assertEquals($expectedResult, $codeExamObj->findAnagramList($word, $list));
    }

    /**
     * This will test with different character cases the result from anagram list
     */
    public function testFindAnagramListCaseAssert()
    {
        // Code Exam
        $codeExamObj = new CodeExam();
        $word = 'PYTHON';
        $list = array(
            'good', 'again', 'tyophn', 'something', 'typnn', 'nohpty'
        );
        $expectedResult = array(
            'tyophn', 'nohpty'
        );

        // Assert the result list after anagram test
        $this->assertEquals($expectedResult, $codeExamObj->findAnagramList($word, $list));
    }
}
