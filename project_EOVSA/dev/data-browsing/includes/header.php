<!DOCTYPE html>

<html>

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EOVSA antenna logs</title>

            <!-- Bootstrap CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/bootstrap-datepicker3.css"/>
        <!-- Custom CSS -->
        <link href="../css/modern-business.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="../css/mycustom.css">
        <!-- Custom Fonts -->
        <link href="../font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <!-- <body style="padding-top: 60px; background: url('https://cdn.eso.org/images/wallpaper5/alma-jfs-2010-10.jpg'); background-size:cover;">    -->
    <body style="padding-top: 60px;">   
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- <div class = "wrapper"> -->
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.html"><i class="fa fa-home"></i> Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">About EOVSA<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="../science.html">Science</a>
                            </li>
                            <li>
                                <a href="../hardware.html">Advanced Technology</a>
                            </li>
                            <li>
                                <a href="../instrument.html">Instrument Specification</a>
                            </li>
                            <li>
                                <a href="../progress.html">Construction Progress</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    if($_SESSION['loggedInUser']) {
                        echo "<li class=\"dropdown\">
                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Data Archive<b class=\"caret\"></b></a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a href=\"clients.php\">Antenna Logs</a></li>
                                        <li><a href=\"add.php\">Add Log</a></li>
                                    </ul>
                                </a>
                              </li>";
                    } else {
                        echo "<li>
                                <a href=\"http://ovsa.njit.edu/dev/data-browsing/\">Data Archive</a>
                            </li>";
                    }
                    ?>
                    <li>
                        <a href="../status.php#">Observing Status</a>
                    </li>
                    <li>
                        <a href="http://www.ovsa.njit.edu/wiki/index.php/Expanded_Owens_Valley_Solar_Array">Documentation</a>
                    </li>
                    <li>
                        <a href="../people.html">Our People</a>
                    </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="https://github.com/dgary50/eovsa"><i class="fa fa-github" aria-hidden="true"></i> EOVSA github</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        // if( $_SESSION['loggedInUser'] ) {
                        //     echo "  <li><a href=\"clients.php\">Antenna Logs</a></li>
                        //             <li><a href=\"add.php\">Add Log</a></li>
                        //         ";
                        // }
                    ?>
                </ul>
                <?php
                    if ($_SESSION['loggedInUser']) {
                    echo "<ul class=\"nav navbar-nav navbar-right\">
                        <p class=\"navbar-text\">Welcome, ".$_SESSION['loggedInUser']."</p>
                            <li>
                                <form action = 'logout.php' method=\"POST\">
                                    <div align = 'left' style = 'text-align: left;'>
                                    <button class=\"btn btn-danger navbar-btn\" name=\"logout\" type=\"submit\"><i class='fa fa-power-off' aria-hidden='true'></i> Logout</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        ?>";
                    } else {
                        echo "
                        <ul class=\"nav navbar-nav navbar-right\">
                            <li>
                                <form action = 'index.php'>
                                    <div align = 'left' style = 'text-align: left;'>
                                    <button class=\"btn btn-success navbar-btn\"  type=\"submit\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        ";
                    }
                ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container" align = "center">

    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/custom.js"></script>