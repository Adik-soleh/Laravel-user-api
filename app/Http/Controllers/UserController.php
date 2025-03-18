<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Services\ApiResponseService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return ApiResponseService::send('Berhasil mendapatkan daftar user', false, $this->userService->getAllUsers());
    }

    public function show($id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return ApiResponseService::send('User tidak ditemukan', true, null, 404);
        }
        return ApiResponseService::send('User ditemukan', false, $user);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());
        return ApiResponseService::send('User berhasil dibuat', false, $user, 201);
    }

    public function update(UserRequest $request, $id): JsonResponse
    {
        $user = $this->userService->updateUser($id, $request->validated());
        if (!$user) {
            return ApiResponseService::send('User tidak ditemukan', true, null, 404);
        }
        return ApiResponseService::send('User berhasil diperbarui', false, $user);
    }

    public function destroy($id): JsonResponse
    {
        if (!$this->userService->deleteUser($id)) {
            return ApiResponseService::send('User tidak ditemukan', true, null, 404);
        }
        return ApiResponseService::send('User berhasil dihapus', false);
    }
}
