<?php

namespace App\Repositories;

use App\Interfaces\ActivityRepositoryInterface;
use App\Models\Activity;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function index(Request $request){

        $page = $request->input('page', 1);
        $size = $request->input('limit', 10);
        $start=\Carbon\Carbon::now()->startOfDay()->format('Y-m-d');
        $end=\Carbon\Carbon::now()->endOfDay()->format('Y-m-d');
        if(Auth::user()->hasRole('ce')){
        $activity = Activity::with('area_groups')->where([['start_date','<=',$start],['end_date','>=',$end]])
                ->orwhereBetween('start_date',array($start,$end))
                ->orWhereBetween('end_date',array($start,$end))->where('area_id', $request->input('area_id'))->when($request->input('q'), fn ($query, $search) =>
                $query->where('title','like', '%' . $search. '%')
                )->paginate(perPage: $size, page: $page);
        }else{
            $activity = Activity::with('area_groups')->where([['start_date','<=',$start],['end_date','>=',$end]])
                ->orwhereBetween('start_date',array($start,$end))
                ->orWhereBetween('end_date',array($start,$end))->when($request->input('q'), fn ($query, $search) =>
                $query->where('title','like', '%' . $search. '%')
                )->paginate(perPage: $size, page: $page); 
        }

        return $activity;
    }

    public function getById($id){
        $activity = Activity::where('id' ,$id)->first();
        return $activity;
    }

    public function store(array $data){

        return Activity::create($data); 

    }

    public function update(array $data,$id){
       $get = Activity::where('id' ,$id)->first();
       $get->update($data);
       return $get;
    }

    public function delete($id){
        return Activity::destroy($id);
    }

    public function getMachine(Request $request){
        $page = $request->input('page', 1);
        $size = $request->input('limit', 10);
        $get = Machine::where('area_id', $request->input('area_id'))
        ->where('customer_id', $request->input('customer_id'))
        ->paginate(perPage: $size, page: $page);

        return $get;
    }
}
