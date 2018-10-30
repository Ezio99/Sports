<?PHP
session_start();
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$y=$_SESSION["ID"];
$tid=$_POST['det'];
$tn=$_POST['Team'];
$q="SELECT * FROM `team` WHERE name='$tn'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($x)==NULL)
{
    die("Team doesn't exist");
}
$row = mysqli_fetch_array($x);
$sp=$row[3];
$cap=$row[4];
$teid=$row[0];
if($cap!=$y)
{
    die("You are not captain of this team");
}
$q="Select * from tour where t_id='$tid'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row = mysqli_fetch_array($x);
$tsp=$row[2];
if($tsp!=$sp)
{
    die("Tournament and team sport dont match");
}
$tcid=$row[1];
$no=$row[12];
$q="Select * from tour_team where t_id='$tid'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row = mysqli_fetch_array($x);
if(mysqli_num_rows($x)!=NULL)
{
    $num=mysqli_num_rows($x);
    if($num==$no)
        die("Tournament full");
}
$q="Select * from tour_req where t_id='$tid' and te_id='$teid'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row = mysqli_fetch_array($x);
if(mysqli_num_rows($x)!=NULL)
{
    $num=mysqli_num_rows($x);
    if($num==1)
        die("Request already sent");
}
$q="Select * from player_team where te_id='$teid'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row = mysqli_fetch_array($x);
/*if(mysqli_num_rows($x)!=NULL)
{
    $num=mysqli_num_rows($x);
    if($num<11)
        die("Team not complete,You atleast need 11 players");
}*/
$q="INSERT INTO `tour_req`(`te_id`, `t_id`, `tc_id`) VALUES ('$teid','$tid','$tcid')";
mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
echo"Request sent";
