<?php
    session_start();
    require '/phpScripts/getSubmittedAnswers.php';
    include_once '/database/dataManager.php';
    include_once'/phpModel/answer.class.php';
    $manager = new DataManager;
    $answers = getSubmittedAnswer($manager, $_SESSION['qID'], $_SESSION['deviceID']);
    $_SESSION['aText']="";
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
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <!-- Question Table -->
                <div class="panel panel-default col-md-12">
                    <h3>Questions:</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Device ID</th>
                                <th>SubmittedAnswer</th>
                                <th>Display Answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div id="selector" class="btn-group">
                            <?php
                                foreach ($answers as $answer) {
                                    echo '<tr>
                                        <td value="'.$answer->getDeviceID().'">'.$answer->getNickname().'</td>
                                        <td id="'.$answer->getDeviceID().'">'.$answer->getSubAnswer().'</td>
                                        <td><button type="button" class="btn btn-default answerDisplay" name="displayAnswer" onclick="displayAnswer('.$answer->getDeviceID().')" >Display Answer</td>
                                    </tr>';
                                };
                            ?>
                            </div>
                        </tbody>
                    </table>
                </div>
                <!-- End Question Table -->
            </div>
        </div>
    </body>

    <script type="text/javascript">
        function displayAnswer(id) {
            var answerText = document.getElementById(id).innerHTML;
            sessionStorage.setItem("text", answerText);
            window.open("displayedAnswer.php", "Displayed Answer");
        }
    </script>
    
</html>