<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {    // proteger les pages de l'admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Accès refusé. Cette zone est réservée aux administrateurs.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
