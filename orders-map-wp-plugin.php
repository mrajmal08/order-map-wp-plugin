<?php

require_once 'autoload.php';
new Map();
new Orders();

/*
 * Plugin Name: Orders Detail
 * Plugin URI: http://localhost/wordpress
 * Description: Add Short code in your page to run this plugin [orders-detail]
 * Version: 1.0
 * Author: Ajmal
 * Author URI: http://localhost/wordpress
 */


function create_custom_table()
{
    Table::custom_plugin_tables();
    Table::custom_page();

}

register_activation_hook(__FILE__, 'create_custom_table');
