<?php
    class Obus{
        private $db;
        private $insert;
        private $connect;
        private $select;

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("insert into obus(nom,penetration,description) values(:nom,:penetration,:description)");
            //$this->connect = $this->db->prepare("select nom, penetration, description from obus where nom=:nom");
            $this->select = $db->prepare("select o.id, nom, penetration, description from obus o");

        }
        
        public function insert($nom,$penetration,$description){
            $r=true;
            $this->insert->execute(array(':nom'=>$nom,':penetration'=>$penetration,':description'=>$description));
            if($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }


       // public function connect($email){
        //    $unUtilisateur = $this->connect->execute(array(':'=>$email));
          //  if ($this->connect->errorCode()!=0){
         //   print_r($this->connect->errorInfo());
         //   }
         //   return $this->connect->fetch();
        //    }



        public function select(){
                $this->select->execute();
                if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());
                }
                return $this->select->fetchAll();
                }

                


    }
    ?>