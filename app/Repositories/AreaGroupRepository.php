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
        return AreaGroup::paginate(perPage: $size, page: $page);
    }

    public function getById($id){
       return AreaGroup::findOrFail($id);
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
}
