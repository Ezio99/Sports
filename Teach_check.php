<?PHP
session_start();
$tus=$_POST['tus'];
$tpass=$_POST['tpass'];
$tf=$_POST['tfname'];
$tm=$_POST['tmname'];
$tl=$_POST['tlname'];
$tg=$_POST['tgender'];
$pno=$_POST['pno'];
$em=$_POST['em'];
$dob=$_POST['dob'];
$state=$_POST['state'];
$city=$_POST['city'];
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$x=1;
if(!(preg_match("/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/",$em)))
{$x=0;echo("Invalid Email\n");}
if(!(preg_match("/^\d{10}$/",$pno)))
{$x=0;echo"Invalid Phone number\n";}
if($x==0)
    die("One or more fields are invalid");
$q="select * from tour_creator;";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$p=1;
while($rec =mysqli_fetch_row($recs))
{
    $lid=$rec[0];
}
$nlid=substr($lid,2,4);
$nlid=(int)$nlid;
$nlid=$nlid+1;
$nlid="TC".sprintf('%03s',$nlid);
$q="select * from tour_creator;";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
while($rec =mysqli_fetch_row($recs))
{
    if($rec[0]==$tus)
	{$p=0;
     break;}
}
if($p==1)
{
    $q="INSERT INTO `tour_creator`(`tc_id`, `uname`, `pass`, `fname`, `mname`, `lname`, `gend`, `phno`, `em`, `dob`, `state`, `city`) VALUES ('$nlid','$tus','$tpass','$tf','$tm','$tl','$tg','$pno','$em','$dob','$state','$city');";
	mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
	echo "Record inserted";
}
else
    echo"This username is already taken";
?>