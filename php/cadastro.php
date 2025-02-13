<?php
if (isset($_POST['submit'])) {
    print_r($_POST['name']);
    print_r($_POST['birthdate']);
    print_r($_POST['phone']);
    print_r($_POST['email']);
    print_r($_POST['password']);
    print_r($_POST['rg']);
    print_r($_POST['cpf']);
    print_r($_POST['responsavel-name']);
    print_r($_POST['responsavel-phone']);
    print_r($_POST['responsavel-email']);
    print_r($_POST['logradouro']);
    print_r($_POST['numero']);
    print_r($_POST['bairro']);
    print_r($_POST['cep']);
    print_r($_POST['cidade']);
    print_r($_POST['instituicao']);
    print_r($_POST['curso']);
    print_r($_POST['periodo']);
    print_r($_POST['cidade-instituicao']);
    print_r($_POST['ra']);

    include_once('conexao.php');

    $nome = $_POST['name'];
    $data_nasc = $_POST['birthdate'];
    $email = $_POST['phone'];
    $telefone = $_POST['email'];
    $senha = $_POST['password'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $nome_inst = $_POST['instituicao'];
    $curso = $_POST['curso'];
    $periodo = $_POST['periodo'];
    $cidade_inst =
        $RA = $_POST['ra'];
    $nome_resp = $_POST['responsavel-name'];
    $celular_resp = $_POST['responsavel-phone'];
    $email_resp = $_POST['responsavel-email'];

    $sql = "INSERT INTO cadastros 
    (nome, data_nasc, telefone, email, senha, rg, cpf, logradouro, numero, bairro, cep, cidade, nome_inst, curso, periodo, cidade_inst, RA, nome_resp, celular_resp, email_resp) 
    VALUES 
    ('$nome', '$data_nasc', '$telefone', '$email', '$senha', '$rg', '$cpf', '$logradouro', '$numero', '$bairro', '$cep', '$cidade', '$nome_inst', '$curso', '$periodo', '$cidade_inst', '$RA', '$nome_resp', '$celular_resp', '$email_resp')";



    if (mysqli_query($conexao, $sql)) {

        echo "<script>
            alert('Cadastro realizado com sucesso!');
            window.location.href = 'index.html'; // Redireciona para a página inicial ou onde preferir
          </script>";
    } else {

        echo "<script>
            alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');
          </script>";
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="shortcut icon" type="imagex/png" href="../image/LOGO.png">
    <title>Cadastro de Aluno</title>
</head>

<body>
    <main>
        <form class="register-container" action="cadastro.php" method="POST" enctype="multipart/form-data">
            <h1>Cadastro de Aluno</h1>

            <!-- Dados Pessoais -->
            <h2>Dados Pessoais</h2>
            <div class="dados-pessoais">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" required>

                <label for="birthdate">Data de Nascimento</label>
                <input type="date" id="birthdate" name="birthdate" required oninput="checkAge()">

                <label for="phone">Celular com WhatsApp</label>
                <input type="tel" id="phone" name="phone" required pattern="[0-9]{11}" title="Digite um número válido com 11 dígitos.">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required minlength="6">

                <label for="rg">RG</label>
                <input type="text" id="rg" name="rg" required>

                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" required pattern="[0-9]{11}" title="Digite um CPF válido com 11 dígitos.">

                <!-- Campos dos Responsáveis (inicialmente ocultos) -->
                <div id="responsavel-section" style="display: none;">
                    <h3>Responsável</h3>
                    <label for="responsavel-name">Nome Completo do Responsável</label>
                    <input type="text" id="responsavel-name" name="responsavel-name" required>

                    <label for="responsavel-phone">Celular do Responsável</label>
                    <input type="tel" id="responsavel-phone" name="responsavel-phone">

                    <label for="responsavel-email">Email do Responsável</label>
                    <input type="email" id="responsavel-email" name="responsavel-email">

                    <!-- Termo de Autorização -->
                    <div id="termo-autorizacao" style="display: none;">
                     <p> <input type="checkbox" id="termo-checkbox" required> Eu autorizo o transporte do aluno e estou ciente dos riscos.</p>
                        
                    </div>
                </div>


            </div>

            <!-- Dados de Endereço -->
            <div class="dados-endereco">
                <h2>Dados de Endereço</h2>
                <label for="logradouro">Logradouro</label>
                <input type="text" id="logradouro" name="logradouro" required>

                <label for="numero">Número</label>
                <input type="text" id="numero" name="numero" required>

                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" required>

                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" required>

                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" required>
            </div>

            <!-- Dados da Instituição Educacional -->
            <div class="dados-instituicao">
                <h2>Dados da Instituição Educacional</h2>
                <label for="instituicao">Nome da Instituição</label>
                <input type="text" id="instituicao" name="instituicao" required>

                <label for="curso">Curso</label>
                <input type="text" id="curso" name="curso" required>

                <label for="periodo">Período</label>
                <input type="text" id="periodo" name="periodo" required>

                <label for="cidade-instituicao">Cidade da Instituição</label>
                <input type="text" id="cidade-instituicao" name="cidade-instituicao" required>

                <label for="ra">RA do Aluno</label>
                <input type="text" id="ra" name="ra" required>
            </div>

            <!-- Anexos de Documentos (comentado por enquanto) 
            <div class="anexos-documentos">
                <h2>Anexos de Documentos</h2>
                <label for="foto-documento">Documento com Foto</label>
                <input type="file" id="foto-documento" name="foto-documento" accept=".pdf,.jpg,.png" required>

                <label for="comprovante-residencia">Comprovante de Residência</label>
                <input type="file" id="comprovante-residencia" name="comprovante-residencia" accept=".pdf,.jpg,.png" required>

                <label for="matricula-instituicao">Matrícula da Instituição</label>
                <input type="file" id="matricula-instituicao" name="matricula-instituicao" accept=".pdf,.jpg,.png" required>

                Documentos Extras para Menores de 18 Anos 
                <div id="documentos-responsavel" style="display: none;">
                    <label for="foto-responsavel">Documento com Foto do Responsável</label>
                    <input type="file" id="foto-responsavel" name="foto-responsavel" accept=".pdf,.jpg,.png">

                    <label for="certidao-nascimento">Certidão de Nascimento do Aluno</label>
                    <input type="file" id="certidao-nascimento" name="certidao-nascimento" accept=".pdf,.jpg,.png">
                </div>
            </div> -->

            <button class="cadastrobtn" type="submit" name="submit">Enviar</button>
        </form>

        <!-- Acessibilidade -->
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
    </main>
    <footer style="padding: 135px 0 0;">
                <hr>
                <p>&copy; JSS DESENVOLVIMENTO</p>
            </footer>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="../JS/script.js"></script>
</body>

</html>