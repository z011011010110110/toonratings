<?php
	session_start(); 
	include_once 'dbh.inc.php';
	
		//reset session if not logged in
		if (isset($_SESSION['id']))
		{
			if ($_SESSION['id']!=1 && $_SESSION['id']!=4)
			{
				session_unset();
				session_destroy();
				session_start();
			}
		}
	
	
	
	if(!empty($_POST['username'])) {
		$username = $_POST['username'];
	}
	else
	{
		$username = '';
	}
	
	if(!empty($_POST['password'])) {
		$password = $_POST['password'];
	}
	else
	{
		$password = '';
	}
	if(!empty($_POST['verifyPassword'])) {
		$verifyPassword = $_POST['verifyPassword'];
	}
	else
	{
		$verifyPassword = '';
	}
	
	if(!empty($_POST['contact'])) {
		$contact = $_POST['contact'];
	}
	else
	{
		$contact = '';
	}
	
	//Verify username and password and set session
	if (isset($_POST['Log']))
	{
		//session_unset();
		//session_destroy();
		//session_start();
		$sql2 = "SELECT *FROM user WHERE userName = '$username' OR contact = '$username';";
		$result2 = mysqli_query($con, $sql2);	
		
		if ($_POST['username'] == "admin")
		{
			$_SESSION['id'] = 1;
		}
		else if (mysqli_num_rows($result2) > 0 || $username == '') //username taken, attempt to log in
		{
			$value = mysqli_fetch_assoc($result2);
			if($value['password'] == $password && $value['admin'] != 2 && $username != '') //loggin in 
			{
				$_SESSION['id']=4;
				$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT *FROM user WHERE userName = '$username';"));
				$_SESSION['userID'] = $user['id'];

			}
			else //wrong password
			{
				$_SESSION['id']=3;
			}
		}

		else if (mysqli_num_rows($result2) == 0) //username not taken
		{
			$contactTaken = false;
			$sql3 = "SELECT *FROM user WHERE contact = '$contact';";
			$result3 = mysqli_query($con, $sql3);
			 if (mysqli_num_rows($result3) >  0)
			 {
				 $contactTaken = true;
			 }
			
			if ($contactTaken ||$contact == '' || $username == '' || $password == ''|| $verifyPassword == ''|| ($password != $verifyPassword))
			{
				echo "<img style='display:none' src = 'https://soundabox.com/defaultProf.JPG' name = 'defaultImage'></img>";
				if ($contact =='')
				{
					echo "<input style = 'animation: shake 0.75s cubic-bezier(.36,.07,.19,.97) both' value = '".$contact."' id = 'contactHolder' type='text' name='contact' onkeydown='submitLog(event)' placeholder = 'Email or Phone#'>";
				}
				else if ($contactTaken)
				{
					echo "<input style = 'animation: shake 0.75s cubic-bezier(.36,.07,.19,.97) both' value = '' id = 'contactHolder' type='text' name='contact' onkeydown='submitLog(event)' placeholder = '".$contact." is taken...'>";
				}
				else
				{
					echo "<input value = '".$contact."' id = 'contactHolder' type='text' name='contact' onkeydown='submitLog(event)' placeholder = 'Email or Phone#'>";
				}
				
				if ($username == '')
				{
					echo "<input style = 'animation: shake 0.75s cubic-bezier(.36,.07,.19,.97) both' id = 'username' value = '".$username."' type='text' name='username' onkeydown='submitLog(event)' placeholder = 'Username or Email'>";
				}
				else
				{
					echo "<input id = 'username' value = '".$username."' type='text' name='username' onkeydown='submitLog(event)' placeholder = 'Username or Email'>";
				}
				
				if (($password == ''|| $verifyPassword == '')|| ($password != $verifyPassword))
				{
					echo "<input style = 'animation: shake 0.75s cubic-bezier(.36,.07,.19,.97) both' id = 'password' type ='password' name='password' onkeydown='submitLog(event)' placeholder = 'Password'>
						<input style = 'animation: shake 0.75s cubic-bezier(.36,.07,.19,.97) both' id = 'verifyPassword' type ='password' name='verifyPassword' onkeydown='submitLog(event)' placeholder = 'Verify Password'>";
				}
				else
				{
					echo "<input id = 'password' type ='password' name='password' onkeydown='submitLog(event)' placeholder = 'Password'>
						<input id = 'verifyPassword' type ='password' name='verifyPassword' onkeydown='submitLog(event)' placeholder = 'Verify Password'>";
				}
				echo "<input  id = 'submitButton' onclick = 'logging()' type='submit' name = 'Log' value='Log/Register' title = 'Register to use queue and playlists anywhere'>";
				$_SESSION['id']=2;
			}
			else
			{
				$_SESSION['id']=4;
				
				$addUser = mysqli_query($con, "INSERT INTO user (contact, userName, password)VALUES('$contact', '$username', '$password');");	//user added
				
				$result3 = mysqli_query($con, "SELECT *FROM user WHERE userName = '$username' AND contact = '$contact'");

				if(mysqli_num_rows($result3) > 0)
				{
					while ($row = mysqli_fetch_assoc($result3))
					{
						$userid = $row['id']; //userid is the the id of the new account
						
						$image = addslashes(file_get_contents("defaultProf.jpg"));
						mysqli_query($con,  "INSERT INTO profilepic (userid, profileImage) VALUES ('$userid', '$image');" );
						$compressedImg = addslashes(file_get_contents("defaultProf.jpg"));
						$sql2 = "UPDATE profilepic SET profileImage = '$compressedImg'  WHERE userid = $userid;";
						//$uploaded = mysqli_query($con, $sql2);
						
						copy("defaultProf.jpg", "user/".$userid."ProfPic.jpg");
					}
				}
				$_SESSION['userID'] = $userid;
			}
		}
	}
	
	if (isset($_SESSION['id']))
		{
			if ($_SESSION['id'] == 0)
			{
				echo "
					<input id = 'username' type='text' name='username' onkeydown='submitLog(event)' placeholder = 'Username or Email' value = '".$username."'>
					<input id = 'password' type = 'password' name='password' onkeydown='submitLog(event)' placeholder = 'Password'>
					<input id = 'submitButton' onclick = 'logging()' type='submit' name = 'Log' value='Log/Register' title = 'Register to use queue and playlists anywhere'>
				";	
			}
			else if ($_SESSION['id'] == 1)
			{
				echo "
					<form action='/log_out.php' method='POST'>
						<img id = 'profilePic' src = 'ProfDefault.jpg'><img>
						<input id = 'logOutButton' type='submit' name = 'LogOut' value='Log Out'>
					</form>
				";

			}
			else if ($_SESSION['id'] == 2)
			{

			}
			else if ($_SESSION['id'] == 3)//Wrong username or password
			{
				echo "
					<input value = '".$username."' id = 'username' type='text' name='username' onkeydown='submitLog(event)' placeholder = 'Username or Email'>
					<input style = 'animation: shake 0.75s cubic-bezier(.36,.07,.19,.97) both' id = 'password' type = 'password' name='password' onkeydown='submitLog(event)' placeholder = 'Password'>
					<input id = 'submitButton' onclick = 'logging()' type='submit' name = 'Log' value='Log/Register' title = 'Register to use queue and playlists anywhere'>
				";	
			}
			else if ($_SESSION['id'] == 4) //logged in
			{
				$userID = $_SESSION['userID'];
				$result = mysqli_query($con, "SELECT *FROM user WHERE id = $userID;");
				if (mysqli_num_rows($result)>0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
                        $_SESSION['admin'] = $row['admin'];
						$id = $row['id'];
						$resultImg = mysqli_query($con,"SELECT *FROM profilepic WHERE userid = '$id';");
						if($rowImg = mysqli_fetch_assoc($resultImg))
						{
							
							echo "<div id = 'account'>
									<font style = 'display:none'  name = 'userId' value = ".$id."></font>
									
									<input id='file-input' type='file' style='display:none' name = 'fileInput' onchange = \"changeProfImage(this)\">
									<label for = 'file-input'>
										<img style = 'border-radius: 10px;' id = 'profilePic' src = 'https://soundabox.com/user/".$userID."ProfPic.jpg'>
									</label>
								<font id = 'usernameFont'>";
							echo $row['userName'];
						}
					}
				}
				echo "
				</font>	 
				<div id = 'matchNav' class='dropdown'>
					<button class='dropbtn'>Dropdown <i class='fa fa-caret-down'></i>
					</button>
                <div class='styleRight'>";
                
                if (!empty($_POST['planetest']))
                {
                    echo "<a href='log_out2' name = 'Log Out' value='Log Out'>Log Out</a>";
                }
				else if (!empty($_POST['toonrating']))
                {
                    echo "<a href='log_out3' name = 'Log Out' value='Log Out'>Log Out</a>";
                }
                else
                {
                    echo "<a href = 'dashboard?artist=".$userID."'>Dashboard</a>";
                    echo "<a href = 'playlist' value='My Playlists'>My Playlists</a>";
                    echo "<a href = 'file_transfer' value='My Files'>My Files</a>";
                    echo "<a href='uploadpiece'>Upload</a>";
                    echo "<a href='settings' value='Settings'>Settings</a>";
                    echo "<a href='log_out2' name = 'Log Out' value='Log Out'>Log Out</a>";
                }
				unset($_POST['planetest']);
				unset($_POST['toonrating']);
				
                echo"
					</div>
				</div> 
			</div>";
			}
		}
	else {
		echo "<input value = '".$password."' id = 'username' type='text' name='username' onkeydown='submitLog(event)' placeholder = 'Username or Email'>
		<input id = 'password' type ='password' name='password' onkeydown='submitLog(event)' placeholder = 'Password'>
		<input id = 'submitButton' onclick = 'logging()' type='submit' name = 'Log' value='Log/Register' title = 'Register to use queue and playlists anywhere anywhere'>";	
	}
	echo "<param id = 'sessionID' value = '".$_SESSION['id']."'>";
	session_write_close(); 
	//<a class = 'loader' href = 'my_saves' value='My Saves'>My Saves</a>
?>














