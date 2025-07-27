<?php
session_start();
if(!isset($_SESSION['dir_id']))
{
    header("location: ../index.php");
    exit;
}
if(isset($_POST['update']))
{
	
}
?>
<style type="text/css">
	.btn-warning
	{
		color: white;
	}
	.btn-warning:hover
	{
		color: white;
	}
</style>

<!-- Model -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete = "off" enctype="multipart/form-data">
        <div class="modal fade" id="editpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light" style="border-top:3.5px solid #087ec2;">
                        <h6 class="modal-title" id="exampleModalLabel" style="color:#057EC5;"><i class="fa fa-edit"></i><spam> Edit Academic Year</spam></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                <div class="modal-body">
                
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 17px; color:dimgrey; font-weight: bold;" for = "academic_year"> <span style="color: red">* </span>Academic Year</label>

                        <input type="text" name="academic_year" class="form-control " id="academic_year">
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
                <th style="text-align:center;">Academic Year</th>
                <th style="text-align:center;">Hide / Unhide Status</th>
                <th style="text-align:center;">Hide / Unhide</th>
                <!-- <th style="text-align:center;">Unhide</th> -->
                <th style="text-align:center;">Edit</th>
                <!-- <th style="text-align:center;">Delete</th> -->
            </tr>
        </thead> 
        <tbody>
        	<?php
        		require '../config.php';
				$sql = "SELECT * FROM academic_year ORDER BY academic_year";
				$res = $con->query($sql);

				$i=0;
				while($row = $res->fetch_assoc())
				{
					if($row["hide_status"] == 0)
					{
						$status = "Hide";
					}
					else
					{
						$status = "Unhide";
					}
					$i++;
					echo"<tr style='text-align:center;'>";
					echo"<td>{$i}</td>";
					echo"<td>{$row["academic_year"]}</td>";
					echo"<td>$status</td>";

					if($row["hide_status"] == 1)
					{
						echo"<td><button type='button' class='btn btn-sm btn-danger hide' data-id={$row["id"]}><i class='fa-solid fa-eye-slash'></i></button></td>";
					}
					else
					{
						echo"<td><button type='button' class='btn btn-sm btn-warning unhide' data-id={$row["id"]}><i class='fa-solid fa-eye'></i></button>
						</td>";
					}
							
					echo"<td><button type='button' class='btn btn-sm btn-success edit' data-id={$row["id"]}><i class='fa-solid fa-pen-to-square'></i></td>";
							
					// echo"<td><button type='button' class='btn btn-sm btn-danger del' data-id={$row["criterion_id"]}><i class='fa-solid fa-trash-can'></i></td>";
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
            $('#academic_year').val(data[1]);
        });
    });
</script>