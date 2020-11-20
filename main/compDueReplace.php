<?php  //check if session is active
if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : compDueReplace.php
 *? DESCRIPTION : computer due to replace page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");
?>
<div class="LoginStyle">
    <div class="StyleBox">
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){        
            echo "<h1>ABC Limited | Computer Due for Replacement</h1>";
            ///START OF VIEW///
		//connect to DB
		include "../includes/connect.php";
		try{
			$db = "SELECT * FROM `ABC_CompTable` WHERE `datePurchased` < (CURRENT_TIMESTAMP - INTERVAL 4 YEAR);";
			$reseltSet = $pdo->query($db);
		}
		catch(PDOException $ex){
			echo "Error!! Error!! Record could not be fetch!! Error!: ".$ex->getMessage();
            exit();
		}
		?>
		<table class="Table">
		    <tr>
                <th>No</th>
    	        <th>Brand</th>
    	        <th>Type</th> 
		        <th>Operating System</th>
    	        <th>OS Version</th>
    	        <th>RAM</th>		
                <th>Storage</th>
                <th>Staff ID</th>
                <th>Date of Purchased</th>
		    </tr>
		    <?php
		    //extract data using loop from $reseltSet
		    foreach($reseltSet as $row){
                //store row data
                $no = $row['compNo'];
		    	$brand = $row['brand'];
		    	$compType = $row['compType'];
		    	$os = $row['os'];
		    	$osVersion = $row['osVersion'];
		    	$ram = $row['ram'];
                $storage = $row['storage'];
                $staffID = $row['staffName'];
                $doPurchase = $row['datePurchased'];
		    	//display row data
		    	echo"
                <tr>
                    <td>$no</td>
		    		<td>$brand</td>
		    		<td>$compType</td>
		    		<td>$os</td>
		    		<td>$osVersion</td>
		    		<td>$ram</td>
		    		<td>$storage</td>
		    		<td>$staffID</td>
		    		<td>$doPurchase</td>
		    	</tr>";
		    }?>
		</table>
        <?php } else {
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