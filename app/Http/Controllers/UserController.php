<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()->latest()->paginate(),
        );
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $validated = $request->validated();

        DB::transaction(function () use ($user, $validated): void {
            $user->update($validated);

            if (array_key_exists('is_active', $validated) && ! $validated['is_active']) {
                $user->tokens()->delete();
            }
        });

        return (new UserResource($user->refresh()))
            ->additional(['message' => 'User updated successfully.']);
    }
}
