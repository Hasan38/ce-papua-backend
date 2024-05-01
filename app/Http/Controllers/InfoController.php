<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreInfoRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Resources\InfoResource;
use App\Interfaces\InfoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    private InfoRepositoryInterface $infoRepositoryInterface;

    public function __construct(InfoRepositoryInterface $infoRep){
        $this->infoRepositoryInterface = $infoRep;
    }

    public function index(Request $request) {
        $data = $this->infoRepositoryInterface->index($request);
        return ApiResponseClass::sendResponse($data,'',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfoRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $info = $this->infoRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new InfoResource($info),'Info Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateInfoRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $info= $this->infoRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new InfoResource($info),'Info Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->infoRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Info Delete Successful','',204);
    }


    public function getByArea(Request $request) {
        $data = $this->infoRepositoryInterface->getByArea($request);
        return ApiResponseClass::sendResponse($data,'',200);
    }
}
