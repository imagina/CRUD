<?php

namespace Modules\Bcrud\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class BcrudServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
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


        //
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
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'bcrud'
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




    public static function resource($module,$name, $controller, array $options = [])
    {


        // CRUD routes
        Route::post($name.'/search', [
            'as' => 'crud.'.$module.'.'.$name.'.search',
            'uses' => $controller.'@search',
        ]);
        Route::get($name.'/reorder', [
            'as' => 'crud.'.$module.'.'.$name.'.reorder',
            'uses' => $controller.'@reorder',
        ]);
        Route::post($name.'/reorder', [
            'as' => 'crud.'.$module.'.'.$name.'.save.reorder',
            'uses' => $controller.'@saveReorder',
        ]);
        Route::get($name.'/{id}/details', [
            'as' => 'crud.'.$module.'.'.$name.'.showDetailsRow',
            'uses' => $controller.'@showDetailsRow',
        ]);
        Route::get($name.'/{id}/translate/{lang}', [
            'as' => 'crud.'.$module.'.'.$name.'.translateItem',
            'uses' => $controller.'@translateItem',
        ]);
        Route::get($name.'/{id}/revisions', [
            'as' => 'crud.'.$module.'.'.$name.'.listRevisions',
            'uses' => $controller.'@listRevisions',
        ]);
        Route::post($name.'/{id}/revisions/{revisionId}/restore', [
            'as' => 'crud.'.$module.'.'.$name.'.restoreRevision',
            'uses' => $controller.'@restoreRevision',
        ]);

        $options_with_default_route_names = array_merge([
            'names' => [
                'index'     => 'crud.'.$module.'.'.$name.'.index',
                'create'    => 'crud.'.$module.'.'.$name.'.create',
                'store'     => 'crud.'.$module.'.'.$name.'.store',
                'edit'      => 'crud.'.$module.'.'.$name.'.edit',
                'update'    => 'crud.'.$module.'.'.$name.'.update',
                'show'      => 'crud.'.$module.'.'.$name.'.show',
                'destroy'   => 'crud.'.$module.'.'.$name.'.destroy',
            ],
        ], $options);

        Route::resource($name, $controller, $options_with_default_route_names);
    }
}
