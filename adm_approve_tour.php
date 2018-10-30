<?PHP
session_start();
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$tid=$_POST['det'];
$ch=$_POST['choice'];
if($ch=="Approve")
{
    $q="UPDATE `tour` SET `approval`='Approved' where t_id='$tid'";
    mysqli_query($con,$q) or die("error in updating data".mysqli_error($con));
    $q="DELETE FROM `adm_tour_req` WHERE t_id='$tid'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
    echo"Approved";
}
elseif($ch=="Reject")
{
    $q="UPDATE `tour` SET `approval`='Not Approved' where t_id='$tid'";
    mysqli_query($con,$q) or die("error in updating data".mysqli_error($con));
    $q="DELETE FROM `adm_tour_req` WHERE t_id='$tid'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
    echo"Not Approved";
}