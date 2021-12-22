<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => '(DESCRIPTION=
                (ADDRESS=(PROTOCOL=tcp)(HOST=10.20.33.42)(PORT=1521))
            (CONNECT_DATA=
                (SID=TC319P)
            )
        )',
        'host'           => env('DB_HOST_ORA', '10.20.33.42'),
        'port'           => env('DB_PORT_ORA', '1521'),
        'database'       => env('DB_DATABASE_ORA', 'TC319P'),
        'username'       => env('DB_USERNAME_ORA', 'cb'),
        'password'       => env('DB_PASSWORD_ORA', 'wasserflasche'),
        'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
    ],
];
