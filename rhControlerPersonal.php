<?php
require_once("../comunes/top.inc.php");
if (!isset($_REQUEST["act"])) {
    exit;
}
$retVal = "";
switch (expect_safe_html($_REQUEST["act"])) {
    case "predictPicoPlaca":
        $datePlate = isset($_REQUEST["datePlate"]) ? strtotime(expect_text($_REQUEST["datePlate"])) : 0;
        $timePlate = isset($_REQUEST["timePlate"])? expect_text($_REQUEST["timePlate"]):"";
        $plateNumber = isset($_REQUEST["plateNumber"])?expect_text($_REQUEST["plateNumber"]):"";
        require_once("../personal/classes/class.plate.php");
        $objPlate = new Plate();
        $idPlate = $objPlate->findDays($datePlate, $plateNumber);
        $objPlate->initFromDB($idPlate);
        if($objPlate->get("dayPlate") >= 1 && $objPlate->get("dayPlate") <= 5){
            $timePlateArray = explode(":", $timePlate);
            if (($timePlateArray[0] >= 7 && $timePlateArray[0] < 9)  ||($timePlateArray[0] >= 16 && $timePlateArray[0] <= 18)){
                $retVal = date("l",$datePlate)." Car can't be on the road";
            }
            elseif (($timePlateArray[0] >= 9 && $timePlateArray[0] < 10)  ||($timePlateArray[0] >= 19 && $timePlateArray[0] < 20)){
                if ($timePlateArray[1] <= 30)
                    $retVal = date("l",$datePlate)." Car can't be on the road";
                else
                    $retVal = date("l",$datePlate)." Car can be on the road";
            }
            else
                $retVal = date("l",$datePlate)." Car can be on the road";
        }
        else
            $retVal = "Weekend Car can be on the road";
        break;
        
}
encodedEnd($retVal);
?><? //_FIN_DE_ARCHIVO    ?><?
/* KEY_bea612775f77b9975a925d1f5d0c3a91c055b468_KEY_END */?><? /*KEY_231aee3dce9d97e9d4bd5061b0bdcc802dad5dc9_KEY_END*/?>