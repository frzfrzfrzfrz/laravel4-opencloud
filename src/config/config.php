<?php
use OpenCloud\Rackspace;

return array(

    'rackspace' => array(
        'endpoint' => Rackspace::US_IDENTITY_ENDPOINT, // or Rackspace::UK_IDENTITY_ENDPOINT for London
        'auth'     => array(
            'username' => 'username',
            'apiKey'  => 'apikey'
        )
    ),

    'openstack' => array(
        'endpoint' => '',
        'auth'     => array(
            'username' => 'yourunsername',
            'password' => 'yourpassword'
        )
    ),

    'publish_routes' => true,

    'route_prefix' => 'opencloud'


);