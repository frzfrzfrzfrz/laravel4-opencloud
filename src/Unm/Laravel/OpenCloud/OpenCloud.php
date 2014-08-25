<?php

namespace Unm\Laravel\OpenCloud;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use OpenCloud\Rackspace;
use OpenCloud\OpenStack;

class OpenCloud {

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getRackspace()
    {
        $client = new Rackspace($this->config['rackspace']['endpoint'], $this->config['rackspace']['auth']);
        return $this->checkCache($client);
    }

    public function getOpenStack()
    {
        $client = new OpenStack($this->config['openstack']['endpoint'], $this->config['openstack']['auth']);
        return $this->checkCache($client);
    }

    private function checkCache($client)
    {
        if ($token = Cache::get(get_class($client).'.token')) {
            $client->importCredentials($token);
        }

        $token = $client->getTokenObject();

        if (!$token || ($token && $token->hasExpired())) {
            $client->authenticate();
            Cache::forever(get_class($client).'.token', $client->exportCredentials());
        }

        return $client;
    }

}