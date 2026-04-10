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
        return view('clients.dashboard', compact('user'));
    }

    public function home()
    {
        return view('home');
    }

    public function checkIn()
    {
        $result = $this->clientService->checkIn();

        if ($result) {
            return redirect()->back()->with('success', 'تم تسجيل حضورك لليوم بنجاح! أحسنت يا بطل 💪');
        }

        return redirect()->back()->with('error', 'لقد قمت بتسجيل اليوم مسبقاً، أو ليس لديك باقة نشطة حالياً.');
    }
}
