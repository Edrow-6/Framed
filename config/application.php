<?php
return array(
    'setup' => false,
    'name' => 'Framed',
    'debug' => true,
    'url' => 'http://localhost',
    'database' => array(
        'driver' => 'mysql',
        'host' => 'dawbee.fr',
        'name' => 'framed_db',
        'user' => 'edrow',
        'password' => 'edrowpass',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ),
    'logger' => array(
        'error' => array(
            'enabled' => true,
            'details' => true,
        ),
        'name' => 'framed',
        'path' => 'D:\\Utilisateurs\\Edrow\\Documents\\Developpement\\WebProjects\\Framed\\core/../tmp/logs/app.log',
        'level' => 100,
    ),
    'plugins' => array(
        'Example' => true,
    ),
);
