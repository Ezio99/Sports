<?PHP
session_start();
$y=$_SESSION["ID"];
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$name=$_POST['user'];
$tn=$_POST['tn'];
$q="Select * from player where uname='$name'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($x)==NULL)
{
    die("Player doesn't exist");
}
$row = mysqli_fetch_array($x);
$recid=$row[0];
if($recid==$y)
{
    die("Cant send request to yourself");
}
$gen=$row[6];
$sp=array($row[13],$row[14],$row[15],$row[16]);
$q="SELECT * FROM `team` WHERE name='$tn'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($x)==NULL)
{
    die("Team doesn't exist");
}
$row = mysqli_fetch_array($x);
$tgen=$row[2];
$tsp=$row[3];
$teid=$row[0];
$cap=$row[4];
$numpl=$row[5];
$sport=$row[3];
for($i=0;$i<count($sp);$i++)
{
    if($tsp==$sp[$i])
        break;
}
if($i==count($sp))
{
    die("Team sport and reciever sport don't match");
}
if($gen!=$tgen)
{
    die("The recievers gender and team's gender don't match");
}
if($cap!=$y)
{
    die("You are not captain of this team");
}
$q="Select * from player_team where te_id='$teid'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($x)!=NULL)
{
    $num=mysqli_num_rows($x);
    if($num==$numpl)
        die("Team is full");
}
$flag=0;
while($row = mysqli_fetch_row($x))
{
    if($row[0]==$recid)
    {
        $flag=1;
        break;
    }
}
if($flag==1)
{
    die("Player already in team");
}
$q="Select * from team_req where te_id='$teid' and reciever='$y'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($x)!=NULL)
{
    $num=mysqli_num_rows($x);
    if($num==1)
        die("Request already sent");
}
$q="INSERT INTO `team_req`(`sender`, `te_id`, `reciever`, `sport`) VALUES ('$y','$teid','$recid','$tsp')";
mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
echo"Request sent";