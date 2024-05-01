<?php

namespace App\Repositories;

use App\Interfaces\MachineRepositoryInterface;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class MachineRepository implements  MachineRepositoryInterface {

    public function index(Request $request){
        $page = $request->input('page', 1);
        $size = $request->input('limit', 10);
      if(Auth::user()->hasRole('ce')){
         $machine = Machine::with('area_groups','customers')->withCount('notes')->when($request->input('q'), fn ($query, $search) =>
         $query->where('terminal_id','like', '%' . $search. '%')
         ->orWhere('sn','like', '%' . $search. '%')
         ->orWhere('customer_type','like', '%' . $search. '%')
         ->orWhere('branch','like', '%' . $search. '%'))->where('area_id',Auth::user()->area_id)->paginate(perPage: $size, page: $page);
         return $machine;
      }
        $machine = Machine::with('area_groups','customers')->withCount('notes')->when($request->input('q'), fn ($query, $search) =>
        $query->where('terminal_id','like', '%' . $search. '%')
        ->orWhere('sn','like', '%' . $search. '%')
        ->orWhere('customer_type','like', '%' . $search. '%')
        ->orWhere('branch','like', '%' . $search. '%'))->paginate(perPage: $size, page: $page);
        return $machine;
    }

    public function getById($id){
       return Machine::findOrFail($id);
    }

    public function store(array $data){
       return Machine::create($data);
    }

    public function update(array $data,$id){
      $get = Machine::where('id' ,$id)->first();
      $get->update($data);     
       return $get;
    }
    
    public function delete($id){
       Machine::destroy($id);
    }

    public function list(){
      return Machine::get();
    }
}
