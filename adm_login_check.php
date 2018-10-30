<?PHP
session_start();
$sus=$_POST['suser'];
$spass=$_POST['spass'];
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$q="select * from admin;";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$p=1;
while($rec =mysqli_fetch_row($recs))
{
    if($rec[0]==$sus)
	{
        if($rec[1]==$spass)
        {
            $p=0;
        }
        break;
    }
}
if($p==1)
{
    echo"Username or password is incorrect";
}
else if($p==0)
{
    $_SESSION["pass"]=$spass;
    $_SESSION["us"]=$sus;
    $q="UPDATE `tour` SET `Status`=1 where RegS>CURDATE()";
    $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    $q="UPDATE `tour` SET `Status`=2 where RegS<=CURDATE() and CURDATE()<RegE";
    $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    $q="UPDATE `tour` SET `Status`=5 where RegE<=CURDATE() and CURDATE()<TS";
    $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    $q="UPDATE `tour` SET `Status`=3 where TS<=CURDATE() and CURDATE()<TE";
    $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    $q="UPDATE `tour` SET `Status`=4 where CURDATE()>=TE";
    $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    header("Location: adm_filler.html");
}
?>