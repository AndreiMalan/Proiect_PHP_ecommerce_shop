<?php
echo "intra aici" ;
session_start();
session_destroy();
// Redirectare paginaprincipala produse:
header('Location: index.html');
?>