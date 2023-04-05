<?php
session_start();
session_destroy();
// Redireciona para a página de login:
header('Local: index.html');
?>