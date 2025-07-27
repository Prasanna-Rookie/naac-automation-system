<?php

session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
}

$academic_year = $academic_year_err = $register_no = $register_no_err = $stu_name = $stu_name_err = $year = $year_err = $field_project = $field_project_err = $internships = $internships_err = $stu_project = $stu_project_err = "";

require '../../config.php';

if(isset($_POST['single_course']))        
{
    // Academic Year Validation

    if(empty(trim($_POST["academic_year"])))
    {
    $academic_year_err = "Please Select Academic Year.";
    }
    else
    {
        $academic_year = trim($_POST["academic_year"]);
    }
    // Register No Validation

    if (empty(trim($_POST["register_no"]))) 
    {
        $register_no_err = " Please Enter Student Register Number.";
    }
    else
    {
        $register_no=trim($_POST["register_no"]);     
    }

    // Student Name Validation

    if (empty(trim($_POST["stu_name"]))) 
    {
        $stu_name_err = " Please Enter Student Name.";
    }
    else
    {
        $stu_name=trim($_POST["stu_name"]);     
    }
    // Year Validation

    if (empty(trim($_POST["year"]))) 
    {
        $year_err = " Please Year.";
    }
    else
    {
        $year=trim($_POST["year"]);     
    }

    // Field Project Validation

    if (empty(trim($_POST["field_project"]))) 
    {
        $field_project_err = " Please Select Field Project.";
    }
    else
    {
        $field_project=trim($_POST["field_project"]);     
    }

    // Internships Validation

    if (empty(trim($_POST["internships"]))) 
    {
        $internships_err = " Please Select Internships.";
    }
    else
    {
        $internships=trim($_POST["internships"]);     
    }

    // Student Project Validation

    if (empty(trim($_POST["stu_project"]))) 
    {
        $stu_project_err = " Please Select Student Project.";
    }
    else
    {
        $stu_project=trim($_POST["stu_project"]);     
    }

    // Insert Data

    if(empty($academic_year_err) && empty($register_no_err) && empty($stu_name_err) && empty($year_err) && empty($field_project_err) && empty($internships_err) && empty($stu_project_err))
    {
        $department = $_SESSION['department'];
        $query = "INSERT INTO cri_1_3_4_student_project (academic_year, department, register_no, stu_name, year, field_project, internships, stu_project) VALUES ('$academic_year', '$department', '$register_no', '$stu_name', '$year', '$field_project', '$internships', '$stu_project')";

            if(mysqli_query($con, $query))
            {
                echo '<script language="javascript">';
                echo'alert("Student Added Successfully."); location.href="cri_1.3.4_add_project.php"';
                echo '</script>';
            }
            else
            {
                echo '<script language="javascript">';
                echo'alert("Failed, Please Try Again."); location.href="cri_1.3.4_add_project.php"';
                echo '</script>';
            }
            mysqli_close($con);
    }   

}

