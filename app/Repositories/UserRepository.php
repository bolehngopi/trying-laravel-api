<?php

namespace App\Repositories;

use App\Events\UserCreated;
use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes){

            $created = User::query()->create([
                'name' => data_get($attributes, 'name'),
                'email' => data_get($attributes, 'email')
            ]);

            throw_if(!$created, GeneralJsonException::class, 'Failed to create user');
            event(new UserCreated($created));
            return $created;
        });
    }

    public function update($user, array $attributes)
    {
        return DB::transaction(function () use ($user, $attributes) {
            $updated = $user->update([
                'name' => data_get($attributes, 'name', $user->name),
                'email' => data_get($attributes, 'email', $user->email),
            ]);

            throw_if(!$updated, GeneralJsonException::class, 'Failed to update a post');

            return $user;
        });
    }

    public function forceDelete($user)
    {
        return DB::transaction(function () use ($user){
            $deleted = $user->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, 'Failed to deleted a user');

            return $deleted;
        });
    }
}
