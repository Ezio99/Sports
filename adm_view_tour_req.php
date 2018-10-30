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
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #009999;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$q="SELECT * FROM `adm_tour_req`";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
if(mysqli_num_rows($recs)!=NULL)
{
    echo "<table id=\"pro\" align=\"center\" border=1>";
    echo"<tr><th>SR.NO.</th><th>Tournament Name</th><th>Creator Name</th><th>Details</th></tr>";
    $i=1;
    while($rec=mysqli_fetch_row($recs))
    {
        $q="Select name from tour where t_id='$rec[1]'";
        $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
        $row=mysqli_fetch_array($x);
        $tn=$row[0];
        $q="Select fname from tour_creator  where tc_id='$rec[0]'";
        $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
        $row=mysqli_fetch_array($x);
        $tcn=$row[0];
        echo"<tr><td>$i</td><td>$tn</td><td>$tcn</td><td><form method=\"POST\" action=\"adm_view_req_det.php\"> <input type=\"hidden\" name=\"tcid\" value=\"$rec[0]\"> <input type=\"hidden\" name=\"tid\" value=\"$rec[1]\"> <input  type=\"submit\" value=\"Details\"></form></td></tr>";
        $i++;
    }
    echo"</table>";
}
else
{
    echo"No requests";
}