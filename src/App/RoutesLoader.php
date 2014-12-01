<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    private function instantiateControllers()
    {
        $this->app['notes.controller'] = $this->app->share(function () {
            return new Controllers\NotesController($this->app['notes.service']);
        });
        $this->app['sting.controller'] = $this->app->share(function () {
            return new Controllers\StingController($this->app['sting.service']);
        });
    }

    public function bindRoutesToControllers()
    {
        //main controller
        $api = $this->app["controllers_factory"];
      //Notes
        $api->get('notes', "notes.controller:getAll");
        $api->post('notes', "notes.controller:save");
        $api->put('notes/{id}', "notes.controller:update");
        $api->delete('notes/{id}', "notes.controller:delete");

        //Sting
        $api->get('sting', "sting.controller:getAll");
        $api->get('/sting/{id}', "sting.controller:getOne");
        $api->post('sting', "sting.controller:save");
        $api->put('sting/{id}', "sting.controller:update");
        $api->delete('/sting/{id}', "sting.controller:delete");


        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}
