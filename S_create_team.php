<?PHP
session_start();
$name=$_POST['name'];
$sp=$_POST['sp'];
$y=$_SESSION["ID"];
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$q="Select * from player where p_id='$y'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row = mysqli_fetch_array($x);
$f=$row[13];
$c=$row[14];
$v=$row[15];
$b=$row[16];
$g=$row[6];
$q="select * from team;";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
while($rec =mysqli_fetch_row($recs))
{
    $lid=$rec[0];
}
$nlid=substr($lid,2,4);
$nlid=(int)$nlid;
$nlid=$nlid+1;
$nlid="TE".sprintf('%03s',$nlid);
$q="Select * from team";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$p=1;
while($rec =mysqli_fetch_row($recs))
{
    if($rec[1]==$name)
	{
     $p=0;
     break;
    }
}
if($p==1)
{
    $flag=0;
    if($sp==$f)
        $flag=1;
    elseif($sp==$c)
        $flag=1;
    elseif($sp==$b)
        $flag=1;
    elseif($sp==$c)
        $flag=1;
    if($flag==0)
    {
        die("You have not registered for this sport");
    }
    if($sp=="Football")
        $numpl=23;
    elseif($sp=="Cricket")
        $numpl=11;
    elseif($sp=="Volleyball")
        $numpl=12;
    else
        $numpl=12;
    $q="INSERT INTO `team`(`te_id`, `name`, `gender`, `sport`, `cap`, `numpl`) VALUES ('$nlid','$name','$g','$sp','$y',$numpl)";
	mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
    $q="INSERT INTO `player_team`(`p_id`, `te_id`) VALUES ('$y','$nlid')";
    mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
	echo "Team created";
}
else
    echo"This Team name is already taken";
