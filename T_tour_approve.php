<?PHP
session_start();
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
$y=$_SESSION["ID"];
echo"<style>";
echo"#pro{font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;}";
echo"#pro td, #pro th {border: 1px solid #ddd;padding: 8px;}";
echo"#pro tr:nth-child(even){background-color: #f2f2f2;}";
echo"#pro tr:hover {background-color: #ddd;}";
echo"#pro th {padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #cc0000;color: white;}";
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #cc0000;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 25%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$teid=$_POST['teid'];
$tid=$_POST['tid'];
$ch=$_POST['choice'];
if($ch=="Accept")
{
    $q="INSERT INTO `tour_team`(`t_id`, `te_id`) VALUES ('$tid','$teid')";
    mysqli_query($con,$q) or die("error in insertion".mysqli_error($con));
    $q="DELETE FROM `tour_req` WHERE te_id='$teid' and t_id='$tid'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
    echo("Team added to tournament");
}
elseif($ch=="Reject")
{
    $q="DELETE FROM `tour_req` WHERE te_id='$teid' and t_id='$tid'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
    echo("Request rejected");
}
else
{
    $q="SELECT p_id from player_team where te_id='$teid'";
    $recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    if(mysqli_num_rows($recs)!=NULL)
    {
    echo "<table id=\"pro\" align=\"center\" border=1>"; 
    echo"<tr><th>SR.NO.</th><th>Name</th><th>Role</th><th>Phone no.</th><th>Email</th></tr>";
    $i=1;
    $q="Select * from team where te_id='$teid'";
    $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    $row=mysqli_fetch_row($x);
    $cid=$row[4];
    while($rec=mysqli_fetch_row($recs))
    {
        $q="Select * from player where p_id='$rec[0]'";
        $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
        $row=mysqli_fetch_row($x);
        if($cid==$row[0])
            {$role="Captain";}
        else
            {$role="Player";}
        echo"<tr><td>$i</td><td>$row[3]</td><td>$role</td><td>$row[7]</td><td>$row[8]</td></tr>";
        $i++;
    }
    echo"</table>";
}
}