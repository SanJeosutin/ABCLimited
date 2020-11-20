<?php  //check if session is active
if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : compUpdate.php
 *? DESCRIPTION : Update computer details page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");
?>
<div class="LoginStyle">
    <div class="StyleBox">
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){        
            echo "<h1>ABC Limited | Update Device</h1>";
            if(!isset($_POST['getID'])){
            ?>
        <form action="compUpdate.php" method="post">
            <p>
                Select userID and ComputerID from the list bellow.
            </p>
            <p>
                <select name="getID">
                    <?php getCompList(); ?>
                </select>
            </p>
            <p>
                <input class="Button" type="submit" name="updateComp" value="Update Device">
                <input class="Button" type="submit" name="deleteComp" value="Delete Device">
            </p>
        </form>
        <?php
        }else if (isset($_POST['updateComp'])){
            $getID = $_POST['getID'];
            $records = getCompRecord($getID);
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
            <p> 
                Check that this is the correct Device that you wish to update.
            </p>
            <p>Owned / Borrowed by:
                <input type="text" name="staffName" value="<?php echo $records['staffName'];?>" readonly>
            </p>
            <p>Device Number:
                <input type="text" name="compNo" value="<?php echo $records['compNo'];?>" readonly>
            </p>
            <p>Date of Purchase:
                <input type="date" name="doPurchase" value="<?php echo $records['datePurchased'];?>" >
            </p>
            <p>Computer Brand:
                <input type="text" name="brand" value="<?php echo $records['brand'];?>" >
            </p>
            <p>Type of Computer:
                <input type="radio" name="typeOfComputer" value="Desktop" <?php if($records['compType'] == 'Desktop') echo"checked" ?>>Desktop 
                <input type="radio" name="typeOfComputer" value="Laptop" <?php if($records['compType'] == 'Laptop') echo"checked" ?>>Laptop
            </p>
            <p>Operating System:
                <input type="radio" name="os" value="Windows" <?php if($records['os'] == 'Windows') echo"checked" ?>>Windows 
                <input type="radio" name="os" value="Mac" <?php if($records['os'] == 'Mac') echo"checked" ?>>Mac
            </p>
            <p>RAM:
            <?php $xplodeRAM = explode(" ", $records['ram']); ?>
                <input type="number" name="sizeRAM" value="<?php echo $xplodeRAM[0];?>" min="0" placeholder="Size of RAM" required>                
                <input type="radio" name="bytesRAM" value="MB" <?php if($xplodeRAM[1] == 'MB') echo"checked" ?>>MB
                <input type="radio" name="bytesRAM" value="GB" <?php if($xplodeRAM[1] == 'GB') echo"checked" ?>>GB
            </p>
            <p>Storage:
            <?php $xplodeStorage = explode(" ", $records['storage']); ?>
                <input type="radio" name="typeStorage" value="HHD" <?php if($xplodeStorage[0] == 'HHD') echo"checked" ?>> Hybrid Hard Drive (HHD)
                <input type="radio" name="typeStorage" value="SSD" <?php if($xplodeStorage[0] == 'SSD') echo"checked" ?>>Solid State Drive (SSD) <br>
                <input type="number" name="sizeStorage" value="<?php echo $xplodeStorage[1];?>" min="0" placeholder="Size of Storage" required>                
                <input type="radio" name="bytesStorage" value="MB" <?php if($xplodeStorage[2] == 'MB') echo"checked" ?>>MB
                <input type="radio" name="bytesStorage" value="GB" <?php if($xplodeStorage[2] == 'GB') echo"checked" ?>>GB
                <input type="radio" name="bytesStorage" value="TB" <?php if($xplodeStorage[2] == 'TB') echo"checked" ?>>TB
            </p>
            <p>Operating System Version:
            <?php $xplodeOSVer = explode(" ", $records['osVersion']); array_shift($xplodeOSVer); $xplodeOSVer = implode(" ", $xplodeOSVer);?>
                <input type="text" name="osVer" value="<?php echo $xplodeOSVer;?>">
            </p>
            <p>Lend to...
                <select name="userID">
                    <?php getUserList(); ?>
                </select>
            </p>
            <p>
                <input class="Button" type='submit' name='submitUpdate' value='Update Computer'>
                <input class="Button" type='submit' name='cancel' value='cancel'>
            </p>
        </form>
        <?php }else if (isset($_POST['deleteComp'])){
             $getID = $_POST['getID'];
             $fields = getCompRecord($getID);
         ?>
         <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='post'>
             <p> 
                 Check that this is the correct Device that you wish to delete.
             </p>
            <p>Owned / Borrowed by:
                <input type="text" name="staffName" value="<?php echo $fields['staffName'];?>" readonly>
            </p>
            <p>Device Number:
                <input type="text" name="compNo" value="<?php echo $fields['compNo'];?>" readonly>
            </p>
            <p>Date of Purchase:
                <input type="text" name="doPurchase" value="<?php echo $fields['datePurchased'];?>"  readonly>
            </p>
            <p>Computer Brand:
                <input type="text" name="brand" value="<?php echo $fields['brand'];?>"  readonly>
            </p>
            <p>Type of Computer:
                <input type="radio" name="typeOfComputer" value="Desktop" <?php if($fields['compType'] == 'Desktop') echo"checked" ?> disabled>Desktop 
                <input type="radio" name="typeOfComputer" value="Laptop" <?php if($fields['compType'] == 'Laptop') echo"checked" ?> disabled>Laptop
            </p>
            <p>Operating System:
                <input type="radio" name="os" value="Windows" <?php if($fields['os'] == 'Windows') echo"checked" ?> disabled>Windows 
                <input type="radio" name="os" value="Mac" <?php if($fields['os'] == 'Mac') echo"checked" ?> disabled>Mac
            </p>
            <p>RAM:
            <?php $xplodeRAM = explode(" ", $fields['ram']); ?>
                <input type="number" name="sizeRAM" value="<?php echo $xplodeRAM[0];?>" min="0" placeholder="Size of RAM" required disabled>                
                <input type="radio" name="bytesRAM" value="MB" <?php if($xplodeRAM[1] == 'MB') echo"checked" ?> disabled>MB
                <input type="radio" name="bytesRAM" value="GB" <?php if($xplodeRAM[1] == 'GB') echo"checked" ?> disabled>GB
            </p>
            <p>Storage:
            <?php $xplodeStorage = explode(" ", $fields['storage']); ?>
                <input type="radio" name="typeStorage" value="HHD" <?php if($xplodeStorage[0] == 'HHD') echo"checked" ?> disabled> Hybrid Hard Drive (HHD)
                <input type="radio" name="typeStorage" value="SSD" <?php if($xplodeStorage[0] == 'SSD') echo"checked" ?> disabled>Solid State Drive (SSD) <br>
                <input type="number" name="sizeStorage" value="<?php echo $xplodeStorage[1];?>" min="0" placeholder="Size of Storage" required disabled>                
                <input type="radio" name="bytesStorage" value="MB" <?php if($xplodeStorage[2] == 'MB') echo"checked" ?> disabled>MB
                <input type="radio" name="bytesStorage" value="GB" <?php if($xplodeStorage[2] == 'GB') echo"checked" ?> disabled>GB
                <input type="radio" name="bytesStorage" value="TB" <?php if($xplodeStorage[2] == 'TB') echo"checked" ?> disabled>TB
            </p>
            <p>Operating System Version:
            <?php $xplodeOSVer = explode(" ", $fields['osVersion']); ?>
                <input type="text" name="osVer" value="<?php echo $xplodeOSVer[1];?>"  readonly>
            </p>
            <p>
                 <input class="Button" type='submit' name='submitDelete' value='Delete Computer'>
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
            $compNo = $_POST['compNo'];

            $userID = $_POST['userID'];
            $records = getUserRecord($userID);
            // capture data from form and clean
            $date = cleanInput($_POST['doPurchase']);
            $compBrand = cleanInput($_POST['brand']);
            $compType = cleanInput($_POST['typeOfComputer']);
            $compOS = cleanInput($_POST['os']);
            
            $compSizeRAM = cleanInput($_POST['sizeRAM']);
            $compRAM = "$compSizeRAM ".$_POST['bytesRAM'];

            $compTypeStorage = cleanInput($_POST['typeStorage']);
            $compSizeStorage = cleanInput($_POST['sizeStorage']);
            $compByteStorage = cleanInput($_POST['bytesStorage']);
            $compStorage = $compTypeStorage." $compSizeStorage ".$compByteStorage;

            $compOSVer = cleanInput($_POST['osVer']);
            $compOSVer = substr($compOS, 0, 3)." ".$compOSVer;
            
            include '../includes/connect.php';
            try{
                $sql = "UPDATE ABC_CompTable SET datePurchased = :datePurchased, brand =:brand, compType =:compType, os =:os, 
                osVersion =:osVersion, ram =:ram, storage =:storage, staffName =:staffName WHERE compNo=:compNo;";
                $statement = $pdo->prepare($sql);
                
                $statement -> bindValue(':compNo', $compNo);
                $statement -> bindValue(':datePurchased', $date);
                $statement -> bindValue(':brand', $compBrand);
                $statement -> bindValue(':compType', $compType);
                $statement -> bindValue(':os', $compOS);
                $statement -> bindValue(':osVersion', $compOSVer);
                $statement -> bindValue(':ram', $compRAM);
                $statement -> bindValue(':storage', $compStorage);
                $statement -> bindValue(':staffName', $records['firstName']);
            
                $go = true;
                if ($go == true){
                    $statement -> execute();                   
                    echo "<p>".$userID."'s device has been updated!<p>";
                }
            }
            catch(PDOException $e) {
                echo "Error updating record: " .$e -> getMessage();
                exit();
            }
            echo "<script type='text/javascript'>window.location.href = 'compUpdate.php' </script>";
        }
            if (isset($_POST['cancel'])) {
                echo "<script type='text/javascript'> window.location.href = 'compUpdate.php';</script>";        
            }
        
        if (isset($_POST['submitDelete'])) {
            $compNo = cleanInput($_POST['compNo']);
        
            include "../includes/connect.php";
        
            try{
                $sql = "DELETE FROM ABC_CompTable WHERE compNo = :compNo;";
                $statement = $pdo -> prepare($sql);
                $statement -> bindValue(':compNo', $compNo);
                $statement -> execute();

                echo "<p>device has been deleted!<p>";
               
            }
            catch(PDOException $e){
                echo "Error Deleting user from database ".$e ->getMessage();
                exit();
            }
            echo "<script type='text/javascript'> window.location.href = 'compUpdate.php';</script>";
        }
            if (isset($_POST['cancel'])) {
                echo "<script type='text/javascript'> window.location.href = 'compUpdate.php';</script>";        
            }?>
    </div>
</div>
<?php include("footer.php")?>