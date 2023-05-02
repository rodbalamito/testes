<?php

// Inicie a sessão
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
  // Redirecione para a página de login
  header('Location: login.php');
  exit();
}
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withDatabaseUri('https://teste-c7714-default-rtdb.firebaseio.com')
    ->withServiceAccount('/home1/revistaquilombo/public_html/csgo/teste-c7714-firebase-adminsdk-bvizn-85b764494f.json');

$database = $factory->createDatabase();

$reference = $database->getReference('pickban');



$data = $reference->getValue();
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSGO Map Veto</title>

    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="estilo.css">
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <main id="app">
        <header>
            <span>Time 1</span>
            <span>VS</span>
            <span>Time 2</span>
        </header>

        <div id="teamVeto">
            <hr>
            <span id="teamVetoText">É a vez do Time 1 banir o mapa!</span>
            <hr>
        </div>

        <div id="vetoContainer">
          
     <?php foreach ($data as $pickban): ?>
    <div id="<?php echo $pickban['id'] ?>" class="<?php echo $pickban['class'] ?>" onclick="atualizarClass('<?php echo $pickban['nome'] ?>')">
        <div class="banText"><span>Banir</span></div>
        <div class="banIcon"><i class="fas fa-times"></i></div>
        <img class="<?php echo $pickban['classimg'] ?>" src="<?php echo $pickban['imagem'] ?>" alt="<?php echo $pickban['nome'] ?> Map Image" draggable="false">
        <div class="mapName">
            <span class="nameOfTheMap"><?php echo $pickban['nome'] ?></span>
        </div>
    </div>
<?php endforeach; ?>


<script>
  // Initialize Firebase
  var firebaseConfig = {
      apiKey: "AIzaSyDPh3IhbHcm00HUEKgUiqBLt8u4Um0o7hI",
    authDomain: "teste-c7714.firebaseapp.com",
    databaseURL: "https://teste-c7714-default-rtdb.firebaseio.com",
    projectId: "teste-c7714",
    storageBucket: "teste-c7714.appspot.com",
    messagingSenderId: "39003542966",
    appId: "1:39003542966:web:228c5af9f7fa5c46599d17"
  };
  firebase.initializeApp(firebaseConfig);
  var database = firebase.database();

  // Obtém uma referência para o nó pickban no banco de dados
  var pickbanRef = firebase.database().ref('pickban');

  // Adiciona um listener para atualizar o HTML quando o valor da classe muda no banco de dados
  pickbanRef.on('child_changed', function(snapshot) {
    var data = snapshot.val();
    var element = document.getElementById(data.id);
    element.className = 'card scaleAnimation ' + data.class;
    element.getElementsByTagName('img')[0].className = data.classimg;
  });

  function atualizarClass(nomeDoMapa) {
    // Obtém uma referência para o nó correspondente no banco de dados
    var ref = firebase.database().ref('pickban').child(nomeDoMapa);

    // Atualiza o valor dos campos class e classimg
    ref.update({
      class: "card selected",
      classimg: "mapImg mapImgAfterSelected"
    });
  }
</script>




        </div>
    </main>
</body>




</html>
