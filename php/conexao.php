<?php
    // Configuração do banco de dados
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'cadastro_iter';

    // Cria conexão com o banco de dados
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Verifica se a conexão foi bem-sucedida
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Consulta SQL
    $sql = "SELECT * FROM cadastros";
    $resultado = $conexao->query($sql);

    // Verifica se a consulta foi bem-sucedida
    if ($resultado) {
        // Exibe o número de registros encontrados
        echo "Número de registros encontrados: " . $resultado->num_rows;
    } else {
        // Exibe mensagem de erro caso a consulta falhe
        echo "Erro ao executar a consulta: " . $conexao->error;
    }
    
?>