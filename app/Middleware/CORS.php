<?php
namespace App\Middleware;

use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Middleware\BaseMiddleware;

class CORS extends BaseMiddleware
{
    public function handle(RequestInterface $request, $arguments = null)
    {
        $response = Services::response();

        // Modify headers as needed
        $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setHeader('Access-Control-Allow-Headers', '*');
        $response->setHeader('Access-Control-Allow-Methods', '*');
        $response->setHeader('Access-Control-Max-Age', '3600');
        $response->setHeader('Access-Control-Expose-Headers', '');

        // If request is OPTIONS, return response with 200 status
        if ($request->getMethod(true) === 'OPTIONS') {
            return $response->setStatusCode(200); // OPTIONS request should return 200 OK, no content needed
        }

        return $this->next->handle($request);
    }
}
