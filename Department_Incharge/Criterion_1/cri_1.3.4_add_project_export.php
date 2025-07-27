<?php 

if(isset($_POST['export']))
{
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition:attachment; filename = Add Student.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Sl.No','Academic Year','Register No','Student Name','Year', 'Field Projects', 'Internships', 'Student Projects'));
    fclose($output);
}
else
{
    echo '<script language="javascript">';
    echo'alert("File not exported."); location.href="cri_1.3.4_add_project.php"';
    echo '</script>';
}

?>