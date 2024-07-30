<?php
require_once("Database.class.php");


class Quadrado{
    private $id; 
    private $lado; 
    private $cor;
    private $un;
    private $quadrado; 
    

   
    public function __construct($id = 0, $lado = "null", $cor = "null", $un = "null"){
        $this->setId($id); 
        $this->setLado($lado);
        $this->setCor($cor); 
        $this->setUn($un);
    }


    
    public function setId($novoId){
        if ($novoId < 0)
            throw new Exception("Erro: id inválido!"); 
        else
            $this->id = $novoId;
    }

    public function setLado($novolado){
        if ($novolado == "")
            throw new Exception("Erro: lado inválido!");
        else
            $this->lado = $novolado;
    }
    public function setCor($novocor){
        if ($novocor == "")
            throw new Exception("Erro: cor inválido!");
        else
            $this->cor = $novocor;
    }
    public function setUn($novoUn){
        if ($novoUn == "")
            throw new Exception("Erro: cor inválido!");
        else
            $this->un = $novoUn;
    }
  
    public function getId(){ return $this->id; }
    public function getLado() { return $this->lado;}
    public function getCor() { return $this->cor;}
    public function getUn() { return $this->un;}

     
    public function incluir(){
        $sql = 'INSERT INTO quadrado (id, lado, cor, un)   
                     VALUES (:id, :lado, :cor, :un)';
        $parametros = array(':id'=>$this->id,
                            ':lado'=>$this->lado,
                            ':cor'=>$this->cor,
                            ':un' =>$this->un);

        Database::executar($sql, $parametros);
        
       
    }
    public function getQuadrado(){
        return $this->quadrado;
    }

    public function setQuadrado($quadrado): self
    {
        $this->quadrado = $quadrado;

        return $this;
    }
  
    public function excluir(){
        $sql = 'DELETE 
                  FROM quadrado
                 WHERE id = :id';
        $parametros = array(':id'=> $this->id);
        return Database::executar($sql, $parametros);
    }  

   
    public function alterar(){
        $conexao = Database::getInstance();
        $sql = 'UPDATE quadrado 
                   SET lado = :lado, cor = :cor, un = :un 
                 WHERE id = :id';
        $comando = $conexao->prepare($sql); 
        $comando->bindValue(':id',$this->id);
        $comando->bindValue(':lado',$this->lado);
        $comando->bindValue(':cor',$this->cor);
        $comando->bindValue(':un',$this->un);
   
        try{
            $comando->execute(); 
            $this->getQuadrado()->alterar();
            return true;
        }catch(PDOException $e){
            throw new Exception ("Erro ao executar o comando no banco de dados: "
               .$e->getMessage()." - ".$comando->errorInfo()[2]);
        }
    }    

    public static function listar($tipo = 0, $busca = "" ){
        $conexao = Database::getInstance();
     
        $sql = "SELECT * FROM quadrado";        
        if ($tipo > 0 )
            switch($tipo){
                case 1: $sql .= " WHERE id = :busca"; break;
                case 2: $sql .= " WHERE lado like :busca"; $busca = "%{$busca}%"; break;
                case 3: $sql .= " WHERE cor like :busca";  $busca = "%{$busca}%";  break;
                case 4: $sql .= " WHERE un like :busca";  $busca = "%{$busca}%";  break;
            }
        $comando = $conexao->prepare($sql);        
        if ($tipo > 0 )
            $comando->bindValue(':busca',$busca); 
        $comando->execute(); 
        $quadrados = array();       
        while($registro = $comando->fetch()){       
            $quadrado = new Quadrado($registro['id'],$registro['lado'],$registro['cor'] , $registro['un']);
            array_push($quadrados,$quadrado); 
        }
        return $quadrados;  
    }    

        public function desenhar(){
            return "<div class='quadrado' style='width:{$this->getLado()}{$this->getUn()};height:{$this->getLado()}{$this->getUn()};background-color:{$this->getCor()};'></div>";
        }
}

?>