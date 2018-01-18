




<html>
<head>
    <script src="js/jquery-3.2.0.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="js/bootstrap.min.js"></script>
    <style>
        .nav {
            left:50%;
            margin-left:-150px;
            top:30px;
            position:absolute;
        }
        .nav>li>a:hover, .nav>li>a:focus, .nav .open>a, .nav .open>a:hover, .nav .open>a:focus {
            background:#fff;
        }
        .dropdown {
            background:#fff;
            border:1px solid #ccc;
            border-radius:4px;
            width:300px;
        }
        .dropdown-menu>li>a {
            color:#428bca;
        }
        .dropdown ul.dropdown-menu {
            border-radius:4px;
            box-shadow:none;
            margin-top:20px;
            width:300px;
        }
        .dropdown ul.dropdown-menu:before {
            content: "";
            border-bottom: 10px solid #fff;
            border-right: 10px solid transparent;
            border-left: 10px solid transparent;
            position: absolute;
            top: -10px;
            right: 16px;
            z-index: 10;
        }
        .dropdown ul.dropdown-menu:after {
            content: "";
            border-bottom: 12px solid #ccc;
            border-right: 12px solid transparent;
            border-left: 12px solid transparent;
            position: absolute;
            top: -12px;
            right: 14px;
            z-index: 9;
        }
    </style>
</head>
<body>
<ul class="nav navbar-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Select an level <span class="glyphicon glyphicon-user pull-right"></span></a>
        <ul class="dropdown-menu">
            <li><a href="geojson_test_adm_0.php">Mozambique <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
            <li class="divider"></li>
            <li><a href="geojson_test_adm_1.php">Province<span class="glyphicon glyphicon-stats pull-right"></span></a></li>
            <li class="divider"></li>
            <li><a href="geojson_test_adm_2.php">District <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
            <li class="divider"></li>
            <li><a href="geojson_test_adm_3.php">community <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
            <li class="divider"></li>
        </ul>
    </li>
</ul>
</body>
</html>