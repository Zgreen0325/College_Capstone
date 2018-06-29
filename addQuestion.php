<!DOCTYPE html>
<html lang="en">

    <?php
        session_start();
        require '/phpScripts/createQuestion.php';
        include_once '/database/dataManager.php';
        $manager = new DataManager;
    ?>
    
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
        <?php
            if(isset($_POST["submit"])) {
                createQuestion($manager);
            }
        ?>
        <div class="container">
            <form action="addQuestion.php" method="post">
                <div class="form-group">
                    <label for="q_type">Question Type: </label>
                    <select class="form-control" name="q_type" id="q_type" onchange="questionType(this)">
                        <option value="multiplechoice">Multiple Choice</option>
                        <option value="shortanswer">Short Answer</option>
                        <option value="truefalse">True/False</option>
                        <option value="graphical">Graphical</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="q_text">Question Text: </label>
                    <textarea class="form-control" rows="5" name="q_text" id="q_text"></textarea>
                </div>
                <div class="form-group" id="multchoice">
                    <label for="a_textbutton">Add Answer:</label>
                    <button id="a_textbutton" onclick="addOption(); return false;">Add Answer</button><br />
                    <label for="correctID">Please input which option is correct (just the number): </label>
                    <textarea class="form-control" name="correctID" id="correctID"></textarea>
                </div>
                <div class="form-group hidden" id="shortanswer">
                </div>
                <div class="form-group hidden" id="truefalse">
                    <label for="tfCorrectID">Which is correct?</label>
                    <select class="form-control" name="tfCorrectID" id="tfCorrectID">
                        <option value="1">True</option>
                        <option value="2">False</option>
                    </select>
                </div>
                <div class="form-group hidden" id="graphical">
                    <label for="a_textg">Select a graph image to upload: </label>
                    <input type="file" hidden>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </body>
    
    <script>
        var multChoiceIndex = 1;
        
        function questionType(qType) {
            var qTypeValue = qType.options[qType.selectedIndex].value;
            if (qTypeValue == "multiplechoice") {
                document.getElementById("multchoice").classList.remove("hidden")
                document.getElementById("shortanswer").classList.add("hidden")
                document.getElementById("truefalse").classList.add("hidden")
                document.getElementById("graphical").classList.add("hidden")
            } else if (qTypeValue == "shortanswer") {
                document.getElementById("shortanswer").classList.remove("hidden")
                document.getElementById("multchoice").classList.add("hidden")
                document.getElementById("truefalse").classList.add("hidden")
                document.getElementById("graphical").classList.add("hidden")
            } else if (qTypeValue == "truefalse") {
                document.getElementById("truefalse").classList.remove("hidden")
                document.getElementById("shortanswer").classList.add("hidden")
                document.getElementById("multchoice").classList.add("hidden")
                document.getElementById("graphical").classList.add("hidden")
            } else if (qTypeValue == "graphical") {
                document.getElementById("graphical").classList.remove("hidden")
                document.getElementById("shortanswer").classList.add("hidden")
                document.getElementById("truefalse").classList.add("hidden")
                document.getElementById("multchoice").classList.add("hidden")
            }
        }
        
        function addOption() {
            var label = document.createElement("label");
            var labeltext = document.createTextNode("Answer Text: ");
            label.setAttribute("for", "answer"+multChoiceIndex.toString());
            label.appendChild(labeltext);
            var textarea = document.createElement("textarea");
            textarea.setAttribute("class", "form-control");
            textarea.setAttribute("id", "answer"+multChoiceIndex.toString());
            textarea.setAttribute("name", "answer"+multChoiceIndex.toString())
            linebreak = document.createElement("br");
            document.getElementById("multchoice").appendChild(linebreak);
            document.getElementById("multchoice").appendChild(label);
            document.getElementById("multchoice").appendChild(textarea);
            multChoiceIndex++;
        }
    </script>
</html>