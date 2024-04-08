<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreRegionalRequest;
use App\Http\Requests\UpdateRegionalRequest;
use App\Http\Resources\RegionalResource;
use App\Interfaces\RegionalRepositoryInterface;
use App\Models\Regional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionalController extends Controller
{
    private RegionalRepositoryInterface $regionalRepositoryInterface;

    public function __construct(RegionalRepositoryInterface $regionalsRep){
      $this->regionalRepositoryInterface = $regionalsRep;
    }

    public function index(Request $request) {
        $data = $this->regionalRepositoryInterface->index($request);
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
    public function store(StoreRegionalRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $region = $this->regionalRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new RegionalResource($region),'Regional Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $region = $this->regionalRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new RegionalResource($region),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regional $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateRegionalRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $region= $this->regionalRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new RegionalResource($region),'Regional Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->regionalRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Regional Delete Successful','',204);
    }

    public function list(){
        $data = $this->regionalRepositoryInterface->list();
        return ApiResponseClass::sendResponse($data,'',200);
    }
}