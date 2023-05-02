<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicie a sessão
session_start();

// Inclua o arquivo com as credenciais do Firebase
include_once 'firebase_config.php';

// Verifique se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtenha os valores dos campos
  $nickname = $_POST['nickname'];
  $senha = $_POST['senha'];

  // Faça a consulta no banco de dados
  $usersRef = $database->getReference('usuarios');
  $query = $usersRef->orderByChild('nick')->equalTo($nickname);
  $result = $query->getValue();

  // Verifique se o usuário foi encontrado e se a senha está correta
  if ($result) {
    foreach ($result as $key => $value) {
      if ($value['senha'] == $senha) {
        // Armazene o ID do usuário na sessão
        $_SESSION['user_id'] = $key;

        // Redirecione para a página principal
        header('Location: teste.php');
        exit();
      }
    }
  }

  // Se as credenciais estiverem incorretas, exiba uma mensagem de erro
  $error_message = 'Nickname ou senha incorretos';
}
?>


<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <?php if (isset($error_message)): ?>
    <p><?php echo $error_message; ?></p>
  <?php endif; ?>
  <form method="POST">
    <label for="nickname">Nickname:</label>
    <input type="text" name="nickname" id="nickname" required>
    <br>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>
    <br>
    <button type="submit">Login</button>
  </form>
</body>
</html>
