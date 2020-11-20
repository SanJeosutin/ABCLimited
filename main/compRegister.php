<?php  //check if session is active
if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : compRegister.php
 *? DESCRIPTION : Register new computer page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");
?>
<div class="LoginStyle">
    <div class="StyleBox">
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){        
            echo "<h1>ABC Limited | Register Device</h1>";
            ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <p> Computer Number: <a class="Important">*</a>
                <input type="text" name="compNum" value="" placeholder="Auto increment" readonly>
            </p>
            <p> Date Purchased: <a class="Important">*</a>
                <input type="date" name="doPurchase" value="" required>
            </p>
            <p> Computer Brand: <a class="Important">*</a>
                <input type="text" name="brand" value="" required>
            </p>
            <p> Type of Computer: <a class="Important">*</a>
                <input type="radio" name="typeOfComputer" value="Desktop">Desktop 
                <input type="radio" name="typeOfComputer" value="Laptop" checked>Laptop
            </p>
            <p> Operating System: <a class="Important">*</a>
                <input type="radio" name="os" value="Windows" checked>Windows 
                <input type="radio" name="os" value="Mac">Mac
            </p>
            <p> RAM: <a class="Important">*</a>
                <input type="number" name="sizeRAM" value="" min="0" placeholder="Size of RAM" required>                
                <input type="radio" name="bytesRAM" value="MB"> MB
                <input type="radio" name="bytesRAM" value="GB" checked>GB
            </p>
            <p> Storage: <a class="Important">*</a>
                <input type="radio" name="typeStorage" value="HHD"> Hybrid Hard Drive (HHD)
                <input type="radio" name="typeStorage" value="SSD" checked>Solid State Drive (SSD) <br>
                <input type="number" name="sizeStorage" value="" min="0" placeholder="Size of Storage" required>                
                <input type="radio" name="bytesStorage" value="MB"> MB
                <input type="radio" name="bytesStorage" value="GB" checked>GB
                <input type="radio" name="bytesStorage" value="TB" checked>TB
            </p>
            <p> Operating System Version: <a class="Important">*</a>
                <input type="text" name="osVer" value="" required>
            </p>
            <p> staff Name: <a class="Important">*</a>
            <select name="userID">
                    <?php getUserList(); ?>
                </select>
            </p>
            <input class="Button" type="submit" name="submit" value="Add Computer">
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
            $userID = $_POST['userID'];
            $records = getUserRecord($userID);
            // capture data from form and clean
            $date = cleanInput($_POST['doPurchase']);
            $compBrand = cleanInput($_POST['brand']);
            $compType = cleanInput($_POST['typeOfComputer']);
            $compOS = cleanInput($_POST['os']);
            
            $compSizeRAM = cleanInput($_POST['sizeRAM']);
            $compRAM = "$compSizeRAM ".$_POST['bytesRAM'];

            $compSizeStorage = cleanInput($_POST['sizeStorage']);
            $compTypeStorage = cleanInput($_POST['bytesStorage']);
            $compStorage = $_POST['typeStorage']." $compSizeStorage ".$_POST['bytesStorage'];

            $compOSVer = cleanInput($_POST['osVer']);
            $compOSVer = substr($compOS, 0, 3)." ".$compOSVer;
        
        	include "../includes/connect.php";
        	// generate sql
        	try {
        		// create our SQL insert statement
                $createSQL = "INSERT INTO ABC_CompTable SET datePurchased = :datePurchased , brand =:brand, compType =:compType, os =:os, osVersion =:osVersion, ram =:ram, storage =:storage, staffName =:staffName;";
        		// prepare the statement
        		$statement = $pdo->prepare($createSQL);
            
                // bind the values to the statement's placeholders
                $statement -> bindValue(':datePurchased', $date);
                $statement -> bindValue(':brand', $compBrand);
                $statement -> bindValue(':compType', $compType);
                $statement -> bindValue(':os', $compOS);
                $statement -> bindValue(':osVersion', $compOSVer);
                $statement -> bindValue(':ram', $compRAM);
                $statement -> bindValue(':storage', $compStorage);
                $statement -> bindValue(':staffName', $records['firstName']);

                $statement->execute();
                //Email the user their Login details
                echo "The device has been added to the database!";
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