<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db.conn.php");
$res=mysqli_query($mysqli, "SELECT * FROM `registration` WHERE username LIKE '$session_user'");
if ($res) $re = mysqli_fetch_array($res);
//if the session for username has not been saved, automatically go back to signin_form.php
 if ($session_user=="")
{
    header('Location: ./Home_page.php');
}
if(isset($_GET['error']))
{
    $errormessage=$_GET['error'];
    //show error message using javascript alert
    echo "<script>alert('$errormessage');</script>";
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
    <div class="mainpage">
        <div class="middile">
            <div class="viewaccount">
            <div class="apply_bus">
            <h3>Apply Business Account</h3>
        <form method="POST" action="./apply_engine.php">
            <label for="bus_user">Username:</label><br>
            <input name="bus_name" value="<?php echo $session_user;?>"/><br><br>
            <label for="abn_bus">ABN:</label><br>
            <input name="abn"/><br>
            <input id="access" name="access_bus" type="hidden" value="1"/><br>
            <input id="ac_type" name="ac_type" type="hidden" value="Business"/><br>
            <input class="submit" type="submit" value="Confirm"/>
            
        </form>
          </div>
            <table  name="maintable" >
            <tr>
            <th>Nickname/Type</th>
            <th>BSB/Details</th>
            <th>Account number</th>
            <th>Account balance</th>
            <th>Available funds</th> 
            </tr>
            <?php
             include('db_conn.php');//connect the database
           // $query_saving = "SELECT * FROM `saving` INNER JOIN `business`";
            $query_saving = "SELECT * FROM `account`";
            $result_saving = $mysqli->query($query_saving);
            $datarow= $result_saving->num_rows;
            
            //to show the user's account
           
            for($i=0;$i<$datarow;$i++)
                {
                 $query_arr = $result_saving->fetch_assoc();
                 if($query_arr['username']==$session_user){
                 $type_saving = $query_arr['ac_type'];
                //echo $type_saving;
                //echo "333";
                $bsb_saving = "03 5632";
                $account_num = $query_arr['id'];
                //echo $account_num;
                $balance_saving = $query_arr['funds'];
                $funds_saving = $query_arr['funds'];
                
                echo"
                <tr>
                <td>$type_saving</td>
                <td>$bsb_saving</td>
                <td>$account_num</td>
                <td>$$balance_saving</td>
                <td>$$funds_saving</td>
                </tr>";
                 }
                }
           
            ?>
            </table>
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