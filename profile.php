<?php
// Precisamos usar sessões, então você deve sempre iniciar sessões usando o código abaixo.
session_start();
// Se o usuário não estiver logado redireciona para a página de login...
if (!isset($_SESSION['loggedin'])) {
header('Local: index.html');
exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'raiz';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
exit('Falha ao conectar ao MySQL: ' . mysqli_connect_error());
}
// Não temos as informações de senha ou e-mail armazenadas nas sessões, então podemos obter os resultados do banco de dados.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// Nesse caso, podemos usar o ID da conta para obter as informações da conta.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($senha, $email);
$stmt->fetch();
$stmt->close();
?>
 
<!DOCTYPE html>
<html>
<cabeça>
<meta charset="utf-8">
<title>Página de perfil</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<nav class="navtop">
<div>
<h1>Título do site</h1>
<a href="profile.php"><i class="fas fa-user-circle"></i>Perfil</a>
<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
</div>
</nav>
<div class="conteúdo">
<h2>Página de perfil</h2>
<div>
<p>Os detalhes da sua conta estão abaixo:</p>
<tabela>
<tr>
<td>Nome de usuário:</td>
<td><?=$_SESSION['name']?></td>
</tr>
<tr>
<td>Senha:</td>
<td><?=$senha?></td>
</tr>
<tr>
<td>E-mail:</td>
<td><?=$email?></td>
</tr>
</table>
</div>
</div>
</body>
</html>
