<?php
 include("db_conn.php");
include("session.php");
//to get the value from the comments page;
$comments_show = $_POST['comments_show'];
$comments_number = $_POST['comments_number'];
$select_time = $_POST['time'];
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
<header>
    <div class="container">
                    <!-- <div class="background_home">
                        <img src="1.jpg" width="100%" height="800px">
                    </div>  -->
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
                                    <li><a href="./main_page.php" class="menu">Viewaccounts</a></li>
                                    <li><a href="./transfer.php" class="menu">Transactions</a></li>
                                    <li><a href="comments.php" class="menu">EStatements</a></li>
                                    <li><a href="./paybill.php" class="menu">Pay</a></li>
                                    
                                </ul>
                                <div class="logout">
                                <a href="signout.php">Logout</a>
                                </div>
                    </div>
                     </div>
                     <div class="welcome">
            <p class="user">Welcome                         <?php echo $session_user;echo " <br>Last login time:".$session_lasttime;?></p>
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
       $date= "1 MONTH";
        $fee = 0;
        if($select_time == "onemonth")
        {
            $date= "1 MONTH";
            $fee = 2.5;
        }
        elseif($select_time == "threemonths")
        {
            $date= "3 MONTH";
            $fee = 5;
        }
        elseif($select_time == "sixmonths")
        {
            $date= "6 MONTH";
            $fee = 7;
        }
        //create a number as the transfer reference number;
        $reference = rand(10000,99999);
         $query_fee = "SELECT * FROM `account` WHERE `id`= '$comments_number'";
        $result_fee= $mysqli->query($query_fee);
        $data_fee = $result_fee->fetch_assoc();
        $payfee = $data_fee['funds'];
        $new_data = (float)$payfee - $fee;
        //to finish the fee deduction when the user choose different period estatement;
        $sql_fee = "UPDATE 'account' SET `funds`= '$new_data' WHERE `id`= '$comments_number' ";
        $mysqli->query($sql_fee);
        $sql_add = "INSERT INTO `".$comments_number."` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`, `balance`) 
        VALUES ('$reference', '$comments_number', '111111', '$session_user', 'secure bank', '$fee', 'fee', '-$fee')";
        $sql_comments = "INSERT INTO `comments` (`reference`, `from_ac`, `to_ac`, `from_user`, `to_user`, `funds`, `purpose`) 
        VALUES ('$reference', '$comments_number', '111111', '$session_user', 'secure bank', '$fee', 'fee' )";
        $mysqli->query($sql_add); 
        $mysqli->query($sql_comments);

        //to show different period estatement depend on the user's choice;
      /*  if($select_time== "oneday"){ */
        $reference = rand(10000,99999);
        $query_one = "SELECT * FROM `".$comments_number."`  WHERE `date` BETWEEN DATE_SUB(CURDATE(), INTERVAL  ".$date.") AND CURDATE()+1;";
        $result_one = $mysqli->query($query_one);
        $row_one = $result_one->num_rows;
        for($i=0; $i<$row_one; $i++){
            $data_one = $result_one->fetch_assoc();
            $reference_one = $data_one['reference'];
            $account_one = $data_one['from_ac'];
            $to_one = $data_one['to_ac'];
            $user_one = $data_one['from_user'];
            $to_user = $data_one['to_user'];
            $funds_one = $data_one['balance'];
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
        
        //header('Location: ./comments_engine.php?error='.$new_data.'');
   
        ?>
        </table>
        <div class="back">
                    <button><a href="./comments.php">Back</a></button>
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