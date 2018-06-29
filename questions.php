<?php
    session_start();
    require '/phpScripts/getQuestion.php';
    include_once '/database/dataManager.php';
    include_once '/phpModel/question.class.php';
    $manager = new DataManager;
    $questions = getQuestion($manager);
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
                <p id="deviceID" value="<?php $_SESSION['deviceID'] ?>">Teacher ID:
                    <?php 
                        if(isset($_SESSION['deviceID']))
                            echo $_SESSION['deviceID'];
                        else
                            echo 'Uh-oh, something went wrong';
                    ?>
                <p>
            </div>
            <div class="row">
                <!-- Question Table -->
                <div class="panel panel-default col-md-12">
                    <h3 class="float-left" style="float:left;">Questions:</h3>
                    <span class="input-group-btn">
                        <a class="btn btn-link btn-number" data-type="plus" data-field="quant[1]" style="float:right; margin-top:1em;" href="addQuestion.php">
                            Add Question <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </span>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Question ID</th>
                                <th>Text</th>
                                <th>Correct Answer</th>
                                <th>Set Active</th>
                                <th>Display Answers</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div id="selector" class="btn-group">
                            <?php
                                $buttonID = 1;
                                foreach ($questions as $question) {
                                    echo '<tr>
                                        <td>'.$question->getId().'</td>
                                        <td id="'.$question->getId().'">'.$question->getText().'</td>
                                        <td>'.$question->getCorrectAnswer().'</td>
                                        <td><button type="button" class="btn btn-default" id="'.$buttonID.'"name="activeQuestion" onclick="setActive('.$question->getId().')">Set Active Question</td>
                                        <td><button type="button" class="btn btn-default answerDisplay" name="displayAnswers"><a href="/GameOfPhones/answers.php" >Display Answers</a></td>
                                    </tr>';
                                    ++$buttonID;
                                };
                            ?>
                            </div>
                        </tbody>
                    </table>
                </div>
                <!-- End Question Table -->
            </div>
            <!-- End Content Row -->

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; D^3 2016</p>
                    </div>
                </div>
            </footer>
        <!-- /.container -->
        </div>

    </body>

    <script type="text/javascript">

        function setActive(id) {
        
            var qText, qID, deviceID;
            qID = id;
            qText = document.getElementById(id).innerHTML;
            deviceID = <?php echo $_SESSION['deviceID'] ?>;
            sessionStorage.setItem("text", qText);
            
            $.ajax({
                type: "POST",
                url: "displayedQuestion.php",
                data: ({qID : qID, deviceID : deviceID}),
                success: function(data) {
                    window.open("displayedQuestion.php", "Displayed Question")
                }
            })
        }
    </script>
    
</html>