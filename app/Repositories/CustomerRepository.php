<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function index(Request $request){
        $page = $request->input('page', 1);
        $size = $request->input('limit', 10);

        $region = Customer::when($request->input('q'), fn ($query, $search) =>
        $query->where('name','like', '%' . $search. '%')
        )->paginate(perPage: $size, page: $page);
        return $region;
    }

    public function getById($id){
       return Customer::findOrFail($id);
    }

    public function store(array $data){
       return Customer::create($data);
    }

    public function update(array $data,$id){
       $get = Customer::where('id' ,$id)->first();
       $get->update($data);
       return $get;
    }
    
    public function delete($id){
       Customer::destroy($id);
    }

    public function list(){
      return Customer::get();
    }
}
