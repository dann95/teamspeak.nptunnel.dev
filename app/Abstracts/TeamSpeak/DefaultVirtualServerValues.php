<?php

namespace NpTS\Abstracts\TeamSpeak;


/**
 * Class DefaultVirtualServerValues
 * This class only return arrays with defaults values to create
 * virtual servers.
 * @package NpTS\Abstracts\TeamSpeak
 */
class DefaultVirtualServerValues
{
    /**
     * Get Array With default Preferences for Virtual Server
     * @return array
     */
    public function preferences()
    {
        return [
            "virtualserver_name"    =>  "GameSpeak.com.br - Qualidade em TeamSpeak",
            "virtualserver_gfx_url" =>  "http://i.imgur.com/hvkjRBd.jpg",
            "virtualserver_hostbutton_tooltip"  =>  "GameSpeak",
            "virtualserver_hostbanner_url" => "http://www.nptunne.com",
            "virtualserver_hostbanner_gfx_url" => "http://i.imgur.com/JeAmgcK.jpg",
            "virtualserver_hostbanner_gfx_interval" => 0,
            "virtualserver_hostbanner_mode" => 1,


        ];
    }

}