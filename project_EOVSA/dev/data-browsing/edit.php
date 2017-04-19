<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
    header("Location: index.php");
}

// get ID sent by GET collection
$logID = $_GET['id'];

// connect to database
include('includes/connection.php');

// include functions file
include('includes/functions.php');

// query the database with client ID
$query = "SELECT * FROM ant_log WHERE id='$logID'";
$result = mysql_query($query );

// if result is returned
if( mysql_num_rows($result) > 0 ) {
    
    // we have data!
    // set some variables
    while( $row = mysql_fetch_assoc($result) ) {
        $antArray = array($row['ant01'],$row['ant02'],$row['ant03'],$row['ant04'],$row['ant05'],$row['ant06'],$row['ant07'],$row['ant08'],
            $row['ant09'],$row['ant10'],$row['ant11'],$row['ant12'],$row['ant13'],$row['ant14']);

        $antName = array('ant01','ant02','ant03','ant04','ant05','ant06','ant07','ant08','ant09','ant10','ant11','ant12','ant13','ant14');
        $entry_time = $row['entry_time'];
        $error = $row['error'];
        $flare_note = $row['flare_note'];
        $observe_date = $row['observe_date'];
        $solution = $row['solution'];
        $tohban_name = $row['tohban_name'];

    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>No information. <a href='clients.php'>Go back</a>.</div>";
}

// if update button was submitted
if( isset($_POST['update']) ) {
    
    // set variables
        for( $i=0; $i<count($antArray); $i++) {
            // $tmp = $antName[i];
            if(isset($_POST[$antName[$i]])){
                $antArray[$i] = 1;
            } else { 
                $antArray[$i] = 0;
            }
        }

        $ant_num = count($antArray) - array_sum($antArray);
        $error = $_POST['error']; //validateFormData($_POST['error']);
        $flare_note = $_POST['flare_note']; //validateFormData($_POST['flare_note']);
        $observe_date = validateFormData($_POST['date']);
        $solution = $_POST['solution']; //validateFormData($_POST['solution']);
        $tohban_name = validateFormData($_POST['tohban_name']);
    
    // new database query & result

    $query = "UPDATE ant_log
            SET ant01='".$antArray[0]."',
                ant02='".$antArray[1]."',
                ant03='".$antArray[2]."',
                ant04='".$antArray[3]."',
                ant05='".$antArray[4]."',
                ant06='".$antArray[5]."',
                ant07='".$antArray[6]."',
                ant08='".$antArray[7]."',
                ant09='".$antArray[8]."',
                ant10='".$antArray[9]."',
                ant11='".$antArray[10]."',
                ant12='".$antArray[11]."',
                ant13='".$antArray[12]."',
                ant14='".$antArray[13]."',
                ant_num= '$ant_num',
                error='$error',
                flare_note='$flare_note',
                observe_date='$observe_date',
                solution='$solution',
                tohban_name='".$_SESSION['loggedInUser']."'
                WHERE id='$logID'";   
    
    $result = mysql_query($query );
    
    if( $result ) {
        
        // redirect to client page with query string
        header("Location: clients.php?alert=updatesuccess");
    } else {
        echo "Error updating record: " . mysql_error($conn); 
    }
}

// if delete button was submitted
if( isset($_POST['delete']) ) {
    
    $alertMessage = "<div class='alert alert-danger'>
                        <p>Are you sure you want to delete this log? No take backs!</p><br>
                        <form action='". htmlspecialchars( $_SERVER["PHP_SELF"] ) ."?id=$logID' method='post'>
                            <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete!'>
                            <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Oops, no thanks!</a>
                        </form>
                    </div>";
}

// if confirm delete button was submitted
if( isset($_POST['confirm-delete']) ) {
    
    // new database query & result
    $query = "DELETE FROM ant_log WHERE id='$logID'";
    $result = mysql_query( $query );
    
    if( $result ) {
        
        // redirect to client page with query string
        header("Location: clients.php?alert=deleted");
    } else {
        echo "Error updating record: " . mysql_error($conn);
    }
    
}

// close the mysql connection
mysql_close($conn);

include('includes/header.php');
?>

<h1>Edit Log</h1>

<?php echo $alertMessage;
 ?>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $logID; ?>" method="post" class="row">
    <div class="col-sm-12">
        <hr>
            <button type="submit" class="btn btn-md btn-danger pull-left" name="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            <div class="pull-right">
                <a href="clients.php" type="button" class="btn btn-md btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Cancel</a>
                <button type="submit" class="btn btn-md btn-success" name="update"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
            </div>
        <hr>
    </div>
    <h1>&nbsp;</h1>
    
    <div class="form-group col-sm-6">
        <label for="tohban-date">Observing Date</label>
        <input type="text" class="form-control input-md" id="tohban-date" placeholder="YYYY-MM-DD" name="date" value="<?php echo $observe_date; ?>">
    </div>


   

    <div class="form-group col-sm-6">
        <label for="tohban-name">Tohban Name</label>
        <input type="text" class="form-control input-md" id="tohban-name" name="tohban_name" value="<?php echo $tohban_name; ?>" disabled>
    </div>

    <div class="form-group form-inline col-sm-12">
        <label>Offline Antenna</label>
        <?php
            for ($i=0; $i<count($antArray); $i++) {
                if ($antArray[$i] == 0) {
                    echo "
                    <div class='checkbox'>
                        <label>
                            <input type='checkbox' name = '".$antName[$i]."' value='".$antArray[$i]."'>&nbsp;".$antName[$i]."&nbsp;
                        </label>
                    </div>
                    ";
                // }
                } else {
                    echo "
                    <div class='checkbox'>
                        <label>
                            <input type='checkbox' name = '".$antName[$i]."' value='".$antArray[$i]."' checked>&nbsp;".$antName[$i]."&nbsp;
                        </label>
                    </div>
                    ";
                }
            }

        ?>

    </div>

    <div class="form-group col-sm-12">
        <label for="error">Error</label>
        <textarea type="text" class="form-control input-md" rows="5" id="error" name="error"><?php echo $error; ?></textarea>
    </div>

    <div class="form-group col-sm-12">
        <label for="solution">Solution</label>
        <textarea type="text" class="form-control input-md" rows="5" id="solution" name="solution"><?php echo $solution; ?></textarea>
    </div>

    <div class="form-group col-sm-12">
        <label for="flare-note">Flare Note</label>
        <textarea type="text" class="form-control input-md" rows="5" id="flare-note" name="flare_note"><?php echo $flare_note; ?></textarea>
    </div>
 
</form>

<?php
include('includes/footer.php');
?>

