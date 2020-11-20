<?php /*Start session if there isn't any*/ 
if (session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SanJeosutin">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABC Limited</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="LoginStyle">
            <div class="StyleBox">
                <p class="Title">ABC Limited</p>
            <?php  //check if user have an active session
            if (isset($_POST['userid'])) {
                include("includes/myFunctions.php");
                //Clean the user input. Prevent SQL Injection
                $userId = cleanInput($_POST['userid']);
                $passwd = cleanInput($_POST['passwd']);
            
                //verify the user
                include("includes/connect.php");
                //Load userID and Password from the databasse
                try {
                    $sql = "SELECT * FROM ABC_UserLogin WHERE userID = :userID AND passwd = :passwd";
                    //prepare sql statement
                    $statement = $pdo->prepare($sql);
                    //binding the values to a placeholder
                    $statement -> bindValue(':userID', $userId);
                    $statement -> bindValue(':passwd', $passwd);
                    //execute the statement
                    $statement -> execute();
                //display any error that are encountered
                } catch(PDOException $e) {
                    echo "Error verifying user: " .$e -> getMessage();
                    exit();
                }
                //checking rows
                $numOfRow = $statement->rowCount();
                if ($numOfRow == 1){
                    $_SESSION['status'] = "valid";
                    //get the basic user info from the database
                    $row = $statement->fetch(PDO::FETCH_NUM);
                    $_SESSION['uID'] = $row[0];
                    $_SESSION['fName'] = $row[2];
                    $_SESSION['role'] = $row[4];
                    $statement->fetchColumn();
                } else {
                    echo "<p>Error. The Server room might be on fire!!!</p>";
                }
            }?>
            
            <?php
            //check if session status is valid
            if (isset($_SESSION['status']) && $_SESSION['status'] == "valid"){
                echo"<script type='text/JavaScript'> console.log('User has logged in!'); </script>";
                header("location: main/myAccount.php");
            } else {
                if (isset($_SESSION['status']) && $_SESSION['status'] == "invalid") {
                    echo "<p>Incorect userID or Password. Try again! </p>";
                    ?>
            <form name="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="Username">
                    <p>Username: <input type="text" name="userid" size="20" /> </p>
                </div>
                <div class="Password">
                    <p>Password: <input type="password" name="passwd" size="20" /></p> <br>
                </div>
                <input class ="Button" type="submit" value="Login">
            </form>
            <?php
                    //reset session login
                    unset($_SESSION['status']);
                }
                else { ?>
            <form name="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="Username">
                    <p>Username: <input type="text" name="userid" size="20" /> </p>
                </div>
                <div class="Password">
                    <p>Password: <input type="password" name="passwd" size="20" /></p> <br>
                </div>
                <input class ="Button" type="submit" value="Login">
                <?php
                } 
            } ?>
            <br><br>
            <footer><b>Collins St | 3000 MELBOURNE, VIC</b></footer>
        </div>
    </div>
    </form>
</body>

</html>