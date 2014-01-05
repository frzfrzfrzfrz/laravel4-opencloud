<?php

namespace Unm\Laravel\OpenCloud;

use App, Input, View, Redirect, Config;
use Illuminate\Routing\Controllers;

use OpenCloud\Common\Exceptions;


class OpenCloudController extends \BaseController {

    public function index()
    {
        $oc = App::make('opencloud')->getRackspace();

//        dd($oc);

        $service = $oc->objectStoreService('cloudFiles');

        $containerList = $service->listContainers();

        while ($container = $containerList->next()) {
            dd($oc);
        }

        return View::make('opencloud::index');
    }

}
