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

    /**
     * @param $credentials
     * @param null $port
     * @return \TeamSpeak3\Adapter\AbstractAdapter
     */
    private function connect($credentials)
    {
        return TeamSpeak3::factory('serverquery://'.$credentials['user'].':'.$credentials['password'].'@'.$credentials['ip'].':10011/#no_query_clients');
    }

    /**
     * @param array $options
     * @return array
     */
    public function createServer(array $options)
    {
        return $this->ts->serverCreate($options);
    }

    public function selectServer($sid)
    {
        foreach($this->ts->serverList() as $server)
        {
            if($server->virtualserver_id == $sid)
            {
                return $server;
            }
        }
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