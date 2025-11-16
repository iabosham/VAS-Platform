<?php

class Model{

    // getConnection, used for Database classes to initialize database connection
    public static function getConnection($dbName = false) {

        // Read configuration from configuration file
        $jsonFileName = General::getConfigurationFile();
        $database = $dbName? $dbName : General::getConfigurationParameter("database", "sdp_db", "$jsonFileName");
        $server = General::getConfigurationParameter("server", "127.0.0.1", "$jsonFileName");
        $port = General::getConfigurationParameter("port", "3306", "$jsonFileName");
        $username = General::getConfigurationParameter("username", "root", "$jsonFileName");
        $password = General::getConfigurationParameter("password", "", "$jsonFileName");
        try {
            // Create connection
            $connection = new mysqli($server, $username, $password, $database, $port);

            if (!$connection) {
                 
                // General::writeEvent("Error in connect " . $connection);
            } else {
                //to read arabic
                //mysqli_set_charset($connection, 'utf8');
                //mysqli_query($connection, "SET CHARACTER_SET utf8;");
            }
            return $connection;
        } catch (Exception $exception) {
            /* @var $lastError type */
            $lastError = $exception->getMessage();
            // General::writeEvent($lastError);
        }
        return false;
    }

    // save an array of keys values in the current table
    public static function saveData($tableName, $fillable){
        $connection = self::getConnection();
        $insertId = 0;
        try {
            $sql = "INSERT INTO ".$tableName;
            $columns = "";
            $values = "";
            foreach ($fillable as $key => $value){
                if($key == 'id'){
                    continue;
                }
                $val = $value;
                if($val){
                    $columns .= $key . ' ,';
                    $values .= "'".$val."' ,";
                }
            }
            $columns = substr($columns,0,-1);
            $values = substr($values,0,-1);
            $sql .= '('.$columns.') VALUES ('.$values.')';
            General::writeEvent("SQL: $sql");
            if ($connection->query($sql) === TRUE) {
                $insertId = $connection->insert_id;
            } else {
                $connection->close();
                return false;
            }

            // $stmt = $connection->prepare($sql);
            // if(!$stmt){
            //     // General::writeEvent("Error on prepare statment, SQL: $sql");
            //     return false;
            // }

            // $stmt->execute();
            // if ($stmt->insert_id > 0) {
            //     $insertId = $stmt->insert_id;
            // } else {
            //     General::addError($stmt->error);
            //     // General::writeEvent("Save in $tableName error" . $stmt->error);
            // }
            // $stmt->close();
            $connection->close();
            return $insertId;
        } catch (Exception $e) {
            // General::writeEvent("Save: on table $tableName error save" . $e->getContact());
        }
        return false;
    }
    public static function updateData($tableName, $fillable, $wheres = [['id', '=', 0]]){
        $connection = self::getConnection();
        try {
            $sql = "UPDATE $tableName SET ";
            foreach ($fillable as $key => $value){
                if ($key == 'id') {
                    continue;
                }
                if($value === null){
                    $sql .= " $key = NULL ,";
                } else {
                    $sql .= " $key = '".$value."' ,";
                }
            }
            $sql = substr($sql,0,-1);

            $sql .= " WHERE ". self::parseWheres($connection, $wheres);
           General::writeEvent("Generated SQL is: $sql");
            $result = false;
            if($connection->query($sql) === TRUE){
                $result = true;                
            }
            // $stmt = $connection->prepare($sql);
            // if(!$stmt){
            //     // General::writeEvent("Error on prepare statment, SQL: $sql");
            //     return false;
            // }
            // $result = $stmt->execute();
            // if (!$result) {
            //     General::addError($stmt->error);
            //     // General::writeEvent("Update error in $tableName , error : " . $stmt->error);
            // }
            // $stmt->close();
            $connection->close();
            return $result;
        } catch (Exception $e) {
            // General::writeEvent("Update: on table $tableName error update " . $e->getContact());
        }
        return false;
    }
    public static function deleteData($tableName, $wheres = [['id', '=', 0]]){
        $connection = self::getConnection();
        try {
            $sql = "DELETE FROM $tableName WHERE ".self::parseWheres($connection, $wheres);
           General::writeEvent("Generated SQL for delete is: $sql");
            $result = false;
            if ($connection->query($sql) === TRUE) {
                $result = true;
            }
            // $stmt = $connection->prepare($sql);
            // if(!$stmt){
            //     // General::writeEvent("Error on prepare statment, SQL: $sql");
            //     return false;
            // }
            // $result = $stmt->execute();
            // if (!$result) {
            //     General::addError($stmt->error);
            //     // General::writeEvent("Delete error in $tableName , error : " . $stmt->error);
            // }
            // $stmt->close();
            $connection->close();
            return $result;
        } catch (Exception $e) {
            // General::writeEvent("Delete: on table $tableName error delete " . $e->getContact());
        }
        return false;
    }

