<?php 

class QueryBuilder{
    private $conn;
    public function __construct($connection){
        $this->conn = $connection;
        return $this->conn;
    }

    //create
    public function create($table, $datas){
        try{
            $column_names = implode("," , array_keys($datas));
            $bind_values = implode(", :", array_keys($datas));
            $sql = "INSERT INTO $table($column_names) VALUES(:$bind_values)";
    
            $stmt = $this->conn->prepare($sql);
            foreach($datas as $key => &$value){
                $stmt->bindParam(":".$key, $value);
            }
            $stmt->execute();
            return true;
        }catch(Exception $e){
            // echo "<pre>";
            print_r($e);
            // echo "</pre>";
            
        }
        
    }

    //login
    public function login($email, $password){
        $state = $this->conn->prepare("SELECT users.*, roles.roleName, roles.value FROM users INNER JOIN roles on users.role_id=roles.id WHERE email=:email AND status!='Ban'");
        $state->bindParam(":email", $email);
        $state->execute();
        $result = $state->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    //getAllJoin
    public function getAll($table, $cols, $join, $where, $order){
        $sql = "SELECT $cols FROM $table";
        if($join != null){
            $sql .= " $join";
        }
        if($where != null){
            $sql .= " WHERE $where";
        }
        if($order != null){
            $sql .= " ORDER BY $order";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    
    }

    //search posts or users
    public function Search($search){
        try{
            $query = "SELECT * FROM posts INNER JOIN users on posts.created_by=users.id WHERE posts.title LIKE '%$search%' OR posts.description LIKE '%$search%'";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            return $results;
        }catch(PDOException $e){
            
        }
    }



    //getoneJoin
    public function get($table, $cols, $join, $where){
        $sql = "SELECT $cols FROM $table";
        if($join != null){
            $sql .= " $join";
        }
        if($where != null){
            $sql .= " WHERE $where";
        }
        // echo $sql;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //update
    public function update($table, $datas, $id){
        $edits = "";
        foreach($datas as $key=>$value){ 
            $edits .= "$key=:$key,"; 
        }
        $edits = rtrim($edits, ',');
        $sql = "UPDATE $table SET $edits WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        foreach($datas as $key => &$value){
            $stmt->bindParam(":".$key, $value);
        }
        $stmt->execute();
        return true;
    }

    //delete
    public function delete($table, $id){
        $sql = "DELETE FROM $table WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return true;
    }
}

?>