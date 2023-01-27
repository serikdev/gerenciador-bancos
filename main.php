<?php
$bdServidor = 'localhost';
$bdUsuario = 'sistemaGerenciador';
$bdSenha = 'sistema';
$bdBanco = 'database';

$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco) or die ("Erro de conexão com banco de dados!");

function criarBanco($nomeBanco, $numeroAgencia, $endereco, $bandeira){
    $insert = "INSERT INTO list_banks (nomeBanco, numeroAgencia, endereco, bandeira) ";
    $values = "VALUES ('$nomeBanco', $numeroAgencia, '$endereco', '$bandeira');";
    $sqlInserir = $insert . $values;
    $query = mysqli_query($GLOBALS['conexao'], $sqlInserir);
    return $query;
}

function criarConta($nomeBanco, $nomeCliente, $CPF, $enderecoCliente, $numeroAgencia){
    $numeroConta = gerarNumeroConta();
    $insert = "INSERT INTO list_accounts (nomeBanco, nomeCliente, CPF, enderecoCliente, numeroConta, numeroAgencia) ";
    $values = "VALUES ('$nomeBanco','$nomeCliente','$CPF','$enderecoCliente','$numeroConta',$numeroAgencia);";
    $sqlInserir = $insert . $values;
    $query = mysqli_query($GLOBALS['conexao'], $sqlInserir);
    return $query;
}

function excluirBanco($nomeBanco){
    $verify = "SELECT COUNT(0) FROM list_accounts WHERE  nomeBanco = '$nomeBanco'";
    $query = mysqli_fetch_row(mysqli_query($GLOBALS['conexao'], $verify));
    if ($query[0]){
        return '-1';
    }
    $sqlDelete = "DELETE FROM list_banks WHERE nomeBanco = '$nomeBanco';";
    $query = mysqli_query($GLOBALS['conexao'], $sqlDelete);
    return $query;
}

function excluirConta($numeroConta){
    $sqlDelete = "DELETE FROM list_accounts WHERE numeroConta = $numeroConta;";
    $query = mysqli_query($GLOBALS['conexao'], $sqlDelete);
    return $query;
}

function depositar($numeroConta, $valor){
    if ($valor <= 0){
        return '-1';
    }
    $dinheiroConta = mysqli_fetch_row(mysqli_query($GLOBALS['conexao'], "SELECT dinheiroConta FROM list_accounts WHERE numeroConta = $numeroConta;"));
    $dinheiroAtualizado = $dinheiroConta[0] + $valor;
    $query = mysqli_query($GLOBALS['conexao'], "UPDATE list_accounts SET dinheiroConta = $dinheiroAtualizado WHERE numeroConta = $numeroConta;");
    echo $query;
    return $query;
}

function sacar($numeroConta, $valor){
    $dinheiroConta = mysqli_fetch_row(mysqli_query($GLOBALS['conexao'], "SELECT dinheiroConta FROM list_accounts WHERE numeroConta = $numeroConta;"));
    if ($valor >= $dinheiroConta[0]){
        return '-1';
    }
    $dinheiroAtualizado = $dinheiroConta[0] - $valor;
    $query = mysqli_query($GLOBALS['conexao'], "UPDATE list_accounts SET dinheiroConta = $dinheiroAtualizado WHERE numeroConta = $numeroConta;");
    return $query;
}

function transferir($deConta, $paraConta, $valor){
    $bancoConta1 = mysqli_query($GLOBALS['conexao'], "SELECT nomeBanco FROM list_accounts WHERE numeroConta = '$deConta'");
    $bancoConta2 = mysqli_query($GLOBALS['conexao'], "SELECT nomeBanco FROM list_accounts WHERE numeroConta = '$paraConta'");
    if ($bancoConta1 == $bancoConta2){
        $dinheiroConta1 = mysqli_fetch_row(mysqli_query($GLOBALS['conexao'], "SELECT dinheiroConta FROM list_accounts  WHERE numeroConta = '$deConta'"));
        $dinheiroConta2 = mysqli_fetch_row(mysqli_query($GLOBALS['conexao'], "SELECT dinheiroConta FROM list_accounts  WHERE numeroConta = '$paraConta'"));
        mysqli_query($GLOBALS['conexao'], "UPDATE list_accounts SET dinheiroConta = $dinheiroConta1[0] - $valor WHERE numeroConta = '$deConta'");
        mysqli_query($GLOBALS['conexao'], "UPDATE list_accounts SET dinheiroConta = $dinheiroConta2[0] + $valor WHERE numeroConta = '$paraConta'");

        return "1";
    }
    else {
        return "0";
    }
}

