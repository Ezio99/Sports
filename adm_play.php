<?PHP
session_start();
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"sport") or die("error in db selection".mysqli_error($con));
echo"<style>";
echo"#pro{font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;}";
echo"#pro td, #pro th {border: 1px solid #ddd;padding: 8px;}";
echo"#pro tr:nth-child(even){background-color: #f2f2f2;}";
echo"#pro tr:hover {background-color: #ddd;}";
echo"#pro th {padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #009999;color: white;}";
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #009999;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 25%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$q="Select * from player";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($recs)!=NULL)
{
    echo "<table id=\"pro\" align=\"center\" border=1>";
    echo"<tr><th>Sr No.</th><th>ID</th><th>Username</th><th>Name</th><<th>Choose</th</tr>";
    $i=1;
    while($rec=mysqli_fetch_row($recs))
    {
        echo"<tr><td>$i</td><td>$rec[0]</td><td>$rec[1]</td><td>$rec[3]</td><td><form method=\"POST\" action=\"adm_play_det.php\"> <input type=\"hidden\" name=\"pid\" value=\"$rec[0]\"> <input name=\"choice\" type=\"submit\" value=\"Details\">  <input name=\"choice\"  type=\"submit\" value=\"Delete\"></form></td></tr>";
        $i++;
    }
    echo"</table>";
}
else
{
    echo"No Players found";
}