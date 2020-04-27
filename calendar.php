<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <style>
        body {
            display: flex;
            margin: 0 auto;
            justify-content: center;
            height: 100vh;
        }

        /* 上方標題區 */
        .Loader1 {
            display: flex;
            position: absolute;
            justify-content: center;
            align-content: center;
            height: 20%;
            width: 50%;
            min-width: 550px;
            margin-top: 2%;
            background: linear-gradient(180deg, skyblue, transparent);
            border-radius: 50px 50px 3px 3px;
            position: relative;
        }

        .Select {
            position: absolute;
            left: 0%;
        }

        .TheDateY,
        .TheDateM,
        .TheDateBig {
            position: absolute;
            text-transform: uppercase;
            font-family: "Lucida Sans";
        }
        trytrytry
        /* 「年」 */
        .TheDateY {
            bottom: 3%;
            right: 1%;
            font-size: 50px;
        }

        /* 「月-英文」 */
        .TheDateM {
            top: 5%;
            right: 1%;
            font-size: 50px;
        }

        /* 「月-數字」 */
        .TheDateBig {
            top: -35%;
            font-size: 200px;
            font-weight: bolder;
        }

        /* 上下年按鈕 */
        .YearButton {
            bottom: 0%;
            left: 100%;
        }

        .BackToday {
            left: 100%;
            bottom: -25.5%;
        }

        .YearButton a {
            width: 4rem;
            height: 1.5rem;
            line-height: 1.5rem;
            text-align: center;
            border: 1 solid black;
        }

        /* 上下月按鈕 */
        .MonthButton {
            top: 7%;
            left: 100%;
        }

        /* 按鈕整體設定 */
        .MonthButton a,
        .YearButton a,
        .BackToday a {
            width: 4.5rem;
            height: 1.5rem;
            text-align: center;
            line-height: 1.5rem;
            border: 1px solid black;
            padding: 0 3px 0 3px;
            border-radius: 5px;
            box-shadow: 0 0 5px black inset;
            font-family: sans-serif;
            color: black;
            text-decoration: none;
            margin-bottom: 5px;
        }

        .MonthButton a:hover,
        .YearButton a:hover,
        .BackToday a:hover {
            box-shadow: 0 0 5px black;
        }



        /* 按鈕整體設定 */
        .MonthButton,
        .YearButton,
        .BackToday {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            position: absolute;
        }

        /* 連結基礎樣式設定 */
        a:active {
            color: black;
        }

        a:visited {
            color: black;
        }

        a:hover {
            color: gray;
        }

        /* 以下為月曆本體區 */
        .Loader2 {
            height: 50%;
            width: 50%;
            position: absolute;
            top: 25%;
            min-width: 550px;
        }

        table {
            height: 100%;
            width: 100%;
            border-collapse: collapse;
            position: relative;
        }

        /* 月曆表格本體 */
        td {
            height: 10vh;
            border: 1px solid lightgrey;
            table-layout: fixed;
            min-width: 65px;
            position: relative;
            /* border-style: hidden; */
        }

        /* 月曆表格 */
        td span {
            display: flex;
            color: black;
            justify-content: center;
            font-family: 'Segoe UI';
            font-weight: bolder;
        }

        /* 懸浮於日期框框 */
        tr td:hover {
            background: transparent;
            box-shadow: 0 0 3px blue inset;
        }

        /* 標題列：周一 到 周五 */
        table th {
            height: 10vh;
            border: 1px solid grey;
            table-layout: fixed;
            min-width: 65px;
            position: relative;
            font-size: 17px;
            height: 50%;
            background: #a8a8a8;
            color: #000000;
            font-family: "Segoe UI";
        }

        /* 標題列：周六 跟 周日 */
        table th:first-child,
        th:last-child {
            font-size: 19px;
            color: black;
            background: #FF5151;
            font-family: "Lucida Sans";
        }

        /* 周六 跟 周日的日期數字 */
        tr td:first-child span,
        tr td:last-child span {
            color: red;
        }

        /* 上個月日期顯示 */
        .numberprev {
            font-weight: lighter;
            color: #444444;
            border-radius: 5px;
            text-align: center;
            line-height: 1.1rem;
            opacity: 0.7;
        }

        /* 下個月日期顯示 */
        .numbernext {
            font-weight: lighter;
            font-size: 9px;
            color: #444444;
            border-radius: 5px;
            text-align: center;
            line-height: 1.1rem;
            opacity: 0.7;
        }

        /* 懸浮於下個月日期 */
        .numbernext_td:hover,
        .numberprev_td:hover {
            position: relative;
            opacity: 0.9;
            background: transparent;
            box-shadow: 0 0 3px red inset;
        }

        /* 特別文字標籤 */
        .wordnote {
            position: absolute;
            display: block;
            top: 5%;
            left: 5%;
            text-align: center;
            height: 1.0rem;
            width: auto;
            font-size: 8px;
            padding: 1px 1px 2.5px 2.5px;
            color: red;
            border-radius: 50px;
            background: linear-gradient(135deg, transparent, #C4E1FF, #97CBFF, #2894FF);
        }
    </style>
</head>

<body>
    <!-- 設定日期結構 -->
    <!-- 設定日期結構 -->
    <!-- 設定日期結構 -->
    <?php
    if (isset($_GET['ym'])) {
        $YM = $_GET['ym'];
    } elseif (isset($_POST['YearList']) && isset($_POST['MonthList'])) {
        $YM = $_POST['YearList'] . '-' . $_POST['MonthList'];
    } else {
        $YM = date('Y-m');
    }

    $WeeksName = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    // date of today
    // date of today
    $Today = strtotime(date('Y-m-d'));
    // the first day of month
    // the first day of month
    $TimeStamp = strtotime(date($YM . '-01'));
    if ($TimeStamp === false) {
        $YM = date('Y-m');
        $TimeStamp = strtotime($YM . '-01');
    }
    // 0=Sunday, 1=Monday, 2=Tuesday...
    // 0=Sunday, 1=Monday, 2=Tuesday...
    $FirstDayWeek = date('w', $TimeStamp);
    $FirstDayNext = date('w', strtotime('+1 month', $TimeStamp));

    /* 設定日期變化 */
    /* 設定日期變化 */
    $DaysCount = date('t', $TimeStamp);
    $DaysCountPrev = date('t', strtotime('-1 month', $TimeStamp));
    $PrevMonth = date('Y-m', strtotime('-1 month', $TimeStamp));
    $NextMonth = date('Y-m', strtotime('+1 month', $TimeStamp));
    $PrevYear = date('Y-m', strtotime('-1 year', $TimeStamp));
    $NextYear = date('Y-m', strtotime('+1 year', $TimeStamp));
    $TheDateY = date('Y', $TimeStamp);
    $TheDateM = date('F', $TimeStamp);
    $TheDateD = date('j', $TimeStamp);
    $TheDateBig = date('n', $TimeStamp);
    $SecondSunday = date('j', strtotime('2 Sunday', $TimeStamp));
    $MotherDay = '5-' . $SecondSunday;
    /* 設定今天 */
    /* 設定今天 */
    $TheM = date('n', $Today);
    $TheD = date('j', $Today);
    $TheY = date('Y', $Today);

    // 設定節日
    // 設定節日
    // 設定節日
    $Holiday = [
        '1-1' => '元旦',
        '2-28' => '228紀念日',
        '2-14' => '情人節',
        '4-1' => '愚人節',
        '5-1' => '勞動節',
        '8-8' => '父親節',
        '10-10' => '雙十節',
        '12-25' => '聖誕節',
        '3-8' => '婦女節',
        '3-12' => '植樹節',
        '4-4' => '兒童節',
        '4-5' => '清明節',
        '9-3' => '軍人節',
        '9-28' => '教師節',
        $MotherDay => '母親節'
    ];


    ?>
    <div class="Loader1">
        <div class="Select">
            <form action="calendar.php" method="POST">
                <select option="calendar.php" name="YearList">
                    <?php
                    for ($y = $TheDateY - 500; $y <= $TheDateY + 500; $y++) {
                        if ($y == $TheDateY) {
                            echo "<option selected>";
                            echo $y;
                            echo "</option>";
                        } else {
                            echo "<option>";
                            echo $y;
                            echo "</option>";
                        }
                    }
                    ?>
                </select>

                <select action="calendar.php" name="MonthList">
                    <?php
                    for ($m = 1; $m <= 12; $m++) {
                        if ($m == $TheDateBig) {
                            echo "<option selected>";
                            echo $m;
                            echo "</option>";
                        } else {
                            echo "<option>";
                            echo $m;
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="查詢">
            </form>
        </div>
        <div class='TheDateY'><?= $TheDateY ?></div>
        <div class='TheDateM'><?= $TheDateM ?></div>
        <div class='TheDateBig'><?= $TheDateBig ?></div>
        <div class='MonthButton'>
            <a href="?ym=<?= $PrevMonth; ?>"><?= date('n', strtotime($PrevMonth)) ?>月&#9650;</a>
            <a href="?ym=<?= $NextMonth; ?>"><?= date('n', strtotime($NextMonth)) ?>月&#9660;</a>
        </div>
        <div class=YearButton>
            <a href="?ym=<?= $PrevYear; ?>"> <?= date('Y', strtotime($PrevYear)) ?>年&#9650;</a>
            <a href="?ym=<?= $NextYear; ?>"> <?= date('Y', strtotime($NextYear)) ?>年&#9660;</a>
        </div>
        <div class=BackToday><a href="calendar.php">Today</a></div>
    </div>

    <div class="Loader2">
        <table>
            <tr>
                <?php
                for ($w = 0; $w < 7; $w++) {
                    echo "<th> $WeeksName[$w] </th>";
                }
                ?>
            </tr>
            <?php
            for ($i = 0; $i < 5; $i++) {
                echo "<tr>";
                for ($t = 0; $t < 7; $t++) {
                    $Num = ($i * 7) + ($t - $FirstDayWeek + 1);
                    $NumPrev = $DaysCountPrev - $FirstDayWeek + $t + 1;
                    $NumNext = $t + 1;
                    if ($i == 0 && $t < $FirstDayWeek) {
                        // 上個月最後幾天
                        echo "<td class=numberprev_td>";
                        echo "<span  class='numberprev'>";
                        echo $NumPrev;
                        echo "</span>";
                        echo "</td>";
                    } elseif ($TheM == date('n', $TimeStamp) && $Num == $TheD && $TheY == date('Y', $TimeStamp)) {
                        // 「今天」
                        echo "<td>";
                        echo "<span class='wordnote'>";
                        echo '今日';
                        echo "</span>";
                        echo "<span  class='number'>";
                        echo $Num;
                        echo "</span>";
                        echo "</td>";
                    } else if (array_key_exists($TheDateBig . '-' . $Num, $Holiday)) {
                        // 「節日」
                        echo "<td>";
                        echo "<span class='wordnote'>";
                        echo $Holiday[($TheDateBig . '-' . $Num)];
                        echo "</span>";
                        echo "<span  class='number'>";
                        echo $Num;
                        echo "</span>";
                        echo "</td>";
                    } elseif ($Num < $DaysCount + 1) {
                        // 直接計算每月起始週期＆每月到第幾天
                        echo "<td>";
                        echo "<span  class='number'>";
                        echo $Num;
                        echo "</span>";
                        echo "</td>";
                    } else {
                        // 下個月的前幾天
                        $NumNext = $t - $FirstDayNext + 1;
                        echo "<td class=numbernext_td>";
                        echo "<span class='numbernext'>";
                        echo $NumNext;
                        echo "</td>";
                        echo "</span>";
                    }
                }
            }


            echo "</tr>";
            ?>
        </table>
    </div>
</body>

</html>