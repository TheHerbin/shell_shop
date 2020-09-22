<?php
    class Utilisateur{
        private $db;
        private $insert;
        

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("insert into utilisateur(nom,prenom,email,motdepasse,tel,idrole) values(:nom,:prenom,:email,:motdepasse,:tel,:idrole)");

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
    }
    ?>