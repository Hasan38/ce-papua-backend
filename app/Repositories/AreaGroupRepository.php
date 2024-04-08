<?php

namespace App\Repositories;

use App\Interfaces\AreaGroupRepositoryInterface;
use App\Models\AreaGroup;
use Illuminate\Http\Request;

class AreaGroupRepository implements AreaGroupRepositoryInterface
{
    /**
     * Create a new class instance.
     */

    public function index(Request $request){
       
        $page = $request->input('page', 1);
        $size = $request->input('limit', 10);

        $area = AreaGroup::with('regionals')->when($request->input('q'), fn ($query, $search) =>
        $query->where('name','like', '%' . $search. '%')
        )->paginate(perPage: $size, page: $page);
        return $area;
        
    }

    public function getById($id){
       $area = AreaGroup::where('id' ,$id)->first();
       return $area;
       
    }

    public function store(array $data){
       return AreaGroup::create($data);
    }

    public function update(array $data,$id){
       $get = AreaGroup::where('id' ,$id)->first();
       $get->update($data);
       return $get;
    }
    
    public function delete($id){
       AreaGroup::destroy($id);
    }

    public function list(){
      return AreaGroup::get();
    }
}
