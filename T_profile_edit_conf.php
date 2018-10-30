<?PHP
session_start();
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$y=$_SESSION["ID"];
$tf=$_POST['tfname'];
$tm=$_POST['tmname'];
$tl=$_POST['tlname'];
$pno=$_POST['pno'];
$em=$_POST['em'];
$dob=$_POST['dob'];
$state=$_POST['state'];
$city=$_POST['city'];
$x=1;
if(!(preg_match("/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/",$em)))
{$x=0;echo("Invalid Email\n");}
if(!(preg_match("/^\d{10}$/",$pno)))
{$x=0;echo"Invalid Phone number\n";}
if($x==0)
    die("One or more fields are invalid");
$q="UPDATE `tour_creator` SET `fname`='$tf',`mname`='$tm',`lname`='$tl',`phno`='$pno',`em`='$em',`dob`='$dob',`state`='$state',`city`='$city' WHERE tc_id='$y'";
mysqli_query($con,$q) or die("error in updating data".mysqli_error($con));
echo"Profile updated";