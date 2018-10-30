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
echo"input[type=\"submit\"],input[type=\"reset\"]{background-color: #6666ff;color: white;padding: 16px 20px;margin: 8px 0;border: none;cursor: pointer;width: 15%;opacity: 0.9;}";
echo"input[type=\"submit\"],input[type=\"reset\"]:hover {opacity: 1;}";
echo"ul{list-style: none;}";
echo"li{margin: 10px 0;}";
echo"</style>";
$q="SELECT * from player where p_id='$y'";
$x=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
$row=mysqli_fetch_row($x);
echo"<h1 align=\"center\">Player Profile</h1>";
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
echo"<tr><th>Pin:</th><td>$row[12]</td></tr>";
echo"<tr><th>Interests:</th><td>";
echo"<ul>";
if($row[13]=="Football")
    echo"<li>$row[13]</li>";
if($row[14]=="Cricket")
    {echo"<li>$row[14]</li>";}
if($row[15]=="Volleyball")
    echo"<li>$row[15]</li>";
if($row[16]=="Basketball")
    echo"<li>$row[16]</li>";
echo"</ul></td></tr></table>";
echo"<br>";
echo"<form align=\"center\" method=\"POST\" action=\"S_profile_edit.php\"> <input class=\"registerbtn\"  type=\"submit\" value=\"Edit\"></form>";