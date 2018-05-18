<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Path to the stub files for the generator
    |--------------------------------------------------------------------------
    */
    'path' => CristianVuolo\ModuleGenerator\GeneratorHelpers::getPath(),

    /*
    |--------------------------------------------------------------------------
    | Default namespaces for the classes
    |--------------------------------------------------------------------------
    | Warning! Root application namespaсe (like "App") should be skipped.
    */
    'namespaces' => [
        'channel'      => '\Broadcasting',
        'command'      => '\Console\Commands',
        'controller'   => '',
        'event'        => '\Events',
        'exception'    => '\Exceptions',
        'job'          => '\Jobs',
        'listener'     => '\Listeners',
        'mail'         => '\Mail',
        'middleware'   => '\Http\Middleware',
        'model'        => '',
        'notification' => '\Notifications',
        'policy'       => '\Policies',
        'provider'     => '\Providers',
        'request'      => '\Http\Requests',
        'resource'     => '\Http\Resources',
        'rule'         => '\Rules',
    ],

];
