<?php

include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $localizacao = $_POST["localizacao"];
    $nome = $_POST["nomeLocal"];
    $descricao = $_POST["descricaoLocal"];
    $telefone = $_POST["telefone"];
    $redeSocial = $_POST["redeSocial"];
    $site = $_POST["site"];
    $idadeMim = $_POST["idadeMim"];
    $horario_fechamento = $_POST["horario_fechamento"];
    $horario_fechamento = $_POST["horario_fechamento"];

    // Dados do tipo
    $tipoMapping = [
        "restaurante cabin" => 1,
        "restaurante_vegano cabin" => 2,
        "restaurante_opcao_vegana cabin" => 3,
        "cafe cabin" => 4,
        "cafe_vegano cabin" => 5,
        "entreterimento cabin" => 6,
        "pontos_turisticos cabin" => 7
        
    ];
    $tipoSelecionado = $_POST['tipoLocal'];
    $id_tipo = $tipoMapping[$tipoSelecionado];

    // Verifica se as imagens foram enviadas
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // Caminho temporário do arquivo
        $imagem_temp = $_FILES['imagem']['tmp_name'];

        // Abre o arquivo de imagem em modo de leitura binária
        $conteudo_imagem = file_get_contents($imagem_temp);

        // Insere a imagem na tabela 'imagem' como um BLOB
        $sql_imagem = "INSERT INTO imagem (imagem, tipo) VALUES (?, 'Estabelecimento')";
        $stmt_imagem = mysqli_prepare($conn, $sql_imagem);

        if ($stmt_imagem) {
            mysqli_stmt_bind_param($stmt_imagem, 's', $conteudo_imagem);
            if (mysqli_stmt_execute($stmt_imagem)) {
                $id_imagem = mysqli_insert_id($conn);
                
                // verifica se já existe o nome e telefone no banco
                // uso de alert do js
                $sql_check_nome = "SELECT * FROM estabelecimento WHERE nome = '$nome'";
                $result_check_nome = mysqli_query($conn, $sql_check_nome);
                if ($result_check_nome && mysqli_num_rows($result_check_nome) > 0) {
                    echo "<script>
                        alert('O nome já está em uso. Por favor, insira outro nome.');
                        window.location.href = 'cadastroLocal.html';
                    </script>";
                } else {
                    $sql_check_fone = "SELECT * FROM estabelecimento WHERE telefone = '$telefone'";
                    $result_check_fone = mysqli_query($conn, $sql_check_fone);
                    if ($result_check_fone && mysqli_num_rows($result_check_fone) > 0) {
                        echo "<script>
                            alert('O telefone já está em uso. Por favor, insira outro telefone.');
                            window.location.href = 'cadastroLocal.html';
                        </script>";
                        exit();
                    } else {

                        // Insere os dados do estabelecimento na tabela 'estabelecimento'
                        $sql_estabelecimento = "INSERT INTO estabelecimento (localizacao, nome, descricao, telefone, rede_social, site, idadeMinima, horario_abertura, horario_fechamento, imagem_id, id_tipo)
                                VALUES ('$localizacao', '$nome', '$descricao', '$telefone', '$redeSocial', '$site', '$idadeMim', '$horario_abertura', '$horario_fechamento', '$id_imagem', '$id_tipo')";

                        // uso de alert do js
                        if (mysqli_query($conn, $sql_estabelecimento)) {
                            echo '<script>alert("Estabelecimento registrado com sucesso."); window.location.href = "explorarHTML.php";</script>';
                            exit();
                        } else {
                            echo '<script>alert("Erro ao registrar estabelecimento."); window.location.href = "cadastroLocal.html";</script>';
                            exit();
                        }
                    }
                }
            } else {
                echo "Erro ao executar a consulta de inserção de imagem: " . mysqli_error($conn);
            }

            // Fechar a declaração da imagem
            mysqli_stmt_close($stmt_imagem);
        } else {
            echo "Erro ao preparar a consulta de inserção de imagem: " . mysqli_error($conn);
        }
    } else {
        echo "Por favor, selecione pelo menos uma imagem.";
        header("Location: cadastroLocal.html");
        exit();
    }
} else {
    echo "Método inválido para acessar esta página.";
}
?>
