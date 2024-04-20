<?php

namespace App\Repositories;

use App\Interfaces\RatingRepositoryInterface;
use App\Models\Rating;

class RatingRepository implements RatingRepositoryInterface
{
    public function store(array $data){
        return Rating::create($data);
     }
 
     public function delete($id){
        Rating::destroy($id);
     }
}
