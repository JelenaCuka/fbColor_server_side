<?php
include_once 'baza.class.php';
if(isset($_POST['generiraj'])&&$_POST['generiraj']!=""&&!empty($_POST['generiraj'])){
    $generiraj=$_POST['generiraj'];
    if($generiraj==="generateIdCode"){
			$veza = new Baza();
            $veza->spojiDB();
            $sql="INSERT INTO users (user_id) VALUES (DEFAULT);";
			$idNew="";
            $idNew=$veza->updateDB($sql);
            $veza->zatvoriDB();
			echo $idNew;
			//echo json_encode($idNew,JSON_UNESCAPED_UNICODE);
    }
}
?>