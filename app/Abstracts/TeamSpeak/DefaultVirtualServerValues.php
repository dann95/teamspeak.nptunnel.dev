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

        ];
    }

}