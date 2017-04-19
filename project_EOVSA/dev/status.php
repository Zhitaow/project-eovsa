<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <!-- refresh every 60 second -->
    <meta http-equiv="refresh" content="60">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EOVSA - Observing Status</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/mycustom.css">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Get flare monitor filenames for "today" (displayed until 
   0300 UT) and for "yesterday" -->
    <?php
     $todayFLM  = 'http://ovsa.njit.edu/flaremon/FLM'.date('Ymd',strtotime("now") - 10800.).'.png';
     $yesterdayFLM = 'http://ovsa.njit.edu/flaremon/FLM'.date('Ymd',  strtotime("now") - 97200.).'.png'; 
     $latestXSP = 'http://ovsa.njit.edu/flaremon/XSP_latest.png'; 
     $laterXSP = 'http://ovsa.njit.edu/flaremon/XSP_later.png'; 
    exec('wget -O /common/webplots/flaremon/snap.jpg "http://192.168.24.142:7777/media/?action=snapshot&user=dgary&pwd=snap4me"');
    ?>
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- <div class = "wrapper"> -->
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><i class="fa fa-home"></i> Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">About EOVSA<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="science.html">Science</a>
                            </li>
                            <li>
                                <a href="hardware.html">Advanced Technology</a>
                            </li>
                            <li>
                                <a href="instrument.html">Instrument Specification</a>
                            </li>
                            <li>
                                <a href="progress.html">Construction Progress</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="http://ovsa.njit.edu/dev/data-browsing/">Data Archive</a>
                    </li>
                    <li>
                        <a href="status.php#">Observing Status</a>
                        <!-- <a href="http://ovsa.njit.edu/EOVSA/status.php#">Observing Status</a> -->
                    </li>
                    <li>
                        <a href="http://www.ovsa.njit.edu/wiki/index.php/Expanded_Owens_Valley_Solar_Array">Documentation</a>
                    </li>
                    <li>
                        <a href="people.html">Our People</a>
                    </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="https://github.com/dgary50/eovsa"><i class="fa fa-github" aria-hidden="true"></i> EOVSA github</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <ul  class="nav nav-pills" data-tab id ="myTab">
          <li class="active">
            <a  href="#tab1" data-toggle="tab">Observing Status</a>
          </li>
          <li>
            <a href="#tab2" data-toggle="tab">Antenna Status</a>
          </li>
        </ul>

        <div class="tab-content clearfix">
          <div class="tab-pane active" id="tab1">
            
           <!-- Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Most recent status
                        <!-- <small>Most rencent status</small> -->
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6 portfolio-item" align = "center">
                    <p>&nbsp;</p>
                    <h3>
                        <a href="<?php echo $todayFLM;?>">EOVSA's cross-power light curve</a>
                    </h3>
                    <p>&nbsp;</p>
                    <a href="<?php echo $todayFLM;?>">
                        <img class="img-responsive"  src="<?php echo $todayFLM;?>" alt="data not available" onerror="this.onerror=null;this.src='img/landingPage/no_data.jpg';">
                    </a>
                    <p>&nbsp;</p>
                </div>
                <div class="col-md-6 portfolio-item" align = "center">
                    <p>&nbsp;</p>
                    <h3>
                        <a href="<?php echo $latestXSP;?>">EOVSA Solar Dynamic Spectrogram</a>
                    </h3>
                    <a href="<?php echo $latestXSP;?>">
                        <img class="img-responsive" src="<?php echo $latestXSP;?>" alt="data not available" onerror="this.onerror=null;this.src='img/landingPage/no_data.jpg';">
                    </a>
                    <p>&nbsp;</p>
                </div>
            </div>
            <!-- Projects Row -->
            <div class="row">
                <div class="col-md-6 portfolio-item" align = "center">
                    <h3>
                        <a href="http://services.swpc.noaa.gov/images/goes-xray-flux-6-hour.gif">6-hour GOES light curves</a>
                    </h3>
                    <a href="http://services.swpc.noaa.gov/images/goes-xray-flux-6-hour.gif">
                        <img class="img-responsive" src="http://services.swpc.noaa.gov/images/goes-xray-flux-6-hour.gif" alt="data not available" onerror="this.onerror=null;this.src='img/landingPage/no_data.jpg';" max-width="100%" max-height = "400px" width = "auto" height= "auto">
                    </a>
                    <p>&nbsp;</p>
                </div>
                <div class="col-md-6 portfolio-item" align = "center">
                    <h3>
                        <a href="http://Helioviewer.org/">SDO AIA 171</a>
                    </h3>
                    <a href="http://Helioviewer.org/">
                        <img align = "center" class="img-responsive" src="https://api.helioviewer.org/v2/takeScreenshot/?imageScale=5&layers=[SDO,AIA,AIA,171,1,100]&scaleX=0&scaleY=0&date=2999-01-01T23:59:59Z&x1=-1650&x2=1650&y1=-1228.8&y2=1228.8&display=true" alt="data not available" onerror="this.onerror=null;this.src='img/landingPage/no_data.jpg';">
                    </a>
                    <p>&nbsp;</p>
                </div>
            </div>
            <!-- /.row -->

            <!-- Projects Row -->
            <div class="row">
                <div class="col-md-6 portfolio-item" align = "center">
                    <p>&nbsp;</p>
                    <h3>
                        <a href="http://services.swpc.noaa.gov/images/goes-xray-flux.gif">3-day GOES light curves</a>
                    </h3>
                    <a href="http://services.swpc.noaa.gov/images/goes-xray-flux.gif">
                        <img class="img-responsive" src="http://services.swpc.noaa.gov/images/goes-xray-flux.gif" alt="data not available" onerror="this.onerror=null;this.src='img/landingPage/no_data.jpg';" max-width="100%" max-height = "400px" width = "auto" height= "auto">
                    </a>
                    <p>&nbsp;</p>
                </div>
                <div class="col-md-6 portfolio-item" align = "center">
                    <p>&nbsp;</p>
                    <h3>
                        <a href="http://ovsa.njit.edu/flaremon/snap.jpg">Current Webcam Image</a>
                    </h3>
                    <a href="http://ovsa.njit.edu/flaremon/snap.jpg">
                        <img class="img-responsive" src="http://ovsa.njit.edu/flaremon/snap.jpg" alt="data not available" onerror="this.onerror=null;this.src='img/landingPage/no_data.jpg';">
                    </a>
                    <p>&nbsp;</p>
                </div>
            </div>
            <!-- /.row -->

           <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Previous Status
                        <!-- <small>previous status</small> -->
                    </h1>
                </div>
            </div>

            <!-- Projects Row -->
            <div class="row">
                 <div class="col-md-6 portfolio-item" align = "center">
                    <h3>
                        <a href="<?php echo $yesterdayFLM;?>">Yesterday's cross-power light curve</a>
                    </h3>
                    <p>&nbsp;</p>
                    <a href="<?php echo $yesterdayFLM;?>">
                        <img class="img-responsive" src="<?php echo $yesterdayFLM;?>" alt="data not available" onerror="this.onerror=null;this.src='img/landingPage/no_data.jpg';">
                    </a>
                    <p>&nbsp;</p>
                </div>
                <div class="col-md-6 portfolio-item" align = "center">
                    <h3>
                        <a href="<?php echo $laterXSP;?>">Overview of Solar Dynamic Spectrogram</a>
                    </h3>
                    <a href="<?php echo $laterXSP;?>">
                        <img class="img-responsive" src="<?php echo $laterXSP;?>" alt="data not available" onerror="this.onerror=null;this.src='img/landingPage/no_data.jpg';">
                    </a>
                    <p>&nbsp;</p>
                </div>
            </div>
            <!-- /.row -->

          </div>
          <div class="tab-pane" id="tab2">
            <hr>
            <div class = "table-responsive">
              <table id="antenna_table" class="table table-striped" width="790">
                <?php
                      $status = array('oper' => 'Operational','rep' => 'Under Repair','oos' => 'Out of Service');
                      $color = array('oper' => 'color="#00aa00"','rep' => 'style="BACKGROUND-COLOR:#ffff00"', 'oos' => 'style="BACKGROUND-COLOR:#ff0000" color="#ffffff"');
                      require_once('mysql_connect.php');
                      // Headings
                      echo('<tr><th width="30" scope="col">Ant</th>');
                      echo('<th width="100" scope="col">Aux Box</th>');
                      echo('<th width="100" scope="col">Controller</th>');
                      echo('<th width="100" scope="col">Antenna</th>');
                      echo('<th width="100" scope="col">FE Module</th>');
                      echo('<th width="100" scope="col">DC Module</th>');
                      echo('<th width="150" scope="col">Last Update</th></tr>');
                      echo('<tr><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td></tr>');
                      // Database row contents
                      for ($x = 0; $x <= 14; $x++) {
                           $query = "select * from status where antnum = ".$x." order by timestamp desc limit 1";
                           $result = @mysql_query($query);
                           while ($row = mysql_fetch_array($result)) {
                           if ($row['valid'] == 1) {
                               echo('<tr><th width="30" scope="col">'.$row['antnum'].'</th>');
                               echo('<th width="75" scope="col"><font '.$color[$row['aux']].'">'.$status[$row['aux']].'</font></th>');
                           echo('<th width="75" scope="col"><div id="show-option" title="'.$row['contreason'].'">
                           <font '.$color[$row['cont']].'>'.$status[$row['cont']].'</font></div></th>');
                           echo('<th width="75" scope="col"><div id="show-option" title="'.$row['antreason'].'">
                           <font '.$color[$row['ant']].'>'.$status[$row['ant']].'</font></div></th>');
                           echo('<th width="75" scope="col"><div id="show-option" title="'.$row['femreason'].'">
                           <font '.$color[$row['fem']].'>'.$status[$row['fem']].'</font></div></th>');
                           echo('<th width="75" scope="col"><div id="show-option" title="'.$row['dcmreason'].'">
                           <font '.$color[$row['dcm']].'>'.$status[$row['dcm']].'</font></div></th>');
                               echo('<th width="150" scope="col">'.$row['timestamp'].'</th></tr>');
                           }
                         }
                      } 
                      mysql_close();
                ?> 
              </table>
            </div>
          </div>
        </div>

        <hr>
        <div class = "well">
            <div class="row">
                <div class="col-lg-12" align ="justify">
                    <small>This material is based upon work supported by the National Science Foundation under Grant Nos. AST-1312802. Any opinions, findings, and conclusions or recommendations expressed in this material are those of the author(s) and do not necessarily reflect the views of the National Science Foundation. Funding is also provided by a NASA Supporting Research & Technology grant NNX14AK66G. </small>
                </div>
            </div>
        </div>

        <!-- Pagination -->
<!--         <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div> -->

        <!-- <hr> -->

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-3">
                    <div class ="row">
                    </div>
                    <div class ="row">
                        <img alt="Brand" src="img/landingPage/brand.jpg">
                        <img alt="nasa" src="img/landingPage/nasa.jpg">
                        <p>Copyright &copy; EOVSA Website 2017</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /back-to-top-link-block -->
        <span id="top-link-block" align = "center">
            <a href="#top" class="well well"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                <i class="fa fa-angle-double-up fa-2x"></i>
            </a>
        </span><!-- /top-link-block -->
    </div>
    <!-- /.container -->
<!-- </div> -->


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/custom.js"></script>
    
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

</body>

</html>
