<?php
    session_start();
    include_once 'dbh.inc.php';
    
    if (!isset($_POST['load']))
    {
        include_once 'planeHome.php';
        echo "<div id = 'content'>";
    }
    echo "<title>Tours</title>";
    
    if ($_SESSION['search'] == 'docNum'){
        $findFareString = "SELECT *FROM statements WHERE paid > -1 ";
        //$findFare = mysqli_query($con, "SELECT *FROM statements ORDER BY issueDate DESC;");
        if (!empty($_GET['input']))
        {
            $input = $_GET['input'];
            //$findFare = mysqli_query($con, "SELECT *FROM statements WHERE orderNumber LIKE '%$input%' OR docNumber LIKE '%$input%' OR route LIKE '%$input%' OR description LIKE '%$input%' ORDER BY issueDate DESC;");
            $findFareString = $findFareString."AND (orderNumber LIKE '%$input%' OR docNumber LIKE '%$input%' OR route LIKE '%$input%' OR description LIKE '%$input%') ";
        }
        
        if (!empty($_SESSION['dateSearch']))
        {
            $date = $_SESSION['dateSearch'];
            $findFareString = $findFareString."AND issueDate >= '$date' ";
        }
        if (!empty($_SESSION['dateSearch2']))
        {
            $date2 = $_SESSION['dateSearch2'];
            $findFareString = $findFareString."AND issueDate <= '$date2' ";
        }
        $findFareString = $findFareString."ORDER BY issueDate DESC;";
        $findFare = mysqli_query($con, $findFareString);
        
        echo"<br><br><div class = 'newFare'>
        <input id = 'date' name = 'issueDate' type='date' value='".date("Y-m-d")."'>
        <input value='' id='docNumber' type='text' name='Document Number' placeholder='Document Number'>
        <input value='' id='orderNumber' type='text' name='Order Number' placeholder='Order Number'>
        <input value='' id='route' type='text' name='Route' placeholder='Route'>
        <input value='' id='description' type='text' name='Description' placeholder='Description'>
        <input value='1' id='ROE' type='number' name='ROE' placeholder='Return on Equity'>
        <input value='' id='fare' type='number' name='Fare' placeholder='Fare'>
        <input value='' id='tax' type='number' name='Tax' placeholder='Tax'>
        <input value='' id='vat' type='number' name='Vat' placeholder='Vat'>
        <input value='' id='PVD' type='number' name='PVD' placeholder='PVD'>
        <input value='' id='local' type='number' name='Local' placeholder='Local'>
        <input value='' id='VND' type='number' name='VND' placeholder='VND'>
        <input value='Submit' id='submit' type='submit' name='Submit' placeholder='Sumbit' onclick = 'submit()'></div>
        ";
        
        echo "<div class='content'>
        <table>
        <tr>
        <th class = 'centerTable'>No.</th>
        <th class = 'centerTable'><p date-searchable>Issue Date</p></th>
        <th class = 'centerTable'>Document Number</th>
        <th class = 'centerTable'>Order Number</th>
        <th>Route</th>
        <th class = 'centerTableDetails'>Description</th>
        <th class = 'centerTable'>Return on Equity</th>
        <th class = 'centerTable'>Fare</th>
        <th class = 'centerTable'>Tax</th>
        <th class = 'centerTable'>Vat</th>
        <th class = 'centerTable'>PVD</th>
        <th class = 'centerTable'>Local</th>
        <th class = 'centerTable'>VND</th>
        <th class = 'centerTable'>Paid</th>
        <th class = 'centerTable'>Remove?</th>
        </tr>";
        
        $num = 0;
        $fareTotal = 0;
        $taxTotal = 0;
        $vatTotal = 0;
        $PVDTotal = 0;
        $localTotal = 0;
        $VNDTotal = 0;
        while ($fare = mysqli_fetch_assoc($findFare))
        {
            $num ++;
            $fareTotal += $fare['fare'];
            $taxTotal += $fare['tax'];
            $vatTotal += $fare['vat'];
            $PVDTotal += $fare['PVD'];
            $localTotal += $fare['local'];
            $VNDTotal += $fare['VND'];
            echo "<tr>";
            echo "<td>".$num."</td>";
            echo "<td><p id = '".$fare['docNumber']."' class = 'date' date-editable>".$fare['issueDate']."</p></td>";
            echo "<td>".$fare['docNumber']."</td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'orderNumber' text-editable>".$fare['orderNumber']."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'route' text-editable>".$fare['route']."</p></td>";
            echo "<td class = 'centerTableDetails'><p id = '".$fare['docNumber']."' class = 'description' text-editable>".$fare['description']."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'ROE' editable>".$fare['ROE']."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'fare' editable>".number_format($fare['fare'], 0, '.', ',')."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'tax' editable>".number_format($fare['tax'], 0, '.', ',')."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'vat' editable>".number_format($fare['vat'], 0, '.', ',')."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'PVD' editable>".number_format($fare['PVD'], 0, '.', ',')."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'local' editable>".number_format($fare['local'], 0, '.', ',')."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."' class = 'VND' editable>".number_format($fare['VND'], 0, '.', ',')."</p></td>";
            echo "<td class = 'centerTable'>";
            if ($fare['paid'] == 0)
            {
                echo "<i id = '".$fare['docNumber']."' class='fa fa-plus tooltip' onclick = 'changePay(this)'><span class='tooltiptext'></span></i>";
            }
            else if ($fare['paid'] == 1)
            {
                echo "<i id = '".$fare['docNumber']."' class='fa fa-check tooltip' onclick = 'changePay(this)'><span class='tooltiptext'></span></i>";
            }
            echo "</td>";
            echo "<td class = 'centerTable'><p id = '".$fare['docNumber']."'>
            <i id = '".$fare['docNumber']."' class='fa fa-times-circle tooltip' onclick = 'remove(this,'docNum')'><span class='tooltiptext'></span></i>
            </td>";
        }
        
        $num ++;
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td class = 'centerTable'></td>";
        echo "<td class = 'centerTableDetails'></td>";
        echo "<td class = 'centerTable'></td>";
        echo "<td class = 'centerTable'>".number_format($fareTotal, 0, '.', ',')."</td>";
        echo "<td class = 'centerTable'>".number_format($taxTotal, 0, '.', ',')."</td>";
        echo "<td class = 'centerTable'>".number_format($vatTotal, 0, '.', ',')."</td>";
        echo "<td class = 'centerTable'>".number_format($PVDTotal, 0, '.', ',')."</td>";
        echo "<td class = 'centerTable'>".number_format($localTotal, 0, '.', ',')."</td>";
        echo "<td class = 'centerTable'>".number_format($VNDTotal, 0, '.', ',')."</td>";
        echo "<td class = 'centerTable'></td>";
        
        
        echo "</table><input  class = 'inputs'id = 'regButton' type = 'button' onclick = 'reg()' value = 'Submit'></div>";
        echo "<br><br><br><br><br><br>";
        
    }
    else if ($_SESSION['search'] == 'ticketNum'){
        echo "
        <div class = 'bg' id = 'bg'>
            <div class = 'wrapper'>
                <div class = 'input'>
                    <input id = 'editId' type = 'number' class = 'inputs' title = 'edit'>
                    <input id = 'today' type = 'date' class = 'inputs' title = 'Today&#146s Date' value='".date("Y-m-d")."'>
        
		                    <div><input  class = 'inputs formats' id = 'formatOri' type = 'button' onclick = \"translateFormat('Default')\" value = 'Default'>
							<input  class = 'inputs formats' id = 'formatBam' type = 'button' onclick = \"translateFormat('Bamboo')\" value = 'Bamboo'>
							<input  class = 'inputs formats' id = 'formatVietJet' type = 'button' onclick = \"translateFormat('VietJet')\" value = 'VietJet'></div>
		
                    <div  id = 'swipe'>
                        <textarea id = 'translateText' class = 'inputs' type = 'text' oninput = 'inputText(this)'></textarea>
                        <textarea id = 'translateTextKOR' class = 'inputs' type = 'text'></textarea></div>
        
                    <div class = 'tooltip'><input class = 'inputs' id = 'editTicket' type = 'button' onclick = 'submitTicket(this)' value = 'Done Editing'></div>
                    <div class = 'tooltip'><input  class = 'inputs' id = 'copyENG' type = 'button' onclick = \"copyTicket('ENG')\" value = 'Copy English'>
					<input  class = 'inputs' id = 'copyKOR' type = 'button' onclick = \"copyTicket('KOR')\" value = 'Copy Korean'></span></div>
                    <div class = 'tooltip'><input  class = 'inputs' id = 'submitTicket' type = 'button' onclick = 'submitTicketBamboo(this)' value = 'Submit'><span class = 'tooltiptext' id = 'translateTxt'></span></div>
        <input id = 'today' type = 'date' class = 'inputs' title = 'Today&#146s Date' value='".date("Y-m-d")."'>
                </div>
            </div>
        </div>";
        
        $findFareString = "SELECT *FROM tickets WHERE code > -1 ";
        
        $limit = 50;
        
        if (!empty($_GET['limit']))
        {
            $limit = $_GET['limit'];
        }
        echo " <input  style = 'display:none' id = 'limit' type = 'number' value = '$limit'>";
        $page = 1;
        if (!EMPTY($_GET['page']))
        {
            $page = $_GET['page'];
        }
        $offset = ($page-1) * $limit;
        //$findFare = mysqli_query($con, "SELECT *FROM statements ORDER BY issueDate DESC;");
        if (!empty($_GET['input']))
        {
            $input = $_GET['input'];
            $findFareString = $findFareString."AND (areaCode LIKE '%$input%' OR name LIKE '%$input%' OR tour LIKE '%$input%' OR tourID LIKE '%$input%' OR itenary LIKE '%$input%' OR class LIKE '%$input%' OR currency LIKE '%$input%' OR startDate LIKE '%$input%') ";
        }
        
        if (!empty($_SESSION['dateSearch']))
        {
            $date = $_SESSION['dateSearch'];
            $findFareString = $findFareString."AND date >= '$date' ";
        }
        
        if (!empty($_SESSION['dateSearch2']))
        {
            $date2 = $_SESSION['dateSearch2'];
            $findFareString = $findFareString."AND date <= '$date2' ";
        }
        $numFareSearch = $findFareString.";";
        $findFareString = $findFareString."ORDER BY date DESC LIMIT $limit OFFSET $offset;";
        
        $findFare = mysqli_query($con, $findFareString);
        $findFarex = mysqli_query($con, $numFareSearch);
        
        $numTours = mysqli_num_rows(mysqli_query($con, $numFareSearch));
        $totalPages = ceil($numTours/$limit);
        
        echo "<div class='content'>
        <table>
            <tr>
                <th class = 'centerTable'><p id = '' class = 'tooltip'><p>no.</p></th>
                <th class = 'centerTable'><p id  = 'thDate' class = 'tooltip'><p>등록일</p></th>
                <th class = 'centerTable'><p id  = 'thCode' class = 'tooltip'><p>예약코드</p></th>
                <th class = 'centerTable'><p id  = 'thName' class = 'tooltip'><p>이름</p></th>
                <th class = 'centerTable'><p id = 'thCity' class = 'tooltip'><p>항공사</p></th>
                <th class = 'centerTable'><p id = 'thCheckIn' class = 'tooltip'><p>항공편</p></th>
                <th class = 'centerTable'><p id = 'thHotel' class = 'tooltip'><p>출발일</p></th>
                <th class = 'centerTable'><p id = 'thRoomNum' class = 'tooltip'><p>도착지</p></th>
                <th class = 'centerTable'><p id  = 'thClass' class = 'tooltip'><p>클라스</p></th>
                <th class = 'centerTable'><p id = 'thMem' class = 'tooltip'><p>시간</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'><p>가격</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'><p>돈(USD)</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'><p>발권마감일</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'><p>예약</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'><p>진행</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'><p>확정</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'><p>입금</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'><p>발권</p></th>";
        
            if ($_SESSION['admin'] == 1)
            {
                echo "<th class = 'centerTable'><p id = 'thRemove'><p>삭제?</p></th>";
            }
        echo "</tr><tr>";
            echo "<td class = 'centerTable'><p id = 'new1' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new2' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new3' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new4' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new5' >x</td>";
            echo "<td class = 'centerTable'><p id = 'new6' class = 'name' >x</td>";
            echo "<td class = 'centerTable'><p id = 'new7' >x</td>";
            echo "<td class = 'centerTable'><p id = 'new8' >x</td>";
            echo "<td class = 'centerTable'><p id = 'new9' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new10' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new11' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new12' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new13' t>x</td>";
            echo "<td class = 'centerTable'><p id = 'new14' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new15' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new16' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new17' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new18' class = 'name'>x</td>";
            echo "<td class = 'centerTable'><p id = 'new19' class = 'name'>x</td>";
        echo "</tr>";
        
        $num = 0;
        while ($farex = mysqli_fetch_assoc($findFare))
        {
            $num++;
            $ticketID = $farex['idx'];
            $date = $farex['date'];
            $areaCode = $farex['areaCode'];
            $name = $farex['name'];
            $tour = $farex['tour'];
            $tourID = $farex['tourID'];
            $startDate = $farex['startDate'];
            $itenary = $farex['itenary'];
            $class = $farex['class'];
            $time = $farex['time'];
            $price = $farex['price'];
            $currency = $farex['currency'];
            $payDate = $farex['payDate'];
            
            $appointment = $farex['appointment'];
            $progress = $farex['progress'];
            $confirmation = $farex['confirmation'];
            $deposit = $farex['deposit'];
            $ticketing = $farex['ticketing'];
            echo "<tr>";
                echo "<td class = 'centerTable'>
            <p id = 'new1' onclick = 'outputText($ticketID)'>$num</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new2' class = 'tooltip'>".date("M-d", strtotime($date))."<span class = 'tooltiptext'>".$date."</span></p></td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new3' >$areaCode</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new4' >$name</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new5' class = 'trTour'>$tour</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new6' >$tourID</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new7' class = 'trDate'>$startDate</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new8' class = 'trItenary'>$itenary</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new9' >$class</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new10' >$time</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new11' >$price</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new12' >$currency</td>";
                echo "<td class = 'centerTable'><p id = '".$ticketID."new13' class = 'trDate'>$payDate</td>";

            echo "<td class = 'centerTable'>";
            if ($appointment == '0000-00-00')
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-plus tooltip' onclick = \"changeCheck2(this,'appointment')\"></i>";
            }
            else
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-check tooltip' onclick = \"changeCheck2(this,'appointment')\"><span class='tooltiptext'>".$appointment."</span></i>";
            }
            echo "</td>";
            
            echo "<td class = 'centerTable'>";
            if ($progress == '0000-00-00')
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-plus tooltip' onclick = \"changeCheck2(this,'progress')\"></i>";
            }
            else
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-check tooltip' onclick = \"changeCheck2(this,'progress')\"><span class='tooltiptext'>".$progress."</span></i>";
            }
            echo "</td>";
            
            echo "<td class = 'centerTable'>";
            if ($confirmation == '0000-00-00')
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-plus tooltip' onclick = \"changeCheck2(this,'confirmation')\"></i>";
            }
            else
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-check tooltip' onclick = \"changeCheck2(this,'confirmation')\"><span class='tooltiptext'>".$confirmation."</span></i>";
            }
            echo "</td>";
            
            echo "<td class = 'centerTable'>";
            if ($deposit == '0000-00-00')
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-plus tooltip' onclick = \"changeCheck2(this,'deposit')\"></i>";
            }
            else
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-check tooltip' onclick = \"changeCheck2(this,'deposit')\"><span class='tooltiptext'>".$deposit."</span></i>";
            }
            echo "</td>";
            
            echo "<td class = 'centerTable'>";
            if ($ticketing == '0000-00-00')
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-plus tooltip' onclick = \"changeCheck2(this,'ticketing')\"></i>";
            }
            else
            {
                echo "<i id = '".$farex['idx']."' class='fa fa-check tooltip' onclick = \"changeCheck2(this,'ticketing')\"><span class='tooltiptext'>".$ticketing."</span></i>";
            }
            echo "</td>";
            
            
                if ($_SESSION['admin'] == 1)
                {
                    echo "<td class = 'centerTable'><p id = '".$farex['idx']."'>
                    <i id = '".$farex['idx']."' class='fa fa-times-circle tooltip' onclick = \"remove(this,'ticket')\"><span class='tooltiptext'>Remove</span></i>
                    </td>";
                }
            echo "</tr>";
        }
        echo "</tr></table></div><p id = 'output'></p><script>translate()</script>";
    
    }
    else if ($_SESSION['search'] == 'page'){
        echo "<div class = 'add'><i id = 'adder' class='fa fa-plus' onclick = 'hide(this)'>등록 하기(M)</i>
        
        <div class = 'bg' id = 'bg' style = 'display:none'>
            <div class = 'wrapper'>
					<input id = 'editId' type = 'number' class = 'inputs' title = 'edit'>
                    <input id = 'today' type = 'date' class = 'inputs' title = 'Today&#146s Date' value='".date("Y-m-d")."'>
		
                <div class = 'input'>
					<div><input id = 'pgiName' type = 'text' placeholder='이름' title = '이름' class = 'inputs' ></div><br>
		
                    <div><input id = 'pgiPeople' type = 'number' placeholder='인원' title = '인원' class = 'inputs' >
                    <input id = 'pgiNights' type = 'number' placeholder='박수'  title = '박수' class = 'inputs' >
                    <input id = 'pgiVehicle' type = 'text' placeholder='차종' title = '차종' class = 'inputs' >
                    <input id = 'pgiGuide' type = 'text' placeholder='가이드' title = '가이드' class = 'inputs' ></div><br>
        
                    <div><input id = 'pgiStartCity' type = 'text' placeholder='출발지' title = '출발지' class = 'inputs' >
                    <input id = 'pgiRooms' type = 'text' placeholder='룸수' title = '룸수' class = 'inputs' >
                    <input id = 'pgiVehiclePrice' type = 'text' placeholder='차랑 가격(USD)' title = '차랑 가격(USD)' class = 'inputs' >
                    <input id = 'pgiGuideNum' type = 'text' placeholder='가이드 수' title = '가이드 수' class = 'inputs' ></div></div><br>
        
                    <div><input id = 'pgiDestination' type = 'text' placeholder='도착지' title = '도착지' class = 'inputs'>
                    <input id = 'pgiHotel' type = 'text' placeholder='호텔명' title = '호텔명' class = 'inputs' >
                    <input id = 'pgiCar' type = 'text' placeholder='차랑수' title = '차랑수' class = 'inputs' ></div><br>
        
                    <div><input id = 'pgiStartDate' type = 'date' placeholder='출발일' title = '출발일' class = 'inputs' oninput = 'loadPage()'>
                    <input id = 'pgiPrice' type = 'number' placeholder='호텔 가격' title = '호텔 가격' class = 'inputs' >
                    </div><br>
                    </div></div>";
        
        
        echo "<div class='content'>
        <table id = 'pagePreTable'>
        <table id = 'pageTable'>
        <tr>
            <th class = 'centerTable'><p id  = 'pgDate' class = 'tooltip'><p>일자</p></th>
            <th class = 'centerTable'><p id  = 'pgCity' class = 'tooltip'><p>장소</p></th>
            <th class = 'centerTable'><p id  = 'pgDescription' class = 'tooltip'><p>내역</p></th>
            <th class = 'centerTable'><p id = 'pgNumber' class = 'tooltip'><p>단가</p></th>
            <th class = 'centerTable'><p id = 'pgPeople' class = 'tooltip'><p>인원/수양</p></th>
            <th class = 'centerTable'><p id = 'pgCost' class = 'tooltip'><p>금액</p></th>";
        echo "</tr>";
        echo "</table>
        <table id = 'pageDetailTable'></table>
        </div>";
        
        
        
        $findFareString = "SELECT *FROM tours WHERE code > -1 AND tourType = 'TOUR'";
        
        $limit = 50;
        
        if (!empty($_GET['limit']))
        {
            $limit = $_GET['limit'];
        }
        echo " <input  style = 'display:none' id = 'limit' type = 'number' value = '$limit'>";
        $page = 1;
        if (!EMPTY($_GET['page']))
        {
            $page = $_GET['page'];
        }
        $offset = ($page-1) * $limit;
        
        if (!empty($_GET['input']))
        {
            $input = $_GET['input'];
            $findFareString = $findFareString."AND (override LIKE '%$input%' OR details LIKE '%$input%' OR destination LIKE '%$input%' OR notes LIKE '%$input%') ";
        }
        
        if (!empty($_SESSION['dateSearch']))
        {
            $date = $_SESSION['dateSearch'];
            $findFareString = $findFareString."AND date >= '$date' ";
        }
        
        if (!empty($_SESSION['dateSearch2']))
        {
            $date2 = $_SESSION['dateSearch2'];
            $findFareString = $findFareString."AND date <= '$date2' ";
        }
        $numFareSearch = $findFareString.";";
        $findFareString = $findFareString."ORDER BY date DESC LIMIT $limit OFFSET $offset;";
        
        $findFare = mysqli_query($con, $findFareString);
        $findFarex = mysqli_query($con, $numFareSearch);
        
        $numTours = mysqli_num_rows(mysqli_query($con, $numFareSearch));
        $totalPages = ceil($numTours/$limit);
        
        echo "<div class='content'>
            <table>
            <tr>
            <th class = 'centerTable'><p id = '' class = 'tooltip'><p>no.</p></th>
            <th class = 'centerTable'><p id  = 'thDate' class = 'tooltip'><p>이름</p></th>
            <th class = 'centerTable'><p id  = 'thDate' class = 'tooltip'><p>타이틀</p></th>
            <th class = 'centerTable'><p id  = 'thDate' class = 'tooltip'><p>등록일</p></th>
            <th class = 'centerTable'><p id  = 'thName' class = 'tooltip'><p>입구일</p></th>
			<th class = 'centerTable'><p id = 'thTotal' class = 'tooltip'>총 금액(USD)</p></th>
			<th class = 'centerTable'><p id = 'thMargin' class = 'tooltip'>마진(USD)</p></th>
			<th class = 'centerTable'><p id = 'thDeposit' class = 'tooltip'>입금 완료</p></th>
			<th class = 'centerTable'><p id = 'thExpenditure' class = 'tooltip'>지출 완료</p></th>
			<th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'>비고</p></th>";
        
        if ($_SESSION['admin'] == 1)
        {
            echo "<th class = 'centerTable'><p id = 'thRemove'><p>삭제?</p></th>";
        }
        echo "</tr>";

        
        $num = 0;
        while ($farex = mysqli_fetch_assoc($findFare)){
            $num++;
            $PID = $farex['id'];
            $date = $farex['date'];
            $startDate = $farex['checkIn'];
            $issueDate = $farex['date'];
            $route = $farex['destination'];
            $override = $farex['override'];
            $notes = $farex['notes'];
            $details = $farex['details'];
			$margin = $farex['margin'];
			$deposit = $farex['deposit'];
            $expenditure = $farex['expenditure'];
            $remarks = $farex['remarks'];
			if ($farex['tourType'] == 'TOUR'){
				$total = 0;
				$override = $farex['override'];
				$row = preg_split ("/\;/", $override);
				for ($i = 0; $i < count($row); $i++){
					$rowIndex = preg_split("/\&/", $row[$i]);
					for ($o = 1; $o <= count($rowIndex); $o++){
						if ($o%4 == 0)
						{
							$total += $rowIndex[$o-2]*$rowIndex[$o-1];
							//echo $total." ".$rowIndex[$o-2]."x".$rowIndex[$o-1]." : ";
						}
					}
				}
				$newDetails = preg_split ("/\&/", $farex['details']);
				//echo $fare['details'];
				$total += $newDetails[3]*$newDetails[4];
			}
			
            echo "<tr onclick = \"quickPage($PID,'$startDate', '$route', '$override', '$notes', '$details', '$issueDate')\">";
            echo "<td class = 'centerTable'>
            <p id = 'new1'>$num</p></td>";
            echo "<td class = 'centerTable'><p id = '".$PID."new2' class = 'tooltip'>".preg_split ("/\&/", $details)[1]."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$PID."new3' class = 'tooltip'>".preg_split ("/\&/", $details)[0]."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$PID."new4' class = 'tooltip'>".date("M-d", strtotime($date))."<span class = 'tooltiptext'>".$date."</span></p></td>";
            echo "<td class = 'centerTable'><p id = '".$PID."new5' >$startDate</td>";
			
			
			
			
			echo "<td class = 'centerTable'><p id = '".$farex['id']."' class = 'total' >$".number_format($total, 0, '.', ',')."</p></td>";
			echo "<td class = 'centerTable'><p id = '".$farex['id']."' class = 'margin' text-editable2>".$margin."</p></td>";
			
            echo "<td class = 'centerTable'>";
            if ($deposit == '0000-00-00')
            {
                echo "<i id = '".$farex['id']."' class='fa fa-plus tooltip' onclick = \"changeCheck(this,'deposit')\"></i>";
            }
            else
            {
                echo "<i id = '".$farex['id']."' class='fa fa-check tooltip' onclick = \"changeCheck(this,'deposit')\"><span class='tooltiptext'>".$deposit."</span></i>";
            }
            echo "</td>";
			
            echo "<td class = 'centerTable'>";
            if ($expenditure == '0000-00-00')
            {
                echo "<i id = '".$farex['id']."' class='fa fa-plus tooltip' onclick = \"changeCheck(this,'expenditure')\"></i>";
            }
            else
            {
                echo "<i id = '".$farex['id']."' class='fa fa-check tooltip' onclick = \"changeCheck(this,'expenditure')\"><span class='tooltiptext'>".$expenditure."</span></i>";
            }
            echo "</td>";
			
            echo "<td class = 'centerTable'><p id = '".$farex['id']."' class = 'remarks' text-editable2>".$remarks."</p></td>";
			
			
			
            if ($_SESSION['admin'] == 1){
                echo "<td class = 'centerTable'><p id = '".$farex['id']."'>
                <i id = '".$farex['id']."' class='fa fa-times-circle tooltip' onclick = \"remove(this,'page')\"><span class='tooltiptext'>Remove</span></i>
                </td>";
            }
            echo "</tr>";
        }
        echo "</tr></table></div><p id = 'output'></p><script>translate();
        newPage();</script>";
    }
    else if ($_SESSION['search'] == 'all'){
		echo "<div class = 'add'><i id = 'adder' class='fa fa-plus' onclick = 'hide(this)'>등록 하기(M)</i>
		
        <div class = 'bg' id = 'bg' style = 'display:none'>
            <div class = 'wrapper'>
					<input id = 'editId' type = 'number' class = 'inputs' title = 'edit'>
                    <input id = 'today' type = 'date' class = 'inputs' title = 'Today&#146s Date' value='".date("Y-m-d")."'>
			<div class = 'input' id = 'input1' style = 'display: block'>

					<div id = 'trCity'>지역</div>
						<button id = 'areaCXR' type = 'button' class = 'active areaButton' title = 'Area' onclick = 'clickedArea(this)'>CXR</button>
						<button id = 'areaDAN' type = 'button' class = 'areaButton' title = 'Area' onclick = 'clickedArea(this)'>DAN</button>
						<button id = 'areaPQC' type = 'button' class = 'areaButton' title = 'Area' onclick = 'clickedArea(this)'>PQC</button><br>

					<div id = 'trName'>이름</div><input id = 'name' type = 'text' placeholder='Name...' title = 'Name' class = 'inputs' value='".$_GET['name']."'><br>
					<input id = 'today' type = 'date' class = 'inputs' title = 'Today&#146s Date' value='".date("Y-m-d")."'>

					<div id = 'trHotel'>호텔</div><input id = 'hotel' type = 'text' placeholder='Hotel' title = 'Hotel Name' class = 'inputs' value='".$_GET['hotel']."'><br>

					<div id = 'trRoomNumber'>룸수</div><input id = 'roomNum' type = 'number' placeholder='Room Number?' title = 'Room Number...' class = 'inputs' value='".$_GET['roomNum']."'><br>

					<div id = 'trCheckIn'>체크인</div><input id = 'checkIn' type = 'date' class = 'inputs' placeholder='YYYY-MM-DD' title = 'Check In Date' value='".$_GET['checkIn']."' onchange = 'output()'><br>

					<div id = 'trNights'>박 수</div><input id = 'nights' type = 'number' placeholder='How many nights?' title = 'How Many Nights?' class = 'inputs' value='".$_GET['nights']."'><br>

					<div id = 'trAdultRate'>성인</div><input id = 'costAdult' type = 'number' placeholder='Room Rate' title = 'Room Cost Rate($)' class = 'inputs' value='".$_GET['costAdult']."'><br>

					<div id = 'trBedRate'>베드 추가</div><input id = 'costBed' type = 'number' placeholder='Bed Rate' title = 'Bed Cost Rate($)' class = 'inputs' value='".$_GET['costBed']."'>
					x<input id = 'numBed' type = 'number' placeholder='How Many?' class = 'inputs mini' title = 'How Many Extra Beds?' value='".$_GET['numBed']."'>

					<div id = 'trChildRate'>아동</div><input id = 'costOthers' type = 'number' placeholder='Room Rate' title = 'Room Cost Rate($)' class = 'inputs' value='".$_GET['costOthers']."'>
					x<input id = 'numOthers' type = 'number' placeholder='How Many?' class = 'inputs mini' title = 'How Many Children?' value='".$_GET['numOthers']."'>

					<br>
					<div id = 'trMembers'>인원</div><input id = 'members' type = 'text' placeholder='How Many Members?' class = 'inputs' title = 'How Many Members?' value='".$_GET['members']."'>
					<br>

					<div id = 'trPusd'>공항 픽업/샌딩</div>
					<button id = 'yesPusd' type = 'button' class = '";
					if ($_GET['pusd']!='No')
					{
						echo "active ";
					}
					echo " pusdButton' title = 'Yes' onclick = 'clickedPusd(this)'>Yes</button>

					<button id = 'noPusd' type = 'button' class = '";
					if ($_GET['pusd']=='No')
					{
						echo "active ";
					}
					echo " pusdButton' title = 'No' onclick = 'clickedPusd(this)'>No</button>

					<input id = 'pusdCost' type = 'number' placeholder='Cost' class = 'inputs mini' title = 'Cost' value='".$_GET['pusdCost']."'><br>

					<div id = 'trTour'>투어 추가</div>
						<textarea id = 'tourText' class = 'inputs' type = 'text'>".$_GET['tour']."</textarea><br><br>
						<textarea readonly id = 'outputText' class = 'inputs' type = 'text'></textarea>
						<input  class = 'inputs'id = 'copyButton' type = 'button' onclick = 'copy()' value = 'Copy'>
						<input  class = 'inputs'id = 'regButton' type = 'button' onclick = 'reg()' value = 'Submit'>
						<input  class = 'inputs' style = 'display:none' id = 'editButton' type = 'button' onclick = 'edit()' value = 'Done Editing'>
					 </div>
				</div>
                <div class = 'input' id = 'input2' style = 'display: none'>
					<div><input id = 'pgiName' type = 'text' placeholder='이름' title = '이름' class = 'inputs' ></div><br>
		
                    <div><input id = 'pgiPeople' type = 'number' placeholder='인원' title = '인원' class = 'inputs' >
                    <input id = 'pgiNights' type = 'number' placeholder='박수'  title = '박수' class = 'inputs' >
                    <input id = 'pgiVehicle' type = 'text' placeholder='차종' title = '차종' class = 'inputs' >
                    <input id = 'pgiGuide' type = 'text' placeholder='가이드' title = '가이드' class = 'inputs' ></div><br>
		
                    <div><input id = 'pgiStartCity' type = 'text' placeholder='출발지' title = '출발지' class = 'inputs' >
                    <input id = 'pgiRooms' type = 'text' placeholder='룸수' title = '룸수' class = 'inputs' >
                    <input id = 'pgiVehiclePrice' type = 'text' placeholder='차랑 가격(USD)' title = '차랑 가격(USD)' class = 'inputs' >
                    <input id = 'pgiGuideNum' type = 'text' placeholder='가이드 수' title = '가이드 수' class = 'inputs' ></div><br>

                    <div><input id = 'pgiDestination' type = 'text' placeholder='도착지' title = '도착지' class = 'inputs'>
                    <input id = 'pgiHotel' type = 'text' placeholder='호텔명' title = '호텔명' class = 'inputs' >
                    <input id = 'pgiCar' type = 'text' placeholder='차랑수' title = '차랑수' class = 'inputs' ></div><br>
		
                    <div><input id = 'pgiStartDate' type = 'date' placeholder='출발일' title = '출발일' class = 'inputs' oninput = 'loadPage()'>
                    <input id = 'pgiPrice' type = 'number' placeholder='호텔 가격' title = '호텔 가격' class = 'inputs' >
                    </div><br>
                    </div></div>";
		
        echo "<div class='content'>
        <table id = 'pagePreTable'>
        <table id = 'pageTable'>";
        echo "</table>
        <table id = 'pageDetailTable'></table>
        </div>";
	
		
		
        $findFareString = "SELECT *FROM tours WHERE code > -1 ";
		
        $limit = 50;
		
        if (!empty($_GET['limit']))
        {
            $limit = $_GET['limit'];
        }
        echo " <input  style = 'display:none' id = 'limit' type = 'number' value = '$limit'>";
        $page = 1;
        if (!EMPTY($_GET['page']))
        {
            $page = $_GET['page'];
        }
        $offset = ($page-1) * $limit;
        //$findFare = mysqli_query($con, "SELECT *FROM statements ORDER BY issueDate DESC;");
        if (!empty($_GET['input']))
        {
            $input = $_GET['input'];
            $findFareString = $findFareString."AND (name LIKE '%$input%' OR hotel LIKE '%$input%' OR area LIKE '%$input%' OR tourText LIKE '%$input%' OR remarks LIKE '%$input%' OR hotel LIKE '%$input%' OR override LIKE '%$input%' OR details LIKE '%$input%' OR destination LIKE '%$input%' OR notes LIKE '%$input%') ";
        }
		
        if (!empty($_SESSION['dateSearch']))
        {
            $date = $_SESSION['dateSearch'];
            $findFareString = $findFareString."AND date >= '$date' ";
        }
		
        if (!empty($_SESSION['dateSearch2']))
        {
            $date2 = $_SESSION['dateSearch2'];
            $findFareString = $findFareString."AND date <= '$date2' ";
        }
        $numFareSearch = $findFareString.";";
        $findFareString = $findFareString."ORDER BY date DESC LIMIT $limit OFFSET $offset;";
        $findFare = mysqli_query($con, $findFareString);
        $findFarex = mysqli_query($con, $numFareSearch);
        $numTours = mysqli_num_rows(mysqli_query($con, $numFareSearch));
        $totalPages = ceil($numTours/$limit);
		
		
        $adultTotalx = 0;
        $bedTotalx = 0;
        $othersTotalx = 0;
        $fareTotalx = 0;
        $nightsTotalx = 0;
        $pusdTotalx = 0;

        while ($farex = mysqli_fetch_assoc($findFarex))
        {
            $costAdultx = $farex['costAdult'];
            $adultTotalx += $costAdultx;
			
            $costBedx = $farex['costBed'];
            $numBedx = $farex['numBed'];
            $bedx = $costBedx*$numBedx;
			
            $costOthersx = $farex['costOthers'];
            $numOthersx = $farex['numOthers'];
            $othersx = $costOthersx * $numOthersx;
			
            $nightsx = $farex['nights'];
            $totalx = ($costAdultx + $bedx + $othersx)*$nightsx;
			
            $pusdCostx = $farex['pusdCost'];
            if ($pusdCostx >= 0){
                $pusdTotalx += $pusdCostx;
            }
			
            $bedTotalx += $bedx;
            $othersTotalx += $othersx;
			
            $fareTotalx += $totalx;
            $nightsTotalx += $nightsx;
        }
        echo "<div class='content'>
            <table>
            <tr>
                <th class = 'centerTable'><p id = '' class = 'tooltip'>no.</p></th>
                <th class = 'centerTable'><p id  = 'thTourType' class = 'tooltip'>분류</p></th>
                <th class = 'centerTable'><p id  = 'thDate' class = 'tooltip'>신청일</p></th>
                <th class = 'centerTable'><p id  = 'thName' class = 'tooltip'>이름</p></th>
                <th class = 'centerTable'><p id = 'thCity' class = 'tooltip'>지역</p></th>
                <th class = 'centerTable'><p id = 'thCheckIn' class = 'tooltip'>체크인</p></th>
                <th class = 'centerTable'><p id = 'thHotel' class = 'tooltip'>호텔</p></th>
                <th class = 'centerTable'><p id = 'thMem' class = 'tooltip'>인원</p></th>
                <th class = 'centerTable tooltip2'><p id = 'thNights'>박 수</p><span class = 'tooltiptext' >$nightsTotalx</span></th>
                <th class = 'centerTable'><p id = 'thTotal' class = 'tooltip'>총 금액(USD)</p></th>
                <th class = 'centerTable'><p id = 'thMargin' class = 'tooltip'>마진(USD)</p></th>
				<th class = 'centerTable'><p id = 'thDeposit' class = 'tooltip'>입금 완료</p></th>
                <th class = 'centerTable'><p id = 'thExpenditure' class = 'tooltip'>지출 완료</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'>비고</p></th>";
		
                if ($_SESSION['admin'] == 1)
                {
                    echo "<th class = 'centerTable'><p id = 'thRemove'>삭제?</p></th>";
                }
		
                echo "</tr>";

        $num = 0;
        $adultTotal = 0;
        $bedTotal = 0;
        $othersTotal = 0;
        $fareTotal = 0;
        $nightsTotal = 0;
        $pusdTotal = 0;
        $finalTotal = 0;
        while ($fare = mysqli_fetch_assoc($findFare))
        {
            $id = $fare['id'];
            $datex = $fare['date'];
            $name = $fare['name'];
            $tourType = $fare['tourType'];
			if ($fare['tourType'] == 'TOUR')
			{
				$details = $fare['details'];
				$name = preg_split ("/\&/", $details)[1];
			}
			
            $area = $fare['area'];
            $hotel = $fare['hotel'];
            $roomNum = $fare['roomNum'];
            $checkIn = $fare['checkIn'];
            $costAdult = $fare['costAdult'];
			
            $costBed = $fare['costBed'];
            $numBed = $fare['numBed'];
            $bed = $costBed*$numBed;
			
            $costOthers = $fare['costOthers'];
            $numOthers = $fare['numOthers'];
            $others = $costOthers * $numOthers;
			
            $nights = $fare['nights'];
			if ($fare['tourType'] == 'TOUR')
			{
				$override = $fare['override'];
				$nights = count(preg_split("/\;/", $override))-1;
			}
			
			
            $total = ($costAdult + $bed + $others)*$nights;
			if ($fare['tourType'] == 'TOUR')
			{
				$total = 0;
				$override = $fare['override'];
				$row = preg_split ("/\;/", $override);
				for ($i = 0; $i < count($row); $i++){
					$rowIndex = preg_split("/\&/", $row[$i]);
					for ($o = 1; $o <= count($rowIndex); $o++){
						if ($o%4 == 0)
						{
							$total += $rowIndex[$o-2]*$rowIndex[$o-1];
							//echo $total." ".$rowIndex[$o-2]."x".$rowIndex[$o-1]." : ";
						}
					}
					
				}
				$newDetails = preg_split ("/\&/", $fare['details']);
				//echo $fare['details'];
				$total += $newDetails[3]*$newDetails[4];
			}
			$finalTotal += $total;
			
            $members = $fare['members'];
			if ($fare['tourType'] == 'TOUR')
			{
				$details = $fare['details'];
				$members = preg_split ("/\&/", $details)[2];
			}
			
            $pusdCost = $fare['pusdCost'];
            $tourText = $fare['tourText'];
            $deposit = $fare['deposit'];
            $expenditure = $fare['expenditure'];
            $remarks = $fare['remarks'];
			
            $num++;
            $adultTotal += $costAdult;
            $bedTotal += $bed;
            $othersTotal += $others;
			
            $fareTotal += $total;
            $nightsTotal += $nights;

            $pusdString = '';
			
			$route = $fare['destination'];
			if ($fare['tourType'] == 'TOUR')
			{
				$route = $fare['destination'];
				$area = preg_split ("/;/", $route)[1];
			}
			
            $override = $fare['override'];
            $notes = $fare['notes'];
            $details = $fare['details'];
			$issueDate = $fare['date'];
			$margin = $fare['margin'];
            if ($pusdCost >= 0){
                $pusdString = "Yes ($".number_format($pusdCost, 0, '.', ',').")";
                $pusdTotal += $pusdCost;
            }
            else
            {
                 $pusdString = 'No';
            }
			
            $output = "copyOutput('$name', '$roomNum', '$area', '$hotel', '$roomNum', $costAdult,$costOthers,$numOthers,$costBed,$numBed,'$checkIn',$nights,'$members', $pusdCost,'$tourText', $id)";
            if ($fare['tourType'] == 'TOUR')
			{
				$output = "quickPage($id, '$checkIn', '$route', '$override', '$notes', '$details', '$issueDate')";
			}
			
            echo "<input id = 'today' style = 'display:none' type = 'date' class = 'inputs' title = 'Today&#146s Date' value='".date("Y-m-d")."'>";
			
            echo "<tr>";
            echo "<td><a class = 'hoverable' onclick = \"$output\">".($num+$offset)."</a></td>";
			echo "<td><p id = '".$fare['id']."' class = 'date tooltip'>".$tourType."</p></td>";
            echo "<td><p id = '".$fare['id']."' class = 'date tooltip'>".date("M-d", strtotime($datex))."<span class = 'tooltiptext'>".$datex."</span></p></td>";
			
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'name' text-editable2>".$name."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'area' text-editable2>".$area."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'checkIn' date-editable2>".$checkIn."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'hotel' text-editable2>".$hotel."</p></td>";

            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'members' text-editable2>".$members."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'nights' editable2>".$nights."</p></td>";
			
			echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'total' >$".number_format($total, 0, '.', ',')."</p></td>";
			echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'margin' text-editable2>".$margin."</p></td>";
            echo "<td class = 'centerTable'>";
            if ($deposit == '0000-00-00')
            {
                echo "<i id = '".$fare['id']."' class='fa fa-plus tooltip' onclick = \"changeCheck(this,'deposit')\"></i>";
            }
            else
            {
                echo "<i id = '".$fare['id']."' class='fa fa-check tooltip' onclick = \"changeCheck(this,'deposit')\"><span class='tooltiptext'>".$deposit."</span></i>";
            }
            echo "</td>";
			
            echo "<td class = 'centerTable'>";
            if ($expenditure == '0000-00-00')
            {
                echo "<i id = '".$fare['id']."' class='fa fa-plus tooltip' onclick = \"changeCheck(this,'expenditure')\"></i>";
            }
            else
            {
                echo "<i id = '".$fare['id']."' class='fa fa-check tooltip' onclick = \"changeCheck(this,'expenditure')\"><span class='tooltiptext'>".$expenditure."</span></i>";
            }
            echo "</td>";
			
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'remarks' text-editable2>".$remarks."</p></td>";
			
			
            if ($_SESSION['admin'] == 1)
            {
                echo "<td class = 'centerTable'><p id = '".$fare['id']."'>
                <i id = '".$fare['id']."' class='fa fa-times-circle tooltip' onclick = \"remove(this,'deleteTour')\"><span class='tooltiptext'>Remove</span></i>
                </td>";
            }
			
        }
        echo "<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>".number_format($nightsTotal, 0, '.', ',')."</td>
		<td>$".number_format($finalTotal, 0, '.', ',')."</td>
        <td></td>
        <td></td>
        <td></td>";
        if ($_SESSION['admin'] == 1)
        {
            echo "<td></td>";
        }
        echo "</tr></table></div>";
		
        echo "<div id = 'sliderContainer' class = 'sliderContainer tooltip'><input id = 'slider' type = 'range' class = 'pageSlider' step = '1' value = '$page' min = '1' max = '$totalPages' onmousemove = 'pageNum(event)' onchange = 'changePage(this)'><span id = 'page' class = 'tooltiptext' style = 'bottom: auto;'>Page $page / $totalPages</span></div>";
    }
    else{
        echo "<div class = 'add'><i id = 'adder' class='fa fa-plus' onclick = 'hide(this)'>등록 하기(M)</i>
        
        <div class = 'bg' id = 'bg' style = 'display:none'>
            <div class = 'wrapper'>
                <div class = 'input'>
        
        <input id = 'editId' type = 'number' style = 'display:none' placeholder='ID' title = 'ID To Edit' class = 'inputs' value=''>
        
                <div id = 'trCity'>지역</div>
                    <button id = 'areaCXR' type = 'button' class = 'active areaButton' title = 'Area' onclick = 'clickedArea(this)'>CXR</button>
                    <button id = 'areaDAN' type = 'button' class = 'areaButton' title = 'Area' onclick = 'clickedArea(this)'>DAN</button>
                    <button id = 'areaPQC' type = 'button' class = 'areaButton' title = 'Area' onclick = 'clickedArea(this)'>PQC</button><br>
        
                <div id = 'trName'>이름</div><input id = 'name' type = 'text' placeholder='Name...' title = 'Name' class = 'inputs' value='".$_GET['name']."'><br>
                <input id = 'today' type = 'date' class = 'inputs' title = 'Today&#146s Date' value='".date("Y-m-d")."'>
        
                <div id = 'trHotel'>호텔</div><input id = 'hotel' type = 'text' placeholder='Hotel' title = 'Hotel Name' class = 'inputs' value='".$_GET['hotel']."'><br>
        
                <div id = 'trRoomNumber'>룸수</div><input id = 'roomNum' type = 'number' placeholder='Room Number?' title = 'Room Number...' class = 'inputs' value='".$_GET['roomNum']."'><br>
        
                <div id = 'trCheckIn'>체크인</div><input id = 'checkIn' type = 'date' class = 'inputs' placeholder='YYYY-MM-DD' title = 'Check In Date' value='".$_GET['checkIn']."' onchange = 'output()'><br>
        
                <div id = 'trNights'>박 수</div><input id = 'nights' type = 'number' placeholder='How many nights?' title = 'How Many Nights?' class = 'inputs' value='".$_GET['nights']."'><br>
        
                <div id = 'trAdultRate'>성인</div><input id = 'costAdult' type = 'number' placeholder='Room Rate' title = 'Room Cost Rate($)' class = 'inputs' value='".$_GET['costAdult']."'><br>
        
                <div id = 'trBedRate'>베드 추가</div><input id = 'costBed' type = 'number' placeholder='Bed Rate' title = 'Bed Cost Rate($)' class = 'inputs' value='".$_GET['costBed']."'>
                x<input id = 'numBed' type = 'number' placeholder='How Many?' class = 'inputs mini' title = 'How Many Extra Beds?' value='".$_GET['numBed']."'>
        
                <div id = 'trChildRate'>아동</div><input id = 'costOthers' type = 'number' placeholder='Room Rate' title = 'Room Cost Rate($)' class = 'inputs' value='".$_GET['costOthers']."'>
                x<input id = 'numOthers' type = 'number' placeholder='How Many?' class = 'inputs mini' title = 'How Many Children?' value='".$_GET['numOthers']."'>
        
                <br>
                <div id = 'trMembers'>인원</div><input id = 'members' type = 'text' placeholder='How Many Members?' class = 'inputs' title = 'How Many Members?' value='".$_GET['members']."'>
                <br>
        
                <div id = 'trPusd'>공항 픽업/샌딩</div>
                <button id = 'yesPusd' type = 'button' class = '";
                if ($_GET['pusd']!='No')
                {
                    echo "active ";
                }
                echo " pusdButton' title = 'Yes' onclick = 'clickedPusd(this)'>Yes</button>
        
                <button id = 'noPusd' type = 'button' class = '";
                if ($_GET['pusd']=='No')
                {
                    echo "active ";
                }
                echo " pusdButton' title = 'No' onclick = 'clickedPusd(this)'>No</button>
        
                <input id = 'pusdCost' type = 'number' placeholder='Cost' class = 'inputs mini' title = 'Cost' value='".$_GET['pusdCost']."'><br>
        
                <div id = 'trTour'>투어 추가</div>
                    <textarea id = 'tourText' class = 'inputs' type = 'text'>".$_GET['tour']."</textarea><br><br>
                    <textarea readonly id = 'outputText' class = 'inputs' type = 'text'></textarea>
                    <input  class = 'inputs'id = 'copyButton' type = 'button' onclick = 'copy()' value = 'Copy'>
                    <input  class = 'inputs'id = 'regButton' type = 'button' onclick = 'reg()' value = 'Submit'>
                    <input  class = 'inputs' style = 'display:none' id = 'editButton' type = 'button' onclick = 'edit()' value = 'Done Editing'>
                 </div>
            </div>
        </div>
        
        </div>";
        
        $findFareString = "SELECT *FROM tours WHERE code > -1  AND tourType = 'HOTEL'";
        
        $limit = 50;
        
        if (!empty($_GET['limit']))
        {
            $limit = $_GET['limit'];
        }
        echo " <input  style = 'display:none' id = 'limit' type = 'number' value = '$limit'>";
        $page = 1;
        if (!EMPTY($_GET['page']))
        {
            $page = $_GET['page'];
        }
        $offset = ($page-1) * $limit;
        //$findFare = mysqli_query($con, "SELECT *FROM statements ORDER BY issueDate DESC;");
        if (!empty($_GET['input']))
        {
            $input = $_GET['input'];
            $findFareString = $findFareString."AND (name LIKE '%$input%' OR hotel LIKE '%$input%' OR area LIKE '%$input%' OR tourText LIKE '%$input%' OR remarks LIKE '%$input%' OR hotel LIKE '%$input%') ";
        }
        
        if (!empty($_SESSION['dateSearch']))
        {
            $date = $_SESSION['dateSearch'];
            $findFareString = $findFareString."AND date >= '$date' ";
        }
        
        if (!empty($_SESSION['dateSearch2']))
        {
            $date2 = $_SESSION['dateSearch2'];
            $findFareString = $findFareString."AND date <= '$date2' ";
        }
        $numFareSearch = $findFareString.";";
        $findFareString = $findFareString."ORDER BY date DESC LIMIT $limit OFFSET $offset;";
        $findFare = mysqli_query($con, $findFareString);
        $findFarex = mysqli_query($con, $numFareSearch);
        $numTours = mysqli_num_rows(mysqli_query($con, $numFareSearch));
        $totalPages = ceil($numTours/$limit);
        
        
        $adultTotalx = 0;
        $bedTotalx = 0;
        $othersTotalx = 0;
        $fareTotalx = 0;
        $nightsTotalx = 0;
        $pusdTotalx = 0;
        while ($farex = mysqli_fetch_assoc($findFarex))
        {
            $costAdultx = $farex['costAdult'];
            $adultTotalx += $costAdultx;
            
            $costBedx = $farex['costBed'];
            $numBedx = $farex['numBed'];
            $bedx = $costBedx*$numBedx;
            
            $costOthersx = $farex['costOthers'];
            $numOthersx = $farex['numOthers'];
            $othersx = $costOthersx * $numOthersx;
            
            $nightsx = $farex['nights'];
            $totalx = ($costAdultx + $bedx + $othersx)*$nightsx;
            
            $pusdCostx = $farex['pusdCost'];
            if ($pusdCostx >= 0){
                $pusdTotalx += $pusdCostx;
            }
            
            $bedTotalx += $bedx;
            $othersTotalx += $othersx;
            
            $fareTotalx += $totalx;
            $nightsTotalx += $nightsx;
        }
        echo "<div class='content'>
            <table>
            <tr>
                <th class = 'centerTable'><p id = '' class = 'tooltip'>no.</p></th>
                <th class = 'centerTable'><p id  = 'thDate' class = 'tooltip'>신청일</p></th>
                <th class = 'centerTable'><p id  = 'thName' class = 'tooltip'>이름</p></th>
                <th class = 'centerTable'><p id = 'thCity' class = 'tooltip'>지역</p></th>
                <th class = 'centerTable'><p id = 'thCheckIn' class = 'tooltip'>체크인</p></th>
                <th class = 'centerTable'><p id = 'thHotel' class = 'tooltip'>호텔</p></th>
                <th class = 'centerTable'><p id = 'thRoomNum' class = 'tooltip'>룸수</p></th>
                <th class = 'centerTable'><p id = 'thMem' class = 'tooltip'>인원</p></th>
                <th class = 'centerTable tooltip2'><p id = 'thNights'>박 수</p><span class = 'tooltiptext' >$nightsTotalx</span></th>
                <th class = 'centerTable tooltip2'><p id = 'thPriceAdult'>성인요금</p><span class = 'tooltiptext' >$".number_format($adultTotalx, 0, '.', ',')."</span></th>
                <th class = 'centerTable tooltip2'><p id = 'thPriceBed'>베드</p><span class = 'tooltiptext' >$".number_format($bedTotalx, 0, '.', ',')."</span></th>
                <th class = 'centerTable tooltip2'><p id = 'thPriceChild'>아동추가</p><span class = 'tooltiptext' >$".number_format($othersTotalx, 0, '.', ',')."</span></th>
                <th class = 'centerTable tooltip2'><p id = 'thPusd'>공항 픽업/샌딩</p><span class = 'tooltiptext'>$".number_format($pusdTotalx, 0, '.', ',')."</span></th>
                <th class = 'centerTable'><p id = 'thTourText' class = 'tooltip'>투어 추가</p></th>
                <th class = 'centerTable tooltip2' ><p id = 'thTotal' >합</p><span class = 'tooltiptext'>$".number_format($fareTotalx, 0, '.', ',')."</span></th>
                <th class = 'centerTable'><p id = 'thDeposit' class = 'tooltip'>입금 완료</p></th>
                <th class = 'centerTable'><p id = 'thExpenditure' class = 'tooltip'>지출 완료</p></th>
                <th class = 'centerTable'><p id = 'thRemarks' class = 'tooltip'>비고</p></th>";
        
                if ($_SESSION['admin'] == 1)
                {
                    echo "<th class = 'centerTable'><p id = 'thRemove'>삭제?</p></th>";
                }
        
                echo "</tr>";

        $num = 0;
        $adultTotal = 0;
        $bedTotal = 0;
        $othersTotal = 0;
        $fareTotal = 0;
        $nightsTotal = 0;
        $pusdTotal = 0;
        while ($fare = mysqli_fetch_assoc($findFare))
        {
            $id = $fare['id'];
            $datex = $fare['date'];
            $name = $fare['name'];
            $area = $fare['area'];
            $hotel = $fare['hotel'];
            $roomNum = $fare['roomNum'];
            $checkIn = $fare['checkIn'];
            $costAdult = $fare['costAdult'];
            
            $costBed = $fare['costBed'];
            $numBed = $fare['numBed'];
            $bed = $costBed*$numBed;
            
            $costOthers = $fare['costOthers'];
            $numOthers = $fare['numOthers'];
            $others = $costOthers * $numOthers;
            
            $nights = $fare['nights'];
            $total = ($costAdult + $bed + $others)*$nights;
            
            $members = $fare['members'];
            $pusdCost = $fare['pusdCost'];
            $tourText = $fare['tourText'];
            $deposit = $fare['deposit'];
            $expenditure = $fare['expenditure'];
            $remarks = $fare['remarks'];
            
            $num++;
            $adultTotal += $costAdult;
            $bedTotal += $bed;
            $othersTotal += $others;
            
            $fareTotal += $total;
            $nightsTotal += $nights;

            $pusdString = '';
            if ($pusdCost >= 0){
                $pusdString = "Yes ($".number_format($pusdCost, 0, '.', ',').")";
                $pusdTotal += $pusdCost;
            }
            else
            {
                 $pusdString = 'No';
            }
                
            echo "<input id = 'today' style = 'display:none' type = 'date' class = 'inputs' title = 'Today&#146s Date' value='".date("Y-m-d")."'>";
            
            echo "<tr>";
            echo "<td><a class = 'hoverable' onclick = \"copyOutput('$name', '$roomNum', '$area', '$hotel', '$roomNum', $costAdult,$costOthers,$numOthers,$costBed,$numBed,'$checkIn',$nights,'$members', $pusdCost,'$tourText', $id)\">".($num+$offset)."</a></td>";
            
            echo "<td><p id = '".$fare['id']."' class = 'date tooltip'>".date("M-d", strtotime($datex))."<span class = 'tooltiptext'>".$datex."</span></p></td>";
            
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'name' text-editable2>".$name."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'area' text-editable2>".$area."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'checkIn' date-editable2>".$checkIn."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'hotel' text-editable2>".$hotel."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'roomNum' text-editable2>".$roomNum."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'members' text-editable2>".$members."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'nights' editable2>".$nights."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'costAdult' editable2>$".number_format($costAdult, 0, '.', ',')."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'bed' >$".number_format($bed, 0, '.', ',')."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'others' >$".number_format($others, 0, '.', ',')."</p></td>";
            
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'pusdCost' editable2>$pusdString</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'tourText' text-editable2>".$tourText."</p></td>";
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'total' >$".number_format($total, 0, '.', ',')."</p></td>";
            
            echo "<td class = 'centerTable'>";
            if ($deposit == '0000-00-00')
            {
                echo "<i id = '".$fare['id']."' class='fa fa-plus tooltip' onclick = \"changeCheck(this,'deposit')\"></i>";
            }
            else
            {
                echo "<i id = '".$fare['id']."' class='fa fa-check tooltip' onclick = \"changeCheck(this,'deposit')\"><span class='tooltiptext'>".$deposit."</span></i>";
            }
            echo "</td>";
            
            echo "<td class = 'centerTable'>";
            if ($expenditure == '0000-00-00')
            {
                echo "<i id = '".$fare['id']."' class='fa fa-plus tooltip' onclick = \"changeCheck(this,'expenditure')\"></i>";
            }
            else
            {
                echo "<i id = '".$fare['id']."' class='fa fa-check tooltip' onclick = \"changeCheck(this,'expenditure')\"><span class='tooltiptext'>".$expenditure."</span></i>";
            }
            echo "</td>";
            
            echo "<td class = 'centerTable'><p id = '".$fare['id']."' class = 'remarks' text-editable2>".$remarks."</p></td>";
            echo "</td>";
            
            if ($_SESSION['admin'] == 1)
            {
                echo "<td class = 'centerTable'><p id = '".$fare['id']."'>
                <i id = '".$fare['id']."' class='fa fa-times-circle tooltip' onclick = \"remove(this,'deleteTour')\"><span class='tooltiptext'>Remove</span></i>
                </td>";
            }
        }
        echo "<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>".number_format($nightsTotal, 0, '.', ',')."</td>
        <td>$".number_format($adultTotal, 0, '.', ',')."</td>
        <td>$".number_format($bedTotal, 0, '.', ',')."</td>
        <td>$".number_format($othersTotal, 0, '.', ',')."</td>
        <td>$".number_format($pusdTotal, 0, '.', ',')."</td>
        <td></td>
        <td>$".number_format($fareTotal, 0, '.', ',')."</td>
        <td></td>
        <td></td>
        <td></td>";
        if ($_SESSION['admin'] == 1)
        {
            echo "<td></td>";
        }
        echo "</tr></table></div>";
        
        echo "<div id = 'sliderContainer' class = 'sliderContainer tooltip'><input id = 'slider' type = 'range' class = 'pageSlider' step = '1' value = '$page' min = '1' max = '$totalPages' onmousemove = 'pageNum(event)' onchange = 'changePage(this)'><span id = 'page' class = 'tooltiptext' style = 'bottom: auto;'>Page $page / $totalPages</span></div>";
    }
   
    
    if (!isset($_POST['load']))
    {
        echo "</div><br><br><br><br><br><br><br><br><br><br><br><br>";
    }
?>
</div>

