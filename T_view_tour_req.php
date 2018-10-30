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
$q="Select * from tour_req where tc_id='$y'";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($recs)!=NULL)
{
    echo "<table id=\"pro\" align=\"center\" border=1>";
    echo"<tr><th>Sr No.</th><th>Team</th><th>Tournament</th><th>Sport</th><th>City</th><th>Choose</th</tr>";
    $i=1;
    while($rec=mysqli_fetch_row($recs))
    {
        $q="Select * from team where te_id='$rec[0]'";
        $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
        $row = mysqli_fetch_array($x);
        $ten=$row[1];
        $q="Select * from tour where t_id='$rec[1]'";
        $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
        $row = mysqli_fetch_array($x);
        $tn=$row[4];
        echo"<tr><td>$i</td><td>$ten</td><td>$tn</td><td>$row[2]</td><td>$row[3]</td><td><form method=\"POST\" action=\"T_tour_approve.php\"><input type=\"hidden\" name=\"teid\" value=\"$rec[0]\"> <input type=\"hidden\" name=\"tid\" value=\"$rec[1]\"> <input name=\"choice\" type=\"submit\" value=\"Accept\">  <input name=\"choice\"  type=\"submit\" value=\"Reject\"> <input name=\"choice\" type=\"submit\" value=\"Details\"></form></td></tr>";
        $i++;
    }
    echo"</table>";
}
else
{
    echo"No Requests found";
}