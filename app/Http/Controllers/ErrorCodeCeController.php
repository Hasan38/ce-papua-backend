<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreErrorCodeCeRequest;
use App\Http\Requests\UpdateErrorCodeCeRequest;
use App\Http\Resources\ErrorCodeCeResource;
use App\Interfaces\ErrorCodeCeRepositoryInterface;
use App\Models\ErrorCodeCe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ErrorCodeCeController extends Controller
{
    private ErrorCodeCeRepositoryInterface $errorRepositoryInterface;

    public function __construct(ErrorCodeCeRepositoryInterface $errorRep){
      $this->errorRepositoryInterface = $errorRep;
    }

    public function index(Request $request) {
        $data = $this->errorRepositoryInterface->index($request);
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
    public function store(StoreErrorCodeCeRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $error = $this->errorRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new ErrorCodeCeResource($error),'Error Create Successful',201);

        }catch(\Exception $ex){
            dd($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $machine = $this->errorRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new ErrorCodeCeResource($machine),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ErrorCodeCe $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateErrorCodeCeRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $error= $this->errorRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new ErrorCodeCeResource($error),'Error Code Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->errorRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Error Code Delete Successful','',204);
    }
}
