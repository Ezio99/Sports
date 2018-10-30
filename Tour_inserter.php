<?PHP
session_start();
$tname=$_POST['tname'];
$tsp=$_POST['tsport'];
$city=$_POST['city'];
$add=$_POST['Address'];
$num=$_POST['no'];
$rs=$_POST['rsdate'];
$re=$_POST['redate'];
$ts=$_POST['tsdate'];
$te=$_POST['tedate'];
$tg=$_POST['Gender'];
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$q="select * from tour;";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$rsd=date($rs);
$red=date($re);
$tsd=date($ts);
$ted=date($te);
$cd=date('Y-m-d');
if($rsd>$red or $rsd>$ted or $rsd>$tsd or $red>$tsd or $red>$ted or $tsd>$ted)
{   echo"$rsd $red $tsd $ted";
    die("Dates are in wrong order");
}
if($rsd>$cd)
    $st=1;
elseif($cd>=$rsd and $cd<$red)
    $st=2;
elseif($cd>=$red and $cd<$tsd)
    $st=5;
elseif($cd>=$tsd and $cd<$ted)
    $st=3;
elseif($cd>=$ted)
    $st=4;
while($rec =mysqli_fetch_row($recs))
{
    $lid=$rec[0];
}
$nlid=substr($lid,2,4);
$nlid=(int)$nlid;
$nlid=$nlid+1;
$nlid="TO".sprintf('%03s',$nlid);
$y=$_SESSION["ID"];
$q="INSERT INTO `tour`(`t_id`, `tc_id`, `sport`, `city`, `name`, `Gender`, `RegS`, `RegE`, `TS`, `TE`, `Address`, `Status`, `participation`,`approval`) VALUES ('$nlid','$y','$tsp','$city','$tname','$tg','$rs','$re','$ts','$te','$add',$st,$num,'Under Review')";
mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
$q="INSERT INTO `adm_tour_req`(`tc_id`, `t_id`) VALUES ('$y','$nlid')";
mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
echo "Tournament Created";
?>