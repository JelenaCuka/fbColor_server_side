<?php
include_once 'baza.class.php';
/*script written for inserting energyClasses*/
/*used once and removed from server*/
$arr=[0,51,102,153,204,255];
$lengX=count($arr);
$veza = new Baza();
$veza->spojiDB();
for($i=0;$i<$lengX;$i++){
	$p=0;
	$p=calculatePower($arr[$i],$arr[$i],$arr[$i]);
	//calculate $p (energy consumption)

	$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$i],$arr[$i],$arr[$i],$p);";
	$veza->updateDB($sql);
    for ($j=$i+1;$j<$lengX;$j++){	
		$p=0;
		$p=calculatePower($arr[$j],$arr[$i],$arr[$i]);
		$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$j],$arr[$i],$arr[$i],$p);";
	    $veza->updateDB($sql);
		$p=0;
		$p=calculatePower($arr[$i],$arr[$j],$arr[$i]);
		$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$i],$arr[$j],$arr[$i],$p);";
	    $veza->updateDB($sql);
		$p=0;
		$p=calculatePower($arr[$i],$arr[$i],$arr[$j]);
		$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$i],$arr[$i],$arr[$j],$p);";
	    $veza->updateDB($sql);
		$p=0;
		$p=calculatePower($arr[$j],$arr[$j],$arr[$i]);
		$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$j],$arr[$j],$arr[$i],$p);";
	    $veza->updateDB($sql);
		$p=0;
		$p=calculatePower($arr[$i],$arr[$j],$arr[$j]);
		$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$i],$arr[$j],$arr[$j],$p);";
	    $veza->updateDB($sql);
		$p=0;
		$p=calculatePower($arr[$j],$arr[$i],$arr[$j]);
		$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$j],$arr[$i],$arr[$j],$p);";
	    $veza->updateDB($sql);	
		
        for ($k=$j+1;$k<$lengX;$k++){			
			$p=0;
			$p=calculatePower($arr[$j],$arr[$i],$arr[$k]);
			$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$j],$arr[$i],$arr[$k],$p);";
			$veza->updateDB($sql);
			$p=0;
			$p=calculatePower($arr[$j],$arr[$k],$arr[$i]);
			$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$j],$arr[$k],$arr[$i],$p);";
			$veza->updateDB($sql);
			$p=0;
			$p=calculatePower($arr[$i],$arr[$j],$arr[$k]);
			$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$i],$arr[$j],$arr[$k],$p);";
			$veza->updateDB($sql);
			$p=0;
			$p=calculatePower($arr[$i],$arr[$k],$arr[$j]);
			$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$i],$arr[$k],$arr[$j],$p);";
			$veza->updateDB($sql);
			$p=0;
			$p=calculatePower($arr[$k],$arr[$j],$arr[$i]);
			$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$k],$arr[$j],$arr[$i],$p);";
			$veza->updateDB($sql);
			$p=0;
			$p=calculatePower($arr[$k],$arr[$i],$arr[$j]);
			$sql="INSERT INTO energy_color_class (r,g,b,power) VALUES ($arr[$k],$arr[$i],$arr[$j],$p);";
			$veza->updateDB($sql);
        }
    }
}
$veza->zatvoriDB();    



function calculatePower($rr,$gg,$bb) {
	//$rr*
	//choose pR and pG and pB
	//switch cases return results of energy consumption for specific component of color defined by functions used in this project for needed classes
	/*calculates energy consumption of 1 pixel of energy class (J)*/
	switch ($rr) {
		case 0: $pR=0;break;
		case 51: $pR=1;break;
		case 102: $pR=6;break;
		case 153: $pR=12;break;
		case 204: $pR=24;break;
		case 255: $pR=35;break;		
		default: $pR=0;/**/
	}
	switch ($gg) {
		case 0: $pG=0;break;
		case 51: $pG=0.4;break;
		case 102: $pG=2.5;break;
		case 153: $pG=5;break;
		case 204: $pG=10;break;
		case 255: $pG=16;break;		
		default: $pG=0;
	}
	switch ($bb) {
		case 0: $pB=0;break;
		case 51: $pB=0.5;break;
		case 102: $pB=4;break;
		case 153: $pB=8;break;
		case 204: $pB=15;break;
		case 255: $pB=25;break;		
		default: $pB=0;
	}
	
    $pixelPower = $pR+$pG+$pB;
    return $pixelPower;
}	

?>