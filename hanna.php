<style>
    .dropbtn {
        background-color: red;
        color: white;
        padding: 5px 13px;
        font-size: 15px;
        border: none;
        cursor: pointer;
    }
    .dropbtn:hover, .dropbtn:focus {
        background-color: #c41717;
    }
    .dropdown {
        position: relative;
        display: inline-block;
    }
  .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown:hover .dropdown-content{
        display: block;
    }
    .dropdown-content a:hover {
        color: white;
        background-color: red;
        display: block;
    }
    a{
        text-decoration: none;
    }
    .midnav{
        align-items: center;
    display: flex;
    padding: 0px;
    margin: 10px;
        min-width: 600px;
    display: table;
    margin: 50px auto;
    }
</style>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <body>
        <div class = "midnav">
            <div class="dropdown">
                <a href="http://hannatour.kr" class="dropbtn">홈</a>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb01" class="dropbtn">항공권</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb01">- 한국행 항공료</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb03">- 기타노선</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb04">- 예약문의</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb04">- 예약신청</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/hanna_backup/visa/step1.php" class="dropbtn">베트남비자</a>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb12_1&wr_id=52&page=2" class="dropbtn">당일투어</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb12_1&wr_id=52&page=2">- <strong>나트랑</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb11&wr_id=1">- <strong>달랏</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb05&wr_id=1&page=0&sca=&sfl=&stx=&sst=&sod=&spt=0&page=0">- 호치민</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb10&wr_id=1">- 하노이</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb13&page=1&sfl=&stx=&spt=0&page=1">- 다낭</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb13_2&wr_id=1&page=1&sca=&sfl=&stx=&sst=&sod=&spt=0&page=1">- 푸꾹</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb13_3&wr_id=1&page=1&sca=&sfl=&stx=&sst=&sod=&spt=0&page=1">- 무이네</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb14">- 예약문의</a>
                    <a href="http://hannatour.kr/bbs/write.php?bo_table=tb14_1">- 예약신청</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_10&page=1&sfl=&stx=&spt=0&page=1" class="dropbtn">패키지투어</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_10&page=1&sfl=&stx=&spt=0&page=1">- 호치민</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_1">- 붕다우</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_2">- 무이네</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_8&page=1&sfl=&stx=&spt=0&page=1">- 다낭</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_3">- 나트랑</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_4">- 달랏</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_9&page=1&sfl=&stx=&spt=0&page=1">- 나트랑+달랏</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_5">- 하롱베이</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_6">- 푸꾹</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb15_7">- 꼰다오</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb22_2">- 알뜰투어</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb23">- 예약문의</a>
                    <a href="http://hannatour.kr/bbs/write.php?bo_table=tb23_1">- 예약신청</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%B3%AA%C6%AE%B6%FB" class="dropbtn">호텔</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%B3%AA%C6%AE%B6%FB">- <strong>나트랑</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%B4%DE%B6%F9">- <strong>달랏</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%C8%A3%C4%A1%B9%CE">- 호치민</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%BA%D8%B4%D9%BF%EC">- 붕다우</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%C7%CF%B3%EB%C0%CC">- 하노이</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%B9%AB%C0%CC%B3%D7">- 무이네</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%B4%D9%B3%B6">- 다낭</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb25&sca=%C7%AA%B2%DA">- 푸꾹</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb35">- 예약문의</a>
                    <a href="http://hannatour.kr/bbs/write.php?bo_table=tb35_1">- 예약신청</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb45_2" class="dropbtn">특식</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb45_2">- <strong>호치민</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb45_3">- <strong>하노이</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb45_4">- <strong>다낭</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb45_5">- <strong>하이퐁</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb45_6">- <strong>나트랑</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb72">- <strong>예약문의</strong></a>
                    <a href="http://hannatour.kr/bbs/write.php?bo_table=tb57_reservations">- <strong>예약신청</strong></a>
                </div>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb45&page=0" class="dropbtn">골프</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb45&page=0">- <strong>달랏</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb46&page=0">- <strong>나트랑</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb44&page=1">- 호치민</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb47&page=1">- 하노이</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb48&page=0">- 다낭</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb48_2&page=0">- 판티엣</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb48_3&page=1&sfl=&stx=&spt=0&page=1">- 단체동계훈련</a>
                    <a href="/bbs/board.php?bo_table=movie_golf">- 골프장 동영상</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb49">- 예약문의</a>
                    <a href="http://hannatour.kr/bbs/write.php?bo_table=tb49_1">- 예약신청</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_1" class="dropbtn">프로모션</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_1">- <strong>호치민</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_2">- <strong>하노이</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_3">- <strong>다낭</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_4">- <strong>하이퐁</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_5">- <strong>나트랑</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_6">- <strong>푸꾹</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_7">- <strong>달랏</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_8">- <strong>안람 닌반베이</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_9">- <strong>무이네</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_10">- <strong>판티엣</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57_vungtau">- <strong>붕다우</strong></a>
                </div>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb56_1" class="dropbtn">STORY</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb56_1">- 갤러리</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=talk&page=0&page=0">- 여행 후기</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb70">- 여행동영상</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb59">- 한나이야기</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb71">- 자유게시판</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57" class="dropbtn">고객센터</a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb57">- <strong>프로모션</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb54">- <strong>공지사항</strong></a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb55">- FAQ</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb56">- 여행정보팁</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb72">- 온라인문의</a>
                    <a href="http://hannatour.kr/bbs/board.php?bo_table=tb58&wr_id=1">- 회사소개</a>
                </div>
            </div>
        </div>

    </body>

</html>

<script>
    function show() {
        document.getElementById("myDropdown").classList.toggle("show");
    }


</script>
