<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Request;
use App\Models\Performance;

class PerformanceTimeOverlap implements ValidationRule
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $performanceId = $this->request->get('id');
        $starttime = $this->request->get('starttime');
        $endtime = $this->request->get('endtime');

        // Query to check if there's any performance that overlaps with the given time range
        $overlappingPerformance = Performance::where(function ($query) use ($starttime, $endtime) {
            $query->where(function ($query) use ($starttime, $endtime) {
                $query->where('starttime', '<=', $endtime)
                    ->where('endtime', '>=', $starttime);
            });
        });

        // If we're updating a performance, exclude the current performance from the query
        if ($performanceId) {
            $overlappingPerformance = $overlappingPerformance->where('id', '!=', $performanceId);
        }

        // If there's any overlapping performance, the validation fails
        if ($overlappingPerformance->exists()) {
            $fail('The performance time overlaps with another performance.');
        }
    }
}
