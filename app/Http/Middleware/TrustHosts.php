<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Lấy các pattern của host mà ứng dụng nên tin cậy.
     *
     * @return array
     */
    public function hosts()
    {
        $trustedHosts = explode(',', env('TRUSTED_HOSTS', ''));

        return array_merge(
            [
                $this->allSubdomainsOfApplicationUrl(),
            ],
            $trustedHosts
        );
    }
}
