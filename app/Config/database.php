<?php
/**
 * Group Deal
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    GroupDeal
 * @subpackage Core
 * @author     Agriya <info@agriya.com>
 * @copyright  2018 Agriya Infoway Private Ltd
 * @license    http://www.agriya.com/ Agriya Infoway Licence
 * @link       http://www.agriya.com
 */
class DATABASE_CONFIG
{
    // For localhost i.e., development -->
    // *** Note: Do not edit $default and $master for server DB config
    var $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'ahsan123',
        'database' => 'groupdeal',
        'prefix' => '',
        'encoding' => 'UTF8',
        'port' => ''
    );
    // Master & slave: http://groups.google.com/group/cake-php/msg/fdff3040db8f9cf6
    var $master = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'ahsan123',
        'database' => 'groupdeal',
        'prefix' => '',
        'encoding' => 'UTF8',
        'port' => ''
    );
    // <-- localhost
    // For server i.e., production -->
    // if there is no master/slave, set the values same to both
    var $server_default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'ahsan123',
        'database' => 'groupdeal',
        'prefix' => '',
        'encoding' => 'UTF8',
        'port' => ''
    );
    var $server_master = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'ahsan123',
        'database' => 'groupdeal',
        'prefix' => '',
        'encoding' => 'UTF8',
        'port' => ''
    );
    // <-- server
    function __construct() 
    {
        // When running on production server, switch the db config ...
        if (empty($_SERVER['SERVER_ADDR']) || $_SERVER['SERVER_ADDR'] != '127.0.0.1') {
            $this->default = $this->server_default;
            $this->master = $this->server_master;
        }
    }
}
?>