function transferir2($deConta, $paraConta, $valor){
    $bancoConta1 = mysqli_query($GLOBALS['conexao'], "SELECT nomeBanco FROM list_accounts WHERE numeroConta = '$deConta'");
    $bancoConta2 = mysqli_query($GLOBALS['conexao'], "SELECT nomeBanco FROM list_accounts WHERE numeroConta = '$paraConta'");
    if ($bancoConta1 == $bancoConta2){
        sacar($deConta, $valor);
        sleep(0.1);
        depositar($paraConta, $valor);
        return "1";
    }
    else {
        return "0";
    }
}

function pesquisarConta($nomeCliente){
    $pesquisaCliente = "SELECT * FROM list_accounts WHERE nomeCliente = '$nomeCliente';";
    $query = mysqli_query($GLOBALS['conexao'], $pesquisaCliente);
    criarTabelaAccounts($query);
}

function listarContasBanco($nomeBanco){
    $listaContas = "SELECT * FROM list_accounts WHERE nomeBanco = '$nomeBanco';";
    $query = mysqli_query($GLOBALS['conexao'], $listaContas);
    criarTabelaAccounts($query);
}

function pesquisarBancos($info, $aux){
    if ($aux == 1){
        $listaBancos = "SELECT * FROM list_banks WHERE nomeBanco = '$info';";
    }
    else if ($aux == 2){
        $listaBancos = "SELECT * FROM list_banks WHERE bandeira = '$info';";
    }
    $query = mysqli_query($GLOBALS['conexao'], $listaBancos);
    criarTabelaBanks($query);
}

function listarBancos(){
    $query = mysqli_query($GLOBALS['conexao'], "SELECT * FROM list_banks");
    criarTabelaBanks($query);
}

function criarTabelaAccounts($query){
    echo "<table class='tabelas'>
    <tr>
    <th>Nome do Banco</th>
    <th>Nome do Cliente</th>
    <th>CPF</th>
    <th>Endereço do Cliente</th>
    <th>Numero da Conta</th>
    <th>Numero da Agencia</th>
    <th>Dinheiro em Conta</th>
    </tr>
    ";
    while ($data = mysqli_fetch_assoc($query)){
        echo "<tr>";
        echo "<td>".$data['nomeBanco']."</td>";
        echo "<td>".$data['nomeCliente']."</td>";
        echo "<td>".$data['cpf']."</td>";
        echo "<td>".$data['enderecoCliente']."</td>";
        echo "<td>".$data['numeroConta']."</td>";
        echo "<td>".$data['numeroAgencia']."</td>";
        echo "<td>".$data['dinheiroConta']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function criarTabelaBanks($query){
    echo "<table class='tabelas'>
    <tr>
    <th>Nome do Banco</th>
    <th>Numero da Agencia</th>
    <th>Endereço da Agencia</th>
    <th>Bandeira</th>
    </tr>
    ";
    while ($data = mysqli_fetch_assoc($query)){
        echo "<tr>";
        echo "<td>".$data['nomeBanco']."</td>";
        echo "<td>".$data['numeroAgencia']."</td>";
        echo "<td>".$data['endereco']."</td>";
        echo "<td>".$data['bandeira']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function gerarNumeroConta(){
    do{
        $numero = rand(1000000, 9999999);
        $query = "SELECT COUNT(0) FROM list_accounts WHERE numeroConta = '$numero'";
        $result = mysqli_fetch_row(mysqli_query($GLOBALS['conexao'], $query));
    } while($result[0] == 1);
    return $numero;
}