<?php

namespace App\Observers;

use App\Models\OSType;

class OSTypeObserver
{

    public function creating(OSType $OSType)
    {
        $OSType->created_by = auth()->id();
    }

    /**
     * Handle the o s type "created" event.
     *
     * @param \App\Models\OSType $oSType
     * @return void
     */
    public function created(OSType $oSType)
    {
        //
    }

    /**
     * Handle the o s type "updated" event.
     *
     * @param \App\Models\OSType $oSType
     * @return void
     */
    public function updated(OSType $oSType)
    {
        //
    }

    /**
     * Handle the o s type "deleted" event.
     *
     * @param \App\Models\OSType $oSType
     * @return void
     */
    public function deleted(OSType $oSType)
    {
        //
    }

    /**
     * Handle the o s type "restored" event.
     *
     * @param \App\Models\OSType $oSType
     * @return void
     */
    public function restored(OSType $oSType)
    {
        //
    }

    /**
     * Handle the o s type "force deleted" event.
     *
     * @param \App\Models\OSType $oSType
     * @return void
     */
    public function forceDeleted(OSType $oSType)
    {
        //
    }
}
