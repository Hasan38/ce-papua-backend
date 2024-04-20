<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreRatingRequest;
use App\Interfaces\RatingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    private RatingRepositoryInterface $ratingRepositoryInterface;

    public function __construct(RatingRepositoryInterface $ratingsRep){
      $this->ratingRepositoryInterface = $ratingsRep;
    }

    public function store(StoreRatingRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $rating = $this->ratingRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse($rating,'Rating Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

   
    public function destroy($id)
    {
         $this->ratingRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Rating Delete Successful','',204);
    }


}
