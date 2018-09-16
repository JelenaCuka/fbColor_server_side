<?php
include_once 'baza.class.php';
if(isset($_POST['userid'])&&$_POST['userid']!=""&&!empty($_POST['userid'])
	&&isset($_POST['width'])&&$_POST['width']!=""&&!empty($_POST['width'])
	&&isset($_POST['height'])&&$_POST['height']!=""&&!empty($_POST['height'])
	&&isset($_POST['pixelcount'])&&$_POST['pixelcount']!=""&&!empty($_POST['pixelcount'])
	&&isset($_POST['dateTime'])&&$_POST['dateTime']!=""&&!empty($_POST['dateTime'])
	&&isset($_POST['pageColorsArray'])&&!empty($_POST['pageColorsArray'])
	&&isset($_POST['specificColorsArray'])&&!empty($_POST['specificColorsArray'])
){
	$userid=$_POST['userid'];
	$width=$_POST['width'];
	$height=$_POST['height'];
	$pixelcount=$_POST['pixelcount'];
	$dateTime=$_POST['dateTime'];

	$pageColorsArray=$_POST['pageColorsArray'];
	$specificColorsArray=$_POST['specificColorsArray'];

    if($userid!=""&&$pixelcount!=""){
			$veza = new Baza();
            $veza->spojiDB();
            $sql="INSERT INTO page_data
(pixels_count,width,height,time_client,user_id,fbblue1,fbblue2,fbgrey1,fbblue3,fbgrey2,fbwhite,fbblack)
VALUES
($pixelcount,$width,$height,'$dateTime',$userid,".$specificColorsArray[0]['c']/$pixelcount*100 .",".$specificColorsArray[1]['c']/$pixelcount*100 .",".$specificColorsArray[2]['c']/$pixelcount*100 .",".$specificColorsArray[3]['c']/$pixelcount*100 .",".$specificColorsArray[4]['c']/$pixelcount*100 .",".$specificColorsArray[5]['c']/$pixelcount*100 .",".$specificColorsArray[6]['c']/$pixelcount*100 .");";
			//echo $sql;
			$pageIdInserted=$veza->updateDB($sql);
    }
	foreach($pageColorsArray as $key=>$valueAr)
		  {
		//select ID klase 
		//insert klasa stranica i broj
			$dohvatiIdKlaseUpit="SELECT id FROM energy_color_class WHERE r=".$pageColorsArray[$key]["r"]." and g=".$pageColorsArray[$key]["g"]." AND b=".$pageColorsArray[$key]["b"].";";
			$klasaID=$veza->selectDB($dohvatiIdKlaseUpit)->fetch_array();
			$klasaID=$klasaID[0];
			$sqlInsertBrojacKlase="INSERT INTO page_has_energy_classes (page_id,energy_id,pixelsCount,percentage) VALUES ($pageIdInserted,$klasaID,".$pageColorsArray[$key]["c"].",".$pageColorsArray[$key]["c"]/$pixelcount*100 .");";
			$veza->updateDB($sqlInsertBrojacKlase);
			}
	$veza->zatvoriDB();
}
?>