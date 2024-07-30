<?php  

include('quadrado.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Quadrado</title>
</head>
<body>
  
    <h1>Quadrados</h1>
    <h3><?=$msg?></h3>
    <form action="quadrado.php" method="post">
        <fieldset>
            <legend>Quadrado</legend>        
            <fieldset>
                <legend>Dados do Quadrado</legend>        
                    <label for="id">Id:</label>
                    <input type="text" name="id" id="id" value="<?=isset($quadrado)?$quadrado->getId():0 ?>" readonly>
                    <label for="lado">Lado:</label>
                    <input type="text" name="lado" id="lado" value="<?php if(isset($quadrado)) echo $quadrado->getLado()?>">
                    <label for="cor">Cor:</label>
                    <input type="color" name="cor" id="cor" value="<?php if(isset($quadrado)) echo $quadrado->getCor()?>">
                    <label for="un">Unidade de medida:</label>
                    <input type="text" name="un" id="un" value="<?php if(isset($quadrado)) echo $quadrado->getUn()?>">
                    
            </fieldset>
                <button type='submit' name='acao' value='salvar'>Salvar</button>
                <button type='submit' name='acao' value='excluir'>Excluir</button>
                <button type='reset'>Cancelar</button>
        </fieldset>
    </form>
    <hr>
  
    <form action="" method="get">
        <fieldset>
            <legend>Pesquisa</legend>
            <label for="busca">Busca:</label>
            <input type="text" name="busca" id="busca" value="">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="0">Escolha</option>
                <option value="1">Id</option>
                <option value="2">Largura</option>
                <option value="3">Cor</option>
                <option value="4">Unidade de Medida</option>
            </select>
            <button type='submit'>Buscar</button>
        </fieldset>
    </form>
    <hr>
    <h1>Lista meus contatos</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Lado</th>
            <th>Cor</th>
            <th>Unidade de Medida</th>
        </tr>
            <div> </div>
        <?php  
            foreach($lista as $quadrado){ 
                echo "<tr><td><a href='index.php?id=".$quadrado->getId()."'>".$quadrado->getId()."</a></td><td>".$quadrado->getLado()."</td><td>".$quadrado->getCor()."</td><td>".$quadrado->getUn(). $quadrado->desenhar()."</td><td>";
            }     
        ?>
    </table>
     
       
</body>
</html>
