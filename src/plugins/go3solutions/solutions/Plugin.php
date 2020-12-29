<?php namespace Go3solutions\Solutions;

use Go3solutions\Solutions\Components\Portfolio;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            Portfolio::class => 'portfolio'
        ];
    }

    public function registerSettings()
    {
    }
}
