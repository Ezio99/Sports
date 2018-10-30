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
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #009999;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 15%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"</style>";
$tcid=$_POST['tcid'];
$ch=$_POST['choice'];
$q="SELECT * from tour_creator where tc_id='$tcid'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row = mysqli_fetch_array($x);
if($ch=="Details")
{
echo"<h1>Tournament Creator Profile</h1>";
echo "<table id=\"pro\" align=\"center\" border=1>";
echo"<tr><th>First Name:</th><td>$row[3]</td></tr>";
echo"<tr><th>Middle Name:</th><td>$row[4]</td></tr>";
echo"<tr><th>Last Name:</th><td>$row[5]</td></tr>";
echo"<tr><th>Gender:</th><td>$row[6]</td></tr>";
echo"<tr><th>Phone number:</th><td>$row[7]</td></tr>";
echo"<tr><th>Email:</th><td>$row[8]</td></tr>";
echo"<tr><th>Date of Birth:</th><td>$row[9]</td></tr>";
echo"<tr><th>State:</th><td>$row[10]</td></tr>";
echo"<tr><th>City:</th><td>$row[11]</td></tr>";
echo"</table";
echo"<br>";
}
elseif($ch=="Delete")
{
    $q="DELETE FROM `tour_creator` WHERE tc_id='$tcid'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
    $q="Select t_id FROM `tour` WHERE tc_id='$tcid'";
    $x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
    if(mysqli_num_rows($x)!=NULL)
    {
        while($rec=mysqli_fetch_row($x))
        {
            $q="Delete from tour_team where t_id='$rec[0]'";
            mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
        }
    }
    $q="DELETE FROM `tour` WHERE tc_id='$tcid'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
    $q="DELETE FROM `adm_tour_req` WHERE tc_id='$tcid'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
    $q="DELETE FROM `tour_req` WHERE tc_id='$tcid'";
    mysqli_query($con,$q) or die("error in deletion".mysqli_error($con));
    echo"Creator deleted";
}