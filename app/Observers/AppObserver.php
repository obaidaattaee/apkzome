<?php

namespace App\Observers;

use App\Models\App;

class AppObserver
{
    public function creating(App $app){
        $app->created_by = auth()->id();
    }
    /**
     * Handle the app "created" event.
     *
     * @param  \App\Models\App  $app
     * @return void
     */
    public function created(App $app)
    {
        //
    }

    /**
     * Handle the app "updated" event.
     *
     * @param  \App\Models\App  $app
     * @return void
     */
    public function updated(App $app)
    {
        //
    }

    /**
     * Handle the app "deleted" event.
     *
     * @param  \App\Models\App  $app
     * @return void
     */
    public function deleted(App $app)
    {
        //
    }

    /**
     * Handle the app "restored" event.
     *
     * @param  \App\Models\App  $app
     * @return void
     */
    public function restored(App $app)
    {
        //
    }

    /**
     * Handle the app "force deleted" event.
     *
     * @param  \App\Models\App  $app
     * @return void
     */
    public function forceDeleted(App $app)
    {
        //
    }
}
