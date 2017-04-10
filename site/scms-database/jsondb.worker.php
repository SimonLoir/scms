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

            $this->e = $e;
                       
            $table_array = json_decode(file_get_contents(dirname(__FILE__) . "/db/table-" . $table . ".json"));

            $array = [];

            if(strpos($options, " WHERE") === 0){

                $table_column = json_decode(file_get_contents(dirname(__FILE__) . "/db/tables.json"), true)[$table];
                $this->cols = $table_column;
                
                preg_match('/^ WHERE (.[^ ]*) = (.*)$/', $options, $matchs);
                if($matchs){
                    $index = array_search( $matchs[1] , $table_column);

                    foreach ($table_array as $row) {
                        if($row[$index] == $matchs[2]){
                            array_push($array, $this->getArray($row));
                        }
                    }
                }

                preg_match('/^ WHERE (.[^ ]*) BETWEEN (.*) AND (.*)$/', $options, $matchs);
                if($matchs){
                    $index = array_search( $matchs[1] , $table_column);

                    foreach ($table_array as $row) {
                        if($row[$index] >= $matchs[2] && $row[$index] <= $matchs[3]){
                            array_push($array, $this->getArray($row));
                        }
                    }
                }
               


            }else{
                $array = $table_array;
                $table_array = [];
            }

            return $array;
        }elseif(strpos($statement, "INSERT INTO") === 0){
            // Request type : INSERT
            // Request code : $statement
            try{
                preg_match('/^INSERT INTO (.+) VALUES (.+)$/', $statement, $matchs);

                $table = $matchs[1];
                $values = $matchs[2];
                
                while(is_file(dirname(__FILE__) . "/db/table-used-" . $table)){

                    sleep(1);

                }

                $table_array = json_decode(file_get_contents(dirname(__FILE__) . "/db/table-" . $table . ".json"));
                
                $to_add = json_decode($values);

                array_push($table_array, $to_add);

                if(file_put_contents(dirname(__FILE__) . "/db/table-" . $table . ".json", json_encode($table_array))){
                    return true;
                }else{
                    throw new Exception("Bad filename or database is busy", 1);
                }

            }catch(Exception $e){
                echo "<!-- Database error : impossible to insert values on database : database can be too busy or an error has occured : see this error message for more details : $e-->";
                
                return false;
            }
        }

    }

    private function getArray($row){
        $x_row = [];

        $requested = ($this->e == "*") ? $this->cols : array_map('trim', explode(',', $this->e)) ;

        foreach ($this->cols as $col) {
            
            if(in_array(trim($col), $requested)){

                $x_row[$col] = $row[array_search( $col , $this->cols )];
                
            }

        }

        return $x_row;
    }
}

?>