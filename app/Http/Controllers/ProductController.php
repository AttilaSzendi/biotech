<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('users.index', ['products' => 1]);
    }
}
