<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $usersRepositoryInterface){
        $this->userRepositoryInterface = $usersRepositoryInterface;
    }

    public function store(StoreUserRequest $request){

        $data = $request->validated();

        try{
            $user = $this->userRepositoryInterface->store($data);

            DB::commit();
            return ApiResponseClass::sendResponse(new UserResource($user),'User Create Successful',201);
        }
        catch (Exception $e){
            dd($e);
        }

    }
    
}
