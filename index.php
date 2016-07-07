<?php
/**
 * Created by PhpStorm.
 * User: dhiraj
 * Date: 6/7/16
 * Time: 8:48 PM
 */

// include the test class
require_once ('CodeExam.php');

// CodeExam object
$codeExamObj = new CodeExam();

// new draw date
$day = '2016-07-06 20:00:00';
$nextDrawDate = $codeExamObj->dateCalculation($day);
//$nextDrawDate = $codeExamObj->dateCalculation('2016-07-09 20:00:00');
$inputDate = $day <> ''?date('d/m/Y - h:i A', strtotime($day)):date('d/m/Y - h:i A', strtotime(date('2016-07-06 20:00:00')));
echo 'Date Calculator :<br><br> Input date is '.$inputDate.' next DRAW date and time is '.date('d/m/Y - h:i A', strtotime($nextDrawDate)).'<br><hr>';

echo 'LRU Cache Test : <br><br>';
echo $codeExamObj->lruCache();
echo '<br><hr>';

echo 'Anagram Test :<br><br>';
$word = 'PYTHON';
$list = array(
  'good', 'again', 'tyophn', 'something', 'typnn', 'nohpty'
);
echo 'Word : '.$word.'<br>';
$result = $codeExamObj->findAnagramList($word, $list);
echo 'Anagram result list : <br>';
print_r($result);