<?php
require_once("../comunes/classes/class.clase.php");

class Plate extends Clase{
    protected $id;
    protected $dayPlate;
    protected $digit;
    
    function __construct (){
        parent::init("plate","plate_");
        $this->checkStructure();
    }
    
    function findDays($datePlate, $plateNumber){
        eval('$db=new ' . DB1 . 'DB();');
        $dayPlate = date('w', $datePlate);
        $restPlate = substr($plateNumber, -1);
        $sql = $db->mkSQL("
            SELECT plate_id
            FROM   plate
            WHERE  plate_digit = %N
            AND    plate_dayPlate = %N", $restPlate, $dayPlate);
        if ( $db->query($sql)){
            $row = $db->fetchRow();
            $id = $row["plate_id"];
            return $id;
        }
        return 0;
    }
    
    function checkStructure(){
        if(DEVELOPMENT){
            eval('$db=new '.DB1.'DB();');
            $db->mantieneBase(
                array(
                    "table"=>"plate",
                    "prefix"=>"plate_",
                    "fields"=>array(
                        array(
                            "name"=>"id",
                            "type"=>"int",
                            "size"=>"",
                            "default"=>"",
                            "special"=>"",
                            "index"=>"primary",
                        ),
                        array(
                            "name" => "digit",
                            "type" => "varchar",
                            "size" => "1",
                            "default" => "",
                            "special" => "",
                            "index" => "normal",
                        ),
                        array(
                            "name"=>"dayPlate",
                            "type"=>"varchar",
                            "size"=>"20",
                            "default"=>"",
                            "special"=>"",
                            "index"=>"",
                        ),
                    )
                )
            );
        }
    }
}
?><? //_FIN_DE_ARCHIVO ?><? /*KEY_9c65f39b2073b225988ba5d788ae4a730123cdf7_KEY_END*/?>
