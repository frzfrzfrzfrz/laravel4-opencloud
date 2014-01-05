<?php

namespace Unm\Laravel\OpenCloud;

use Illuminate\Support\Facades\Config;
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
        return new Rackspace($this->config['rackspace']['endpoint'], $this->config['rackspace']['auth']);
    }

    public function getOpenStack()
    {
        return new OpenStack($this->config['openstack']['endpoint'], $this->config['openstack']['auth']);
    }

}