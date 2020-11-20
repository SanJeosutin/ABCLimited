<?php  //check if session is active
if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : userRegister.php
 *? DESCRIPTION : Register User page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");
?>
<div class="LoginStyle">
    <div class="StyleBox">
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){        
            echo "<h1>ABC Limited | Register User</h1>";
            ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
            enctype="multipart/form-data">
            <p> First Name:<a class="Important">*</a>
                <input type="text" name="fName" value="" required size="20">
            </p>
            <p> Last Name:<a class="Important">*</a>
                <input type="text" name="lName" value="" required size="20">
            </p>
            <p> Email:<a class="Important">*</a>
                <input type="email" name="email" value="" required size="20">
            </p>
            <p> Role:<a class="Important">*</a>
                <input type="radio" name="role" value="Admin">Admin 
                <input type="radio" name="role" value="Viewer" checked>Viewer
            </p>
            <input class="Button" type="submit" name="submit" value="Create User">
            </p>
            <p class="Info">Field marked with an <a class="Important">*</a> are required. </p>
        </form>

        <?php } else {
            echo "<h1>ABC Limited | ACCESS DENIED </h1>";
            echo "<p>I'm affraid you need to provide your identity to one of our bot</p>
                <p>Please do so by clicking the button bellow! Danke!!!</p>
            
                <Form name='login' method='post' action='../index.php'>
                    <input class ='Button' type='submit' value='Verify my identity'>
                </from>";
        }
        
        if (isset($_POST['submit'])) {
            $setOfChar = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm";
            $randChar = rand(0, strlen($setOfChar));
            $charGenPasswd = $setOfChar[$randChar];
            //$salt = openssl_random_pseudo_bytes(16);
            $randPasswdNum =  rand(1000, 9999);
            $randUserNumID = rand(1000,5000);    
        
            // capture data from form and clean
            $userID = substr($_POST['lName'], 0 ,3).$randUserNumID;
            $fName = cleanInput($_POST['fName']);
            $lName = cleanInput($_POST['lName']);
            $email = cleanInput($_POST['email']);
            $role = cleanInput($_POST['role']);
            $passwd = substr($_POST['lName'], 0 ,3).$randPasswdNum.$charGenPasswd;
        
        	include "../includes/connect.php";
        	// generate sql
        	try {
        		// create our SQL insert statement
                $createSQL = "INSERT INTO ABC_UserLogin SET userID = :userID, email = :email,
                firstName = :fName, lastName = :lName,  role = :role, passwd = :passwd;";
        
        		// prepare the statement
        		$statement = $pdo->prepare($createSQL);
            
                // bind the values to the statement's placeholders
                $statement -> bindValue(':userID', $userID);
                $statement -> bindValue(':email', $email);
                $statement -> bindValue(':fName', $fName);
                $statement -> bindValue(':lName', $lName);
                $statement -> bindValue(':role', $role);
                $statement -> bindValue(':passwd', $passwd);
            
                $statement->execute();
                //Email the user their Login details
                $emailAdd = $_POST['email'];
                $subject = "ABC Limited | Your Login detail has arrived!!";
                $message = "<h1>Login detail of $fName"." "."$lName</h1><br><p>UserID: $userID <br> Password: $passwd</p>";
                mail($emailAdd, $subject, $message);
                //END OF EMAIL//
                echo "$fName's profile has been created!";
        	}
        	catch(PDOException $e) {
        		echo "Error inserting record: ".$e->getMessage();
        		exit();
        	}
        }
        ?>
    </div>
</div>
<?php include("footer.php")?>