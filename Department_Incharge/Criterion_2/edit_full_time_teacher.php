<?php
session_start();
if(!isset($_SESSION['dci_id']))
{
    header("location: ../../index.php");
    exit;
}
$department = $_SESSION['department'];
require '../../config.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty(trim($_POST["name"])) && empty(trim($_POST["id_number"])) && empty(trim($_POST["pan"])) && empty(trim($_POST["email"])) && empty(trim($_POST["appointment"])) && empty(trim($_POST["gender"])) && empty(trim($_POST["designation"])) && empty(trim($_POST["joining_date"])))
    {
       echo '<script language="javascript">';
       echo'alert("Field not be Empty."); location.href="cri_2.2.2_edit_full_time_teacher.php"';
       echo '</script>';
   	}
   else
   	{
	   	$id = $_POST['id'];
	   	$name = trim($_POST["name"]);
	   	$id_number = trim($_POST["id_number"]);
	   	$pan = trim($_POST["pan"]);
	   	$gender = trim($_POST["gender"]);
	   	$designation = trim($_POST["designation"]);
	   	$email = trim($_POST["email"]);
	   	$appointment = trim($_POST["appointment"]);
	   	$joining_date = trim($_POST["joining_date"]);
	   	$leaving_date = "";

	   	if(empty(trim($_POST["leaving_date"])))
	    {
	        $leaving_date = "-";
	    }
	    else
	    {
	    	$leaving_date = trim($_POST["leaving_date"]);
	    }

	    $query = "UPDATE cri_2_2_2_full_time_teacher SET name = '$name', id_number = '$id_number', email = '$email', gender = '$gender', designation = '$designation', pan = '$pan', appointment = '$appointment', joining_date = '$joining_date', leaving_date = '$leaving_date' WHERE id = '$id'";

       if(mysqli_query($con, $query))
       	{
          	echo '<script language="javascript">';
          	echo'alert("Updated Successfully."); location.href="cri_2.2.2_edit_full_time_teacher.php"';
          	echo '</script>';
      	}
      	else
      	{
          	echo '<script language="javascript">';
          	echo'alert("Failed, Please Try Again."); location.href="cri_2.2.2_edit_full_time_teacher.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam> Edit Teacher</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "name"> <span style="color: red">* </span>Name of the Teacher</label>

                        <input type="text" name="name" class="form-control " id="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "id_number"> <span style="color: red">* </span>ID number/ Aadhar number</label>

                        <input type="text" name="id_number" class="form-control " id="id_number">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "pan"> <span style="color: red">* </span>PAN number</label>

                        <input type="text" name="pan" class="form-control " id="pan">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "email"> <span style="color: red">* </span>Email ID</label>

                        <input type="text" name="email" class="form-control " id="email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "appointment"> <span style="color: red">* </span>Nature of Appointment</label>

                        <select class="form-select" id="appointment" name="appointment">
	                        <option value="Sanctioned Post">Sanctioned Post</option>
	                        <option value="Temporary">Temporary</option>
	                        <option value="Permanent">Permanent</option>
                    	</select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "gender"> <span style="color: red">* </span>Gender</label>

                        <select class="form-select" id="gender" name="gender">
	                        <option value="Male">Male</option>
	                        <option value="Female">Female</option>
                    	</select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "designation"> <span style="color: red">* </span>Designation</label>

                        <input type="text" name="designation" class="form-control " id="designation">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "joining_date"> <span style="color: red">* </span>Date of Joining</label>

                        <input type="date" name="joining_date" class="form-control " id="joining_date">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "ending_date"> <span style="color: red">* </span>Date of Ending</label>

                        <input type="date" name="ending_date" class="form-control " id="ending_date">
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
        <!-- <colgroup>
            <col span="2">
            <col span="3" style="visibility: collapse">
        </colgroup> -->
        <thead style="background-color:#057EC5; color:#FFF;">
            <tr>
                <!-- <th style="text-align:center;">Sl.No</th> -->
                <th style="text-align:center;">Academic Year</th>
                <th style="text-align:center;">Name of the Teacher</th>
                <th style="text-align:center;">ID number / Aadhar number</th>
                <th style="text-align:center;">PAN number</th>
                <th style="text-align:center;">Email ID</th>
                <th style="text-align:center;">Nature of Appointment</th>
                <th style="text-align:center;">Gender</th>
                <th style="text-align:center;">Designation</th>
                <th style="text-align:center;">Date of Joining</th>
                <th style="text-align:center;">Date of Leaving</th>
                <th style="text-align:center;">Action</th>
            </tr>
        </thead> 
        <tbody>
        	<?php
        		require '../../config.php';
				$sql = "SELECT * FROM cri_2_2_2_full_time_teacher WHERE department = '$department'";
				$res = $con->query($sql);

				$i=0;
				while($row = $res->fetch_assoc())
				{
					$i++;
					echo"<tr style='text-align:center;'>";
					// echo"<td>{$i}</td>";
					echo"<td>{$row["academic_year"]}</td>";
					echo"<td>{$row["name"]}</td>";
					echo"<td>{$row["id_number"]}</td>";
					echo"<td>{$row["pan"]}</td>";
					echo"<td>{$row["email"]}</td>";
					echo"<td>{$row["appointment"]}</td>";
					echo"<td>{$row["gender"]}</td>";
					echo"<td>{$row["designation"]}</td>";
					echo"<td>{$row["joining_date"]}</td>";
					echo"<td>{$row["leaving_date"]}</td>";
					echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$row["id"]}><i class='fa-solid fa-pen-to-square'></i></td>";
					echo"</tr>";
				}
			?>
        </tbody>                                    
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('table').DataTable({
            ordering:false,
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
            $('#name').val(data[2]);
            $('#id_number').val(data[3]);
            $('#pan').val(data[4]);
            $('#email').val(data[5]);
            $('#appointment').val(data[6]);
            $('#gender').val(data[7]);
            $('#designation').val(data[8]);
            $('#joining_date').val(data[9]);
            $('#leaving_date').val(data[10]);
        });
    });
</script>