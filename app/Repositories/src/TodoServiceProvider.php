<?php
/**
 * Created by Canaan Etaigbenu
 * User: canaan5
 * Date: 5/10/16
 * Time: 1:35 AM
 */

namespace Canaan\Repo;


use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("Canaan\Repo\Contracts\TodoInterface", "Canaan\Repo\Eloquent\TodoModelRepository");
    }
}