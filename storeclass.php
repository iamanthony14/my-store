<?php

Class Mystore{

    private $server = "mysql:host=localhost;dbname=mystore";
    private $user = "root";
    private $pass = "";
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $con;

    public function openConnection()
    {
        try
        {
            $this->con = new PDO($this->server, $this->user, $this->pass, $this->options);

            return $this->con;
        }catch(PDOException $e)
        {
            echo "There is some problem in the connection :". $e->getMessage();
        }
        
    }

    public function closeConnection()
    {
        $this->con = null;
    }

    public function getUsers()
    {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM members");
        $stmt->execute();
        $users = $stmt->fetchAll();
        $userCount = $stmt->rowCount();

        if($userCount > 0){
            return $users;
        }
        else{
            return 0;
        }

    }

    public function login(){
        if(isset($_POST['submit'])){
            $password = md5($_POST['password']);
            $email = $_POST['email'];
            $connection = $this->openConnection();
            $stmt = $connection->prepare("SELECT * FROM members where email=? AND password=?");
            $stmt->execute([$email, $password]);
            $total=$stmt->rowCount();

            if($total > 0){
                echo "Login Success";
            }
            else{   
                echo "Login Failed";
            }

        }
    }

    public function check_user_exist($email)
    {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM members where email=?");
        $stmt->execute([$email]);
        $total=$stmt->rowCount();

        if($total > 0){
            echo "Login Success";
        }
        else{   
            echo "Login Failed";
        }
    }

    public function add_user()
    {
        if(isset($_POST['add'])){
            $email = $_POST['email'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $password = md5($_POST['password']);

            if($this->check_user_exist($email)==0){

            $connection = $this->openConnection();
            $stmt = $connection->prepare("INSERT INTO members(`email`,`password`,`first_name`,`last_name`) VALUES (?,?,?,?)");
            $stmt->execute([$email, $password, $fname, $lname]);
            }
            else{
                echo "User Already Exist";
            }
        }
    }
}
$store = new MyStore();
