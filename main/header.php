<?php if (session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SanJeosutin">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABC Limited</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
<body>
<div class="menuBar"> 
    <p>
        <?php
        include("../includes/myFunctions.php");
        //getUserList();
        
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){
            echo "<div class='userInfo'>
                        <b>Name: </b>".$_SESSION['fName']."
                        <b> | Role: </b>".$_SESSION['role']."<br>
                    <a href='../includes/logout.php'>Logout</a><br>
                    <a href='forgotPass.php'>Forgot my Password</a><br>
                    <a href='changePass.php'>Change my Password</a>
                </div>";
                                /*NOT DONE!!!!*/
            if (isset($_SESSION['status']) && $_SESSION['role'] == "Admin"){
                echo "<div class='drpdwnMenu'>
                <button class='drpdwnBar'>Users Details</button>
                    <div class='drpdwnContent'>
                        <a href='userRegister.php'>- Add User</a>
                        <a href='userUpdate.php'>- Update User</a>
                    </div>
                </div>";
                echo "<div class='drpdwnMenu'>
                <button class='drpdwnBar'>Computer Details</button>
                    <div class='drpdwnContent'>
                        <a href='compRegister.php'>- Add Computer</a>
                        <a href='compUpdate.php'>- Update Computer</a>
                    </div>
                </div>";
            }
            echo "<div class='drpdwnMenu'>
            <button class='drpdwnBar'>Computer Lists</button>
                <div class='drpdwnContent'>
                    <a href='compView.php'>- View Computer Specs</a>
                    <a href='compFindType.php'>- Find Computer by Type</a>
                    <a href='compFindOS.php'>- Find Computer by OS</a>
                    <a href='compDueReplace.php'>- Due for Replacement</a>
                </div>
            </div>";
        }
        ?>
    </p>
</div>