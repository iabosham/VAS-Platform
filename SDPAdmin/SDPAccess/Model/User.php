<?php

class User extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    //  Insert new user 
    public function addUserData($name, $login, $password, $type, $email, $phone, $sys,$companyId) {
        $secret = md5($password); //
        $add_qry = "insert into user (name,login,password,user_type,email,phone,system_id,company_id) "
                . " values('$name','$login','$secret','$type','$email','$phone',$sys,$companyId) ";

        $isAdded = $this->connection->query($add_qry);
        if ($isAdded != TRUE) {
            General::writeEvent("addUserData error " . mysqli_error($this->connection));
        }
        $this->connection->close();

        return $isAdded;
    }

    public function updateUserData($id, $name, $login, $type, $email, $phone, $status, $secret,$companyId) {

        $sql = "";
        if ($secret != null) {
            $password = md5($secret);

            $sql .= ",password='$password' ";
        }

        $upt_qry = "update user set name = '$name',login='$login',user_type='$type',email='$email',phone='$phone',status=$status ,company_id=$companyId  $sql where id = $id  ";

        $isUpdated = $this->connection->query($upt_qry);
        if ($isUpdated != TRUE) {
            General::writeEvent("updateUserData error " . mysqli_error($this->connection));
        }
        $this->connection->close();

        return $isUpdated;
    }

    public function addUser2($name) {

        try {
            $stmt = $this->connection->prepare("insert into user values(null,?,1)");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            General::writeEvent("addUser error" . $e->getMessage());
            return false;
        }
    }

    public function getUsersData($system = 1) {//
        $qry = "select * from user where system_id = $system ";

        $result = $this->connection->query($qry);
        $table = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
            $this->connection->close();
        }
        return $table;
    }

    public function getUserInfoByIdData($userId) {
        $qry = "select * from user where id = $userId";

        $result = $this->connection->query($qry);
        $row = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        }
        $this->connection->close();
        return $row;
    }

    public function checkLoginData($login, $password, $systemId) {
        $pass = md5($password);
        try {
            $stmt = $this->connection->prepare("select * from user where login = ? and password = ? and system_id = ?  ");
            $stmt->bind_param("ssi", $login, $pass, $systemId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = null;
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("checkLoginData error" . $e->getMessage());
        }
        return $row;
    }

    public function changeUserPasswordData($id, $password) {
        $secret = md5($password);
        $upt_qry = "update user set password = '$secret' where id = $id  ";

        $isUpdated = $this->connection->query($upt_qry);
        if ($isUpdated != TRUE) {
            General::writeEvent("changeUserPasswordData error " . mysqli_error($this->connection));
        }
        $this->connection->close();

        return $isUpdated;
    }

}
