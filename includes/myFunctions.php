<?php
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : myFunctions.php
 *? DESCRIPTION : All the things that this app need :D
 *? CREATED ON  : 7-11-2019
 *********************************************/
function cleanInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generateNumber($min, $max){
    $num = mt_rand($min, $max);
    return $num;
}

function displayWelcome(){
    $date = date('d/m/Y');
    $time = date('h:m:s A');
    $today = getdate();

    $cTime = $today['hours'];

    if($cTime < 12){
        echo "<p>Good Morning User. The time now is $time on $date</p>";
    }
    elseif($cTime < 15){
        echo "<p>Good Afternoon User. The time now is $time on $date</p>";
    }
    elseif($cTime < 18){
        echo "<p>Good Night User. The time now is $time on $date</p>";
    }
    else{
        echo "<p>User, you need to sleep. Currently the time now is $time on $date</p>";
    }
}

function getUserList(){
    include 'connect.php';

    try{
        $sql = "SELECT userID, firstName FROM ABC_UserLogin;";

        $resultSet = $pdo -> query($sql);
    }
    catch(PDOException $e){
        echo "Error.. Cannot fetch User_LoginDetails: ".$e->getMessage();
        exit();
    }

    foreach($resultSet as $row){
        $userid = $row['userID'];
        $firstName = $row['firstName'];

        echo "<option value='$userid'> $firstName   | ID: $userid </option>";
    }   
}

function getUserRecord($userid){
    include 'connect.php';

    try{
        $sql = "SELECT * FROM ABC_UserLogin WHERE userID = :userID";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':userID', $userid);
        $statement->execute();
    }
    catch(PDOException $e){
        echo "Error.. Cannot fetch User_Details: ".$e->getMessage();
        exit;
    }

    return $row = $statement->fetch(PDO::FETCH_ASSOC);
}

function getCompList(){
    include 'connect.php';

    try{
        $sql = "SELECT compNo, staffName FROM ABC_CompTable;";

        $resultSet = $pdo -> query($sql);
    }
    catch(PDOException $e){
        echo "Error.. Cannot fetch Comp_Details: ".$e->getMessage();
        exit();
    }

    foreach($resultSet as $row){
        $compid = $row['compNo'];
        $staffName = $row['staffName'];

        echo "<option value='$compid'> $staffName   | ID: $compid </option>";
    }   
}

function getCompRecord($compid){
    include 'connect.php';

    try{
        $sql = "SELECT * FROM ABC_CompTable WHERE compNo = :compNo";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':compNo', $compid);
        $statement->execute();
    }
    catch(PDOException $e){
        echo "Error.. Cannot fetch Computer_Details: ".$e->getMessage();
        exit;
    }

    return $row = $statement->fetch(PDO::FETCH_ASSOC);
}

?>