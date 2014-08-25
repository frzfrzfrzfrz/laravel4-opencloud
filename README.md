## Laravel 4.1 Package for the Rackspace/Openstack PHP SDK

Disclaimer: I'm new to this, and there may be problems.

## Installation
* Add `'Unm\Laravel\OpenCloud\OpenCloudServiceProvider'` to your providers
* Add `'OpenCloud'   => 'Unm\Laravel\OpenCloud\OpenCloudFacade'` to your aliases

## Configuration
* Publish the configs with `php artisan config:publish unm/laravel4-opencloud`