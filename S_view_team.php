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
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #6666ff;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 25%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$q="Select te_id from player_team  where p_id='$y'";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($recs)!=NULL)
{
    echo "<table id=\"pro\" align=\"center\" border=1>";
    echo"<tr><th>SR.NO.</th><th>Team name</th><th>Sport</th><th>Gender</th><th>View players</th></tr>";
    $i=1;
    while($rec=mysqli_fetch_row($recs))
    {
        $q="Select * from team where te_id='$rec[0]'";
        $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
        $row = mysqli_fetch_array($x);
        echo"<tr><td>$i</td><td>$row[1]</td><td>$row[3]</td><td>$row[2]</td><td><form method=\"POST\" action=\"S_view_team_det.php\"> <input type=\"hidden\" name=\"det\" value=\"$rec[0]\"> <input name=\"choice\"  type=\"submit\" value=\"Details\">  <input name=\"choice\" type=\"submit\" value=\"Leave\">  <input name=\"choice\" type=\"submit\" value=\"Delete\"></form></td></tr>";
        $i++;
    }
    echo"</table>";
}
else
{
    echo"Not registered in any team";
}