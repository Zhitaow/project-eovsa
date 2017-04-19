<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EOVSA data archive - Flare Monitor</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/mycustom.css">

    <!-- Custom CSS -->
    <!--formden.js communicates with FormDen server to validate fields and submit via AJAX -->
    <script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>

    <!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

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
        function listFolderFiles($dir, $substr){
            $ffs = scandir($dir);
            $arr=array();
            // echo '<ol>';
            foreach($ffs as $ff){
                if($ff != '.' && $ff != '..'){
                    if (strpos($ff, '.png') !== false && strpos($ff, $substr) !== false) {
                        array_push($arr, "$dir/$ff");
                    }
                    // echo "$dir/$ff<br>";
                     if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
                }
            }
            return $arr;
        }


        if(isset($_POST["submit"])) {
            function reformDate($formDate) {
                $formDate = trim(stripcslashes(htmlspecialchars($formDate)));
                $MM = substr( $formDate,0,2);
                $DD = substr( $formDate,3,2);
                $YYYY = substr( $formDate,6,4);
                // echo $YYYY.$MM.$DD;
                return $YYYY.$MM.$DD;
            }            

            if(!$_POST["date"]) {
                $dateError = "Please enter a valid date. <br>";
            } else {
                $selected_date = reformDate($_POST["date"]);
            }
        } 

        $FLMList = listFolderFiles('data', 'FLM');
        $XSPList = listFolderFiles('data', 'XSP');

        // $isFound = false;

        $datePrefix = date('Ymd',strtotime($datePicker) - 10800.);
        // $todayFLM  = 'http://ovsa.njit.edu/flaremon/FLM'.date('Ymd',strtotime("now") - 10800.).'.png';

        // foreach($FLMList as $ff) {
        //         echo "$ff<br>";
        // }
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
                        <a href="flaremon.php">Data Archive</a>
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
            <a  href="#tab1" data-toggle="tab">Total-Power Light Curve</a>
          </li>
          <li>
            <a href="#tab2" data-toggle="tab">Cross-Power Dynamic Spectrum</a>
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
                                   <div class="col-md-12 col-sm-4 col-xs-6">
                                        <!-- Form code begins -->
                                        <!-- start date -->
                                        <form class="form-inline" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <!-- start date -->
                                            <div class="form-group"> <!-- Date input -->
                                                <!-- <div class = "col-lg-4" align = "center"> -->
                                                    <label class="control-label" for="date">Date</label>
                                                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"  data-date = ""/>
                                                        <!-- <?php echo (isset($_POST["submit"])) ? "data-date='" . $_POST["date"] . "'" : ""; ?> /> -->
                                                    
                                                    <button class="btn btn-primary " name="submit" type="submit">Submit</button>
                                                <!-- </div> -->
                                            </div>
                                            
                                            <!-- submit -->
                                            <div class="form-group"> <!-- Submit button -->
                                                <!-- <div class = "col-lg-4" align = "center"> -->
                                                    <!-- <label ></label> -->
                                                    <!-- <button class="btn btn-primary " name="submit" type="submit">Submit</button> -->
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
                    <h1 class="page-header">Total-Power Light Curve
                        <!-- <small>Most rencent status</small> -->
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <?php 
                $isFound = false;
                if(isset($_POST["submit"])) {
                    // echo "<h4> your date </h4>";
                     // echo $_POST["date"]."<br>";
                     // echo "new Date()";
                     // echo strtotime("now");
                     // echo "$isFound";
                    foreach ($FLMList as $FLM) {
                        if (strpos($FLM, $selected_date) !== false) {
                        // if ($FLM.Contains($date)) {
                            echo "
                                <div class=\"row\">
                                    <div class=\"col-md-12 portfolio-item\" align = \"center\">
                                        <p>&nbsp;</p>
                                        <h3>
                                            <a href=\"$FLM;\">".$FLM."</a>
                                        </h3>
                                        <a href=\"$FLM\">
                                            <img class=\"img-responsive\" src=\"$FLM\" alt=\"data not available\" onerror=\"this.onerror=null;this.src='img/landingPage/no_data.jpg';\">
                                        </a>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                ";
                            $isFound = true;
                        }
                    }
                    // echo $isFound;
                    if ($isFound == false) {
                        echo "
                                <div class=\"row\">
                                    <div class=\"col-md-12 portfolio-item\" align = \"center\">
                                        <p>&nbsp;</p>
                                        <h3>
                                            <a href=\"$FLM;\">".$_POST["date"]."</a>
                                        </h3>
                                        <a href=\"$FLM\">
                                            <img class=\"img-responsive\" src='img/landingPage/no_data.jpg' alt=\"data not available\">
                                        </a>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                 ";
                    }
                }
            ?>
            <!-- /.row -->

          </div>
          <div class="tab-pane" id="tab2">
            <!-- <hr> -->
            <!-- Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cross-Power Dynamic Spectrum
                        <!-- <small>Most rencent status</small> -->
                    </h1>
                </div>
            </div>

            <!-- /.row -->
            <?php 
                $isFound = false;
                if(isset($_POST["submit"])) {
                    // echo "<h4> your date </h4>";
                    // echo "$date <br>";
                    foreach ($XSPList as $XSP) {
                        if (strpos($XSP, $selected_date) !== false) {
                    
                            echo "
                                <div class=\"row\">
                                    <div class=\"col-md-12 portfolio-item\" align = \"center\">
                                        <p>&nbsp;</p>
                                        <h3>
                                            <a href=\"$XSP;\">".$XSP."</a>
                                        </h3>
                                        <a href=\"$XSP\">
                                            <img class=\"img-responsive\" src=\"$XSP\" alt=\"data not available\" onerror=\"this.onerror=null;this.src='img/landingPage/no_data.jpg';\">
                                        </a>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                ";
                            $isFound = true;
                        }
                    }
                    if ($isFound == false) {
                        echo "
                                <div class=\"row\">
                                    <div class=\"col-md-12 portfolio-item\" align = \"center\">
                                        <p>&nbsp;</p>
                                        <h3>
                                            <a href=\"$XSP;\">".$_POST["date"]."</a>
                                        </h3>
                                        <a href=\"$XSP\">
                                            <img class=\"img-responsive\" src='img/landingPage/no_data.jpg' alt=\"data not available\">
                                        </a>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                 ";
                    }
                }
            ?>

            <!-- /.row -->
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
<!--         <span id="top-link-block" align = "center">
            <a href="#top" class="well well"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                <i class="fa fa-angle-double-up fa-2x"></i>
            </a>
        </span><!-- /top-link-block --> -->
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


    <!-- Extra JavaScript/CSS added manually in "Settings" tab -->
    <!-- Include jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->

    <!-- src: https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js -->
    <script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
    <!-- src: https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css -->
    <link rel="stylesheet" href="css/bootstrap-datepicker3.css"/>

    <script>
        $(document).ready(function(){
            var date_input=$('input[name="date"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            });
            date_input.datepicker(
                'setDate', <?php if(isset($_POST["date"])) {echo "new Date(".substr($_POST["date"],6,4).",".substr((string)intval($_POST["date"])-1,0,2).",".substr($_POST["date"],3,2).")";} else {echo "new Date()";} ?>

                
            );
        })
    </script>


</body>

</html>
