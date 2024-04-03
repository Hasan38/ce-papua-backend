<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreAreaGroupRequest;
use App\Http\Requests\UpdateAreaGroupRequest;
use App\Http\Resources\AreaGroupResource;
use App\Interfaces\AreaGroupRepositoryInterface;
use App\Models\AreaGroup;
use App\Repositories\AreaGroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaGroupController extends Controller
{
    private AreaGroupRepositoryInterface $areaGroupRepositoryInterface;
    private AreaGroupRepository $areaGroupRepository;
    
    public function __construct(AreaGroupRepositoryInterface $areasGroupRepositoryInterface)
    {
        $this->areaGroupRepositoryInterface = $areasGroupRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $data = $this->areaGroupRepositoryInterface->index($request);
        return ApiResponseClass::sendResponse(AreaGroupResource::collection($data),'',200);
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
    public function store(StoreAreaGroupRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $area = $this->areaGroupRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new AreaGroupResource($area),'Area Group Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->areaGroupRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new AreaGroupResource($product),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AreaGroup $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaGroupRequest $request, $id)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $product = $this->areaGroupRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Area Group Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->areaGroupRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Area Group Delete Successful','',204);
    }
}
