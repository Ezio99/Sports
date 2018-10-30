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
echo"#pro th {padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #6666ff;color: white;}";
echo"</style>";
$te=$_POST['det'];
$ch=$_POST['choice'];
$q="Select * from team where te_id='$te'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row=mysqli_fetch_row($x);
$cid=$row[4];
if($ch=="Details")
{
    $q="SELECT p_id from player_team where te_id='$te'";
    $recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    if(mysqli_num_rows($recs)!=NULL)
    {
        echo "<table id=\"pro\" align=\"center\" border=1>"; 
        echo"<tr><th>SR.NO.</th><th>Username<th>Name</th><th>Role</th><th>Phone no.</th><th>Email</th></tr>";
        $i=1;
        while($rec=mysqli_fetch_row($recs))
        {
            $q="Select * from player where p_id='$rec[0]'";
            $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
            $row=mysqli_fetch_row($x);
            if($cid==$row[0])
                {$role="Captain";}
            else
                {$role="Player";}
            echo"<tr><td>$i</td><td>$row[1]</td><td>$row[3]</td><td>$role</td><td>$row[7]</td><td>$row[8]</td></tr>";
            $i++;
        }
        echo"</table>";
    }
}
elseif($ch=="Leave")
{
    if($y==$cid)
    {
        die("The captain cannot leave the team");
    }
    $q="Delete from player_team where p_id='$y' and te_id='$te'";
    mysqli_query($con,$q) or die("error in deleting data".mysqli_error($con));
    echo"Team left";
}
elseif($ch=="Delete")
{
    if($y!=$cid)
    {
        die("Only the captain can drop the team");
    }
    $q="Delete from team where te_id='$te'";
    mysqli_query($con,$q) or die("error in deleting data".mysqli_error($con));
    $q="Delete from team_req where te_id='$te'";
    mysqli_query($con,$q) or die("error in deleting data".mysqli_error($con));
    $q="Delete from player_team where te_id='$te'";
    mysqli_query($con,$q) or die("error in deleting data".mysqli_error($con));
    $q="Delete from tour_team where te_id='$te'";
    mysqli_query($con,$q) or die("error in deleting data".mysqli_error($con));
    echo"Team deleted";
}