<?php

require_once("./mysql/connection.php");

class usuario{

    //Declaramos los atributos
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $bookList;

    //Declaramos el constructor
    public function __construct(){
        $args=func_get_args();

        if (func_num_args() == 0){
            $this->id = 0;
            $this->firstname = "";
            $this->lastname = "";
            $this->email = "";
            $this->password = "";
            $this->bookList= array();
        }

        //Constructor de busqueda por medio del id del usuario
        if(func_num_args() == 1){
            $sql = "select * from vw_user where id= ?;";
            $conn = mysqlConnection::getConnection();
            $command = $conn->prepare($sql);
            $command->bind_param('i', $args[0]);

            $command->bind_result(
                $id_,
                $firstname_,
                $lastname_,
                $email_,
                $password_
            );

            $command->execute();

            if ($command->fetch()){
                $this->id = $id_;
                $this->firstname = $firstname_;
                $this->lastname = $lastname_;
                $this->email = $email_;
                $this->password = $password_;
                $this->bookList = self::getList($id_);               

                json_decode(self::getJSON());
            }

            mysqli_stmt_close($command);
            $conn->close();
        }

        //Constructor para verificar una cuenta de usuario
        if(func_num_args() == 2){
            $this->id = 0;
            $this->firstname = "";
            $this->lastname = "";
            $this->email = $args[0];
            $this->password = $args[1];
            $this->bookList = array();
            
        }

        //Constructor para llenar atributos y poder insertar a un usuario
        if (func_num_args() == 4){
            $this->id = 0;
            $this->firstname = $args[0];
            $this->lastname = $args[1];
            $this->email = $args[2];
            $this->password = $args[3];
            $this->bookList= array();
        }

    }

    //Funcion para obtener el arreglo de libros del usuario
    public function getList($user){
        $sql = "select * from vw_user_list where id=?;";
        $conn = mysqlConnection::getConnection();
        $command = $conn->prepare($sql);
        $command->bind_param('i', $user);

        $command->bind_result(
            $id_,
            $book_
        );
        $command->execute();
        $lista = array();

        while ($command->fetch()){

            $lista[]=$book_;
        }

        return $lista;
        mysqli_stmt_close($command);
        $conn->close();
    }

    //Funcion para verificar al usuario antes del inicio de sesión
    public function verifyUser(){
        $sql = "select * from vw_user where email=? and paswd=?;";
        $conn = mysqlConnection::getConnection();
        $command = $conn->prepare($sql);
        $command->bind_param('ss', $this->email, $this->password);

        $command->bind_result(
                $id_,
                $firstname_,
                $lastname_,
                $email_,
                $password_
            );

        $command->execute();
        if ($command->fetch()){

            $this->id = $id_;
            $this->firstname = $firstname_;
            $this->lastname = $lastname_;
            $this->email = $email_;
            $this->password = $password_;
            $this->bookList = self::getList($id_);               

            return self::getJSON();

        }else{

            return json_encode(array("error"=>"No encontrado", "res"=>false));
            die;
        }

            mysqli_stmt_close($command);
            $conn->close();
    }
     
    //Funcion para registrar el libro
     public function newbook($bookid){
        $conn = mysqlConnection::getConnection();
        $sql = "call sp_insert_libro (?,?);";
        $command = $conn->prepare($sql);
        $command->bind_param('ii',
        $this->id,
        $bookid);

        $command->execute();

        if($command->error !=""){
            return json_encode(array("error"=>$command->error, "res"=>false));
        }else{
            return json_encode(array("status"=>"Tu registro fue exitoso", "res"=>true));
            } 
            mysqli_stmt_close($command);
            $conn->close();
     }  



    //Funcion para registrar un nuevo usuario
    public function newUser(){
        
        $conn = mysqlConnection::getConnection();
        $conn->query("set @num=0;");

        //EXAMPLE
        //                   FIRSTNAME LASTNAME  EMAIL            PASSWORD  ID
        //call sp_insert_user ("Luis","Carlos","lcarlo@gmail.com","123456", @num);
        $sql = "call sp_insert_user (?,?,?,?, @num);";
        $command = $conn->prepare($sql);
        $command->bind_param('ssss',
                            $this->firstname,
                            $this->lastname,
                            $this->email,
                            $this->password);
		
		$command->execute();

    

        if($command->error !=""){
            return json_encode(array("error"=>$command->error, "res"=>false));
        }else{
            $num = $conn->query("select @num as num;"); 
            $idU = $num->fetch_assoc();

            if($idU != 0){
                $this->id = array_pop($idU);
                $this->bookList = array(); 
                return self::getJSON();
            }else{
                return json_encode(array("error"=>"Este usuario ya existe", "res"=>false));
            }
        }        
		

        mysqli_stmt_close($command);
        $conn->close();
    }

    public function getJSON(){
        return json_encode(
            array(
                'id'=>$this->id,
                'nombre'=>$this->firstname,
                'apellido'=>$this->lastname,
                'email'=>$this->email,
                'password'=>$this->password,
                'bookList'=>$this->bookList,
                'res'=>true
            )
        );
    }

}

?>