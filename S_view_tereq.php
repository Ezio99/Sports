<?PHP
session_start();
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
echo"<style>";
echo"#pro{font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;}";
echo"#pro td, #pro th {border: 1px solid #ddd;padding: 8px;}";
echo"#pro tr:nth-child(even){background-color: #f2f2f2;}";
echo"#pro tr:hover {background-color: #ddd;}";
echo"#pro th {padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #6666ff;color: white;}";
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #6666ff;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 30%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$y=$_SESSION["ID"];
$q="Select * from team_req where reciever='$y'";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($recs)!=NULL)
{
    echo "<table id=\"pro\" align=\"center\" border=1>";
    echo"<tr><th>Sr No.</th><th>Sender</th><th>Team name</th><th>Sport</th><th>Choose</th</tr>";
    $i=1;
    while($rec=mysqli_fetch_row($recs))
    {
        $q="Select * from team where te_id='$rec[1]'";
        $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
        $row = mysqli_fetch_array($x);
        $tn=$row[1];
        $q="Select uname from player where p_id='$rec[0]'";
        $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
        $row = mysqli_fetch_array($x);
        echo"<tr><td>$i</td><td>$row[0]</td><td>$tn</td><td>$rec[3]</td><td><form method=\"POST\" action=\"S_te_approve.php\"><input type=\"hidden\" name=\"teid\" value=\"$rec[1]\"> <input name=\"choice\" type=\"submit\" value=\"Accept\"> <input name=\"choice\"  type=\"submit\" value=\"Reject\"></form></td></tr>";
        $i++;
    }
    echo"</table>";
}
else
{
    echo"No Requests found";
}