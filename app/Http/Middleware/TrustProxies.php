<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Fideloper\Proxy\TrustProxies as Middleware;
class TrustProxies
{
   /**
     * The trusted proxies for the application.
     *
     * @var array|string|null
     */
    protected $proxies = [
        '103.21.244.0/22',
        '103.22.200.0/22',
        // Thêm các địa chỉ IP của Cloudflare khác nếu cần
    ];
}
