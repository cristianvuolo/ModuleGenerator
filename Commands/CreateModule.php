<?php

namespace CristianVuolo\ModuleGenerator\Commands;

use CristianVuolo\ModuleGenerator\CvModule;
use Illuminate\Console\Command;

class CreateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cv {name} {title} {titlePlural}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar um Módulo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        foreach(config('cv_modules.modules', []) as $item) {
            if($this->argument('name') == $item['name']) {
                $this->error('O Módulo já está cadastrado em cv_modules');
                return false;
            }
        }
        $name = ucfirst($this->argument('name'));
        $modulePath = "Modules\\$name";
        $routesFile = strtolower($name) . 'Routes.php';
        $viewFolder = strtolower($name);


        $this->call('make:controller', [
            'name' => "{$modulePath}\\Controllers\\{$name}Controller"
        ]);

        $controllerFile = app_path("{$modulePath}\\Controllers\\{$name}Controller.php");
        $controllerData = file_get_contents($controllerFile);
        $controllerData =
            str_replace(
                ['FRUModuleName', 'FRModuleName', 'FRModuleTitle', 'FRPluralModuleTitle'],
                [$name, strtolower($name), $this->argument('title'), $this->argument('titlePlural')],
                $controllerData
            );
        file_put_contents(app_path("{$modulePath}\\Controllers\\{$name}Controller.php"), $controllerData);
        $this->info('Os nomes dos métodos foram alterados');


        $this->info('O Controller foi criado');

        @mkdir(app_path('Modules'));

        mkdir(app_path("{$modulePath}/resources/views/admin/api/{$viewFolder}"), null, true);
        $this->recurse_copy(__DIR__ . '/../stubs/views/admin', app_path("{$modulePath}\\resources\\views\\admin\\api\\{$viewFolder}"));
        $this->info('As Views foram adicionadas no diretório');

        mkdir(app_path("{$modulePath}\\routes"));
        copy(__DIR__ . '/../stubs/routes/routes.php', app_path("{$modulePath}\\routes\\{$routesFile}"));

        $routeFile = app_path("{$modulePath}\\routes\\{$routesFile}");
        $routes = file_get_contents($routeFile);
        $routes = str_replace(['FRUmoduleName', 'FRmoduleName'], [$name, strtolower($name)], $routes);
        file_put_contents(app_path("{$modulePath}\\routes\\{$routesFile}"), $routes);
        $this->info('Os nomes das rotas foram alterados');

        $this->info('As Routes foram adicionadas');

        mkdir(app_path("{$modulePath}\\Services"));
        $this->info('Diretório de Services adicionado');

        $this->addConfig();
        $this->info('Arquivo de Configuração Atualizado');
        return;
    }

    public function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function addConfig()
    {
        $data = array_merge(config('cv_modules.modules', []), [['name' => ucfirst($this->argument('name')), 'active' => true]]);
        $array = var_export(['modules' => $data], true);
        $config = '<?php return ' . $array . ';';
        file_put_contents(config_path('cv_modules.php'), $config);
    }
}
