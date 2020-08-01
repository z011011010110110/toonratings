<?php
    session_start();
    include_once 'dbh.inc.php';

    
    $editID = 0;
    if (!empty($_POST['editId']))
    {
        $editID = $_POST['editId'];
    }
    
    $date = "'".date("m-d-Y")."'";
    if (!empty($_POST['date']))
    {
        $date = "'".$_POST['date']."'";
    }
    
    $areaCode = "'".'-'."'";
    if (!empty($_POST['areaCode']))
    {
        $areaCode = "'".$_POST['areaCode']."'";
    }
    $area = "'".'CXR'."'";

    $name = "'".'-'."'";
    if (!empty($_POST['name']))
    {
        $name = "'".$_POST['name']."'";
    }
    
    $tour = "'".'-'."'";
    if (!empty($_POST['tour']))
    {
        $tour = "'".$_POST['tour']."'";
    }
    
    $tourID = "'".'-'."'";
    if (!empty($_POST['tourID']))
    {
        $tourID = "'".$_POST['tourID']."'";
    }
    
    $startDate = "'".'-'."'";
    if (!empty($_POST['startDate']))
    {
        $startDate = "'".$_POST['startDate']."'";
    }
    
    $itenary = "'".'-'."'";
    if (!empty($_POST['itenary']))
    {
        $itenary = "'".$_POST['itenary']."'";
    }
    
    $class = "'".'-'."'";
    if (!empty($_POST['class']))
    {
        $class = "'".$_POST['class']."'";
    }
    
    $time = "'".'-'."'";
    if (!empty($_POST['time']))
    {
        $time = "'".$_POST['time']."'";
    }
    
    $price = "'".'-'."'";
    if (!empty($_POST['price']))
    {
        $price = "'".$_POST['price']."'";
    }
    
    $currency = "'".'-'."'";
    if (!empty($_POST['currency']))
    {
        $currency = "'".$_POST['currency']."'";
    }
    
    $payDate = "'".'-'."'";
    if (!empty($_POST['payDate']))
    {
        $payDate = "'".$_POST['payDate']."'";
    }
   
    $appointment = '0';
    if (!empty($_POST['appointment']))
    {
        $appointment = "'".$_POST['appointment']."'";
    }
    $progress = '0';
    if (!empty($_POST['progress']))
    {
        $progress = "'".$_POST['progress']."'";
    }
    $confirmation = '0';
    if (!empty($_POST['confirmation']))
    {
        $confirmation = "'".$_POST['confirmation']."'";
    }
    $deposit = '0';
    if (!empty($_POST['deposit']))
    {
        $deposit = "'".$_POST['deposit']."'";
    }
    $ticketing = '0';
    if (!empty($_POST['ticketing']))
    {
        $ticketing = "'".$_POST['ticketing']."'";
    }
    if ($editID <= 0)
    {
        $sql = "INSERT INTO tickets (date,areaCode,name,tour,tourID,startDate,itenary,class,time,price,currency,payDate)
        VALUES($date,$areaCode,$name,$tour,$tourID,$startDate,$itenary,$class, $time ,$price,$currency,$payDate);";
    }
    else if ($editID > 0)//may not be in use because we dont change what's printed
    {
        $sql = "UPDATE tickets set date = $date, areaCode = $areaCode, name = $name, tour = $tour, tourID = $tourID, startDate = $startDate, itenary = $itenary, class = $class, time = $time, price = $price, currency = $currency, payDate = $payDate  WHERE idx = $editID;";
    }
    echo "$sql".$editId;
    $query = mysqli_query($con,$sql);
?>
