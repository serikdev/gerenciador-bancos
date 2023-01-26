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

function criarConta($nomeBanco, $nomeCliente, $CPF, $enderecoCliente, $numeroConta, $numeroAgencia){
    $insert = "INSERT INTO list_accounts (nomeBanco, nomeCliente, CPF, enderecoCliente, numeroConta, numeroAgencia) ";
    $values = "VALUES ('$nomeBanco','$nomeCliente','$CPF','$enderecoCliente','$numeroConta',$numeroAgencia);";
    $sqlInserir = $insert . $values;
    $query = mysqli_query($GLOBALS['conexao'], $sqlInserir);
    return $query;
}

function excluirConta($numeroConta){
    $sqlDelete = "DELETE FROM list_accounts WHERE numeroConta = $numeroConta;";
    $query = mysqli_query($GLOBALS['conexao'], $sqlDelete);
    return $query;
}

function depositar($numeroConta, $valor){
    $dinheiroConta = mysqli_query($GLOBALS['conexao'], "SELECT dinheiroConta FROM list_accounts WHERE numeroConta = $numeroConta;");
    $dinheiroConta += $valor;
    $query = mysqli_query($GLOBALS['conexao'], "UPDATE list_accounts SET dinheiroConta = $dinheiroConta WHERE numeroConta = $numeroConta;");
    return $query;
}

function sacar($numeroConta, $valor){
    $dinheiroConta = mysqli_query($GLOBALS['conexao'], "SELECT dinheiroConta FROM list_accounts WHERE numeroConta = $numeroConta;");
    $dinheiroConta -= $valor;
    $query = mysqli_query($GLOBALS['conexao'], "UPDATE list_accounts SET dinheiroConta = $dinheiroConta WHERE numeroConta = $numeroConta;");
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

        return "Tranferência Realizada com Sucesso.";
    }
    else {
        return "Para realizar tranferencias é necessário que as duas contas pertensão ao mesmo banco.";
    }
}

function pesquisarConta($nomeCliente){
    $pesquisaCliente = "SELECT * FROM list_accounts WHERE nomeCliente = '$nomeCliente';";
    $query = mysqli_query($GLOBALS['conexao'], $pesquisaCliente);
    criarTabela($query);
}

function listarContasBanco($nomeBanco){
    $listaContas = "SELECT * FROM list_accounts WHERE nomeBanco = '$nomeBanco';";
    $query = mysqli_query($GLOBALS['conexao'], $listaContas);
    criarTabela($query);
}

function criarTabela($query){
    echo "<table>
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
