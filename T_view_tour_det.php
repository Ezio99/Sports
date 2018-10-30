<?PHP
session_start();
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
echo"<style>";
echo"#pro{font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;}";
echo"#pro td, #pro th {border: 1px solid #ddd;padding: 8px;}";
echo"#pro tr:nth-child(even){background-color: #f2f2f2;}";
echo"#pro tr:hover {background-color: #ddd;}";
echo"#pro th {padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #cc0000;color: white;}";
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #cc0000;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 25%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$t=$_POST["det"];
$ch=$_POST['choice'];
if($ch=="Details")
{
    $q="Select * from tour where t_id='$t'";
    $recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    $rec=mysqli_fetch_row($recs);
    $q="SELECT * FROM `tour_team` WHERE t_id='$t';";
    $result=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    $num_rows = mysqli_num_rows($result);
    echo"<h1 align=\"center\">$rec[4]</h1>";
    echo "<table id=\"pro\" border=1>";
    echo"<tr><th>Sport</th><th>Gender</th><th>Number of Teams</th><th>Max Number of Teams</th><th>Registations Start</th><th>Registrations End</th><th>Tournament Start</th><th>Tournament End</th><th>City</th><th>Address</th></tr>";

    echo"<tr><td>$rec[2]</td><td>$rec[5]</td><td>$num_rows</td><td>$rec[12]</td><td>$rec[6]</td><td>$rec[7]</td><td>$rec[8]</td><td>$rec[9]</td><td>$rec[3]</td><td>$rec[10]</td>";
    echo"</table>";
    echo"<br><br>";
    echo"<h1 align=\"center\">Teams</h1>";
    $q="Select te_id from tour_team where t_id='$t'";
    $recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    if(mysqli_num_rows($recs)!=NULL)
    {
        echo "<table id=\"pro\" align=\"center\" border=1>";
        echo"<tr><th>SR.NO.</th><th>Team name</th><th>Sport</th><th>Gender</th><th>Choose</th></tr>";
        $i=1;
        while($rec=mysqli_fetch_row($recs))
        {
            $q="Select * from team where te_id='$rec[0]'";
            $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
            $row = mysqli_fetch_array($x);
            echo"<tr><td>$i</td><td>$row[1]</td><td>$row[3]</td><td>$row[2]</td><td><form method=\"POST\" action=\"T_view_reg_team_det.php\"> <input type=\"hidden\" name=\"teid\" value=\"$rec[0]\"><input type=\"hidden\" name=\"tid\" value=\"$t\"><input name=\"ch\" type=\"submit\" value=\"Drop\"> <input name=\"ch\"  type=\"submit\" value=\"Details\"></form></td></tr>";
            $i++;
        }
        echo"</table>";
    }
    else
        echo"<p align=\"center\">No teams registered</p>";
}
elseif($ch=="Drop")
{
    $q="Delete from tour where t_id='$t'";
    mysqli_query($con,$q) or die("error in deleting data".mysqli_error($con));
    $q="Delete from tour_req where t_id='$t'";
    mysqli_query($con,$q) or die("error in deleting data".mysqli_error($con));
    $q="Delete from tour_team where t_id='$t'";
    mysqli_query($con,$q) or die("error in deleting data".mysqli_error($con));
    echo"Tournament deleted";
    
}

