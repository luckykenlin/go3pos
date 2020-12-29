<?php namespace Go3solutions\Contact;

use Go3solutions\Contact\Components\ContactForm;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            ContactForm::class => 'contactform'
        ];
    }

    public function registerSettings()
    {
    }
}
