<?php
include('session.php');
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
    <div class="transfer">
        <form action="./transfer_engine1.php" method="POST">
            From(account number):<br>
            <input type="text" id="fromaccount" name="fromaccount"/><br>
            To(account number):<br>
            <input type="text" id="toaccount" name="toaccount"/><br>
            To(username):<br>
            <input type="text" id="to_user" name="to_user"/><br>
            Amount:<br>
            <input type="text" id="amount_tra" name="amount_tra"/><br>
            Purpose:<br>
            <input type="text" id="purpose" name="purpose"/><br>
            <input type="radio" id="aud" name="currencies" value="aud" checked/>AUD
            <input type="radio" id="usd" name="currencies" value="usd"/>USD
            <input type="radio" id="cny" name="currencies" value="cny"/>CNY
            <input type="radio" id="gbp" name="currencies" value="gbp"/>GBP
            <br>
            <input  class="submit" type="submit" name="submit" value="confirm"/>
        </form>
       
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