<?php
    session_start();
    require '/phpScripts/createDeviceID.php';
    include_once '/database/dataManager.php';
    $manager = new DataManager;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nickname = $_POST['nickname'];
        $deviceID = createDeviceID($nickname, $manager);
        $_SESSION['deviceID'] = $deviceID;
        header('Location: http://mcs.drury.edu/GameOfPhones/questions.php');
    }
    session_write_close();
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://mcs.drury.edu/GameOfPhones/css/bootstrap.css">

		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="http://mcs.drury.edu/GameOfPhones/css/main.css">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Admin</title>
	</head>
	<body>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Game of Phones</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="index.php">
						<div class="form-group">
							<label for="nickname" class="cols-sm-2 control-label">Enter a Nickname</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="nickname" id="nickname"  placeholder="Enter your nickname"/>
								</div>
							</div>
						</div>
                        <input type="submit" value="Login" />
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	</body>
</html>