    // find an item with spacifice id in current table
    public static function find($tableName, $id){
        $connection = self::getConnection();
        try {
            $sql = "SELECT * FROM $tableName WHERE id = $id ";
            $result = $connection->query($sql);
            $item = [];

            if ($result->num_rows > 0) {
                // output data of each row
                if($row = $result->fetch_assoc()) {
                    $item = $row;
                }
            }
            // $stmt = $connection->prepare($sql);
            // if(!$stmt){
            //     return false;
            // }
            // $stmt->bind_param("i", $id );
            // $stmt->execute();
            // $result = $stmt->get_result();
            // $row = null;
            // $item = [];
            // if ($result->num_rows > 0) {
            //     $row = $result->fetch_assoc();
            //     $item = $row;
            // }
            // $stmt->close();
            $connection->close();
            return $item;
        } catch (Exception $e) {
            // General::writeEvent("Find: in table $tableName {id = $id} " . $e->getContact());
        }
        $connection->close();
        return false;
    }
    // get all items in current table
    public static function all($tableName, $wheres = [['1', '=', '1']], $count = false){
        $connection = self::getConnection();
         
        $items = array();
        try {
           $columns = ($count)? "count(*) count": "*";
           $sql = "SELECT $columns FROM $tableName WHERE ".self::parseWheres($connection, $wheres);
           General::writeEvent("SQL: $sql");
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
             
            if ($result->num_rows > 0) {
                // output data of each row

                while($row = $result->fetch_assoc()) {
                    $item = [];
                    foreach ($row as $key => $value) {
                        $item[$key] = $value;
                    }
                    $items[] = $item;
                }
            }
            // $stmt = $connection->prepare($sql);
            // if(!$stmt){
            //     // General::writeEvent("Error on prepare statment, SQL: $sql");
            //     return false;
            // }
            // $stmt->execute();
            // $result = $stmt->get_result();
            // $row = null;
            // if ($result->num_rows > 0) {
            //     while ($row = $result->fetch_assoc()){
            //         $item = [];
            //         foreach ($row as $key => $value) {
            //             $item[$key] = $value;
            //         }
            //         $items[] = $item;
            //     }
            // }
            // $stmt->close();
            $connection->close();
            if($count){
                return intval($items[0]["count"]);
            }
            return $items;
        } catch (Exception $e) {
            // General::writeEvent("All: in table $tableName " . $e->getContact());
        }
        return false;
    }
    // START: Data For Export
    public static function getDataExport($sql, $database = false){
        $connection = self::getConnection($database);

        $query = $sql;
        $result = mysqli_query($connection, $query);

        $number_of_fields = mysqli_num_fields($result);
        $headers = array();
        for ($i = 0; $i < $number_of_fields; $i++) {
            $headers[] = self::mysqli_field_name($result , $i);
        }
        $body = array();
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            $body[] = array_values($row);
        }
        return [
            'headers' => $headers,
            'body' => $body
        ];
    }
    private static function mysqli_field_name($result, $field_offset){
        $properties = mysqli_fetch_field_direct($result, $field_offset);
        return is_object($properties) ? $properties->name : null;
    }
    // END: Data For Export
    private static function parseWheres($connection, $wheres){
        $wheresStr = '';
        $concat = 'AND';
        foreach ($wheres as $key => $value) {
            $concat = (isset($value[3])) ? $value[3] : 'AND';

            $wheresStr .= $value[0]." ".$value[1]." '".$value[2]. "' $concat ";
        }
        $wheresStr = substr($wheresStr,0, (strlen($concat)+1)*-1 );
        return $wheresStr;
    }

    public static function executeSql($sql, $params = array(), $database = false){
        $connection = self::getConnection($database);
        $items = array();
        try {
           General::writeEvent("SQL: on executeSql , ".$sql);
            $result = $connection->query($sql);

            // $stmt = $connection->prepare($sql);
            // if(!$stmt){
            //     // General::writeEvent("Error on prepare statment, SQL: $sql");
            //     return false;
            // }
            // foreach ($params as $key => $value){
            //     $stmt->bind_param($key, $value);
            // }
            // $stmt->execute();
            // $result = $stmt->get_result();
            $response = array();
            if(is_object($result)){
                while($row = $result->fetch_assoc()) {
                    $response[] = $row;
                }
            } else {
                $response = true;
            }
            
            // $stmt->close();
            $connection->close();
//            exit;
            return $response;
        } catch (Exception $e) {
            // General::writeEvent("Execute SQL $sql " . $e->getContact());
        }
        return false;
    }

}
