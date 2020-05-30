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
            <p class="user">Welcome   <?php   echo $session_user;echo " <br>Last login time:".$session_lasttime;?></p>
        </div>
    </header>
    <div class="main">
        <form method="POST" action="./manager_comments.php">
            <table>
                <tr>
                   <th>time:</th><br>
                   <td>
                       <select name="time">
                           <option value="" selected="selected">Please Select Time</option>
                           <option value="oneday">one day</option>
                           <option value="oneweek">one week</option>
                           <option value="onemonth">one month</option>
                           <option value="threemonths">three months</option>
                       </select>
                   </td>
                   <td><input type="submit" name="submit" id="submit" value="Confirm"/></td>
                </tr>
            </table>
            <!-- <input type="submit" name="submit" id="submit" value="Confirm"/> -->
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