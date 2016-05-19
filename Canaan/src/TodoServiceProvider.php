<?php

namespace Canaan;


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
        $this->app->bind("Canaan\Contracts\TodoInterface", "Canaan\Persistance\TodoModelRepository");
        $this->app->bind("Canaan\Contracts\CalenderSynchronizationInterface", "Canaan\Remote\GoogleCalender");
    }
}