<?php
$connect=mysqli_connect("localhost","root","","unifiedf") or die(mysqli_error());
// echo $_POST['search_text'];

if (isset($_POST['search_text']))
{
	$search_string = $_POST['search_text'];
	// echo "maal";
	$result = mysqli_query($connect,"Select * from profile where aoi REGEXP '$search_string' OR name REGEXP '$search_string' OR department REGEXP '$search_string' OR designation REGEXP '$search_string' OR Insti REGEXP '$search_string'")or die(mysqli_error());
	foreach ($result as $rows) {
		foreach ($rows as $key => $value) {
			//str_ireplace(", u"," ",$value);
			$altr1= str_ireplace("'","",$value);
			$altr2= str_ireplace(", u , u",",",$altr1);
			$altr3= str_ireplace(", u",",",$altr2);
			$altr4= str_ireplace("[u","",$altr3);
			$altr5= str_ireplace("[","",$altr4);
			$altr6= str_ireplace("]","",$altr5);

			$value_arr=explode(',',$altr6,0);
			echo $key. "<br>";
		}
		echo "<br>------------------------------------------------<br>";
	}
}
?>