<?php
session_start();
if(!isset($_SESSION['cri_id']))
{
    header("location: ../../index.php");
    exit;
}
require '../../config.php';
$department = "";
$err = 0;

if(isset($_POST['update']))
{
	// Validate Name
	if(empty(trim($_POST["name"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Please enter a Name."); location.href="edit_incharge.php"';
        echo '</script>';
	} 
	elseif(!preg_match("/^[a-zA-Z-'. ]*$/",trim($_POST["name"])))
	{
		$err++;
		echo '<script language="javascript">';
        echo'alert("Only letters, white space and dots are allowed."); location.href="edit_incharge.php"';
        echo '</script>';
	} 
	else
	{
		$name = trim($_POST["name"]);
	}

	// Update
	if($err == 0)
	{
		$id = $_POST['id'];
		$criterion = trim($_POST["criterion"]);
		$department = trim($_POST["department"]);
		$query = "UPDATE department_incharge SET name = '$name', criterion = '$criterion', department = '$department' WHERE id = '$id'";

        if(mysqli_query($con, $query))
        {
            echo '<script language="javascript">';
        	echo'alert("Update Successfully."); location.href="edit_incharge.php"';
        	echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
       		echo'alert("Failed, Please Try Again."); location.href="edit_incharge.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam> Edit Department Incharge</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                <div class="modal-body">
                
                    <div class="mb-3">
                        <label class="form-label" for = "email"> <span style="color: red">* </span>Email ID</label>

                        <input type="text" name="email" class="form-control" id = "email" disabled readonly>

                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "name"> <span style="color: red">* </span>Name</label>

                        <input type="text" name="name" class="form-control " id="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for = "criterion"> <span style="color: red">* </span>Criterion</label>

                        <select class="form-select" id="criterion" name="criterion">
	                        <option value="Criterion - 1">Criterion - 1</option>
	                        <option value="Criterion - 2">Criterion - 2</option>
	                        <option value="Criterion - 3">Criterion - 3</option>
	                        <option value="Criterion - 4">Criterion - 4</option>
	                        <option value="Criterion - 5">Criterion - 5</option>
	                        <option value="Criterion - 6">Criterion - 6</option>
	                        <option value="Criterion - 7">Criterion - 7</option>
                    	</select>
                    </div>

                    <div class="mb-3">
                    	<label style="font-size: 17px; color:dimgrey; font-weight: bold;" class="control-label" for="department"><span style="color: red">* </span>Department</label>

                    	<select name="department" class="form-select" id="department">

                    		<?php
                    		$sql = "SELECT programme_name,programme_code FROM programme_info";
                    		$result = $con -> query($sql);

                    		while($row = $result -> fetch_assoc())
                    		{
                    			?>
                    			<option value="<?php echo $row['programme_code']; ?>">
                    				<?php
                    				echo $row['programme_name'];
                    				?>
                    			</option>
                    			<?php
                    		}

                    		?>
                    	</select>
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
                <th style="text-align:center;">Name</th>
                <th style="text-align:center;">Criterion</th>
                <th style="text-align:center;">Email ID</th>
                <th style="text-align:center; display: none;">Programme Code</th>
                <th style="text-align:center;">Programme Name</th>
                <th style="text-align:center;">Edit</th>
                <th style="text-align:center;">Delete</th>
            </tr>
        </thead> 
        <tbody>
        	<?php
        		require '../../config.php';
				$sql = "SELECT di.id,di.email,di.name,di.criterion,di.department,pi.programme_name FROM department_incharge AS di INNER JOIN programme_info as pi ON di.department = pi.programme_code WHERE criterion = 'Criterion - 3' ORDER BY di.criterion, pi.id, di.id";
				$res = $con->query($sql);

				$i=0;
				while($row = $res->fetch_assoc())
				{
					$i++;
					echo"<tr style='text-align:center;'>";
					echo"<td>{$i}</td>";
					echo"<td>{$row["name"]}</td>";
					echo"<td>{$row["criterion"]}</td>";
					echo"<td>{$row["email"]}</td>";
					echo"<td style = 'display:none;'>{$row["department"]}</td>";
					echo"<td>{$row["programme_name"]}</td>";
					echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$row["id"]}><i class='fa-solid fa-pen-to-square'></i></td>";
							
					echo"<td><button type='button' class='btn btn-sm btn-danger del' data-id={$row["id"]}><i class='fa-solid fa-trash-can'></i></td>";
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
            $('#email').val(data[3]);
            $('#name').val(data[1]);
            $('#criterion').val(data[2]);
            $('#department').val(data[4]);
        });
    });
</script>