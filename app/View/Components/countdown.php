<?php

namespace App\View\Components;

use Closure;
use App\Models\Performance;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class countdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Retrieve the upcoming performance
        $upcomingPerformance = Performance::where('starttime', '>', Carbon::now())
        ->orderBy('starttime', 'asc')
        ->first();

        // Pass the upcoming performance to the countdown view
        return view('components.countdown', compact('upcomingPerformance'));
    }
}
