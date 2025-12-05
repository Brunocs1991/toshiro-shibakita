<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toshiro Shibakita - Microsserviços</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #667eea;
            text-align: center;
            margin-bottom: 10px;
        }
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-style: italic;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .info-box strong {
            color: #667eea;
        }
        .success {
            background: #d4edda;
            border-left-color: #28a745;
            color: #155724;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .error {
            background: #f8d7da;
            border-left-color: #dc3545;
            color: #721c24;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚔️ Toshiro Shibakita ⚔️</h1>
        <p class="subtitle">Sistema de Microsserviços com Docker</p>

        <?php
        ini_set("display_errors", 1);
        header('Content-Type: text/html; charset=utf-8');

        echo '<div class="info-box">';
        echo '<strong>Versão do PHP:</strong> ' . phpversion() . '<br>';
        echo '</div>';

        // Configurações do banco de dados via variáveis de ambiente
        $servername = getenv('DB_HOST') ?: "mysql";
        $username = getenv('DB_USER') ?: "root";
        $password = getenv('DB_PASSWORD') ?: "Senha123";
        $database = getenv('DB_NAME') ?: "meubanco";

        // Criar conexão
        $link = new mysqli($servername, $username, $password, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
            echo '<div class="error">';
            printf("Erro na conexão: %s\n", mysqli_connect_error());
            echo '</div>';
            exit();
        }

        echo '<div class="success">';
        echo '<strong>✓ Conexão com banco de dados estabelecida!</strong><br>';
        echo '</div>';

        // Gerar dados aleatórios
        $valor_rand1 = rand(1, 999);
        $valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
        $host_name = gethostname();

        // Inserir dados no banco
        $query = "INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) VALUES ('$valor_rand1', '$valor_rand2', '$valor_rand2', '$valor_rand2', '$valor_rand2', '$host_name')";

        if ($link->query($query) === TRUE) {
            echo '<div class="success">';
            echo '<strong>✓ Registro criado com sucesso!</strong><br>';
            echo 'ID: ' . $valor_rand1 . '<br>';
            echo 'Nome: ' . $valor_rand2 . '<br>';
            echo 'Host: ' . $host_name . '<br>';
            echo '</div>';
        } else {
            echo '<div class="error">';
            echo '<strong>✗ Erro:</strong> ' . $link->error;
            echo '</div>';
        }

        // Exibir últimos registros
        $result = $link->query("SELECT * FROM dados ORDER BY AlunoID DESC LIMIT 5");
        if ($result && $result->num_rows > 0) {
            echo '<div class="info-box">';
            echo '<strong>Últimos 5 registros:</strong><br><br>';
            echo '<table style="width:100%; border-collapse: collapse;">';
            echo '<tr style="background: #667eea; color: white;">';
            echo '<th style="padding: 8px; text-align: left;">ID</th>';
            echo '<th style="padding: 8px; text-align: left;">Nome</th>';
            echo '<th style="padding: 8px; text-align: left;">Host</th>';
            echo '</tr>';
            
            while($row = $result->fetch_assoc()) {
                echo '<tr style="border-bottom: 1px solid #ddd;">';
                echo '<td style="padding: 8px;">' . $row['AlunoID'] . '</td>';
                echo '<td style="padding: 8px;">' . $row['Nome'] . '</td>';
                echo '<td style="padding: 8px;">' . $row['Host'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
        }

        $link->close();
        ?>
    </div>
</body>
</html>

