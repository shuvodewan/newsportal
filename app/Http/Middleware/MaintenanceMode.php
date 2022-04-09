<?php

namespace App\Http\Middleware;

use App\Models\GeneralSettings;
use Closure;

class MaintenanceMode
{
    public function handle($request, Closure $next)

    {
        $gs = GeneralSettings::find(1);

            if($gs->is_maintain == 1) {

                    return redirect()->route('front-maintenance');

            }


            return $next($request);

    }
}
