<?php
    session_start();
    include_once 'dbh.inc.php';

    
    $editId = 0;
    if (isset($_POST['editId']))
    {
        $editId = $_POST['editId'];
    }
    
    $time = 'CURRENT_TIMESTAMP';
    if (isset($_POST['date']))
    {
        $time = "'".$_POST['date']."'";
    }
    
    $name = "'".'-'."'";
    if (!empty($_POST['name']))
    {
        $name = "'".$_POST['name']."'";
    }
    $area = "'".'CXR'."'";
    if (!empty($_POST['area']))
    {
        $area = "'".$_POST['area']."'";
    }
    $hotel = "'".'-'."'";
    if (!empty($_POST['hotel']))
    {
        $hotel = "'".$_POST['hotel']."'";
    }
    
    $checkIn = '0';
    if (!empty($_POST['checkIn']))
    {
        
        $checkIn = "'".$_POST['checkIn']."'";
    }
    $costAdult = 0;
    if (!empty($_POST['costAdult']))
    {
        $costAdult = $_POST['costAdult'];
    }
    $costBed = 0;
    if (!empty($_POST['costBed']))
    {
        $costBed = $_POST['costBed'];
    }
    $numBed = 0;
    if (!empty($_POST['numBed']))
    {
        $numBed = $_POST['numBed'];
    }
    $costOthers = 0;
    if (!empty($_POST['costOthers']))
    {
        $costOthers = $_POST['costOthers'];
    }
    $numOthers = 0;
    if (!empty($_POST['numOthers']))
    {
        $numOthers = $_POST['numOthers'];
    }
    $nights = 0;
    if (!empty($_POST['nights']))
    {
        $nights = $_POST['nights'];
    }
    $roomNum = "'-'";
    if (!empty($_POST['roomNum']))
    {
        $roomNum = "'".$_POST['roomNum']."'";
    }
    $members = '0';
    if (!empty($_POST['members']))
    {
        $members = "'".$_POST['members']."'";
    }
    $pusdCost = 0;
    if (!empty($_POST['pusdCost']))
    {
        $pusdCost = $_POST['pusdCost'];
    }
    $tourText = "'".'-'."'";
    if (!empty($_POST['tourText']))
    {
        $tourText = "'".$_POST['tourText']."'";
    }
    $deposit = '0';
    if (!empty($_POST['deposit']))
    {
        $deposit = "'".$_POST['deposit']."'";
    }
    $expenditure = '0';
    if (!empty($_POST['expenditure']))
    {
        $expenditure = "'".$_POST['expenditure']."'";
    }
    $remarks = "'".'-'."'";
    if (!empty($_POST['remarks']))
    {
        $remarks = "'".$_POST['remarks']."'";
    }
	
	$margin = "'".'-'."'";
    if (!empty($_POST['margin']))
    {
        $margin = "'".$_POST['margin']."'";
    }
	
    if ($editId <= 0)
    {
        $sql = "INSERT INTO tours (date, name, area, hotel, checkIn, costAdult, costBed, numBed, costOthers,numOthers,nights, roomNum, members, pusdCost, tourText, deposit, expenditure, remarks,tourType, margin)
        VALUES($time, $name, $area, $hotel, $checkIn, $costAdult, $costBed, $numBed, $costOthers, $numOthers, $nights, $roomNum, $members,$pusdCost, $tourText, $deposit, $expenditure, $remarks, 'HOTEL', $margin);";
    }
    else if ($editId > 0)
    {
        $sql = "UPDATE tours set name = $name, area = $area, hotel = $hotel, checkIn = $checkIn, costAdult = $costAdult, costBed = $costBed, numBed = $numBed, costOthers = $costOthers, numOthers = $numOthers, nights = $nights, roomNum = $roomNum, members = $members, pusdCost = $pusdCost, tourText = $tourText, margin = $margin WHERE id = $editId;";
    }
    echo "$sql".$editId;
    $query = mysqli_query($con,$sql);
?>
