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
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #cc0000;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 50%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$cnd="Ended";
$q="Select * from tour where tc_id='$y' and Status!='$cnd'";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($recs)!=NULL)
{
    echo "<table id=\"pro\" align=\"center\" border=1>"; 
    echo"<tr><th>SR.NO.</th><th>Tournament ID</th><th>Name</th><th>Sport</th><th>Gender</th><th>City</th><th>Status</th><th>Approval</th><th>Details</th></tr>";
    $i=1;
    while($rec=mysqli_fetch_row($recs))
    {
        echo"<tr><td>$i</td><td>$rec[0]</td><td>$rec[4]</td><td>$rec[2]</td><td>$rec[5]</td><td>$rec[3]</td><td>$rec[11]</td><td>$rec[13]</td><td><form method=\"POST\" action=\"T_view_tour_det.php\"> <input type=\"hidden\" name=\"det\" value=\"$rec[0]\"> <input name=\"choice\"  type=\"submit\" value=\"Details\">  <input name=\"choice\" type=\"submit\" value=\"Drop\"></form></td></tr>";
        $i++;
    }
    echo"</table>";
    echo"<br><b>Unless your tournament is approved, players wont be able to see it</b>";
}
else
{
    echo"No current Tournaments found";
}