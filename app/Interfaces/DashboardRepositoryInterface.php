<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface DashboardRepositoryInterface
{
    public function index(Request $request);
    public function getByZona(Request $request);
}
