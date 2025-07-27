<?php
session_start();
if(!isset($_SESSION['chairman_id']))
{
    header("location: ../index.php");
    exit;
} 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../Libraries/bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Libraries/bootstrap-5.2.0/js/bootstrap.min.js">
    <script type="text/javascript" src="../Libraries/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Libraries/fontawesome-6.1.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="../stylesheet/sidebar.css">

    <link rel="icon" type="image/x-icon" href="../images/psna_logo.png">
    <title>Criteria - 3</title>
</head>
<style type="text/css">
    #btnas
    {
        height: 120px;
        width: 230px;
        font-size: 25px;
        padding-top: 36px;
    }
    #faicon
    {
        opacity: 0.4;
        float:left;
        padding-top: 5px;
        color: white;
    }
    #aqar_button
    {
        position: absolute;
        transform: translate(-60%,0%);
        color: white;
    }

    #benchmark_button
    {
        position: absolute;
        transform: translate(-68%,-20%);
        color: white;
    }
</style>
<body>

    <!-- Header -->
    <?php
      require 'header.php';
    ?>
    <!-- Header End -->

    <!-- Side Bar -->

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- col-auto -->
            <div class="bg-color col-md-2 min-vh-100">
                <div class="bg-color">
                    <br>

                    <!-- Menu -->
                    
                       <div class="menu-bar">
                           <?php
                                require 'side_bar.php';
                            ?>
                        </div>
                
                    <!-- Menu End -->

                </div>
            </div>
            <div class="col py-3">

                <!-- Breadcrumb -->

                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php" style="text-decoration: none;">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Criteria - III</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-scale-balanced fa-lg"></i>
                            <span>Criterion III – Research, Innovations and Extension.</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class="card-body">
                            <a  class="btn btn-success btn-lg" href="cri_3_aqar_report.php" role="button" id="btnas" name="addfaculty"><i class="fa-solid fa-square-poll-vertical fa-3x" id="faicon"></i>&nbsp;<spam id="aqar_button">AQAR Report</spam></a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a  class="btn btn-danger btn-lg" href="cri_3_benchmark_report.php" role="button" id="btnas" name="addfaculty"><i class="fa-solid fa-pen-to-square fa-3x" id="faicon"></i>&nbsp;<spam id="benchmark_button">Benchmark<br>Report</spam></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Side Bar End -->

    <!-- Footer -->
    <?php
        require 'footer.php';
    ?>
    <!-- Fotter End -->

</body>
</html>