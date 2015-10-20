<?php

namespace NpTS\Abstracts\TeamSpeak;


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
            "virtualserver_gfx_url" =>  "",
            "virtualserver_hostbutton_tooltip"  =>  "GameSpeak",

        ];
    }

}