<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePodcastIsValid
{
    public function handle($job, $next)
    {
        if ($job->podcast->isValid()) {
            $next($job);
        }
    }
}
