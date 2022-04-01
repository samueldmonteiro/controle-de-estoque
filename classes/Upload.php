<?php

    class Upload {

        protected $localUpload = "images/";
        protected $nameFileTemp;
        protected $localFileSave;

        protected $alerts = [];

        protected $fileName;
        protected $fileType;
        protected $fileSize;
        protected $fileLocalTemp;

        public $resultUpload = false;



        public function __construct($fileName, $fileType, $fileSize, $fileLocalTemp){

            $this->fileName = $fileName;
            $this->fileType = $fileType;
            $this->fileSize = $fileSize;
            $this->fileLocalTemp = $fileLocalTemp;

           
            if($this->fileSize == 0){
                $this->alerts[] = 'Arquivo vazio';
                return false;
            }
            
            elseif($this->checkName() == false){
                return false;
            }

            elseif($this->checkType() == false){
                return false;
            }

            elseif($this->checkContent() == false){
                return false;
            }
            else{
                $this->execUpload();
                $this->resultUpload = $this->localFileSave;
            }
           


        }

        public function checkName(){

            $fileName = $this->fileName;

            // Extensoes Aceitas
            $extAccept = ['.png', '.jpg', 'jpeg'];

            $extFile = substr($fileName, -4);

            if(!in_array($extFile, $extAccept)){
                $this->alerts[] = 'Extensao Invalida';
                return false;
            }

            // Extensoes Invalidas
            $extInvalid = ['txt','php','phtml','js','html','pht'];

            $nameVerify = strtolower($fileName);
            $preg = '/[1234567890]/';
            $nameVerify = preg_replace($preg, '',$nameVerify);

            foreach($extInvalid as $ext){
                if(strpos($nameVerify, $ext) != false){
                    $this->alerts[] = "Extensao Invalida Encontrada: $ext";
                    return false;
                }
            }
 
            return true; // Tudo certo!
        }

        public function checkType(){

            $fileType = $this->fileType;

            // Tipos Aceitos
            $typesAccept = ['image/jpg','image/png','image/jpeg'];

            if(!in_array($fileType, $typesAccept)){
                $this->alerts[] = "Tipo invalido encontrado: $fileType";
                return false;
            }
            elseif(!in_array(mime_content_type($this->fileLocalTemp), $typesAccept)){
                $this->alerts[] = "Tipo invalido encontrado: ". mime_content_type($this->fileLocalTemp);

                return false;
            }
           
            return true; // Tudo certo!
        }


        public function checkContent(){


            // Capturando Conteudo do arquivo
            $fileContent = file_get_contents($this->fileLocalTemp);

            // Buscando por Valores Maliciosos
            $filterContent = ['php','html','system','$_GET','Php','pHp','$_POST','<?php',';?>', '; ?>'];

            foreach($filterContent as $value){
                if(strpos($fileContent, $value) != false){

                    $this->alerts[] = "Erro! Conteudo Inapropriado: $value";
                    unlink($this->fileLocalTemp);
                    return false;
                }
            }

            /* Caso não Encontre Nehuma string Maliciosa, salve o local do arquivo
             temporario na propriedade $nameFileTemp */

            $this->nameFileTemp = $this->fileLocalTemp;
            return true;
            

        }

        protected function ExecUpload(){

            $nameFileUpload = md5(time().rand(1,100)).'.jpg';

            $localFileUpload = $this->localUpload . $nameFileUpload;

            $this->localFileSave = $nameFileUpload;

            //rename($this->nameFileTemp, $localFileUpload);
            move_uploaded_file($this->nameFileTemp, $localFileUpload);

            
        }

        public function getAlerts(){

            return $this->alerts;
        }
        
    }

?>