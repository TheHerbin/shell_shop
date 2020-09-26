<?php
    class Utilisateur{
        private $db;
        private $insert;
        private $connect;
        private $select;

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("insert into utilisateur(nom,prenom,email,motdepasse,tel,idrole) values(:nom,:prenom,:email,:motdepasse,:tel,:idrole)");
            $this->connect = $this->db->prepare("select email, idrole, motdepasse from utilisateur where email=:email");
            $this->select = $db->prepare("select email, idrole, nom, prenom, tel, r.libelle as libellerole from utilisateur u, role r where u.idrole = r.id order by nom");

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



        public function select(){
                $this->select->execute();
                if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());
                }
                return $this->select->fetchAll();
                }

                


    }
    ?>