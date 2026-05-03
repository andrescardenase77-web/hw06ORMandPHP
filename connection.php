<?php
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'pgsql',
    'host'      => 'aws-1-us-east-1.pooler.supabase.com',
    'database'  => 'postgres',
    'username'  => 'postgres.ukxilwyncxikljjzeehg',
    'password'  => 'NX?y4C+9*4n',
    'port'      => '5432',
    'charset'   => 'utf8',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();