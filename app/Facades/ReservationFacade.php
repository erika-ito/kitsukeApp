<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ReservationFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'reservation';
    }
}