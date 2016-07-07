# This application made up with 3 different modules or you can say tests. Tried to make as simple as possible for those complex problems.

-- 1. Date Calculation
The Irish lottery draw takes place twice weekly on a Wednesday and a Saturday at 8pm.
Write a function that calculates and returns the next valid draw date based on the current date and time and also on an optional supplied date.

-- 2. Least recently used cache
Implement a least recently used (LRU) cache mechanism and demonstrate its use in a small script. The LRU must be able to admit a ‘max_size’ parameter that by default has to be 100.

-- 3. Find the anagram
Write a function that accepts a word (string) and a list of words (list or tuple of strings) and return back a list with the valid anagrams for the word inside the given words list.

## How to install
-- You need LAM-PHP installed in your system.
-- Need to install PHPUnit to test. Follow the link to help to install PHPUnit into your system.
https://phpunit.de/getting-started.html
-- Keep the whole folder into your web root [or you can change into other folder as per your wish].
-- Give the proper permission at least 755


## How to run the application
-- Go to URL and paste this part /programmingskill1/ only after your web folder path [where you saved this application]
-- All 3 test result will be displayed one below another. All results are very descriptive. If not run then kindly check the code. Code are well commented all the places. And used very primary php functions.
-- If you want to run seperately then you have to create seperate function in index.php and need to call them from url or command line.

## How to test
-- After installing PHPUnit [see above how to install link].
-- Go to folder path in terminal. Run the following commands to test:
- Test all codeexample except LRU Cache command : # phpunit tests/CodeExamTest.php
- Test method wise then use --filter command eg. # phpunit --filter <b>testDateCalculationAssert</b> tests/CodeExamTest.php

- Test all LRU Cache command : # phpunit tests/SimpleLruCacheTest.php
- Test method wise then use --filter command eg. # phpunit --filter <b>testMakeQueueEmpty</b> tests/SimpleLruCacheTest.php

- any suggestion or comment send to me.
