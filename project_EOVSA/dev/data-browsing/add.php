<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
    header("Location: index.php");
}

// connect to database
include('includes/connection.php');
// include functions file
include('includes/functions.php');

// set all variables to empty by default  
$antArray = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$antName = array('ant01','ant02','ant03','ant04','ant05','ant06','ant07','ant08','ant09','ant10','ant11','ant12','ant13','ant14');
// $entry_time = (string) new Date("Y-m-d H:i:s");
$error = $flare_note = $solution = "";
// if add button was submitted
if( isset( $_POST['add'] ) ) {
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function
    if( !$_SESSION['loggedInUser'] ) {
        $nameError = "You are not logged in! <br>";
    } else {
        $tohban_name = $_SESSION['loggedInUser'];
    }

    if( !$_POST["date"] ) {
        $dateError = "Please enter a date YYYY-MM-DD. <br>";
    } else {
        $observe_date = validateFormData($_POST['date']);
    }

    for( $i=0; $i<count($antArray); $i++) {
            // $tmp = $antName[i];
            if(isset($_POST[$antName[$i]])){
                $antArray[$i] = 1;
            } else { 
                $antArray[$i] = 0;
            }
        }
    $ant_num = count($antArray) - array_sum($antArray);

    // these inputs are not required
    // so we'll just store whatever has been entered
    $error = $_POST["error"]; //validateFormData($_POST["error"]);
    $flare_note = $_POST["flare_note"]; // validateFormData($_POST["flare_note"]);
    $solution = $_POST["solution"]; //validateFormData($_POST["solution"]);

    // if required fields have data
    if( $tohban_name && $observe_date) {
        
        // create query        
        $query = "INSERT INTO ant_log (id, entry_time, tohban_name, flare_note, ant_num, observe_date, ant01, ant02, ant03, ant04, ant05, ant06, 
            ant07, ant08, ant09, ant10, ant11, ant12, ant13, ant14, error, solution, flare_id, flm_list_id, xsp_list_id) 
                VALUES (NULL, CURRENT_TIMESTAMP, '$tohban_name', '$flare_note', '$ant_num', '$observe_date', 
                    '".$antArray[0]."', '".$antArray[1]."', '".$antArray[2]."', '".$antArray[3]."', '".$antArray[4]."', '".$antArray[5]."', '".$antArray[6]."', '".$antArray[7]."',
                        '".$antArray[8]."', '".$antArray[9]."', '".$antArray[10]."', '".$antArray[11]."', '".$antArray[12]."', '".$antArray[13]."', '$error','$solution',NULL,NULL, NULL)";

        $result = mysql_query( $query );
        
        // if query was successful
        if( $result ) {
            // refresh page with query string
            header( "Location: clients.php?alert=success" );
        } else {
            // something went wrong
            echo "Error: ". $query ."<br>" . mysql_error($conn);
        }
    }
    
}

// close the mysql connection
mysql_close($conn);


include('includes/header.php');
?>

<h1>Add Log</h1>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">
    
    <div class="form-group col-sm-6">
        <label for="tohban-date">Observing Date</label>
        <input type="text" class="form-control input-md" id="tohban-date" placeholder="YYYY-MM-DD" name="date" value="">
    </div>


    <div class="form-group col-sm-6">
        <label for="client-name">Tohban Name</label>
        <input type="text" class="form-control input-md" id="tohban-name" name="tohbanName" value="<?php echo $_SESSION['loggedInUser']; ?>" disabled>
    </div>

    <div class="form-group form-inline col-sm-12">
        <label>Offline Antenna</label>
        <?php
            for ($i=0; $i<count($antArray); $i++) {
                echo "
                <div class='checkbox'>
                    <label>
                        <input type='checkbox' name = '".$antName[$i]."' value=''>&nbsp;".$antName[$i]."&nbsp;
                    </label>
                </div>
                ";
            }
        ?>

    </div>

    <div class="form-group col-sm-12">
        <label for="error">Error</label>
        <textarea type="text" class="form-control input-md" rows="5" id="error" name="error"></textarea>
    </div>

    <div class="form-group col-sm-12">
        <label for="solution">Solution</label>
        <textarea type="text" class="form-control input-md" rows="5" id="solution" name="solution"></textarea>
    </div>

    <div class="form-group col-sm-12">
        <label for="flare-note">Flare Note</label>
        <textarea type="text" class="form-control input-md" rows="5" id="flare-note" name="flare_note"></textarea>
    </div>

    <div class="col-sm-12">
            <a href="clients.php" type="button" class="btn btn-md btn-default pull-left" >Cancel</a>
            <button type="submit" class="btn btn-md btn-success pull-right" name="add">Add Log</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>