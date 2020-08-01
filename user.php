<?php
  include 'database.php';
  include_once 'user_session.php'; 
  
  class User extends DB{
       private $nombre;
       private $username;

        public function userExists($user,$pass){
            
            $md5pass=$pass;
            $query=$this->connect()->prepare('SELECT * From representantes WHERE username = :user AND password = :pass');
            $query->execute(['user'=>$user, 'pass'=>$md5pass]);

            $row = $query->fetch(PDO::FETCH_NUM);
            if($row == true){
                $rol=$row[6];
               
                $_SESSION['rol']=$rol;
                switch($rol){
                    case 1:
                       
                        header('location: views/mapa.php');
                    break;
        
                    case 2:
                       
                        header('location: views/mapa2.php');
                    break;
        
                break;
                    default:
                }
    
            }

            if($query->rowCount()){
                return true;
                return $query;
            }else{
                return false;
            }
        }

        public function setUser($user){
            $query=$this->connect()->prepare('SELECT * FROM representantes WHERE username = :user');
            $query->execute(['user'=>$user]);

            foreach($query as $currentUser){
                $this->nombre=$currentUser['nombre'];
                $this->username=$currentUser['username'];
            }
        }
        public function getNombre(){
            return $this->nombre;
        }
    }
?>