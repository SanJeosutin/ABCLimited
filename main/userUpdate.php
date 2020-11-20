<?php  //check if session is active
if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : userUpdate.php
 *? DESCRIPTION : Update user details page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");
?>
<div class="LoginStyle">
    <div class="StyleBox">
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){        
            echo "<h1>ABC Limited | Update User</h1>";
            if(!isset($_POST['userID'])){
            ?>
        <form action="userUpdate.php" method="post">
            <p>
                Select user from the list bellow.
            </p>
            <p>
                <select name="userID">
                    <?php getUserList(); ?>
                </select>
            </p>
            <p>
                <input class="Button" type="submit" name="updateUser" value="Update User">
                <input class="Button" type="submit" name="deleteUser" value="Delete User">
            </p>
        </form>
        <?php
        }else if (isset($_POST['updateUser'])){
            $userID = $_POST['userID'];
            $records = getUserRecord($userID);
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <p> 
                Check that this is the correct user that you wish to update.
            </p>
            <input type="hidden" name="userID" value="<?php echo $records['userID'];?>">
            <input type='hidden' name='passwd' value="<?php echo $records['passwd'];?>">
            <p>*User ID:
                <input type="text" name="uID" value="<?php echo $records['userID'];?>" readonly>
                <input type="radio" name="updateUserID" value="yes"> Yes
                <input type="radio" name="updateUserID" value="no" checked> No<br> 
            </p>
            <p>*First Name: 
                <input type="text" name="fName" value="<?php echo $records['firstName'];?>">
            </p>
            <p>*Last Name: 
                <input type="text" name="lName" value="<?php echo $records['lastName'];?>">
            </p>
            <p>*Email: 
                <input type="email" name="email" value="<?php echo $records['email'];?>">
            </p>
            <p> 
                Role:
                <input type="radio" name="role" value="Admin" <?php
                if($records['role'] == 'Admin')echo "checked"; ?>> Admin
                <input type="radio" name="role" value="Viewer" <?php
                if($records['role'] == 'Viewer')echo "checked"; ?>> Viewer<br>
            </p>
            <p>
                Reset password? 
                <input type="radio" name="resetUserPass" value="yes"> Yes
                <input type="radio" name="resetUserPass" value="no" checked> No<br>
            </p>
            <p>
                <input class="Button" type="submit" name="submitUpdate" value="Update">
                <input class="Button" type='submit' name='cancel' value='cancel'>
            </p>
        </form>
        <?php }else if (isset($_POST['deleteUser'])){
             $userID = $_POST['userID'];
             $fields = getUserRecord($userID);
         ?>
         <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='post'>
             <p> 
                 Check that this is the correct user that you wish to delete.
             </p>
             <input type='hidden' name='userID' value="<?php echo $fields['userID'];?>">
             <p> 
                 First Name:
                 <input type='text' name='fName' value="<?php echo $fields['firstName'];?>" readonly>
             </p>
     
             <p> 
                 Last Name:
                 <input type='text' name='lName' value="<?php echo $fields['lastName'];?>" readonly>
             </p>
     
             <p> 
                 Email:
                 <input type='email' name='email' value="<?php echo $fields['email'];?>" readonly>
             </p>
             <p> 
                 Role: <br>
                 <input type='radio' name='role' value='Admin' <?php if ($fields['role']=='Admin') echo "checked";?> disabled> Admin <br>
                 <input type='radio' name='role' value='Viewer' <?php if ($fields['role']=='Viewer') echo "checked";?> disabled> Viewer <br>
             </p>
             <p> 
                 <input class="Button" type='submit' name='submitDelete' value='Delete user'>
                 <input class="Button" type='submit' name='cancel' value='cancel'>
             </p>
         </form>
         <?php
         }
         ?>
        
        <?php } else {
            echo "<h1>ABC Limited | ACCESS DENIED </h1>";
            echo "<p>I'm affraid you need to provide your identity to one of our bot</p>
                <p>Please do so by clicking the button bellow! Danke!!!</p>
            
                <Form name='login' method='post' action='../index.php'>
                    <input class ='Button' type='submit' value='Verify my identity'>
                </from>";
        }
        if (isset($_POST['submitUpdate'])) {
            //Use for randomly generate user ID and password////////////////////////
            $setOfChar = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm";
            $randChar = rand(0, strlen($setOfChar));
            $charGenPasswd = $setOfChar[$randChar];
            //$salt = openssl_random_pseudo_bytes(16);
            $randPasswdNum =  rand(1000, 9999);
            $randUserNumID = rand(1000,5000);
            //////// END OF RANDOM USER ID & PASS GENERATOR //////////////////////
            $userID = cleanInput($_POST['userID']);
            if(($_POST['updateUserID']) == "yes"){
                $newUserID = substr($_POST['lName'], 0 ,3).$randUserNumID;
            }else if (($_POST['updateUserID']) == "no"){
                $newUserID = cleanInput($_POST['uID']);
            }
            $fName = cleanInput($_POST['fName']);
            $lName = cleanInput($_POST['lName']);
            $email = cleanInput($_POST['email']);
            $role = cleanInput($_POST['role']);
            if(($_POST['resetUserPass']) == "yes"){
                $passwd = substr($_POST['lName'], 0 ,3).$randPasswdNum.$charGenPasswd;
            } else if(($_POST['resetUserPass']) == "no"){
                $passwd = $_POST['passwd'];
            }
        
            include '../includes/connect.php';
            try{
                $sql = "UPDATE ABC_UserLogin SET userID=:newUserID, firstName=:fName, lastName=:lName, email=:email, 
                role=:role, passwd=:passwd WHERE userID=:userID;";
                //UPDATE ABC_UserLogin SET userID="abc" WHERE userID="lop3";
                $statement = $pdo->prepare($sql);
            
                $statement -> bindValue(':userID', $userID);
                $statement -> bindValue(':newUserID', $newUserID);
                $statement -> bindValue(':fName', $fName);
                $statement -> bindValue(':lName', $lName);
                $statement -> bindValue(':email', $email);
                $statement -> bindValue(':role', $role);
                $statement -> bindValue(':passwd', $passwd);
            
                $go = true;
                if ($go == true){
                    $statement -> execute();
                    //Email the user their updated Login details
                    $emailAdd = $_POST['email'];
                    $subject = "ABC Limited | Your New Login detail has arrived!!";
                    $message = "<h1>Login detail of $fName"." "."$lName</h1> 
                                <h3>sent by: ".$_SESSION['fName'].". Admin from ABC Limited<h3/>
                                <br><p>UserID: $userID <br> Password: $passwd</p>";
                    mail($emailAdd, $subject, $message);
                    //END OF EMAIL//
                    echo "<p>$fName's profile has been updated!<p>";
                }
            }
            catch(PDOException $e) {
                echo "Error updating record: " .$e -> getMessage();
                exit();
            }
            echo "<script type='text/javascript'>window.location.href = 'userUpdate.php' </script>";
        }
            if (isset($_POST['cancel'])) {
                echo "<script type='text/javascript'> window.location.href = 'userUpdate.php';</script>";        
            }
        
        if (isset($_POST['submitDelete'])) {
            $userID = cleanInput($_POST['userID']);
        
            include "../includes/connect.php";
        
            try{
                $sql = "DELETE FROM ABC_UserLogin WHERE userID = :userID;";
                $statement = $pdo -> prepare($sql);
                $statement -> bindValue(':userID', $userID);
                $statement -> execute();
                //Email the user their termination details        
                $emailAdd = $_POST['email'];
                $subject = "ABC Limited | Letter of notice!";
                $message = "<h1> Your Login has been terminated!</h1> 
                            <h3>sent by: ".$_SESSION['fName'].". Admin from ABC Limited<h3/>
                            <br><p>We hope you've enjoy working with as at ABC Limited</p>";
                mail($emailAdd, $subject, $message);
                //END OF EMAIL//
            }
            catch(PDOException $e){
                echo "Error Deleting user from database".$e ->getMessage();
                exit();
            }
            echo "<script type='text/javascript'> window.location.href = 'userUpdate.php';</script>";
        }
            if (isset($_POST['cancel'])) {
                echo "<script type='text/javascript'> window.location.href = 'userUpdate.php';</script>";        
            }?>
    </div>
</div>
<?php include("footer.php")?>