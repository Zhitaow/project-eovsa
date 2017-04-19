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




        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#show-option" ).tooltip({
      show: {
        effect: "slideDown",
        delay: 250
      }
    });
  });
  </script>
<link href="styles/EOVSA_main.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


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
                        <a href="404.html">Data Archive</a>
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
<!--         <ul  class="nav nav-pills">
          <li class="active">
            <a  href="#tab1" data-toggle="tab">Observing Status</a>
          </li>
          <li>
            <a href="#tab2" data-toggle="tab">Antenna Status</a>
          </li>
        </ul> -->

<!--         <div class="tab-content clearfix">
          <div class="tab-pane active" id="tab1">
            


          </div>
          <div class="tab-pane" id="tab2">
            
          </div>
        </div> -->
<div id="container">

<div id="rest_of_page">
  <!-- Change below here to change the contents of the page -->
  <div id="content_column">

  <table id="antenna_table" width="790">

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




 <!--        <hr>


        <hr> -->

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
                <div class="col-lg-9 col-md-6" align = "right">
                        <a align = "right" href="http://www.reliablecounter.com" target="_blank"><img src="http://www.reliablecounter.com/count.php?page=ovsa.njit.edu/dev/index.html&digit=style/plain/6/&reloads=1" alt="" title="" border="0"></a><br /><a href="http://www.curinglight.com" target="_blank" style="font-family: Geneva, Arial; font-size: 9px; color: #330010; text-decoration: none;">Link</a><p>Total Vistors</p>
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

</body>

</html>
