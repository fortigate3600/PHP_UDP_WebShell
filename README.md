# PHP UDP Web Shell

## Descrizione
Questa repository contiene una web shell scritta in PHP che utilizza UDP per la comunicazione e crittografia AES-256 per proteggere i comandi inviati.

##  Disclaimer
Questo progetto è stato sviluppato per **scopi educativi** e di **ethical hacking**. L'uso non autorizzato di questo software su sistemi di terze parti **è illegale**. L'autore non si assume alcuna responsabilità per un utilizzo improprio.

---

## Funzionalità
- **Shell UDP Bind**: il server PHP resta in ascolto sulla porta specificata.
- **Crittografia AES-256**: i comandi e le risposte sono cifrati.
- **Client interattivo**: il client PHP invia comandi letti da `stdin` e riceve la risposta.

---

##  Setup e Installazione
### Requisiti
- **PHP** con moduli `sockets` e `openssl`
- **Ambiente Linux** (Ubuntu 22.04 consigliato) o Windows con WSL

---

##  Avvio del Server (Bind Shell)
Esegui il server sulla macchina target:
```bash
php udp_shell.php
```
Dovresti vedere:
```
UDP Bind Shell in ascolto sulla porta 4444...
```

---

## 🔗 Connessione con il Client
Esegui il client PHP per inviare comandi:
```bash
php udp_atk.php
```
Scrivi un comando e premi **Invio**:
```
Comando: whoami
Risposta: ingegnere
Comando: ls
Risposta: file1.txt file2.php ...
```
Per uscire:
```
Comando: exit
```


##  Contatti
Per domande o contributi, apri un'**Issue** o un **Pull Request** su GitHub.

