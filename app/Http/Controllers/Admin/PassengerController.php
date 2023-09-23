<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {
        return view('admin.passenger.index');
    }

}
