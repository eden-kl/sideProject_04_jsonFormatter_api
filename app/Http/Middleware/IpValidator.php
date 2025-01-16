<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpValidator
{
    private array $allowAddresses = [
        '127.0.0.1|127.0.0.1', // localhost
        '0.0.0.0|0.0.0.0', // localhost
    ];

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->ipIsValid($request->ip())) {
            abort(403, 'Request Denied');
        }
        return $next($request);
    }

    /**
     * @param string $ip
     * @return bool
     */
    private function ipIsValid(string $ip): bool
    {
        $longIp = ip2long($ip);
        if ($longIp != -1) {
            foreach ($this->allowAddresses as $allowAddress) {
                [$start, $end] = explode('|', $allowAddress);
                if ($longIp >= ip2long($start) && $longIp <= ip2long($end)) {
                    return true;
                }
            }
        }
        return false;
    }
}
