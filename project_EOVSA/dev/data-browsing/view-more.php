<?php
session_start();

// get ID sent by GET collection
$logID = $_GET['id'];

// connect to database
include('includes/connection.php');

// include functions file
include('includes/functions.php');

// query the database with client ID
$query = "SELECT * FROM ant_log WHERE id='$logID'";
// $query = "SELECT * FROM ant_log WHERE observe_date='$selected_date'";
$result = mysql_query( $query );

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


// close the mysql connection
mysql_close($conn);

include('includes/header.php');
?>

<h1>Detailed Antenna Log</h1>

<?php echo $alertMessage;
 ?>

<!-- <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $logID; ?>" method="post" class="row" > -->
<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $logID; ?>" method="post" class="row">
    <div class="col-sm-12">

            <div class="pull-right">
                <a href="view-only.php" type="button" class="btn btn-lg btn-primary"><i class="fa fa-undo" aria-hidden="true"></i> Return</a>
            </div>
        
    </div>
</form>
    <hr>
    <h1>&nbsp;</h1>
    
    <div class = "well col-sm-12" align = "justify">
        <div class="col-sm-12">
            <h4><strong>Observing Date: </strong><?php echo $observe_date; ?></h4>
        </div>

        <div class="col-sm-12">
            <h4><strong>Tohban Name: </strong><?php echo $tohban_name; ?></h4>
        </div>

        <div class="col-sm-12">
            <h4><strong>Antennas out of Array: </strong><?php 
                for ($i=0; $i<count($antArray); $i++) {
                    if ($antArray[$i] == 1) {
                        echo $antName[$i]."&nbsp;";
                    } 
                }
            ?></h4>
        </div>

        <div class="col-sm-12">
            <h4><strong>Error: </strong><?php echo $error; ?></h4>
        </div>

        <div class="col-sm-12">
            <h4><strong>Solution: </strong><?php echo $solution; ?></h4>
        </div>

        <div class="col-sm-12">
            <h4><strong>Flare/Note: </strong><?php echo $flare_note; ?></h4>
        </div>

    </div>
<!-- </form> -->

<?php
include('includes/footer.php');
?>

