<?php
class NewUserForm extends DbConn
{
    public function createUser($usr, $uid, $email, $pw, $companyname, $companyaddress, $contactname, $phone)
    {
        try {

            $db = new DbConn;
            $tbl_members = $db->tbl_members;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("INSERT INTO ".$tbl_members." (id, username, password, email, 
                memberfirmname, memberfirmaddress, membercontactname, memberphone)
            VALUES (:id, :username, :password, :email, :memberfirmname, :memberfirmaddress, :membercontactname, :memberphone)");
            $stmt->bindParam(':id', $uid);
            $stmt->bindParam(':username', $usr);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pw);
            $stmt->bindParam(':memberfirmname', $companyname);
            $stmt->bindParam(':memberfirmaddress', $companyaddress);
            $stmt->bindParam(':membercontactname', $contactname);
            $stmt->bindParam(':memberphone', $phone);
            $stmt->execute();

            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }
        //Determines returned value ('true' or error code)
        if ($err == '') {

            $success = 'true';

        } else {

            $success = $err;

        };

        return $success;

    }
}
