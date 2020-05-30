<?php
 //include the file session.php
include("session.php");
//if the session for username has been set, automatically go to "signin_success.php"
if($session_user!="")
{
    header('Location: ./main_page.php');
}
if(isset($_POST['error']))
{
    $errormessage=$_POST['error'];
    //show error message using javascript alert
    echo "<script>alert('$errormessage');</script>";
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
    <link rel="stylesheet" href="style.css">
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
                                    <li class="menu"><a href="">Home</a></li>
                                    <li><a href="" class="menu">Viewaccounts</a></li>
                                    <li><a href="" class="menu">Transactions</a></li>
                                    <li><a href="" class="menu">EStatements</a></li>
                                    <li><a href="" class="menu">Pay</a></li>
                                    <li><a href=""class="menu">Manage</a></li>
                                    <li><a href="" class="menu  ">Message</a></li>
                                </ul>
                </div>
            </div>

            <div class="signincontainer">
                <div class="signinname">
                    <form class="form_one" method="POST" action="./login_engine.php" >
                        <label for="name">Username:</label>
                        <input id="name" name="name" type="text"/><br>

                        <label for="password">Password:</label>
                        <input id="password" name="password" type="password"/><br>
                            
                        <input type="checkbox"  name="remeber" id="remeber" value="remeber" />
                        Save Online ID<br><br>
                        <input class="submit" type="submit"  value="Login"/>
                        <p>Don't you have account yet?<a href="./register.php">Registration</a></p>
                        </div> 
                        <div class="main_comment">
                            <h2>Welcome to Sucure bank</h2>
                            <h2>Financial management expert around you</h2>
                        </div>
                </div>
                
            </div>
        </div>
    </header>
<div class='main'>
    <div class="detail_one">
        <p>Saving account</p>
        <img class="" src="saving.jpg" alt="saving" ><br>
        <button class="saving">Learn more</button>
    </div>
    <div class="detail_two">
        <p>Financial Information</p>
        <img class="five" src="news.jpg" alt="news"><br>
        <button class="news">Learn more</button>
    </div>
    <div class="detail_three">
         <p>Ways to pay</p>
        <img class="six" src="pay.jpg" alt="pay"><br>
        <button class="pay">Learn more</button>
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