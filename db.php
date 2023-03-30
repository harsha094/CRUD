<?php
class Database
{
    private $dsn = "mysql:host=harsh.local;dbname=CRUD_APP";
    private $user = "harsh";
    private $pass = "123456";
    public $db;

    public function __construct()
    {
        try {
            $this->db = new PDO($this->dsn, $this->user, $this->pass);
            //echo "Connected";
            //     //echo "<script>alert('Database Connected');</script>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function insert($fname, $lname, $age, $email, $contact)
    {
        // $data =[
        //     'fname' => $fname,
        //     'lname' => $lname,
        //     'age' => $age,
        //     'email' => $email,
        //     'contact' => $contact
        // ];
        try{
            $sql = "INSERT INTO Users(fname,lname,age,email,contact) VALUES(:fname,:lname,:age,:email,:contact)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contact', $contact);
            // $stmt->execute();
            $stmt->execute();
            return true;

        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function read()
    {
        $data = array();
        $sql = "SELECT * FROM Users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
    }
    public function getUserById($id)
    {
        $sql = "SELECT * FROM Users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($id, $fname, $lname, $age, $email, $contact)
    {
        $sql = "UPDATE Users SET fname =:fname, lname=:lname, age=:age, email=:email, contact=:contact WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['fname' => $fname, 'lname' => $lname, 'age' => $age, 'email' => $email, 'contact' => $contact, 'id' => $id]);
        return true;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Users WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    public function totalRowCount()
    {
        $sql = "SELECT * FROM Users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $t_rows = $stmt->rowCount();

        return $t_rows;
    }
}
//$ob = new Database();
// print_r($ob->read());
//echo $ob->totalRowCount();
?>
