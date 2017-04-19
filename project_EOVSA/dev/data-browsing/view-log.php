<?php
session_start();
// if result is returned
if( mysql_num_rows($logfile) > 0 ) {
    
    // we have data!
    // set some variables
    while( $row = mysql_fetch_assoc($logfile) ) {
        $antArray = array($row['ant01'],$row['ant02'],$row['ant03'],$row['ant04'],$row['ant05'],$row['ant06'],$row['ant07'],$row['ant08'],
            $row['ant09'],$row['ant10'],$row['ant11'],$row['ant12'],$row['ant13'],$row['ant14']);

        $antName = array('ant01','ant02','ant03','ant04','ant05','ant06','ant07','ant08','ant09','ant10','ant11','ant12','ant13','ant14');
        $entry_time = $row['entry_time'];
        $error = $row['error'];
        $error = str_replace("\n", "<br/>", $error);
        $flare_note = $row['flare_note'];
        $flare_note = str_replace("\n", "<br/>", $flare_note);
        $observe_date = $row['observe_date'];
        $solution = $row['solution'];
        $solution = str_replace("\n", "<br/>", $solution);
        $tohban_name = $row['tohban_name'];

    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>No information. <a href='clients.php'>Go back</a>.</div>";
}

?>

<h1>Detailed Antenna Log</h1>

<?php echo $alertMessage;?>

     <div class = "well col-sm-12" align = "left">
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
            <h4><strong>Error:</strong><br><?php echo $error; ?></h4>
        </div>

        <div class="col-sm-12">
            <h4><strong>Solution: </strong><br><?php echo $solution; ?></h4>
        </div>

        <div class="col-sm-12">
            <h4><strong>Flare/Note: </strong><br><?php echo $flare_note; ?></h4>
        </div>

    </div>