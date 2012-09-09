<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initZFDebug()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('ZFDebug');
        $this->bootstrap('db');
        $options = array(
            'plugins' => array(
            	'Variables', 
                'Database' => array('adapter' => $frontController = $this->getResource('db')), 
                'File' => array('basePath' => 'w:\www\projects\zf-meetup-speedup'),
                'Exception',
        		'Memory', 
                'Time', 
            )
        );
        $debug = new ZFDebug_Controller_Plugin_Debug($options);
        Zend_Registry::set('logger', $debug->getPlugin('Log'));
    
        $this->bootstrap('frontController');
        $frontController = $this->getResource('frontController');
        $frontController->registerPlugin($debug);
    }
}

