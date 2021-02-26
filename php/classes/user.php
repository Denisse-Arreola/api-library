<?php

require_once("../mysql/connection.php");

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

        if (func_num_args()==0){
            $this->id=0;
            $this->firstname="";
            $this->lastname="";
            $this->email="";
            $this->password="";
            $this->bookList=array();
        }

        if(func_num_args()==2){
            $this->id=0;
            $this->firstname="";
            $this->lastname="";
            $this->email=$args[0];
            $this->password=$args[1];
            $this->bookList=array();
            verifyUser($args[0], $args[1]);
        }

        //Constructor de busqueda por medio del id del usuario
        if(func_num_args()==1){
            $sql= "select * from vw_user where id= ?;";
            $conn=mysqlConnection::getConnection();
            $command=$conn->prepare($sql);
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
                $this->id=$id_;
                $this->firstname=$firstname_;
                $this->lastname=$lastname_;
                $this->email=$email_;
                $this->password=$password_;
                $this->bookList=self::getList($id_);               

                json_decode(self::getJSON());
            }
            mysqli_stmt_close($command);
            $conn->close();
        }

    }

    //Función para obtener el arreglo de libros del usuario
    public function getList($user){
        $sql = "select * from vw_user_list where id=?;";
        $conn=mysqlConnection::getConnection();
        $command=$conn->prepare($sql);
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

    public function verifyUser($email_, $passwd_){
        $sql = "select * from vw_user where email=? and paswd=?;";
        $conn=mysqlConnection::getConnection();
        $command=$conn->prepara($sql);
        $command->bind_param('ss', $email_, $passwd_);
        $command->bind_result(
                $id_,
                $firstname_,
                $lastname_,
                $email_,
                $password_
            );
            $command->execute();
            if ($command->fetch()){
                $this->id=$id_;
                $this->firstname=$firstname_;
                $this->lastname=$lastname_;
                $this->email=$email;
                $this->password=$password;
                $this->bookList=self::getList($id_);               

                array_push(json_decode(self::getJsonObject()));
            }else{
                $this->id=0;
                $this->firstname="";
                $this->lastname="";
                $this->email="No encontrado";
                $this->password="Error";
                $this->bookList=array();   
                array_push(json_decode(self::getJsonObject()));
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
                'bookList'=>$this->bookList
            )
        );
    }

}

?>