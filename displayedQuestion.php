<?php
    session_start();
    require '/phpScripts/getQuestionAnswers.php';
    require '/phpScripts/setQuestion.php';
    include_once '/database/dataManager.php';
    include_once'/phpModel/questionAnswer.class.php';
    $manager = new DataManager;

    if (isset($_POST['qID'])) {
        $_SESSION['qID'] = $_POST['qID'];
    }
    if (isset($_POST['deviceID'])) {
        $_SESSION['deviceID'] = $_POST['deviceID'];
    }

    $answers = getQuestionAnswers($manager, $_SESSION['qID']);
    $success = setQuestion($manager, $_SESSION['qID'], $_SESSION['deviceID']);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Small Business - Start Bootstrap Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="http://mcs.drury.edu/GameOfPhones/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="http://mcs.drury.edu/GameOfPhones/css/small-business.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- JQuery initialization -->
        <script src="js/jquery-1.9.1.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        
    </head>
    
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1 id="question"></h1>
            </div>
            <?php
                foreach ($answers as $answer) {
                    echo '<div class="row">';
                    echo '<div class="jumbotron">';
                    echo '<h1>'.$answer->getText().'</h1>';
                    echo '</div></div>';
                };
            ?>
        </div>
    </body>
    
    <script type="text/javascript">
        document.getElementById("question").innerHTML = sessionStorage.getItem("text");
    </script>
    
</html>