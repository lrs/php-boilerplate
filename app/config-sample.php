<?php
return [
    'database'   => [
        'RDBMS'    => 'mysql',
        'host'     => '[server_address]',
        'database' => '[db_name]',
        'username' => '[db_user]',
        'password' => '[db_password]',
        'options'  => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'session' => [
        'type' => 'database',
        'table' => 'session_table',
        'lifetime' => '21',
        'encrypt' => false
    ]
];
