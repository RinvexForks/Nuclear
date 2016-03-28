<?php

namespace Reactor\Providers;


use Illuminate\Support\ServiceProvider;
use Reactor\Http\Builders\ActivitiesHtmlBuilder;
use Reactor\Http\Builders\ContentsHtmlBuilder;
use Reactor\Http\Builders\FormsHtmlBuilder;
use Reactor\Http\Builders\NavigationHtmlBuilder;
use Reactor\Http\Builders\NodesHtmlBuilder;

class HtmlBuildersServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'reactor.builders.activities',
            'reactor.builders.contents',
            'reactor.builders.forms',
            'reactor.builders.navigation',
            'reactor.builders.nodes'
        ];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerActivitiesHtmlBuilder();
        $this->registerContentsHtmlBuilder();
        $this->registerFormsHtmlBuilder();
        $this->registerNavigationHtmlBuilder();
        $this->registerNodesHtmlBuilder();
    }

    /**
     * Registers activities html builder
     */
    protected function registerActivitiesHtmlBuilder()
    {
        $this->app['reactor.builders.activities'] = $this->app->share(function () {
            return new ActivitiesHtmlBuilder;
        });
    }

    /**
     * Registers contents html builder
     */
    protected function registerContentsHtmlBuilder()
    {
        $this->app['reactor.builders.contents'] = $this->app->share(function () {
            return new ContentsHtmlBuilder;
        });
    }

    /**
     * Registers forms html builder
     */
    protected function registerFormsHtmlBuilder()
    {
        $this->app['reactor.builders.forms'] = $this->app->share(function () {
            return new FormsHtmlBuilder;
        });
    }

    /**
     * Registers navigation html builder
     */
    protected function registerNavigationHtmlBuilder()
    {
        $this->app['reactor.builders.navigation'] = $this->app->share(function () {
            return new NavigationHtmlBuilder;
        });
    }

    /**
     * Registers nodes html builder
     */
    protected function registerNodesHtmlBuilder()
    {
        $this->app['reactor.builders.nodes'] = $this->app->share(function () {
            return new NodesHtmlBuilder;
        });
    }

}