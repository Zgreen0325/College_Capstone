 <?php

    function createQuestion($manager) {
        
        $manager->connect();
        $query = "SELECT * FROM questions ORDER BY q_id DESC LIMIT 0, 1";
        $result = $manager->doQuery($query);
        $row = $result->fetch();
        $q_id = $row['q_id'];
        $q_id = $q_id + 1;
        
        if($_POST["q_type"] == "multiplechoice") {
            setMultChoice($manager, $q_id);
        }
        else if ($_POST["q_type"] == "shortanswer") {
            setShortAnswer($manager, $q_id);
        }
        else if ($_POST["q_type"] == "truefalse") {
            setTrueFalse($manager, $q_id);
        }
        else if ($_POST["q_type"] == "graphical") {
            setGraphical($manager, $q_id);
        }
        
    }

    function setMultChoice($manager, $q_id) {
        
        $manager->connect();
        $multChoiceIndex = 1;
        $query = "SELECT * FROM answers ORDER BY a_id DESC LIMIT 0, 1";
        $result = $manager->doQuery($query);
        $row = $result->fetch();
        $a_id = $row['a_id'];
        $a_id = $a_id + 1;
        $correctID;
        while(isset($_POST["answer".$multChoiceIndex])) {
            $resultCreate = createMultChoiceAnswer($manager, $_POST["answer".$multChoiceIndex]);
            $resultLink = linkMultipleChoice($manager, $a_id, $q_id);
            $a_id = $a_id + 1;
            $multChoiceIndex = $multChoiceIndex + 1;
        }
        $sql = "INSERT INTO questions (q_text, q_type, q_correct_id) VALUES (?, ?, ?)";
        $values = array($_POST["q_text"], "mult", $_POST["correctID"]);
        $result = $manager->doNonQuery($sql,TRUE,$values);
    }

    function setTrueFalse($manager, $q_id) {
        $manager->connect();
        $sqlTrue = "INSERT INTO multanswer (".$q_id.", 1)";
        $sqlFalse = "INSERT INTO multanswers (".$q_id.", 2)";
        $sql = "INSERT INTO questions (q_text, q_type, q_correct_id) VALUES (?, ?, ?)";
        $values = array($_POST["q_text"], "tf", $_POST["tfCorrectID"]);
        $result = $manager->doNonQuery($sql,TRUE,$values);
    }
    
    function setShortAnswer($manager, $q_id) {
        $manager->connect();
        $sql = "INSERT INTO questions (q_text, q_type, q_correct_id) VALUES (?, ?, ?)";
        $values = array($_POST["q_text"], "sa", "0");
        $result = $manager->doNonQuery($sql,TRUE,$values);
    }

    function createMultChoiceAnswer($manager, $a_text) {
        $sql = "INSERT INTO answers (a_text) VALUES (?)";
        $values = array($a_text);
        $result = $manager->doNonQuery($sql, TRUE, $values);
    }

    function linkMultipleChoice($manager, $a_id, $q_id) {
        $sql = "INSERT INTO multanswers (?, ?)";
        $values = array($q_id, $a_id);
        $result = $manager->doNonQuery($sql, TRUE, $values);
    }
?> 