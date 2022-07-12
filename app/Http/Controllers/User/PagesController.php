<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PagesController extends Controller
{
    public function index()
    {
        return inertia('Web/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    
    public function dashboardUser()
    {
        return inertia('User/Dashboard');
    }

    public function userPayment()
    {
        return Inertia('User/Payment');
    }

    public function userReceipt()
    {
        return Inertia('User/Receipt');
    }

    public function userHistory()
    {
        return Inertia('User/TransactionHistory');
    }

    public function userLegal()
    {
        return Inertia('User/Legal');
    }

    public function userDetails()
    {
        return Inertia('User/AccountDetails');
    }
}
