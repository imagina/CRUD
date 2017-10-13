<?php

namespace Modules\Bcrud\Providers;

use Route;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;

class BcrudServiceProvider extends ServiceProvider
{

    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerTranslations();

        $this->registerConfig();

        $this->publishConfig('bcrud', 'permissions');
        $this->publishConfig('bcrud', 'config');
        $this->publishConfig('bcrud', 'backpack/base');
        $this->publishConfig('bcrud', 'backpack/crud');

        $this->registerViews();

        // LOAD THE VIEWS

        // - first the published/overwritten views (in case they have any changes)
        //$this->loadViewsFrom(resource_path('views/vendor/backpack/crud'), 'crud');
        // - then the stock views that come with the package, in case a published view might be missing
        //$this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'crud');

        // PUBLISH FILES

        // publish lang files
        //$this->publishes([__DIR__.'/resources/lang' => resource_path('lang/vendor/backpack')], 'lang');

        // publish views
        //$this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/backpack/crud')], 'views');

        // publish config file
        //$this->publishes([__DIR__.'/config' => config_path()], 'config');

        // publish public Backpack CRUD assets
        //$this->publishes([__DIR__.'/public' => public_path('vendor/backpack')], 'public');

        // publish custom files for elFinder
        /*$this->publishes([
            __DIR__.'/config/elfinder.php'      => config_path('elfinder.php'),
            __DIR__.'/resources/views-elfinder' => resource_path('views/vendor/elfinder'),
        ], 'elfinder');

        // AUTO PUBLISH
        if (\App::environment('local')) {
            if ($this->shouldAutoPublishPublic()) {
                \Artisan::call('vendor:publish', [
                    '--provider' => 'Modules\Bcrud\CrudServiceProvider',
                    '--tag' => 'public',
                ]);
            }
		
        }

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/backpack/crud.php',
            'backpack.crud'
        );*/
    }

/**
     * Publish the given configuration file name (without extension) and the given module
     * @param string $module
     * @param string $fileName
     */
    public function publishConfig($module, $fileName)
    {
        if (app()->environment() === 'testing') {
            return;
        }

        $this->mergeConfigFrom($this->getModuleConfigFilePath($module, $fileName), strtolower("$module.$fileName"));
        $this->publishes([
            $this->getModuleConfigFilePath($module, $fileName) => config_path(strtolower("$module/$fileName") . '.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CRUD', function ($app) {
            return new CRUD($app);
        });

        // register its dependencies
        //$this->app->register(\Backpack\Base\BaseServiceProvider::class);
        //$this->app->register(\Collective\Html\HtmlServiceProvider::class);
        //$this->app->register(\Barryvdh\Elfinder\ElfinderServiceProvider::class);
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);

        // register their aliases
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('CRUD', \Modules\Bcrud\Providers\BcrudServiceProvider::class);
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
        $loader->alias('Image', \Intervention\Image\Facades\Image::class);

        // map the elfinder prefix
        /*if (! \Config::get('elfinder.route.prefix')) {
            \Config::set('elfinder.route.prefix', \Config::get('backpack.base.route_prefix').'/elfinder');
        }*/
    }
    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {


        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('bcrud.php'),
        ]);

        $this->publishes([
            __DIR__.'/../Config/backpack/base.php' => config_path('bcrud/backpack/base.php'),
        ]);

        $this->publishes([
            __DIR__.'/../Config/backpack/crud.php' => config_path('bcrud/backpack/crud.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../Config/backpack/base.php', 'bcrud.backpack.base'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/backpack/crud.php', 'bcrud.backpack.crud'
        );



    }

	/**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/bcrud');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/bcrud';
        }, \Config::get('view.paths')), [$sourcePath]), 'bcrud');
    }
	/**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/bcrud');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'bcrud');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'bcrud');
        }
    }

	/**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }


    public static function resource($name, $controller, array $options = [])
    {
        return new CrudRouter($name, $controller, $options);
    }

    /**
     * Checks to see if we should automatically publish
     * vendor files from the public tag.
     *
     * @return bool
     */
    private function shouldAutoPublishPublic()
    {
        $crudPubPath = public_path('vendor/backpack/crud');

        if (! is_dir($crudPubPath)) {
            return true;
        }

        return false;
    }
}
