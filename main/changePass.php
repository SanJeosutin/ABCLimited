<?php if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : changePass.php
 *? DESCRIPTION : change password page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");
?>
<div class="LoginStyle">
    <div class="StyleBox">
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){
            echo "<h1>ABC Limited | New Password</h1>";
            ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                    enctype="multipart/form-data">
                    <p> Current Password:<a class="Important">*</a>
                        <input type="password" name="oldPasswd" value="" required size="16">
                    </p>
                    <p> New Password:<a class="Important">*</a>
                        <input type="password" name="newPasswd" value="" required size="16">
                    </p>
                    <p> Re-enter New Password:<a class="Important">*</a>
                        <input type="password" name="reNewPasswd" value="" required size="16">
                    </p>
                    <input class="Button" type="submit" name="resetPass" value="Reset My password!">
                    </p>
                    <p class="Info">Field marked with an <a class="Important">*</a> are required.</p>
                </form>
            <?php
            //BROKEN//
            if(isset($_POST['resetPass'])){
                if ($_POST['oldPasswd'] == $_SESSION['passwd']){
                    if($_POST['newPasswd'] == $_POST['reNewPasswd']){
                        include("../includes/myFunctions.php");

                        $userID = $_SESSION['uID'];
                        $oldPasswd = cleanInput($_POST['oldPasswd']);
                        $newPasswd = cleanInput($_POST['newPasswd']);
                        $passwd = cleanInput($_POST['reNewPasswd']);
                        try{
                            include("../includes/connect.php");
                            $updatePass = "UPDATE ABC_UserLogin SET passwd = :passwd WHERE userID = :userID;";
                            $statement = $pdo->prepare($updatePass);

                            $statement -> bindValue(':userID', $userID);
                            $statement -> bindValue(':passwd', $passwd);
                            $statement -> execute();
                        }
                        catch(PDOException $ex){
                            //create Error msg
                            echo "Error!! Error!! Record could not be fetch!! Error!: ".$ex->getMessage();
                            exit();
                        }
                        echo "Your password has been changed.";
                    } else {
                        echo "<p>Incorrect password or new password isn't  match</p>";
                    }
                }
            }
            //END OF BROKEN// 
        } else {
            echo "<h1>ABC Limited | ACCESS DENIED </h1>";
            echo "<p>I'm affraid you need to provide your identity to one of our bot</p>
                <p>Please do so by clicking the button bellow! Danke!!!</p>

                <Form name='login' method='post' action='../index.php'>
                    <input class ='Button' type='submit' value='Verify my identity'>
                </from>";
        }
        ?>
    </div>
</div>
<?php include("footer.php");?>