$file_err = "";
if(isset($_POST['import']))
{
    $csvMimes= array('application/vnd.ms-excel', 'text/plain', 'text/csv');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes))
    {
        if(is_uploaded_file($_FILES['file']['tmp_name']))
        {
            $csvfile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvfile);
            while (($line = fgetcsv($csvfile)) !== FALSE)
            {
                $vsl_no = $line[0];
                $vacademic_year = $line[1];
                $vregister_no = $line[2];
                $vstu_name = $line[3];
                $vyear = $line[4];
                $vfield_project = $line[5];
                $vinternships = $line[6];
                $vstu_project = $line[7];
                // $vdepartment = $_SESSION['department'];

                // Sl.No Validation

                if (empty($vsl_no))
                {
                    $file_err++;
                    echo '<script language="javascript">';
                    echo'alert("Error in File.\nSl.No is missing."); location.href="cri_1.3.4_add_project.php"';
                    echo '</script>';
                }
                else
                {
                    ?>
                    <script type="text/javascript">
                        var sl_no = "<?php echo $vsl_no;?>";
                    </script>
                    <?php 
                }

                // Academic Year Validation

                if (empty($vacademic_year))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">  
                            alert("Error in File. \nAcademic Year is missing in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }
                elseif(strlen($vacademic_year) != 9)
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nAcademic Year is invalid in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }

                elseif (!preg_match('/^[0-9]{4}\-[0-9]{4}$/',$vacademic_year))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nAcademic Year is invalid in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }

                // Year Validation

                if (empty($vyear))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nYear is missing in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }
                elseif(trim($vyear !== 'I - Year') && trim($vyear !== 'II - Year') && trim($vyear !== 'III - Year') && trim($vyear !== 'IV - Year') && trim($vyear !== 'V - Year') && trim($vyear !== 'VI - Year'))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nYear is invalid in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php
                }

                // Student Name Validation

                if (empty($vstu_name))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nStudent Name is missing in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }


                // Field Project Validation

                if (empty($vfield_project))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nField Project is missing in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }
                elseif(trim($vfield_project !== 'Yes') && trim($vfield_project !== 'No'))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nField Project is invalid in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php
                }

                // Internship Validation

                if (empty($vinternships))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nInternships is missing in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }
                elseif(trim($vinternships !== 'Yes') && trim($vinternships !== 'No'))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nInternships is invalid in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php
                }

                // Student Project Validation

                if (empty($vstu_project))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nStudent Project is missing in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }
                elseif(trim($vstu_project !== 'Yes') && trim($vstu_project !== 'No'))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nStudent Project is invalid in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php
                }

                // Register No Validation

                if (empty($vregister_no))
                {
                    $file_err++;
                    ?>
                        <script type="text/javascript">
                            alert("Error in File. \nRegister No. is missing in Sl.No: "+sl_no);
                            location.href = "cri_1.3.4_add_project.php";
                        </script>
                    <?php 
                }
            }
            fclose($csvfile);
            if ($file_err == 0) 
            {
                $csvfile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvfile);
                while (($line = fgetcsv($csvfile)) !== FALSE)
                {
                    $sl_no = $line[0];
	                $academic_year = $line[1];
	                $register_no = $line[2];
	                $stu_name = $line[3];
	                $year = $line[4];
	                $field_project = $line[5];
                    $internships = $line[6];
                    $stu_project = $line[7];
	                $department = $_SESSION['department'];

                  
                   $query = "INSERT INTO cri_1_3_4_student_project (academic_year, department, register_no, stu_name, year, field_project, internships, stu_project) VALUES ('$academic_year', '$department', '$register_no', '$stu_name', '$year', '$field_project', '$internships', '$stu_project')";

                    if(mysqli_query($con, $query))
                    {
                        echo '<script language="javascript">';
                        echo'alert("Student Added Successfully."); location.href="cri_1.3.4_add_project.php"';
                        echo '</script>';
                    }
                    else
                    {
                        echo '<script language="javascript">';
                        echo'alert("Failed, Please Try Again."); location.href="cri_1.3.4_add_project.php"';
                        echo '</script>';
                    }
                }
                fclose($csvfile);
                mysqli_close($con);
            }
        }
    }
    else
    {
        echo '<script language="javascript">';
        echo'alert("Please Select a CSV File"); location.href="cri_1.3.4_add_project.php"';
        echo '</script>';
    }

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../Libraries/bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Libraries/bootstrap-5.2.0/js/bootstrap.min.js">
    <script type="text/javascript" src="../../Libraries/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../Libraries/fontawesome-6.1.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="../../stylesheet/sidebar.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="icon" type="image/x-icon" href="../../images/psna_logo.png">
    <title>Criterion - 1</title>
    <style type="text/css">
	   #active
        {
            font-weight: bold;
        }
        #non-active
        {
            color: dimgrey;
        }
.card-title-new
{
    border-bottom: 1px dotted #000000; 
    padding-bottom: 5px; 
    margin-bottom:20px;
    margin-top: 10px; 
    color:#057EC5; 
    font-size:20px;
}
    </style>
