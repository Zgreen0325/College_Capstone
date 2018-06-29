<?php

    include_once '/phpModel/answer.class.php';

    function getSubmittedAnswer($manager, $qID, $teacherID) {
        
        //set up query
        $query = 'select s.q_id, s.p_device_id, a.a_text, s.sub_ans, n.nickname, s.displayed from submittedanswers s left join multanswers m on s.q_id = m.q_id left join answers a on m.a_id = a.a_id left join nicknames n on s.p_device_id = n.device_id where s.q_id = 4 and s.teacher_id = 0;'; 
        //Correct query for post-testing
        //$query = 'select s.q_id, s.p_device_id, a.a_text, s.displayed from submittedanswers s left join multanswers m on s.q_id = m.q_id left join answers a on m.a_id = a.a_id left join nicknames n on s.p_device_id = n.device_id where s.q_id = '.$qID.' and s.teacher_id = '.$teacherID.';'; 
        
        
        //$query = 'select q_id, p_device_id, sub_ans, displayed from submittedanswers where q_id = '.$qID.' and teacher_id = 0;'; //this is for testing, the correct statement is teacher_id='.$teacherID.';';

        $manager->connect();

        $result = $manager->doQuery($query);
        if ($result) {
            // process the results placing them in an array
            $resultArray = array();
            while ($row = $result->fetch()) {
                $answer = new answer($row['q_id'], $row['p_device_id'], $row['a_text'], $row["sub_ans"], $row['nickname'], $row['displayed']);
                $answerArray[] = $answer;
                extract($row);
            }
        }
        $manager->disconnect();
        return $answerArray;
    }
    
?>