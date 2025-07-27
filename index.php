<?php

    require 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Login As
        if(empty($_POST["login_as"]))
        {
            echo '<script language="javascript">';
            echo'alert("Please Select Login As."); location.href="index.php"';
            echo '</script>';
        }

        // Email Id
        elseif (empty(trim($_POST["email"]))) 
        {
            echo '<script language="javascript">';
            echo'alert("Please Enter Your Email ID."); location.href="index.php"';
            echo '</script>';
        }
        // Password
        elseif (empty(trim($_POST["password"]))) 
        {
            echo '<script language="javascript">';
            echo'alert("Please Enter Your Password."); location.href="index.php"';
            echo '</script>';
        }
        else
        {
            $login_as = trim($_POST["login_as"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            
            if($login_as == "IQAC Director")
            {
                $query = mysqli_query($con,"SELECT * FROM iqac_director WHERE director_email = '$email'");
                $res = mysqli_fetch_array($query);
                if($res > 0)
                {
                    $hashed_password = $res['director_password'];
                    if(password_verify($password, $hashed_password))
                    {
                        session_start();
                        
                        $_SESSION['dir_id'] = $res['director_id'];
                        $_SESSION['dir_name'] = $res['director_name'];
                        $_SESSION['dir_email'] = $res['director_email']; 
                        header("location: IQAC_Director/dashboard.php");
                    }
                    else
                    {
                        echo '<script language="javascript">';
                        echo'alert("Invalid Email ID or Password."); 
                        location.href="index.php"';
                        echo '</script>';
                    }
                }
                else
                {
                    echo '<script language="javascript">';
                    echo'alert("Invalid Email ID or Password."); 
                    location.href="index.php"';
                    echo '</script>';
                }
            }

            elseif($login_as == "Criterion Head")
            {
                $query = mysqli_query($con,"SELECT * FROM criterion_head WHERE email = '$email'");
                $res = mysqli_fetch_array($query);
                if($res > 0)
                {
                    $hashed_password = $res['password'];
                    if(password_verify($password, $hashed_password))
                    {
                        session_start();
                        
                        $_SESSION['cri_id'] = $res['criterion_id'];
                        $_SESSION['name'] = $res['name'];
                        $_SESSION['email'] = $res['email']; 
                        $_SESSION['criterion'] = $res['criterion'];

                        if($_SESSION['criterion'] == "Criterion - 1")
                        {
                            header("location: Criterion_Head/Criterion_1/dashboard.php");
                        }
                        elseif($_SESSION['criterion'] == "Criterion - 2")
                        {
                            header("location: Criterion_Head/Criterion_2/dashboard.php");
                        } 
                        elseif($_SESSION['criterion'] == "Criterion - 3")
                        {
                            header("location: Criterion_Head/Criterion_3/dashboard.php");
                        }
                        elseif($_SESSION['criterion'] == "Criterion - 4")
                        {
                            header("location: Criterion_Head/Criterion_4/dashboard.php");
                        }
                        elseif($_SESSION['criterion'] == "Criterion - 5")
                        {
                            header("location: Criterion_Head/Criterion_5/dashboard.php");
                        }
                        elseif($_SESSION['criterion'] == "Criterion - 6")
                        {
                            header("location: Criterion_Head/Criterion_6/dashboard.php");
                        }
                        else
                        {
                            header("location: Criterion_Head/Criterion_7/dashboard.php");
                        }  
                           
                    }
                    else
                    {
                        echo '<script language="javascript">';
                        echo'alert("Invalid Email ID or Password."); 
                        location.href="index.php"';
                        echo '</script>';
                    }
                }
                else
                {
                    echo '<script language="javascript">';
                    echo'alert("Invalid Email ID or Password."); 
                    location.href="index.php"';
                    echo '</script>';
                }

            }
            elseif($login_as == "Department Criterion Incharge")
            {
                $query = mysqli_query($con,"SELECT * FROM department_incharge WHERE email = '$email'");
                $res = mysqli_fetch_array($query);
                if($res > 0)
                {
                    $hashed_password = $res['password'];
                    if(password_verify($password, $hashed_password))
                    {
                        session_start();
                        
                        $_SESSION['dci_id'] = $res['id'];
                        $_SESSION['name'] = $res['name'];
                        $_SESSION['email'] = $res['email']; 
                        $_SESSION['criterion'] = $res['criterion'];
                        $_SESSION['department'] = $res['department'];

                        if($_SESSION['criterion'] == "Criterion - 1")
                        {
                            header("location: Department_Incharge/Criterion_1/dashboard.php");
                        }
                        elseif($_SESSION['criterion'] == "Criterion - 2")
                        {
                            header("location: Department_Incharge/Criterion_2/dashboard.php");
                        } 
                        elseif($_SESSION['criterion'] == "Criterion - 3")
                        {
                            header("location: Department_Incharge/Criterion_3/dashboard.php");
                        } 
                           
                    }
                    else
                    {
                        echo '<script language="javascript">';
                        echo'alert("Invalid Email ID or Password."); 
                        location.href="index.php"';
                        echo '</script>';
                    }
                }
                else
                {
                    echo '<script language="javascript">';
                    echo'alert("Invalid Email ID or Password."); 
                    location.href="index.php"';
                    echo '</script>';
                }
            }
            elseif($login_as == "Incharge")
            {
                $query = mysqli_query($con,"SELECT * FROM incharge WHERE email = '$email'");
                $res = mysqli_fetch_array($query);
                if($res > 0)
                {
                    $hashed_password = $res['password'];
                    if(password_verify($password, $hashed_password))
                    {
                        session_start();
                        
                        $_SESSION['inc_id'] = $res['inc_id'];
                        $_SESSION['name'] = $res['name'];
                        $_SESSION['email'] = $res['email']; 
                        $_SESSION['criterion'] = $res['criterion'];

                        if($_SESSION['criterion'] == "Criterion - 4")
                        {
                            header("location: Incharge/Criterion_4/dashboard.php");
                        }
                        // }
                        elseif($_SESSION['criterion'] == "Criterion - 5")
                        {
                            header("location: Incharge/Criterion_5/dashboard.php");
                        }
                        elseif($_SESSION['criterion'] == "Criterion - 6")
                        {
                            header("location: Incharge/Criterion_6/dashboard.php");
                        }
                        else
                        {
                            header("location: Incharge/Criterion_7/dashboard.php");
                        }  
                           
                    }
                    else
                    {
                        echo '<script language="javascript">';
                        echo'alert("Invalid Email ID or Password."); 
                        location.href="index.php"';
                        echo '</script>';
                    }
                }
                else
                {
                    echo '<script language="javascript">';
                    echo'alert("Invalid Email ID or Password."); 
                    location.href="index.php"';
                    echo '</script>';
                }
            }
            else
            {
                $query = mysqli_query($con,"SELECT * FROM iqac_chairman WHERE chairman_email = '$email'");
                $res = mysqli_fetch_array($query);
                if($res > 0)
                {
                    $hashed_password = $res['chairman_password'];
                    if(password_verify($password, $hashed_password))
                    {
                        session_start();
                        
                        $_SESSION['chairman_id'] = $res['chairman_id'];
                        $_SESSION['chairman_name'] = $res['chairman_name'];
                        $_SESSION['chairman_email'] = $res['chairman_email']; 
                        header("location: Chairman/dashboard.php");
                    }
                    else
                    {
                        echo '<script language="javascript">';
                        echo'alert("Invalid Email ID or Password."); 
                        location.href="index.php"';
                        echo '</script>';
                    }
                }
                else
                {
                    echo '<script language="javascript">';
                    echo'alert("Invalid Email ID or Password."); 
                    location.href="index.php"';
                    echo '</script>';
                }
            }
        }
        mysqli_close($con);
    }

?>
<!DOCTYPE html>
<html>
<head> 
    <link rel="stylesheet" type="text/css" href="Libraries/bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Libraries/bootstrap-5.2.0/js/bootstrap.min.js">
    <script type="text/javascript" src="Libraries/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Libraries/fontawesome-6.1.2/css/all.css">

    <title>Login - NAAC (XAMPP)</title>
    <link rel="icon" type="image/x-icon" href="images/psna_logo.png"/>

    <style type="text/css">
        body 
        {
            background: #EEEEEE;

        }
        .navbar
        {
            background-color: navy;
        }
        .navbar-brand, .navbar-text
        {
            color: white;
        }
        .navbar-brand:hover
        {
            color: white;
        }
        #login-icon
        {
            height: 145px;
            width: 145px;
            border:1px solid #333;
            padding:5px;
        }
        .btn-primary
        {
            background-color: #087ec2;
            border-color: #087ec2;
        }
        .btn-primary:hover
        {
            background-color: #06649b;
            border-color: #06649b;
        }

    </style>
</head>

<body>
    <img src="images/college_logo.png" class="img-fluid mx-auto d-block" alt="Logo" style="height: 120px; width: 550px;">

    <!-- Header -->
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">PSNACET - NAAC</span>

            <span class="navbar-brand mb-0 h1">
                NAAC - Annual Quality Assurance Report (AQAR) & Self Study Report (SSR)
            </span>
            <!-- <span class="navbar-text">
                Designed and Developed by <b><i>AJAY V, MOHAN K & PRASANNA G</i></b> Students of MCA (Batch : 2022 - 2024)
            </span> -->
        </div>
    </nav><br>
    <!-- Header End -->

    <!-- Body -->
    <div class="card mx-auto" style="width: 35rem;">
        <div class="card-header" style="border-top:2px solid #087ec2;">
            <span style="color:#087ec2; font-weight:bold;"><i class="fa-solid fa-user-lock"></i> NAAC - Login</span>
        </div>
        <div class="card-body text-center">

            <img src="images/adminlogin.png" class="img-fluid rounded-circle" id="login-icon"/><br><br>

            <form method="post" autocomplete = "off">

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user-lock"></i></span>
                    <select class="form-select" name="login_as">
                        <option selected value=""> Select Login As</option>
                        <option value="Chairman">Chairman</option>
                        <option value="IQAC Director">IQAC Director</option>
                        <option value="Criterion Head">Criterion Head</option>
                        <option value="Department Criterion Incharge">Department Incharge</option>
                        <option value="Incharge">Criterion Incharge</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-envelope-circle-check"></i></span>
                    <input type="text" class="form-control" name="email" placeholder="Email ID">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="gap-2 mb-2">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Login</button>
                </div>

            </form> 

        </div>
        <div class="card-footer" style="border-bottom:2px solid #087ec2; color:#087ec2; font-weight: bold; text-align: center;">PSNACET NAAC - Login
        </div>
    </div>
    <br>
    <!-- Body End -->

    <!-- Fooder -->

    <nav class="navbar">
        <div class="container-fluid justify-content-center">
            <span class="navbar-text">
                <center>
                    Copyright <span><i class="fa-regular fa-copyright"></i></span> 2023. All Rights Reserved PSNA College of Engineering and Technology, Dindigul.<br>
                </center>
            </span>
        </div>
    </nav>

    <!-- Footer End-->

</body>
</html>