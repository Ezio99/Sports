<?PHP
$DAP=(float)$_POST['DA'];
$HRAP=(float)$_POST['HRA'];
$TDSP=(float)$_POST['TDS'];
$i=1;
$con=mysqli_connect("localhost","root","1234") or die("error in connect".mysqli_error($con));
$db=mysqli_select_db($con,"office") or die("error in db selection".mysqli_error($con));
$q="select * from employee;";
$recs=mysqli_query($con,$q) or die("error in selecting data".mysqli_error($con));
echo "<table border=1>";
echo "<tr><td>Sl no.<td>EmpID</td><td>Name</td><td>DOB</td>
<td>DepID</td><td>Basicpay</td><td>DA</td><td>HRA</td>
<td>Gross Pay</td><td>TDS</td><td>Net Pay</td></tr>";
 while($rec =mysqli_fetch_row($recs))
 {
	$DA=$DAP/100*$rec[4];
	$HRA=$HRAP/100*$rec[4];
	$TDS=$TDSP/100*$rec[4];
	$GP=$rec[4]+$DA+$HRA;
	$NP=$GP-$TDS;
	echo"<tr><td>$i</td><td>$rec[0]</td><td>$rec[1]</td><td>$rec[2]</td>
	<td>$rec[3]</td><td>$rec[4]</td><td>$DA</td><td>$HRA</td>
	<td>$GP</td><td>$TDS</td><td>$NP</td></tr>";
	$i++;
 }
echo "</table>";
mysqli_close($con);
?>