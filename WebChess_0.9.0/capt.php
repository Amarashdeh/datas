<?

/* connect to database */
require 'connectdb.php';
	

$f=mysql_query("select curPiece,curColor,replaced from history where replaced > '' and gameID =  '".$_SESSION['gameID']."' order by curColor desc , replaced desc");

echo "<TABLE><TR><TH style=\"background-color:lightgray;\">Captured pieces:</TH></TR>";
echo "<TR><TD>";
$c=0;
$d=0;

while($row=mysql_fetch_array($f, MYSQL_ASSOC)){

	if(ereg("white",$row['curColor'])){
		$color="black_";
		$c++;
	}
	else {
		$color="white_";
		}

	if($c==1){
		echo"\n</TD></TR><TR><TD>";
		$d=0;
	}

	$d++;

	echo"\n<img src=\"images/".$_SESSION['pref_theme']."/".$color.$row['replaced'].".gif\">";

	if(($d%8)==0){
		echo "<BR>\n";
	}

} // End while

echo "</TD></TR></TABLE>";

?>
