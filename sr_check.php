<?PHP
$sus=$_POST['sus'];
$spass=$_POST['spass'];
$f=$_POST['F'];
$c=$_POST['C'];
$v=$_POST['V'];
$bb=$_POST['BB'];
$sf=$_POST['sfname'];
$sm=$_POST['smname'];
$sl=$_POST['slname'];
$dob=$_POST['dob'];
$pno=$_POST['pno'];
$em=$_POST['em'];
$state=$_POST['state'];
$city=$_POST['city'];
$pin=$_POST['pin'];
$sg=$_POST['sgender'];
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$x=1;
if(!(preg_match("/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/",$em)))
{$x=0;echo("Invalid Email\n");}
if(!(preg_match("/^\d{6}$/",$pin)))
{$x=0;echo("Invalid Pin\n");}
if(!(preg_match("/^\d{10}$/",$pno)))
{$x=0;echo"Invalid Phone number\n";}
if($x==0)
    die("One or more fields are invalid");
$q="select * from player;";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
while($rec=mysqli_fetch_row($recs))
{
    $lid=$rec[0];
}
$nlid=substr($lid,2,4);
$nlid=(int)$nlid;
$nlid=$nlid+1;
$nlid="PL".sprintf('%03s',$nlid);
$q="select * from player;";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$p=1;
while($rec =mysqli_fetch_row($recs))
{
    if($rec[1]==$sus)
	{
     $p=0;
     break;
    }
}
if($p==1)
{
	$q="INSERT INTO `player`(`p_id`, `uname`, `pass`, `fname`, `mname`, `lname`, `gend`, `phno`, `em`, `dob`, `state`, `city`, `pin`,`football`, `cricket`, `volleyball`, `basketball`) VALUES ('$nlid','$sus','$spass','$sf','$sm','$sl','$sg','$pno','$em','$dob','$state','$city','$pin','$f','$c','$v','$bb');";
	mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
	echo "Record inserted";
}
else
    echo"This username is already taken";