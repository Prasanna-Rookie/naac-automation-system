<?php
session_start();
if(!isset($_SESSION['chairman_id']))
{
    header("location: ../index.php");
    exit;
}
if(isset($_POST['update']))
{
	// Validate name

	if(empty(trim($_POST["name"])))
	{
		echo '<script language="javascript">';
        echo'alert("Please enter a Name."); location.href="manage_chairman.php"';
        echo '</script>';
	} 
	elseif(!preg_match("/^[a-zA-Z-'. ]*$/",trim($_POST["name"])))
	{
		echo '<script language="javascript">';
        echo'alert("Only letters, white space and dots are allowed."); location.href="manage_chairman.php"';
        echo '</script>';
	} 
	else
	{
		require '../config.php';
		$id = $_POST['id'];
		$name = trim($_POST["name"]);

		$query = "UPDATE iqac_chairman SET chairman_name = '$name' WHERE chairman_id = '$id'";

        if(mysqli_query($con, $query))
        {
            echo '<script language="javascript">';
        	echo'alert("Update Successfully."); location.href="manage_chairman.php"';
        	echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
       		echo'alert("Failed, Please Try Again."); location.href="manage_chairman.php"';
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
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam> Edit IQAC Chairman</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                <div class="modal-body">
                
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "email"> <span style="color: red">* </span>Email Id</label>

                        <input type="text" name="email" class="form-control " id="email" disabled readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "name"> <span style="color: red">* </span>Name</label>

                        <input type="text" name="name" class="form-control " id="name">
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
                <th style="text-align:center;">Email Id</th>
                <th style="text-align:center;">Edit</th>
                <th style="text-align:center;">Delete</th>
            </tr>
        </thead> 
        <tbody>
        	<?php
        		require '../config.php';
				$sql = "SELECT * FROM iqac_chairman";
				$res = $con->query($sql);

				$i=0;
				while($row = $res->fetch_assoc())
				{
					$i++;
					echo"<tr style='text-align:center;'>";
					echo"<td>{$i}</td>";
					echo"<td>{$row["chairman_name"]}</td>";
					echo"<td>{$row["chairman_email"]}</td>";
							
					echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$row["chairman_id"]}><i class='fa-solid fa-pen-to-square'></i></td>";
							
					echo"<td><button type='button' class='btn btn-sm btn-danger del' data-id={$row["chairman_id"]}><i class='fa-solid fa-trash-can'></i></td>";
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
            $('#email').val(data[2]);
            $('#name').val(data[1]);
        });
    });
</script>