<html>
    <?php include 'Funcionario.php';?>
    <head>
        <title>Formulário</title>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    </head>
    <body>
        <?php
            if (isset($_COOKIE['temafundo'])) {
                $temafundo = $_COOKIE['temafundo'];
                if($temafundo=="black"){
                    $cor_da_fonte = "white";
                }
            } else {
                $temafundo = "white";
                $cor_da_fonte = "black";
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $funcionario = new Funcionario();
                $funcionario->setNomeCompleto($_POST['nome']);
                $funcionario->setDataDeNascimento($_POST['dataNascimento']);
                $funcionario->setFuncao($_POST['funcao']);
                $funcionario->setTelefone($_POST['telefone']);
                $funcionario->setCorDeFundo($_POST['cor']);

                setcookie('temafundo', $funcionario->getCorDeFundo("paraCSS"), time() + (60 * 60 * 24 * 30), '/');
                
                $temafundo = $funcionario->getCorDeFundo("paraCSS");

                if ($temafundo=="black"){
                    $cor_da_fonte = "white"; 
                } else {
                    $cor_da_fonte = "black";
                }

                $funcionario->setEmail($_POST['email']);
                $funcionario->setSalarioLiquido($_POST['salarioLiq']);
                $funcionario->setSalarioBruto($_POST['salarioBruto']);
                
                echo "<div class=\"container mt-5\">";

                echo "<h2>Dados Cadastrados</h2>";
                echo "<p><strong>Nome do funcionário: </strong>".$funcionario->getNomeCompleto()."</p>";
                echo "<p><strong>Data de nascimento: </strong>".$funcionario->getDataDeNascimento()."</p>";
                echo "<p><strong>Função: </strong>".$funcionario->getFuncao()."</p>";
                echo "<p><strong>Telefone: </strong>".$funcionario->getTelefone()."</p>";
                echo "<p><strong>Tema de fundo escolhido: </strong>".$funcionario->getCorDeFundo()."</p>";
                echo "<p><strong>Email: </strong>".$funcionario->getEmail()."</p>";
                echo "<p><strong>Salário Líquido: </strong>".$funcionario->getSalarioLiquido()."</p>";
                echo "<p><strong>Salário Bruto: </strong>".$funcionario->getSalarioBruto()."</p>";
                echo "<p><strong>Desconto da folha de pagamento: </strong>".$funcionario->calculaDesconto()."</p>";
                echo "<h2>Curiosidade sobre a data de nascimento</h2>";
                $url = "http://numbersapi.com/".$funcionario->getDataDeNascimento("paraApi")."/date";
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPGET, true);
                $resposta = curl_exec($curl);
                echo "<p><strong>".$resposta."</strong></p>";

                echo "</div>";
            }
        ?>
    <div class="container mt-5">
    <h1>Cadastro de funcionário</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="mb-3">
            <label class="form-label"><strong>Nome Completo: </strong></label>
            <input type="text" class="form-control" name="nome" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Data de Nascimento: </strong></label>
            <input type="date" class="form-control" name="dataNascimento" required>
        </div>        

        <div class="mb-3">
            <label class="form-label"><strong>Função: </strong></label>
            <input type="text" class="form-control" name="funcao" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Telefone: </strong></label>
            <input type="tel" class="form-control" name="telefone" placeholder="(XX) XXXX-XXXX" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label"><strong>Email: </strong></label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Salário Líquido: </strong></label>
            <input type="number" class="form-control" name="salarioLiq" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Salário Bruto: </strong></label>
            <input type="number" class="form-control" name="salarioBruto" step="0.01" required>
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary btn-lg" value="Cadastrar"></input>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Cor de fundo: </strong></label><br>
            <Label class="form-label">Claro:<input class="form-check-input" type="radio" name="cor" value="white" required></Label><br>
            <label class="form-label">Escuro:<input class="form-check-input" type="radio" name="cor" value="black" required></label>
        </div> 
    </form> 
    </div>
    </body>
    <style>
        body{
            background-color: <?php echo $temafundo; ?>;
            color: <?php echo $cor_da_fonte; ?>;
        }
    </style>
</html>