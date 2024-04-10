<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    private CustomerRepositoryInterface $customerRepositoryInterface;

    public function __construct(CustomerRepositoryInterface $customersRep){
      $this->customerRepositoryInterface = $customersRep;
    }

    public function index(Request $request) {
        $data = $this->customerRepositoryInterface->index($request);
        return ApiResponseClass::sendResponse($data,'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $cust = $this->customerRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new CustomerResource($cust),'Customer Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cust = $this->customerRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new CustomerResource($cust),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $cust)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateCustomerRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $cust= $this->customerRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new CustomerResource($cust),'Costumer Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->customerRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Costumer Delete Successful','',204);
    }

    public function list(){
        $data = $this->customerRepositoryInterface->list();
        return ApiResponseClass::sendResponse($data,'',200);
    }
}
