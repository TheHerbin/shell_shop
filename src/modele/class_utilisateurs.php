<?php
    class Utilisateur{
        private $db;
        private $insert;
        private $connect;
        private $select;
        private $delete;
        private $selectByEmail;

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("insert into utilisateur(nom,prenom,email,motdepasse,tel,idrole) values(:nom,:prenom,:email,:motdepasse,:tel,:idrole)");
            $this->connect = $this->db->prepare("select email, idrole, motdepasse from utilisateur where email=:email");
            $this->select = $db->prepare("select email, idrole, nom, prenom, tel from utilisateur order by nom");
            $this->delete = $db->prepare("delete from utilisateur where email = :email");
            $this->selectByEmail = $db->prepare("select email, tel, nom, prenom, idrole from utilisateur where email=:email");
        } 

        public function selectByEmail($email){
            $this->selectByEmail->execute(array(':email'=>$email));
            if ($this->selectByEmail->errorCode()!=0){
            print_r($this->selectByEmail->errorInfo());
            }
            return $this->selectByEmail->fetch();
            }
        
        public function insert($nom,$prenom,$email,$motdepasse,$tel,$idrole){
            $r=true;
            $this->insert->execute(array(':nom'=>$nom,':prenom'=>$prenom,':email'=>$email,':motdepasse'=>$motdepasse,':tel'=>$tel,':idrole'=>$idrole));
            if($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }


        public function connect($email){
            $unUtilisateur = $this->connect->execute(array(':email'=>$email));
            if ($this->connect->errorCode()!=0){
            print_r($this->connect->errorInfo());
            }
            return $this->connect->fetch();
            }

            public function delete($email){
               
                $r = true;
                $this->delete->execute(array(':email'=>$email));
                if ($this->delete->errorCode()!=0){
                print_r($this->delete->errorInfo());
                $r=false;
                }
                return $r;
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