<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Local\Payments\Payments as PaymentsLocal;
use App\Models\Api\Payments\Payments as PaymentsApi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $qtdUsers = User::count();

        $qtdPaymentsLocal = PaymentsLocal::where('returnCode', 4)
                                ->orWhere('returnCode', 1)
                                ->count();

        $qtdPaymentsLocalTotal = PaymentsApi::count();

        $qtdPaymentsApi = PaymentsApi::where('returnCode', 4)
                                ->orWhere('returnCode', 1)
                                ->count();
        $qtdPaymentsApiTotal = PaymentsApi::count();

        return view('home', compact('qtdUsers', 'qtdPaymentsLocal', 'qtdPaymentsApi', 'qtdPaymentsLocalTotal', 'qtdPaymentsApiTotal'));
    }

    public function home()
    {
        return redirect('home');
    }

    
}
