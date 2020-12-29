<?php namespace Go3solutions\Career;

use Go3solutions\Career\Components\CareerJob;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            CareerJob::class => 'careerjob'
        ];
    }

    public function registerSettings()
    {
    }
}
