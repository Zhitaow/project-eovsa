<?php
session_start();

// connect to database
include('includes/connection.php');
include('includes/functions.php');
// query & result
// show recent top 10 logs for the first time visit
$query = "SELECT * FROM ant_log ORDER BY observe_date DESC LIMIT 10";
$result = mysql_query($query );

// check for query string
if( isset( $_GET['alert'] ) ) {
    
    // new client added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New Log added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    // client updated
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Log updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
    // client deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Log deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
      
}

if(isset($_GET['date'])) {
    $start_date = (string) $_GET["date"];
}

if(isset($_GET['total_day'])) {
    $total_day = $_GET["total_day"];
}

if(isset($_GET['query']) && $start_date && $total_day) {
    $inc = '+'.(string)$total_day;
    $end_date=addDayswithdate($start_date,$total_day);
    $query = "SELECT * FROM ant_log WHERE observe_date >= '".$start_date."' AND observe_date <= '".$end_date."' ORDER BY observe_date DESC";
    $result = mysql_query($query );
}

// close the mysql connection
mysql_close($conn);

include('includes/header.php');
?>

<h1>Observing Logs</h1>
<hr>
<div class="row">
    <div class="col-sm-8" align = "right">
        <!-- <hr> -->
        <form class="form-inline" role="search" align = "right" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <!-- <div class="form-group form-inline col-sm-6"> -->
                <!-- <label for="tohban-date">Observing Date</label> -->
                <!-- <label class="control-label" for="date">Starting Date</label> -->
                <label for="start-date">Start Date</label>
                <input type="text" class="form-control input-md" id="start-date" placeholder="YYYY-MM-DD" name="date" value="<?php echo $start_date; ?>">
                <label for="sel1"> Show</label>
                  <select class="form-control" name="total_day" id="sel1">
                    <option <?php echo $total_day == "10 days" ? 'selected' : '' ?> >10 days</option>
                    <option <?php echo $total_day == "30 days" ? 'selected' : '' ?>>30 days</option>
                    <option <?php echo $total_day == "50 days" ? 'selected' : '' ?>>50 days</option>
                    <option <?php echo $total_day == "100 days" ? 'selected' : '' ?>>100 days</option>
                    <!-- <option>40</option> -->
                  </select>
                <button class="btn btn-primary " name="query" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            <!-- </div> -->
        </form>
        <!-- <hr> -->
    </div>
</div>
<hr>
<div class = "row"> <!--<div class = "table-responsive"> use horizontal bar to display--> 
<div class = "col-sm-12" align = "center">
    <?php if($start_date && $end_date) {echo "<sm>Showing logs from <strong>".$start_date."</strong> to <strong>".$end_date."</strong></sm>";} ?>
    <table class="table table-striped table-hover table-bordered table-condensed table-scrollable">
        <!-- <tr>
            <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="fa fa-plus"></span> Add Log</a></div></td>
        </tr>
        <tr> -->
        <!-- <div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="fa fa-plus"></span> Add Log</a></div> -->
            <th>View More</th>
            <th>Observing Date</th>
            <th>Total Online Antennas</th>
            <th>Flare Status</th>
            <th>Flare Note</th>
            <th>Antenna Error</th>
            <th>Tohban Name</th>
            <th>Entry Time</th>
        </tr>
        
        <?php
        
        if( mysql_num_rows($result) > 0 ) {
            
            // we have data!
            // output the data
            
            while( $row = mysql_fetch_assoc($result) ) {
                echo "<tr>";

                echo '<td><a href="flaremon.php?date=' . $row['observe_date'] . '&search=" target="_blank" type="button" class="btn btn-warning btn-sm">
                        <span class="fa fa-search-plus"></span>
                        </a></td>';
                
                echo "<td>" .$row['observe_date']. "</td><td>" .$row['ant_num']. "</td><td>" . "</td><td>" .$row['flare_note']. "</td><td>" .$row['error']. "</td><td>" .$row['tohban_name']. "</td><td>" .$row['entry_time']. "</td>";
                
                echo "</tr>";
            }
        } else { // if no entries
            echo "<div class='alert alert-warning'>No Record Found.</div>";
        }

        mysql_close($conn);

        ?>
    </table>
</div>
</div>
<?php echo $alertMessage; ?>
<!-- <i class="fa fa-plus" aria-hidden="true"></i> -->
<?php
include('includes/footer.php');
?>