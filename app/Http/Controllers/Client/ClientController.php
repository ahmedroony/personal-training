<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Domains\Client\Actions\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    public function index()
    {
        $user = $this->clientService->getDashboardData();
        return view('domains.client.dashboard', compact('user'));
    }

    public function home()
    {
        return view('home');
    }
}
