<?php

namespace Database\Factories\Helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FactoryHelper
{
    /**
     * This function will get a random model id from database
     * @param string | HasFactory $model
     */
    public static function getRandomModelId(string $model)
    {
        // get model count

        $count = $model::query()->count();

        if ($count === 0){
            return $model::factory()->create();
        } else {
            return rand(1, $count);
        }
    }
}
