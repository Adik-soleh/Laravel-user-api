<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\ApiResponseService;
use \Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponseService::send('Berhasil mendapatkan daftar user', false, User::all());
    }


    public function show($id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponseService::send('User tidak ditemukan', true, null, 404);
        }
        return ApiResponseService::send('User ditemukan', false, $user);
    }


    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'age' => 'required|integer|min:1'
            ]);

            $user = User::create(array_merge($validated, ['id' => Str::uuid()]));

            return ApiResponseService::send('User berhasil dibuat', false, $user, 201);
        } catch (ValidationException $e) {
            return ApiResponseService::send('Validasi gagal', true, $e->errors(), 422);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponseService::send('User tidak ditemukan', true, null, 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string',
                'email' => "sometimes|required|email|unique:users,email,{$id}",
                'age' => 'sometimes|required|integer|min:1'
            ]);

            $user->update($validated);

            return ApiResponseService::send('User berhasil diperbarui', false, $user);
        } catch (ValidationException $e) {
            return ApiResponseService::send('Validasi gagal', true, $e->errors(), 422);
        }
    }


    public function destroy($id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponseService::send('User tidak ditemukan', true, null, 404);
        }

        $user->delete();

        return ApiResponseService::send('User berhasil dihapus', false);
    }
}
