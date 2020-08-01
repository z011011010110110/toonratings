<?php
	session_start();
	include_once 'dbh.inc.php';
	if (isset($_POST['Log']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];	
		$contact = $_POST['contact'];
		$sql2 = "SELECT *FROM user WHERE userName = '$username' OR contact = '$username';";
		$result2 = mysqli_query($con, $sql2);	
		
		if ($_POST['username'] == "admin")
		{
			$_SESSION['id']=1;
		}
		else if (mysqli_num_rows($result2) > 0) //username taken
		{
			$value = mysqli_fetch_assoc($result2);
			if($value['password'] == $password) 
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
			if ($contact == "" || $username == "" || $password == "")
			{
				$_SESSION['id']=2;
				if ($username == "" )
				{
					$_SESSION['id']=0;
				}
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
						
						$image = addslashes(file_get_contents("defaultProf.JPG"));
						mysqli_query($con,  "INSERT INTO profilepic (userid, profileImage) VALUES ('$userid', '$image');" );	
					}
				}
				
			}
			
		}
			header("Location: https://soundabox.com");
	}
	session_write_close();
	mysqli_close($con);
?>


















