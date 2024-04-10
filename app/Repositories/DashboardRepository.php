<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function index(Request $request){
        $count_cusctomer = Machine::query()
                      ->select(DB::raw('DISTINCT(count(customer_id)) AS total, customers.name, customers.id'))
                      ->leftJoin('customers','customers.id','=','customer_id')
                      ->when($request->input('area_id'), fn ($query, $search) =>
                        $query->where('area_id','=', $search))
                      ->groupBy(['customer_id','customers.id','customers.name'])->get();

        $count_zona = Machine::select(
            DB::raw('COUNT(IF(zona = 1,1,NULL)) as zona_1'),
            DB::raw('COUNT(IF(zona = 2,1,NULL)) as zona_2'),
            DB::raw('COUNT(IF(zona = 3,1,NULL)) as zona_3'),
        )->when($request->input('area_id'), fn ($query, $search) =>
        $query->where('area_id','=', $search))->first();

        $count_cusctomer_type = Machine::query()
                      ->select(DB::raw('DISTINCT(count(customer_type)) AS total, customer_type'))
                      ->when($request->input('area_id'), fn ($query, $search) =>
                        $query->where('area_id','=', $search))
                      ->groupBy('customer_type')->get();
        $data = [
            'count_customer' => $count_cusctomer,
            'count_zona' => $count_zona,
            'count_customer_type' => $count_cusctomer_type,
        ];

        
        return $data;
    }
}
