<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use Illuminate\Http\Request;
use App\Interfaces\DashboardRepositoryInterface;

class DashboardController extends Controller
{
    private DashboardRepositoryInterface $dashboardRepositoryInterface;

    public function __construct(DashboardRepositoryInterface $dashboardsRep){
      $this->dashboardRepositoryInterface = $dashboardsRep;
    }

    public function index(Request $request) {
        $data = $this->dashboardRepositoryInterface->index($request);
        return ApiResponseClass::sendResponse($data,'',200);
    }

    public function getByZona(Request $request) {
      $data = $this->dashboardRepositoryInterface->getByZona($request);
      return ApiResponseClass::sendResponse($data,'',200);
  }

}
