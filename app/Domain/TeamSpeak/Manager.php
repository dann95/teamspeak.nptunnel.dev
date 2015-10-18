<?php

namespace NpTS\Domain\TeamSpeak;

use TeamSpeak3\TeamSpeak3;


class Manager
{
    private $ts;
    private $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
        $this->ts = $this->connect($credentials);
    }

    private function connect($credentials , $port = NULL)
    {
        if ($port == NULL)
            return TeamSpeak3::factory('serverquery://'.$credentials['user'].':'.$credentials['password'].'@'.$credentials['ip'].':10011/#no_query_clients');


        return TeamSpeak3::factory('serverquery://'.$credentials['user'].':'.$credentials['password'].'@'.$credentials['ip'].':10011/?server_port='.$port.'#no_query_clients');
    }




    public function createServer(array $options)
    {
        /**
         * @todo try create a new server
         */
        return $this->ts->serverCreate(array(
            "virtualserver_name" => "My TeamSpeak 3 Server",
            "virtualserver_maxclients" => 64,
            "virtualserver_hostbutton_tooltip" => "My Company",
            "virtualserver_hostbutton_url" => "http://www.example.com",
            "virtualserver_hostbutton_gfx_url" => "http://www.example.com/buttons/button01_24x24.jpg",
        ));
    }

    public function selectServer($port)
    {
        $this->ts = $this->connect($this->credentials , (int) $port);
        return $this;
    }

    /**
     * List all clients on array.
     * @return Array
     */
    public function listClients()
    {
        return $this->ts->clientList();
    }

    /**
     * Return the name of the server (virtual)
     * @return string
     */
    public function getServerName()
    {
        return $this->getServerPropiety("virtualserver_name");
    }

    /**
     * Set a new name for a the server (virtual)
     * @param $name
     * @return Manager
     */
    public function setServerName($name)
    {
        return $this->setServerPropiety('virtualserver_name' , $name);
    }

    /**
     * Start one server by him ServerId;
     * @param $sid
     * @return $this
     */
    public function startServerBySid($sid)
    {
        $this->ts->serverStart($sid);
        return $this;
    }

    /**
     * Stop the current server (virtual).
     * @return null
     */
    public function stop()
    {
        return $this->ts->serverStop($this->ts->serverSelectedId());
    }

    /**
     * Set a propiety of the server (virtual)
     * @param $propiety
     * @param $value
     * @return $this
     */
    private function setServerPropiety($propiety , $value)
    {
        $this->ts[$propiety] = $value;
        return $this;
    }

    /**
     * Return a propiety of the server (virtual)
     * @param $propiety
     * @return mixed
     */
    private function getServerPropiety($propiety)
    {
        return $this->ts[$propiety];
    }

}