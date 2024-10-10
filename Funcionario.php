<?php
    class Funcionario{
        private $nomeCompleto;
        private $dataDeNascimento;
        private $funcao;
        private $telefone;
        private $corDeFundo;
        private $email;
        private $salarioLiquido;
        private $salarioBruto;

        //SET ----------------------------------------------------------------------------------------------------------------------------

        public function setNomeCompleto ($nomeCompleto) { $this->nomeCompleto = $nomeCompleto; }
        public function setDataDeNascimento ($dataDeNascimento) { $this->dataDeNascimento = $dataDeNascimento; }
        public function setFuncao ($funcao) { $this->funcao = $funcao; }
        public function setTelefone ($telefone) { $this->telefone = $telefone; } 
        public function setCorDeFundo ($corDeFundo) { $this->corDeFundo = $corDeFundo; }
        public function setEmail($email) { $this->email = $email; }
        public function setSalarioLiquido($salarioLiquido) { $this->salarioLiquido = $salarioLiquido; }
        public function setSalarioBruto($salarioBruto) { $this->salarioBruto = $salarioBruto;}

        //GET ----------------------------------------------------------------------------------------------------------------------------

        public function getNomeCompleto() { return $this->nomeCompleto; }
        
        public function getDataDeNascimento($api = "semApi") { 
            if($api == "semApi"){
                $dataObj = new DateTime($this->dataDeNascimento);
                return $dataObj->format('d/m/y');
            }
            if ($api=="paraApi"){
                $dataObj = new DateTime($this->dataDeNascimento);
                return $dataObj->format('m/d');
            }
        }

        public function getFuncao() { return $this->funcao; }
        public function getTelefone() { return $this->telefone; }

        public function getCorDeFundo($css = "semCSS"){ 
            if($css == "semCSS"){
                if($this->corDeFundo == "white"){
                    return "Claro";
                } else  { return "Escuro";}
            }
            if($css = "paraCSS"){
                return $this->corDeFundo;
            }
        }
        
        public function getEmail() { return $this->email; }
        public function getSalarioLiquido() { return $this->salarioLiquido; }
        public function getSalarioBruto(){ return $this->salarioBruto; }

        //CALCULA DESCONTO ---------------------------------------------------------------------------------------------------------------

        public function calculaDesconto(){ return $this->salarioBruto - $this->salarioLiquido; }
    }
?>