</head>
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
                            <li class="breadcrumb-item active" aria-current="page">Criteria 1.3</li>
                        </ol>
                    </nav>
                </div>

                <!-- Breadcrumb End -->

                <div class="container-fluid">
                    <div class="card" style="border-top:2px solid #087ec2;">

                        <!-- Card Header -->

                        <div class="card-header" style="color:#087ec2; font-weight:bold;">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <span> Criteria 1.3.4 - Percentage of students undertaking Field Projects / Internships / Student Projects.</span>
                        </div>

                        <!-- Card Header End -->

                        <!-- Card Body -->

                        <div class="card-body">
	                        <ul class="nav nav-tabs">
	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link active" href="cri_1.3.4_add_project.php" id="active">Add Student Project</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.4_doc_upload.php" id="non-active">Upload Document</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.4_doc_view.php" id="non-active">View Document</a>
	                            </li>

	                            <li class="nav-item" role="presentation">
	                                <a class="nav-link" href="cri_1.3.4_pdf_report.php" id="non-active">PDF Report</a>
	                            </li>
	                        </ul>

	                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">

                			<div class = "card-body">
                                <h3 class="card-title card-title-new">Add Single Student Project</h3>
                                    <br>
                                <div class="container-fluid">
                                    
                                    <div class="row justify-content-center">

                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-graduation-cap"></i>
                                                    <span>Criteria 1.3.4 - Add Student Project</span>
                                                </div>
                                                
                                                	<div class="card-body">
                                    
                                                        <div class="mb-3">
														<label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

														<select name="academic_year" class="form-select <?php echo (!empty($academic_year_err)) ? 'is-invalid' : ''; ?>" id="academic_year">

															<option value="">---Select Academic Year---</option>

																<?php
																$sql = "SELECT * FROM academic_year WHERE hide_status = 1 ORDER BY academic_year";
																$result = $con -> query($sql);

																while($row = $result -> fetch_assoc())
																{
																	?>
																	<option value="<?php echo $row['academic_year']; ?>"

																		<?php
																		if($academic_year == $row['academic_year'])
																		{
																			echo "selected";
																		} 
																		?>
																		>
																		<?php
																		echo $row['academic_year'];
																		?>
																	</option>
																	<?php
																}

																?>

															</select>
															<span class="invalid-feedback">
																<?php echo $academic_year_err; ?>
															</span>
														</div>   

                                                        <div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "register_no"> <span style="color: red">* </span>Register No.</label>

                                                            <input type="text" name="register_no" class="form-control <?php echo (!empty($register_no_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "register_no" value = "<?php echo $register_no; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $register_no_err; ?>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "stu_name"> <span style="color: red">* </span>Student Name</label>

                                                            <input type="text" name="stu_name" class="form-control <?php echo (!empty($stu_name_err)) ? 'is-invalid' : ''; ?>"
                                                            id = "stu_name" value = "<?php echo $stu_name; ?>">

                                                            <div class="invalid-feedback">
                                                                <?php echo $stu_name_err; ?>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="year"><span style="color: red">* </span>Year</label>

                                                        <select name="year" class="form-select <?php echo (!empty($year_err)) ? 'is-invalid' : ''; ?>" id="year">

                                                            <option value="">---Select Course Type---</option>

                                                            <option value="I - Year" 
                                                        
                                                            <?php 
                                                            if($year == 'I - Year') 
                                                            { 
                                                                
                                                                echo "selected"; 
                                                            } 
                                                            ?>

                                                            >I - Year</option>

                                                            <option value="II - Year"

                                                            <?php 
                                                            if($year == 'II - Year')
                                                            {
                                                            
                                                                echo "selected";
                                                            }
                                                            ?>

                                                            >II - Year</option>

                                                            <option value="III - Year"

                                                            <?php 
                                                            if($year == 'III - Year')
                                                            {
                                                            
                                                                echo "selected";
                                                            }
                                                            ?>

                                                            >III - Year</option>

                                                            <option value="IV - Year"

                                                            <?php 
                                                            if($year == 'IV - Year')
                                                            {
                                                            
                                                                echo "selected";
                                                            }
                                                            ?>

                                                            >IV - Year</option>

                                                            <option value="V - Year"

                                                            <?php 
                                                            if($year == 'V - Year')
                                                            {
                                                            
                                                                echo "selected";
                                                            }
                                                            ?>

                                                            >V - Year</option>

                                                            <option value="VI - Year"

                                                            <?php 
                                                            if($year == 'VI - Year')
                                                            {
                                                            
                                                                echo "selected";
                                                            }
                                                            ?>

                                                            >VI - Year</option>
                                                        
                                                        </select>
                                                        <span class="invalid-feedback">
                                                            <?php echo $year_err; ?>
                                                        </span>
                                                    </div>

                                                	</div>
                                            </div>

                                        </div>

                                        <div class="col-sm-6 col-sm-6">
                                            <div class="card" style="border-top:2px solid #087ec2;">
                                                <div class="card-header" style="color:#087ec2; font-weight:bold;">
                                                    <i class="fa-solid fa-graduation-cap"></i>
                                                    <span>Criteria 1.3.4 - Add Student Project</span>
                                                </div>
                                                
                                                <div class="card-body">

                                                    <div class="mb-3">
                                                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="field_project"><span style="color: red">* </span>Field Project</label>

                                                        <select name="field_project" class="form-select <?php echo (!empty($field_project_err)) ? 'is-invalid' : ''; ?>" id="field_project">

                                                            <option value="">---Select---</option>

                                                            <option value="Yes" 
                                                        
                                                            <?php 
                                                            if($field_project == 'Yes') 
                                                            { 
                                                                
                                                                echo "selected"; 
                                                            } 
                                                            ?>

                                                            >Yes</option>

                                                            <option value="No"

                                                            <?php 
                                                            if($field_project == 'No')
                                                            {
                                                            
                                                                echo "selected";
                                                            }
                                                            ?>

                                                            >No</option>

                                                        </select>
                                                        <span class="invalid-feedback">
                                                            <?php echo $field_project_err; ?>
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="internships"><span style="color: red">* </span>Internships</label>

                                                        <select name="internships" class="form-select <?php echo (!empty($internships_err)) ? 'is-invalid' : ''; ?>" id="internships">

                                                            <option value="">---Select---</option>

                                                            <option value="Yes" 
                                                        
                                                            <?php 
                                                            if($internships == 'Yes') 
                                                            { 
                                                                
                                                                echo "selected"; 
                                                            } 
                                                            ?>

                                                            >Yes</option>

                                                            <option value="No"

                                                            <?php 
                                                            if($internships == 'No')
                                                            {
                                                            
                                                                echo "selected";
                                                            }
                                                            ?>

                                                            >No</option>

                                                        </select>
                                                        <span class="invalid-feedback">
                                                            <?php echo $internships_err; ?>
                                                        </span>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="stu_project"><span style="color: red">* </span>Student Projects</label>

                                                        <select name="stu_project" class="form-select <?php echo (!empty($stu_project_err)) ? 'is-invalid' : ''; ?>" id="stu_project">

                                                            <option value="">---Select---</option>

                                                            <option value="Yes" 
                                                        
                                                            <?php 
                                                            if($stu_project == 'Yes') 
                                                            { 
                                                                
                                                                echo "selected"; 
                                                            } 
                                                            ?>

                                                            >Yes</option>

                                                            <option value="No"

                                                            <?php 
                                                            if($stu_project == 'No')
                                                            {
                                                            
                                                                echo "selected";
                                                            }
                                                            ?>

                                                            >No</option>

                                                        </select>
                                                        <span class="invalid-feedback">
                                                            <?php echo $stu_project_err; ?>
                                                        </span>
                                                    </div>

                                                     <button type="submit" name = "single_course" class="btn btn-success" style="float: right;"><i class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Save</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div style="border-bottom:2px dashed #114F81; margin-bottom:15px;"></div>
                        <h3 class="card-title card-title-new">Add Multiple Students Projects</h3><br>

                            <div class="row">
                                <div class="col-sm-6 col-sm-6">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                        
                                        <input type="file" name="file" id="uploadfile">
                                        
                                        <button class="btn btn-success" type="submit" name="import"><i class = "fa fa-upload" aria-hidden="ture"></i>&nbsp;&nbsp;Import</button>

                                    </form>
                                </div>
                                <div class="col-sm-6 col-sm-6">
                                    <form action="cri_1.3.4_add_project_export.php" method="post" enctype="multipart/form-data">
                                        
                                        <button style="float: right;" class="btn btn-danger" name="export"> <i class = "fa fa-download" aria-hidden="ture"></i>&nbsp;&nbsp;Export </button>

                                    </form>
                                </div>
                            </div>

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