<?php

namespace App\Repositories;

use App\Interfaces\RegionalRepositoryInterface;
use App\Models\Regional;
use Illuminate\Http\Request;

class RegionalRepository implements RegionalRepositoryInterface
{
    
    public function index(Request $request){
        $page = $request->input('page', 1);
        $size = $request->input('limit', 10);

        $region = Regional::when($request->input('q'), fn ($query, $search) =>
        $query->where('name','like', '%' . $search. '%')
        )->paginate(perPage: $size, page: $page);
        return $region;
    }

    public function getById($id){
       return Regional::findOrFail($id);
    }

    public function store(array $data){
       return Regional::create($data);
    }

    public function update(array $data,$id){
       $get = Regional::where('id' ,$id)->first();
       $get->update($data);
       return $get;
    }
    
    public function delete($id){
       Regional::destroy($id);
    }

    public function list(){
      return Regional::get();
    }
}
