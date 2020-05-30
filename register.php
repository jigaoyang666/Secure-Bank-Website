<?php
/* //include the file db_conn.php
include("db.conn.php");
//include the file register_validate.php. to validate the the information is the eligible.
include("register_validate.php");
//include("insert_register.php");*/
/* if(isset($_GET['error']))
{
    $errormessage=$_GET['error'];
    //show error message using javascript alert
    echo "<script>alert('$errormessage');</script>"; */
/*}*/ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style_1.css">
    <title>Document</title>
    <link rel="stylesheet" href="style_1.css">
</head>
<body>
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
                    <div class="navigation_register">
                            <ul class="nav_home"  align="left" style="float:left">
                                    <li class="menu"><a href="Home_page.php">Home</a></li>
                                </ul>

                    </div>
                     </div>
    </header>
    <div class="register_main">
        <form id="signupForm" method="POST" action="./register_engine.php">
            <div>
                Title:
                <input type="checkbox" id="title" name="title" value="Mr" />Mr
                <input type="checkbox" id="title" name="title" value="Mrs"/>Mrs
                <input type="checkbox" id="title" name="title" value="Miss" />Miss
                <input type="checkbox" id="title" name="title" value="Ms" />Ms
            </div>
            <div>
                 <label for="surname">Surname:</label><br>
                <input id="surname" name="surname"/>
            </div>
            <div>
                <label for="givenname">Given name:</label><br>
                <input id="givenname" name="givenname"/>
            </div>
            <div>
                          <label for="username">Username:</label><br>
                          <input id="username" name="username"/>
            </div>
            <div>
                          <label for="password">Password:</label><br>
                          <input id="password" name="password" type="password"/>
            </div>
            <div>
                          <label for="confirm_password">Confirm password:</label><br>
                          <input id="confirm_password" name="confirm_password" type="password"/>
            </div>
            <div>
                          <label for="brithcertification">Brith certification:</label><br>
                          <input id="certification" name="certification"/>
            </div>
            <div>
                          <label for="date of birth">Date of birth:</label><br>
                          <input id="birth" type="date" name="birth"/>
            </div>
            <div>
                          <label for="email">Email:</label><br>
                          <input id="email" name="email"/>
            </div>
            <div>
                          <label for="mobile">Mobile:</label><br>
                          <input id="mobile" name="mobile"/>
            </div>
                            <input id="access" name="access" type="hidden" value="1"/>
                            <input id="ac_type" name="ac_type" type="hidden" value="Saving"/>
                      <p>
                          <input class="submit" type="submit" value="submit"/>
                      </p>
        </form>
        <?php    		
            if(isset($_GET['error']))
            {
                $errormessage=$_GET['error'];
                //show error message using javascript alert
              /*   echo "<script>alert('$errormessage');</script>";
            } 
            if (isset($error)) { */
    			echo "*".$errormessage; 
			} 
			?>
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