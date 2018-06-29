 <?php

    include_once '/phpModel/question.class.php';

    function getQuestion($manager)
    {

            //set up query
            $query = 'select * from questions left join answers on questions.q_correct_id=answers.a_id;';

            $manager->connect();

            $result = $manager->doQuery($query);

            if ($result) {
                // process the results placing them in an array
                $resultArray = array();
                while ($row = $result->fetch()) {
                    $question = new question($row['q_id'], $row['q_text'], $row['q_type'], $row['p_filename'], $row['q_correct_id'], $row['a_text']);
                    $questionArray[] = $question;
                    extract($row);
                }
            }
            $manager->disconnect();
        return $questionArray;
    }

?> 