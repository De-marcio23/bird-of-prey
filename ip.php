<?php
// Capturar o IP do visitante
$ip = $_SERVER['REMOTE_ADDR'];

// Opcional: Capturar mais detalhes sobre o agente do usuário (navegador, sistema operacional, etc.)
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Logar a data e hora do acesso
$date = date("Y-m-d H:i:s");

// Salvar o IP, agente do usuário e a data em um arquivo de log
$file = fopen("ip_log.txt", "a");
fwrite($file, "IP: " . $ip . " - Data: " . $date . " - Agente: " . $user_agent . "\n");
fclose($file);

// Exibir o IP para confirmação (opcional)
echo "O IP do visitante é: " . $ip;

// Caso queira redirecionar após capturar o IP, descomente a linha abaixo
// header('Location: https://SEU-SITE-AQUI'); 
?>
