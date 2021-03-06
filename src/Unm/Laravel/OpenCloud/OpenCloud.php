<?php

namespace Unm\Laravel\OpenCloud;

use OpenCloud\Rackspace;
use OpenCloud\OpenStack;
use OpenCloud\Image\Service as ImageService;
use OpenCloud\Compute\Service as ComputeService;

class OpenCloud {

    private $config;
    private $client;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getRackspace()
    {
        return new Rackspace($this->config['rackspace']['endpoint'], $this->config['rackspace']['auth']);
    }

    /**
     * @return OpenStack
     */
    public function getOpenStack()
    {
        if (!$this->client) {
            $this->client = new OpenStack($this->config['openstack']['endpoint'], $this->config['openstack']['auth']);
            $this->client->authenticate();
        }
        return $this->client;
    }
    
    /**
     * @return ImageService
     */
    public function imageService()
    {
        $imageService = $this->getOpenStack()->imageService('glance', 'RegionOne');
        /* @var $imageService ImageService */
        $imageService->getEndpoint()->getPublicUrl()->setPath('/v2.0'); // fix url
        return $imageService;
    }
    
    /**
     * @return ComputeService
     */
    public function computeService()
    {
        return $this->getOpenStack()->computeService('nova', 'RegionOne');
    }

    public function networkCollection($filters = [])
    {
        $compute = $this->computeService('nova', 'RegionOne');

        $url = $compute->getUrl('os-networks', $filters);

        return $compute->collection('OpenCloud\Compute\Resource\Network', $url);
    }

    /**
     * I didn't find appropriate collection for handling requests for floating-ips
     */
    public function floatingIpsCollection($filters = [])
    {
        $os    = $this->getOpenStack();
        $token = $os->getToken();

        $compute = $os->computeService('nova', 'RegionOne');

        $obj = $compute->getUrl('os-floating-ips', $filters);

        $client = new \Guzzle\Http\Client();

        $request = $client->get((string)$obj);
        $request->addHeader('X-Auth-Token', $token);
        $request->addHeader('Content-Type', 'application/json');
        $request->addHeader('Accept', 'application/json');
        $response = $request->send();

        $ips = json_decode($response->getBody(), true);

        return $ips;
    }
}
