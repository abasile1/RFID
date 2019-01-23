<?php
class TcpClient
{
    private $address;
    private $port;
    private $socket;

    /*  initialise $address et $port et crée le socket  */
    public function __construct($address,$port)
    {
        $this->address=$address;
        $this->port=$port;

        /* Crée un socket TCP/IP. */
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($this->socket === false) {
            echo "socket_create() a échoué : raison :  " . socket_strerror(socket_last_error()) . "\n";
        } 
    }

    /*  Se connecte  au server tcp/ip  retourne true si bon */
    public function connect()
    {
        $result = socket_connect($this->socket,$this->address,$this->port);
        if ($this->socket === false) {
            echo "socket_connect() a échoué : raison : ($result) " . socket_strerror(socket_last_error($this->socket)) . "\n";
            return false;
        } 
        else {
            return true;
        }
    }
    /* envoie une requete au serveur tcp/ip */
    public function request($requete)
    {
        socket_write($this->socket,$requete, strlen($requete));
    }
    
    /* attend une reponse du seveur tcp/ip retourne la reponse */
    public function answer()
    {
        while ($out = socket_read($this->socket, 2048)) {
            return $out;
        }
        
    }
    /* se deconnecte du serveur tcp/Ip est ferme la socket */
    public function disconnect()
    {
        socket_close($this->socket);
    }
}
?>