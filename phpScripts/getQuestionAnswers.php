<?php

   include_once'/phpModel/questionAnswer.class.php';

    function getQuestionAnswers($manager, $qID) {
        $query = 'select * from multanswers natural join answers where q_id =' . $qID . ';';
        $manager->connect();
        $isMult = isQuestionMultChoice($manager, $qID);
        $answerArray = array();
        
        if ($isMult = true) {
            $result = $manager->doQuery($query);
            $resultArray = array();
            while ($row = $result->fetch()) {
                $answer = new questionAnswer($row['a_id'], $row ['q_id'], $row['a_text'], $row['p_filename']);
                $answerArray[] = $answer;
                extract($row);
            }
            $manager->disconnect();
            return $answerArray;
        }
        else {
            return $answerArray;
        }
    }

    function isQuestionMultChoice($manager, $qID) {
        $query = 'select q_type from questions where q_id = '.$qID.';';
        $manager->connect();
        $result = $manager->doQuery($query);
        $row = $result->fetch();
        if ($row['q_type'] = "mult") {
            return true;
        }
        else {
            return false;
        }
    }
    
?>