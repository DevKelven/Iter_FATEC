<?php
// Conexão com o banco de dados
$servername = "localhost"; // Ou IP do servidor
$username = "root"; // Usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "cadastro_iter"; // Nome do banco de dados

// Criar conexão
$conexao = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['userType'];
    $ra = $_POST['ra'];
    $senha = $_POST['password'];

    // Prevenir SQL Injection usando Prepared Statements
    $userType = $conexao->real_escape_string($userType);
    $ra = $conexao->real_escape_string($ra);

    // Buscar usuário no banco de dados
    $sql = "SELECT * FROM cadastros WHERE ra = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $ra); // 's' para string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obter os dados do usuário
        $user = $result->fetch_assoc();

        // Verificar a senha
        if (password_verify($senha, $user['senha'])) {
            // Login bem-sucedido
            session_start();
            $_SESSION['userType'] = $user['userType'];
            $_SESSION['ra'] = $user['ra'];

            // Redirecionar com base no tipo de usuário
            if ($user['userType'] === 'aluno') {
                header("Location: aluno_dashboard.php");
                exit;
            }
        } 

            echo "<script>
                alert('Login realizado com sucesso!');
                window.location.href = 'index.html'; // Redireciona para a página inicial ou onde preferir
              </script>";
        } else {
    
            echo "<script>
                alert('Erro ao entrar: " . mysqli_error($conexao) . "');
              </script>";
        }
    

    $stmt->close();
}

// Fechar a conexão
$conexao->close();
?>

