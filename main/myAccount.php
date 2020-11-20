<?php  //check if session is active
if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : myAccount.php
 *? DESCRIPTION : My account page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");?>
<div class="LoginStyle">
    <div class="StyleBox">
<?php
if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){
    echo"<h1>ABC Limited | ".$_SESSION['fName']."'s Page</h1>";
    echo"<p>Welcome ".$_SESSION['fName']."!! </p>
        <p>You're logged in as ".$_SESSION['role'].".</p>";

    if (isset($_SESSION['status']) && $_SESSION['role'] == "Admin"){
    echo"<p>You have the power to add, update and delete other user!</p>
        <p> Isn't that nice 😊.</p>
        <p>--------------------------------------------------------</p>
        <p>'With great power, comes great responsibility' - Some random admin dude </p>
        <p>Keep the above quote in mind :D!</p>
    ";} 
    else if (isset($_SESSION['status']) && $_SESSION['role'] == "Viewer"){
        echo"<p>You have the power to View and make report!! Huzzah!!</p>
        <p>--------------------------------------------------------</p>
        <p>'With great power, comes great responsibility' - Some random dude on the internet</p>
        <p>Keep the above quote in mind :D!</p>";
    }
} else{
echo "<h1>ABC Limited | ACCESS DENIED </h1>";
echo "<p>I'm affraid you need to provide your identity to one of our bot</p>
    <p>Please do so by clicking the button bellow! Danke!!!</p>

    <Form name='login' method='post' action='../index.php'>
        <input class ='Button' type='submit' value='Verify my identity'>
    </from>";
}?>
    </div>
</div>
<?php include("footer.php")?>