<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
    header("location: ../../index.php");
    exit;
}
require '../../config.php';

$programme_code = "";
$err = 0;
if(isset($_POST['update']))
{
    // Programme Code Validate

    if (empty(trim($_POST["programme_code"]))) 
    {
        $err++;
        echo '<script language="javascript">';
        echo'alert("Please Enter Programme Code."); location.href="edit_department.php"';
        echo '</script>';
    }
    else
    {
        $id = $_POST['id'];
        $temp_programme_code = $_POST["programme_code"];

        $query = "SELECT COUNT(*) as row_count FROM programme_info WHERE programme_code = '$temp_programme_code'";
        $result = $con->query($query);
        if ($result) 
        {
            $row = $result->fetch_assoc();
            $count = $row['row_count'];
            if($count == 0)
            {
                $programme_code = $_POST["programme_code"];
            }
            elseif($count == 1)
            {
                $query = "SELECT id from programme_info WHERE programme_code = '$temp_programme_code'";
                $result = $con->query($query);
                $row = $result->fetch_assoc();
                $cid = $row['id'];
                if($cid == $id)
                {
                    $programme_code = $_POST["programme_code"];
                }
                else
                {
                    $err++;
                    echo '<script language="javascript">';
                    echo'alert("Programme Code is Already Taken."); location.href="edit_department.php"';
                    echo '</script>';
                }
            }
            else
            {
                $err++;
                echo '<script language="javascript">';
                echo'alert("Programme Code is Already Taken."); location.href="edit_department.php"';
                echo '</script>';
            }
        }
        
    }

    // Programme Name Validate

    if (empty(trim($_POST["programme_name"]))) 
    {
        $err++;
        echo '<script language="javascript">';
        echo'alert("Please Enter Programme Name."); location.href="edit_department.php"';
        echo '</script>';
    }
    else
    {
        $programme_name = trim($_POST["programme_name"]);     
    }

    // Intro Year Validate

    if (empty(trim($_POST["intro_year"]))) 
    {
        $err++;
        echo '<script language="javascript">';
        echo'alert("Please Enter Year of Introduction."); location.href="edit_department.php"';
        echo '</script>';
    }
    else
    {
        $intro_year = trim($_POST["intro_year"]);     
    }

    // Status of Implementation

    if (empty(trim($_POST["cbcs_status"]))) 
    {
        $err++;
        echo '<script language="javascript">';
        echo'alert("Please Select Status."); location.href="edit_department.php"';
        echo '</script>';
    }
    else
    {
        $cbcs_status = trim($_POST["cbcs_status"]);     
    }

    // Implementation Year Validate

    if (empty(trim($_POST["intro_year_cbcs"]))) 
    {
        $err++;
        echo '<script language="javascript">';
        echo'alert("Please Enter Year of Implementation."); location.href="edit_department.php"';
        echo '</script>';
    }
    else
    {
        $intro_year_cbcs = trim($_POST["intro_year_cbcs"]);     
    }

    // Update
    if($err == 0)
    {
        $id = $_POST['id'];
        
        $query = "UPDATE programme_info SET programme_code = '$programme_code', programme_name = '$programme_name', intro_year = '$intro_year', cbcs_status = '$cbcs_status',   cbcs_imple_year = '$intro_year_cbcs' WHERE id = '$id'";

        if(mysqli_query($con, $query))
        {
            echo '<script language="javascript">';
            echo'alert("Update Successfully."); location.href="edit_department.php"';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
            echo'alert("Failed, Please Try Again."); location.href="edit_department.php"';
            echo '</script>';
        }
        mysqli_close($con);
    }
}
?>
<!-- Model -->

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
    <div class="modal fade" id="editpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light" style="border-top:3.5px solid #087ec2;">
                    <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam> Edit Department</spam></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "programme_code"> <span style="color: red">* </span>Programme Code</label>

                        <input type="text" name="programme_code" class="form-control" id = "programme_code">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "programme_name"> <span style="color: red">* </span>Programme Name</label>

                        <input type="text" name="programme_name" class="form-control" id = "programme_name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "intro_year"> <span style="color: red">* </span>Year of Introduction</label>

                        <input type="text" name="intro_year" class="form-control" id = "intro_year">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "intro_year_cbcs"> <span style="color: red">* </span>Status of Implementation of CBCS / Elective Course System</label>

                        <select name="cbcs_status" class="form-select" id="cbcs_status">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "intro_year_cbcs"> <span style="color: red">* </span>Year of Implementation of CBCS / Elective Course System</label>

                        <input type="text" name="intro_year_cbcs" class="form-control" id = "intro_year_cbcs">
                    </div>

                    <input type="hidden" name="id" id="id" value="0">

                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="update"><i class = 'fa fa-edit'></i>&nbsp; Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Model End -->

<div class="table-responsive">
    <table class="table table-bordered" id="table">
        <thead style="background-color:#057EC5; color:#FFF;">
            <tr>
                <th style="text-align:center;">Sl.No</th>
                <th style="text-align:center;">Programme Code</th>
                <th style="text-align:center;">Programme Name</th>
                <th style="text-align:center;">Year of Introduction</th>
                <th style="text-align:center;">CBCS / ECS Status</th>
                <th style="text-align:center;">Year of implemetation of CBCS / ECS</th>
                <th style="text-align:center;">Edit</th>
                <!-- <th style="text-align:center;">Delete</th> -->
            </tr>
        </thead> 
        <tbody>
        	<?php
        		require '../../config.php';
				$sql = "SELECT * FROM programme_info";
				$res = $con->query($sql);

				$i=0;
				while($row = $res->fetch_assoc())
				{
					$i++;
					echo"<tr style='text-align:center;'>";
					echo"<td>{$i}</td>";
					echo"<td>{$row["programme_code"]}</td>";
					echo"<td>{$row["programme_name"]}</td>";
					echo"<td>{$row["intro_year"]}</td>";
					echo"<td>{$row["cbcs_status"]}</td>";
					echo"<td>{$row["cbcs_imple_year"]}</td>";

					echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$row["id"]}><i class='fa-solid fa-pen-to-square'></i></td>";
							
					// echo"<td><button type='button' class='btn btn-sm btn-danger del' data-id={$row["id"]}><i class='fa-solid fa-trash-can'></i></td>";
					echo"</tr>";
				}
			?>
        </tbody>                                    
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('table').DataTable({
            ordering:true,
        });
    });

    $(document).ready(function(){
        $('.edit').on('click',function(){
            $('#editpopup').modal('show');
            var row=$(this);
            var id=$(this).attr("data-id");
            $("#id").val(id);
            var name=row.closest('tr');
            var data = name.children("td").map(function(){
            return $(this).text();
            }).get();

            console.log(data);
            $('#programme_code').val(data[1]);
            $('#programme_name').val(data[2]);
            $('#intro_year').val(data[3]);
            $('#cbcs_status').val(data[4]);
            $('#intro_year_cbcs').val(data[5]);
        });
    });
</script>