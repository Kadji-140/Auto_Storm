<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
    $company = [
        'name' => 'Mon Entreprise',
        'founded' => 2020,
        'employees' => 50
    ];
    
    return view('about', ['company' => $company]);
}

}
