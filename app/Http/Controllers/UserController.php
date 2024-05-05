<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Exceptions\GeneralJsonException;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // event(new UserCreated(User::factory()->make()));
        $pageSize = $request->page_size ?? 10;
        $user = User::paginate($pageSize);
        return UserResource::collection($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = User::create($request->only([
            'name',
            'email',
        ]));

        throw_if(!$created, GeneralJsonException::class, 'Failed to created a new user');

        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $updated = $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
        ]);

        throw_if(!$updated, GeneralJsonException::class, 'Failed to update a user');

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleted = $user->forceDelete();

        throw_if(!$deleted, GeneralJsonException::class, 'Failed to deleted an user');

        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
