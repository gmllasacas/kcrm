<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

#COMMON
//$db['default']['hostname'] = getenv('PROD_DB_HOSTNAME');
//$db['default']['username'] = getenv('PROD_USERNAME');
//$db['default']['password'] = getenv('PROD_PASSWORD');
//$db['default']['database'] = getenv('PROD_DATABASE');

$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);
$db['default']['hostname'] = $dbparts['host'];
$db['default']['username'] = $dbparts['user'];
$db['default']['password'] = $dbparts['pass'];
$db['default']['database'] = ltrim($dbparts['path'],'/');

#GENERAL
$db['default']['dsn'] = '';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['encrypt'] = FALSE;
$db['default']['compress'] = FALSE;
$db['default']['stricton'] = FALSE;
$db['default']['failover'] = array();
$db['default']['save_queries'] = TRUE;
