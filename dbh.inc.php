<?php
	define( 'DB_NAME', 'soundab1_b2a' );

	/** MySQL database username */
	define( 'DB_USER', 'soundab1_b2a' );

	/** MySQL database password */
	define( 'DB_PASSWORD', 'FDC06Bi8d2t5uey4h1l9s3' );

	/** MySQL hostname */
	define( 'DB_HOST', 'localhost' );
	DEFINE('DB_DATABASE', 'soundab1_b2a');

  $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

  if (mysqli_connect_error()) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
  }
  //echo 'Connected successfully.';
?>

