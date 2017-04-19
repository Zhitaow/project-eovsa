<?php
session_start();

// connect to database
include('includes/connection.php');
include('includes/functions.php');

if(isset($_GET["search"])) {
    if(!isset($_GET["date"])) {
        $dateError = "Please enter a valid date. <br>";
    } else {
        $selected_date = (string) $_GET["date"];
        $query = "SELECT * FROM flm_list WHERE date='$selected_date'";
        $FLMList = mysql_query($query );
        $query = "SELECT * FROM xsp_list WHERE date='$selected_date' ORDER BY date_time";
        $XSPList = mysql_query($query );
        $query = "SELECT * FROM ant_log WHERE observe_date='$selected_date'";
        $logfile = mysql_query($query );
    }
} 

// close the mysql connection
mysql_close($conn);

include('includes/header.php');
?>
        <ul  class="nav nav-pills" data-tab id ="myTab">
          <li class="active">
            <a  href="#tab1" data-toggle="tab">Dynamic Spectrum</a>
          </li>
          <li>
            <a href="#tab2" data-toggle="tab">Tohban Log</a>
          </li>
        </ul>
        <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">
                        <div class="container">
                            <!-- start date -->
                            <div class="row">
                                <div class="bootstrap-iso">
                                 <div class="container-fluid">
                                   <div class="col-lg-12 col-sm-4 col-xs-6">
                                        <!-- Form code begins -->
                                        <!-- start date -->
                                        <form class="form-inline" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                                            <!-- start date -->
                                            <div class="form-group"> <!-- Date input -->
                                                    <label class="control-label" for="date">Date</label>
                                                    <input class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" type="text"  data-date = "" value="<?php echo $selected_date; ?>"/>
                                                    <button class="btn btn-primary " name="search" type="submit">Search</button>
                                                <!-- </div> -->
                                            </div>
                                        </form>
                                         <!-- Form code ends --> 
                                  </div>    
                                 </div>
                                </div>
                            <!-- start date -->
                            </div>
                        </div>

                    </h4>
                </div>
            </div>
        <div class="tab-content clearfix">
          <div class="tab-pane active" id="tab1">
           <!-- Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dynamic Spectrum
                        <!-- <small>Most rencent status</small> -->
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <?php
                if( mysql_num_rows($FLMList) > 0 ) {
                    // we have data!
                    // output the data
                    while( $row = mysql_fetch_assoc($FLMList) ) {
                        echo "
                                <div class=\"row\">
                                    <div class=\"col-md-12 portfolio-item\" align = \"center\">
                                        <p>&nbsp;</p>
                                        <h3>
                                            <a href=\"".$row['path']."\">".$row['date']."</a>
                                        </h3>
                                        <a href=\"".$row['path']."\">
                                            <img class=\"img-responsive\" src=\"".$row['path']."\" alt=\"data not available\" onerror=\"this.onerror=null;this.src='img/landingPage/no_data.jpg';\">
                                        </a>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                ";
                    }
                } else { // if no entries
                    echo "
                                <div class=\"row\">
                                    <div class=\"col-md-12 portfolio-item\" align = \"center\">
                                        <p>&nbsp;</p>
                                        <h3>
                                            <a href=\"\">".$_GET["date"]."</a>
                                        </h3>
                                        <a href=\"$FLM\">
                                            <img class=\"img-responsive\" src='../img/landingPage/no_data.jpg' alt=\"data not available\">
                                        </a>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                 ";
                }

                if( mysql_num_rows($XSPList) > 0 ) {
                    // we have data!
                    // output the data
                    while( $row = mysql_fetch_assoc($XSPList) ) {
                        echo "
                                <div class=\"row\">
                                    <div class=\"col-md-12 portfolio-item\" align = \"center\">
                                        <p>&nbsp;</p>
                                        <h3>
                                            <a href=\"".$row['path']."\"> Start Time ".$row['date_time']."</a>
                                        </h3>
                                        <a href=\"".$row['path']."\">
                                            <img class=\"img-responsive\" src=\"".$row['path']."\" alt=\"data not available\" onerror=\"this.onerror=null;this.src='img/landingPage/no_data.jpg';\">
                                        </a>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                ";
                    }
                } else { // if no entries
                    echo "
                                <div class=\"row\">
                                    <div class=\"col-md-12 portfolio-item\" align = \"center\">
                                        <p>&nbsp;</p>
                                        <h3>
                                            <a href=\"\">".$_GET["date"]."</a>
                                        </h3>
                                        <a href=\"$FLM\">
                                            <img class=\"img-responsive\" src='../img/landingPage/no_data.jpg' alt=\"data not available\">
                                        </a>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                 ";
                }
            // }

            ?>

            <!-- /.row -->

          </div>
          <div class="tab-pane" id="tab2">
            <?php 
                include('view-log.php');
            ?>
          </div>
        </div>

        <!-- <hr> -->

        <!-- Footer -->
<?php
include('includes/footer.php');
?>
<!-- Script to Keep Current Tab after refresh -->
    <script>
      $(function() { 
          // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
          $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
              // save the latest tab; use cookies if you like 'em better:
              localStorage.setItem('lastTab', $(this).attr('href'));
          });

          // go to the latest tab, if it exists:
          var lastTab = localStorage.getItem('lastTab');
          if (lastTab) {
              $('[href="' + lastTab + '"]').tab('show');
          }
      });
    </script>
    <!-- /.container -->

