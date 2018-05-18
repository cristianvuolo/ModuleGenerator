<?php

namespace CristianVuolo\ModuleGenerator;


use CristianVuolo\ModuleGenerator\Commands\CreateModule;
use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/' => base_path('config')], 'configs');
        $this->commands([
            CreateModule::class
        ]);

        $this->loadModules();
    }

    public function register()
    {

    }

    public function loadModules()
    {
        foreach (config('cv_modules.modules', []) as $module) {
            if ($module['active']) {
                $route = strtolower($module['name']) . 'Routes.php';
                $this->app['view']->addLocation(app_path('Modules/'.$module['name'] . '/resources/views'));
                \File::requireOnce(app_path('Modules/'.$module['name'] . "/routes/{$route}"));
            }
        }
    }
}