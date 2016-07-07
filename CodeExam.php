<?php

/**
 * Created by PhpStorm.
 * User: dhiraj
 * Date: 6/7/16
 * Time: 8:40 PM
 */
class CodeExam
{
    public function __construct()
    {}

    /**
     * This method will calculate next date of draw
     * @param string $inputDateTime '2016-07-06 20:12:00'
     * @return null|string
     */
    public function dateCalculation($inputDateTime = "")
    {
        date_default_timezone_set('Europe/Dublin');

        $dateFormat = 'Y-m-d H:i:s';
        $nextDrawDateWed = null;
        $nextDrawDateSat = null;
        $nextDrawDate = null;
        //$inputDateTimeObj1 = null;
        //$inputDateTimeObj2 = null;
        $interval = 0;
        
        // if input date is null then take the current date time as default
        if ($inputDateTime == "" || $inputDateTime == null){
            $inputDateTime = date($dateFormat);
            $inputDateTimeObj = new DateTime($inputDateTime);
        }else{
            $inputDateTimeObj = new DateTime($inputDateTime);
        }

        $nextDrawDateWed = $inputDateTimeObj->modify('next wednesday 8pm')->format($dateFormat);
        $inputDateTimeObj = new DateTime($inputDateTime);
        $nextDrawDateSat = $inputDateTimeObj->modify('next saturday 8pm')->format($dateFormat);

        //$inputDateTimeObj1 = new DateTime($nextDrawDateWed);
        //$inputDateTimeObj2 = new DateTime($nextDrawDateSat);
        //$interval = $inputDateTimeObj1->diff($inputDateTimeObj2);
        $interval = (strtotime($nextDrawDateWed) - strtotime($nextDrawDateSat));

        // day difference between two next days
        if($interval > 0){
            // next wed is farther to next sat
            $nextDrawDate = $nextDrawDateSat;
        }else{
            // next sat is farther to next wed
            $nextDrawDate = $nextDrawDateWed;
        }

        return $nextDrawDate;
    }

    /**
     * This method will use LRU cache process
     */
    public function lruCache()
    {
        require_once ('SimpleLruCache.php');

        $size = 10;
        $lruCache = new simpleLruCache($size);

        for($i = 1; $i <= $size; $i++){
            $db[] = 'page no '.$i;
        }

        //$testPattern = "0,2,4,1,0,5,3,1,7,3,5,3,0,1,5,2,5,1,4";
        $testPattern = "0,1,2,3,4,1,2,3,4,1,1,1,1";
        $testPatternArr = explode(",", $testPattern);
        // Implement test pattern.
        foreach ($testPatternArr as $index) {
            $item = $lruCache->referencePage($index);

            if ($item != null) {
                echo "Cache page hit. ". $item."<br>";
            } else {
                echo "Cache page miss for key ".$index.". Adding ".$db[$index]." to cache.<br>";
                $lruCache->enQueue($index, $db[$index]);
            }
        }

    }

    /**
     * This method will find out the matched anagram words [array] from an another list [array]
     * @param $word
     * @param $list array
     * @return array
     */
    public function findAnagramList($word, $list)
    {
        $result = array();
        // making word an charcter array
        $wordAsArray = str_split(strtolower($word));

        // loop throrugh all word in list to match
        foreach ($list as $listWord){
            $charPos1 = 0;
            $anagram = true;
            // create array of a word from list
            $listWordAsArray = str_split(strtolower($listWord));

            // loop while all charcter from word match with list's word
            while ($charPos1 < count($wordAsArray) && $anagram === true) {
                $charPos2 = 0;
                $found = false;

                // loop all characters of a list word
                while ($charPos2 < count($listWordAsArray) && $found === false) {

                    if ($wordAsArray[ $charPos1 ] == $listWordAsArray[ $charPos2 ]) {
                        $found = true;
                    } else {
                        $charPos2 += 1;
                    }
                }

                if ($found === true) {
                    $listWordAsArray[ $charPos2 ] = "";
                } else {
                    $anagram = false;
                }

                $charPos1 += 1;
            }
            // if anagram then save into result array of this list's word
            if($anagram){
                $result[] = $listWord;
            }
        }

        return $result;
    }
}