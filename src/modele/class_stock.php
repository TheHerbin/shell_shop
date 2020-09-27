<?php
    class Stock{
        private $db;
        private $insert;
        private $connect;
        private $selectAPHE;
        private $selectAP;
        private $selectAPCR;
        private $selectHE;
        private $selectHEAT;
        private $selectHESH;
        private $selectATGM;

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("insert into stock(type,prix) values(:type,:prix)");
            $this->connect = $this->db->prepare("select type, prix from stock where type=:type");
            $this->selectAPHE = $db->prepare("select count(*) as nb from stock where type='APHE'");
            $this->selectAP = $db->prepare("select count(*) as nb from stock where type='AP'");
            $this->selectAPCR = $db->prepare("select count(*) as nb from stock where type='APCR'");
            $this->selectHE = $db->prepare("select count(*) as nb from stock where type='HE'");
            $this->selectHEAT = $db->prepare("select count(*) as nb from stock where type='HEAT'");
            $this->selectHESH = $db->prepare("select count(*) as nb from stock where type='HESH'");
            $this->selectATGM = $db->prepare("select count(*) as nb from stock where type='ATGM'");

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



        public function selectAP(){
                $this->selectAP->execute();
                if ($this->selectAP->errorCode()!=0){
                print_r($this->selectAP->errorInfo());
                }
                return $this->selectAP->fetch();
                }

                public function selectAPHE(){
                    $this->selectAPHE->execute();
                    if ($this->selectAPHE->errorCode()!=0){
                    print_r($this->selectAPHE->errorInfo());
                    }
                    return $this->selectAPHE->fetch();
                    }


                    public function selectAPCR(){
                        $this->selectAPCR->execute();
                        if ($this->selectAPCR->errorCode()!=0){
                        print_r($this->selectAPCR->errorInfo());
                        }
                        return $this->selectAPCR->fetch();
                        }


                        public function selectHE(){
                            $this->selectHE->execute();
                            if ($this->selectHE->errorCode()!=0){
                            print_r($this->selectHE->errorInfo());
                            }
                            return $this->selectHE->fetch();
                            }


                            public function selectHEAT(){
                                $this->selectHEAT->execute();
                                if ($this->selectHEAT->errorCode()!=0){
                                print_r($this->selectHEAT->errorInfo());
                                }
                                return $this->selectHEAT->fetch();
                                }

                                public function selectHESH(){
                                    $this->selectHESH->execute();
                                    if ($this->selectHESH->errorCode()!=0){
                                    print_r($this->selectHESH->errorInfo());
                                    }
                                    return $this->selectHESH->fetch();
                                    }

                                    public function selectATGM(){
                                        $this->selectATGM->execute();
                                        if ($this->selectATGM->errorCode()!=0){
                                        print_r($this->selectATGM->errorInfo());
                                        }
                                        return $this->selectATGM->fetch();
                                        }

                


    }
    ?>