<?php
// APAGAR IMEDIATAMENTE APÓS O USO
$nova_senha = 'Asernet@2026';
$hash = password_hash($nova_senha, PASSWORD_BCRYPT);
header('Content-Type: text/plain');
echo "Nova senha: " . $nova_senha . "\n";
echo "Hash gerada no servidor (PHP " . phpversion() . "):\n";
echo $hash . "\n\n";
echo "SQL para rodar no phpMyAdmin:\n";
echo "UPDATE admin_usuarios SET senha = '" . $hash . "' WHERE email = 'erikprimao@gmail.com';";
