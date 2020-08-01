<?php
    session_start();
    include_once 'dbh.inc.php';


 
    $info = "'".'-'."'";
    if (!empty($_POST['info']))
    {
        $info = "'".mysqli_real_escape_string($con, $_POST['info'])."'";
    }
	$pageId = $_GET['pageId'];
	

	$sql = "UPDATE info set info = $info WHERE id = $pageId;";
    
    echo $sql;
    $query = mysqli_query($con,$sql);
?>
