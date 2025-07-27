<?php 
require '../../config.php';
$academic_year = "2022-2023";


$sql_8 = "SELECT COUNT(reg_no) AS appeared,
SUM(CASE WHEN result = 'PASS' THEN 1 ELSE 0 END) AS passed
FROM cri_2_6_3_pass_percentage WHERE academic_year = '$academic_year'";
$datas = $con->query($sql_8);
if($datas->num_rows>0)
{
    while ($data = $datas->fetch_assoc())
    {
        $appeared = $data['appeared'];
        $passed = $data['passed'];
    }
}

if($appeared != 0)
{
    $pass_percentage = ($passed / $appeared) * 100;
}
else
{
    $pass_percentage = 0;
}

$average_pass_mark =  0;

if ($pass_percentage >= 90) 
{
    $average_pass_mark = 4;
} 
elseif ($pass_percentage >= 80 && $pass_percentage < 90) 
{
    $average_pass_mark = 3;
} 
elseif ($pass_percentage >= 70 && $pass_percentage < 80) 
{
    $average_pass_mark = 2;
} 
elseif ($pass_percentage >= 60 && $pass_percentage < 70) 
{
    $average_pass_mark = 1;
} 
else 
{
    $average_pass_mark = 0;
}

echo $appeared;
echo "<br>";
echo $passed;
echo "<br>";
echo $pass_percentage;
echo "<br>";
echo $average_pass_mark;

?>

<!-- stu_tea_ratio            stu_tea_mark

>=15   >=90                       4
12-15     80-90                     3
9-12       70-80                    2 
6-9         60-70                  1 
<6                            0 -->

