<?php
include("db_conn.php");
include("session.php");
if ($session_user=="")
{
    header('Location: ./Home_page.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style_1.css">
</head>
<body>
<header>
    <div class="container">
                    
                    <div class="top">
                    <div class="title">
                        <p>Secure Bank</p>
                    </div>
                    <div class="logo_home">
                            <img class="logo" src="logo1.png" alt="bank" width="60px" height="60px">
                    </div>
                    <div class="navigation">
                            <ul class="nav_home"  align="left" style="float:left">
                                    <li class="menu"><a href="./Home_page.php">Home</a></li>
                                    <li><a href="./manage_viewaccount.php" class="menu">Viewaccounts</a></li>
                                    <li><a href="./manage_account.php" class="menu">Manage</a></li>
                                    <li><a href="man_estatement.php" class="menu">EStatements</a></li>
                                    <li><a href="manage_message.php" class="menu  ">Message</a></li>
                                </ul>
                                <div class="logout">
                                <a href="signout.php">Logout</a>
                                </div>
                    </div>
                     </div>
                     <div class="welcome">
            <p class="user">Welcome  <?php   echo $session_user;echo " <br>Last login time:".$session_lasttime;?></p>
        </div>
    </header>
    <div class="comments_show">
        <div class="viewcomments">
        <table>
            <tr>
                <th>Reference</th>
                <th>From account</th>
                <th>To account</th>
                <th>From user</th>
                <th>To user</th>
                <th>Funds</th>
                <th>Purpose</th>
                <th>Date</th>
            </tr>
        <?php
        // to set two variable, $date and $fee;
        //to validate the user choose. then to assign different value depend on the user's choice;
        $data = 1;
        $select_time = $_POST['time'];
        if($select_time == "oneday")
        {
            $date= 1;
        }
        elseif($select_time == "oneweek")
        {
            $date= 7;
        }
        elseif($select_time == "onemonth")
        {
            $date= 30;
        }
        elseif($select_time == "threemonths")
        {
            $date= 90;
        }
        //to show different period estatement depend on the user's choice;
       /*  if($select_time== "oneday"){ */
            $query_one = "SELECT * FROM `comments` WHERE DATE_SUB(CURDATE(), INTERVAL ".$date." DAY)<=date(`date`) ORDER BY `date`";
            $result_one = $mysqli->query($query_one);
            $row_one = $result_one->num_rows;
            for($i=0; $i<$row_one; $i++){
                $data_one = $result_one->fetch_assoc();
                $reference_one = $data_one['reference'];
            
                $account_one = $data_one['from_ac'];
                $to_one = $data_one['to_ac'];
                $user_one = $data_one['from_user'];
                $to_user = $data_one['to_user'];
                $funds_one = $data_one['funds'];
                $purpose_one = $data_one['purpose'];
                $date = $data_one['date'];
                echo
                 "
                  <tr>
                     <td>$reference_one</td>
                     <td>$account_one</td>
                     <td>$to_one</td>
                     <td>$user_one</td>
                     <td>$to_user</td>
                     <td>$funds_one</td>
                     <td>$purpose_one</td>
                     <td>$date</td>
                  </tr>
                 ";
            }
        ?>
        </table>
        <div class="back">
                    <button><a href="./man_estatement.php">Back</a></button>
            </div>
        </div>
    </div>
    <footer>
        <div  class="footer_home">
            
                <ul>
                    <li>© 2019 Secure Bank ABN 62 951 159 852;***Student Name:Gaoyang Ji; Student Number:484708</li>
                </ul>
        </div>
</footer>
</body>
</html>