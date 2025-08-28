<?php
/***
 *  @package Ritesite
 *  
 *  Bootstraps the Theme
 */

namespace RITESTAY\Inc;

use RITESTAY\Inc\Traits\Singleton;

class RITESTAY{
    use Singleton;

    protected function __construct()
    {
        //load classes
        $this->set_hooks();
    }

    protected function set_hooks(){
        //actions and filters
    }
}