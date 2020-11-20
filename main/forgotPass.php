<?php if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : forgotPass.php
 *? DESCRIPTION : change password page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");
?>
<div class="LoginStyle">
    <div class="StyleBox">
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){
            echo "<h1>ABC Limited | Recover My Password</h1>";
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
            enctype="multipart/form-data">
            <p> user ID:<a class="Important">*</a>
                <input type="text" name="uID" value="" required size="16">
            </p>
            <p> Email:<a class="Important">*</a>
                <input type="email" name="email" value="" required size="16">
            </p>
            <input class="Button" type="submit" name="resetPass" value="Reset My password!">
            </p>
            <p class="Info">Field marked with an <a class="Important">*</a> are required.</p>
        </form>
        <?php
            if(isset($_POST['resetPass'])){
                //BROKEN//
                include("../includes/connect.php");

                $sql = "SELECT userID, email FROM ABC_UserLogin WHERE userID;";
                $statement = $pdo->prepare($sql);
                $statement -> execute();
                echo "$statement->rowCount()";

                $row = $statement->fetch(PDO::FETCH_NUM);
                cleanInput($_POST['uID']);
                cleanInput($_POST['email']);
            
                if($_POST['email'] == $row[1] && $_POST['uID'] == $_SESSION['uID']){
                    $message = "Your password is: ".$_SESSION['passwd']." Please consider to change this to a new one";
                    mail($_SESSION['email'], "New Password", $message);
                    echo "<script type='text/javascript'> alert('Password has been sent to your email!') </script>";
                } else{
                    echo "<script type='text/javascript'> alert('The credentials you have provided is invalid. Please try again') </script>";
                }
                //END OF BROKEN//
	        }
        }else {
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