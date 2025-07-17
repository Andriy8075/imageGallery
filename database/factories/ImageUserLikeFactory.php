<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ImageUserLikeFactory extends Factory
{
    static $usedPairs = [];
    public function definition() {
        $userId = random_int(1, 5);
        $imageId = random_int(1, 100);
        $key = "$userId-$imageId";
        $recordAlreadyExist = DB::table('image_user_likes')
            ->where('user_id', $userId)
            ->where('image_id', $imageId)
            ->exists();
        var_dump($recordAlreadyExist);
        if(!$recordAlreadyExist && !in_array($key, static::$usedPairs)){
            static::$usedPairs[] = $key;
            return [
                'user_id' => $userId,
                'image_id' => $imageId,
            ];
        }
        echo "recursion" . PHP_EOL;
        return $this->definition();
    }
}
