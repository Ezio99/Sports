<?PHP
session_start();
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$y=$_SESSION["ID"];
$teid=$_POST['teid'];
$ch=$_POST['choice'];
if($ch=="Accept")
{
    $q="INSERT INTO `player_team`(`p_id`, `te_id`) VALUES ('$y','$teid')";
    mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
    $q="DELETE FROM `team_req` WHERE te_id='$teid' and reciever='$y'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
}
else
{
    $q="DELETE FROM `team_req` WHERE te_id='$teid' and reciever='$y'";
     mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
}
header("Location: S_view_tereq.php");