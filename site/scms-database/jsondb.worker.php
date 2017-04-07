<?php
/**
 * 
 */
class jdb
{
    function __construct()
    {
        
    }
    
    public function query($statement){

        if(strpos($statement, "SELECT") === 0){
            // Request type : SELECT
            // Request code : $statement

            preg_match('/^SELECT (.+) FROM (.[^ ]*)(.*)$/', $statement, $matchs);

            $e = $matchs[1];
            $table = $matchs[2];
            $options = $matchs[3];

            $table_array = json_decode(file_get_contents("db/table-" . $table . ".json"));

            $array = [];

            if(strpos($options, " WHERE") === 0){
                preg_match('/^ WHERE (.[^ ]*) = (.*)$/', $options, $matchs);
                if($matchs){
                    $index = array_search( $matchs[1] , json_decode(file_get_contents("db/tables.json"), true)[$table]);

                    foreach ($table_array as $row) {
                        if($row[$index] == $matchs[2]){
                            array_push($array, $row);
                        }
                    }
                }

                preg_match('/^ WHERE (.[^ ]*) BETWEEN (.*) AND (.*)$/', $options, $matchs);
                if($matchs){
                    $index = array_search( $matchs[1] , json_decode(file_get_contents("db/tables.json"), true)[$table]);

                    foreach ($table_array as $row) {
                        if($row[$index] >= $matchs[2] && $row[$index] <= $matchs[3]){
                            array_push($array, $row);
                        }
                    }
                }
               


            }else{
                $array = $table_array;
                $table_array = [];
            }

            return $array;
        }else{
            
        }

    }
}

?>