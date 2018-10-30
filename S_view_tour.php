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
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #6666ff;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$ap="Approved";
$q="SELECT * from player where p_id='$y'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row = mysqli_fetch_array($x);
$pcity=$row[11];
$foo=$row[13];
$cric=$row[14];
$vol=$row[15];
$bas=$row[16];
$pgen=$row[6];
$q="Select * from tour where (sport='$foo' or sport='$cric' or sport='$vol' or sport='$bas') and CURDATE()>=RegS and CURDATE()<RegE and Gender='$pgen' and approval='$ap' and t_id not in (SELECT t_id from tour_team where te_id in (Select te_id from player_team where p_id='$y'))";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($recs)!=NULL)
{
    echo "<table id=\"pro\" align=\"center\" border=1>";
    echo"<tr><th>SR.NO.</th><th>Tournament Name</th><th>Sport</th><th>Reg start</th><th>Reg end</th><th>Start</th><th>End</th><th>Details</th></tr>";
    $i=1;
    while($rec=mysqli_fetch_row($recs))
    {
        echo"<tr><td>$i</td><td>$rec[4]</td><td>$rec[2]</td><td>$rec[6]</td><td>$rec[7]</td><td>$rec[8]</td><td>$rec[9]</td><td><form method=\"POST\" action=\"S_view_tour_det.php\"> <input type=\"hidden\" name=\"det\" value=\"$rec[0]\"> <input  type=\"submit\" value=\"Details\"></form></td></tr>";
        $i++;
    }
    echo"</table><br>";
    echo"<b align=\"center\">Only Tournaments which are accepting registrations are displayed here</b>";
}
else
{
    echo"No tournaments available";
}