<?php  //check if session is active
if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : compFindType.php
 *? DESCRIPTION : Computer find page
 *? CREATED ON  : 06-11-2019
 *********************************************/
include("header.php");
?>
<div class="LoginStyle">
    <div class="StyleBox">
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == "valid"){
            echo "<h1>ABC Limited | Search Computer</h1>";
            ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='post'>
        <b class="subHead">Find Computer by type: </b>
            <p>
                <input type="radio" name="typeOfComputer" value="desktop">Desktop
                <input type="radio" name="typeOfComputer" value="laptop">Laptop
                <input type="radio" name="typeOfComputer" value="any" checked>Any
            </p>
                <input class="Button" type='submit' name='submit' value='Get Type'>
        </form>
        <?php
            if(isset($_POST['submit'])) {
                include "../includes/connect.php";
                switch($_POST['typeOfComputer']){
                    case "desktop":
                        echo "Desktop";
                        $db = "SELECT * FROM ABC_CompTable WHERE compType LIKE 'Desktop' ORDER BY `ABC_CompTable`.`compType` ASC;"; 
                        break;
                    case "laptop":
                        echo "Laptop";
                        $db = "SELECT * FROM ABC_CompTable WHERE compType LIKE 'Laptop' ORDER BY `ABC_CompTable`.`compType` ASC;"; 
                        break;
                    default:
                        echo "ANY";
                        $db = "SELECT * FROM ABC_CompTable ORDER BY `ABC_CompTable`.`staffName` ASC;"; 
                        break;
                }
                $reseltSet = $pdo->query($db);
                ?>
                <table class="Table">
		    <tr>
    	        <th>No</th>
    	        <th>Type</th> 
    	        <th>Staff Name</th> 
    	        <th>Date Purchased</th> 
    	        <th>Brand</th> 
		        <th>Operating System</th>
    	        <th>OS Version</th>
    	        <th>RAM</th>		
    	        <th>Storage</th>		
		    </tr>
            <?php
            //extract data using loop from $reseltSet
            foreach($reseltSet as $row){
                //store row data
                $no = $row['compNo'];
                $compType = $row['compType'];
                $staff = $row['staffName'];
                $doPurchased = $row['datePurchased'];
                $brand = $row['brand'];
                $os = $row['os'];
                $osVersion = $row['osVersion'];
                $ram = $row['ram'];
                $storage = $row['storage'];
                //display row data
                echo"
                <tr>
                <td>$no</td>
                <td>$compType</td>
                <td>$staff</td>
                <td>$doPurchased</td>
                <td>$brand</td>
                <td>$os</td>
                <td>$osVersion</td>
                <td>$ram</td>
                <td>$storage</td>
                </tr>";
            } }
            ?>
		</table>
        <?php
        } else {
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