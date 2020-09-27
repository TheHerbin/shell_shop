<?php
    class Stock{
        private $db;
        private $insert;
        private $connect;
        private $select;

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("insert into stock(type,prix) values(:type,:prix)");
            $this->connectAPHE = $this->db->prepare("select count(recherche) from stock where 'recherche' = (select * from stock where type = \"Obus Perforant Hautement Explosif\" )");
            $this->select = $db->prepare("select count(recherche) from stock where 'recherche' = (select * from stock where type = \"Obus Perforant Hautement Explosif\" )");

        } 
        
        public function insert($type,$prix,$nbrF){
            $r=true;
            for($i = 0; i<$nbrF ; $i++){
            $this->insert->execute(array(':type'=>$type,':prix'=>$prix));
            if($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
        }
            return $r;
        }


        public function connect($email){
            $unObus = $this->connect->execute(array(':email'=>$email));
            if ($this->connect->errorCode()!=0){
            print_r($this->connect->errorInfo());
            }
            return $this->connect->fetch();
            }



        public function select(){
                $this->select->execute();
                if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());
                }
                return $this->select->fetchAll();
                }

                


    }
    ?>