<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;
use App\Services\ApiResponseService;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="User API",
 *      description="Dokumentasi API untuk manajemen User",
 * )
 *
 * @OA\PathItem(path="/users")
 */
class UserController extends Controller
{
    /**
     * Ambil semua user.
     * 
     * @OA\Get(
     *      path="/users",
     *      tags={"Users"},
     *      summary="Ambil semua user",
     *      @OA\Response(
     *          response=200,
     *          description="Berhasil mendapatkan daftar user",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *      )
     * )
     */
    public function index(): JsonResponse
    {
        return ApiResponseService::send('Berhasil mendapatkan daftar user', false, User::all());
    }

    /**
     * Ambil user berdasarkan ID.
     * 
     * @OA\Get(
     *      path="/users/{id}",
     *      tags={"Users"},
     *      summary="Ambil user berdasarkan ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID user",
     *          @OA\Schema(type="string", format="uuid")
     *      ),
     *      @OA\Response(response=200, description="Berhasil mendapatkan user", @OA\JsonContent(ref="#/components/schemas/User")),
     *      @OA\Response(response=404, description="User tidak ditemukan")
     * )
     */
    public function show($id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponseService::send('User tidak ditemukan', true, null, 404);
        }
        return ApiResponseService::send('User ditemukan', false, $user);
    }

    /**
     * Buat user baru.
     * 
     * @OA\Post(
     *      path="/users",
     *      tags={"Users"},
     *      summary="Buat user baru",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "email", "age"},
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="email", type="string", format="email"),
     *              @OA\Property(property="age", type="integer")
     *          )
     *      ),
     *      @OA\Response(response=201, description="User berhasil dibuat"),
     *      @OA\Response(response=422, description="Validasi gagal")
     * )
     */
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponseService::send('Validasi gagal', true, $e->errors(), 422);
        }
    }

    /**
     * Perbarui user berdasarkan ID.
     * 
     * @OA\Put(
     *      path="/users/{id}",
     *      tags={"Users"},
     *      summary="Perbarui user",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID user",
     *          @OA\Schema(type="string", format="uuid")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="email", type="string", format="email"),
     *              @OA\Property(property="age", type="integer")
     *          )
     *      ),
     *      @OA\Response(response=200, description="User berhasil diperbarui"),
     *      @OA\Response(response=404, description="User tidak ditemukan")
     * )
     */
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponseService::send('Validasi gagal', true, $e->errors(), 422);
        }
    }

    /**
     * Hapus user berdasarkan ID.
     * 
     * @OA\Delete(
     *      path="/users/{id}",
     *      tags={"Users"},
     *      summary="Hapus user",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID user",
     *          @OA\Schema(type="string", format="uuid")
     *      ),
     *      @OA\Response(response=200, description="User berhasil dihapus"),
     *      @OA\Response(response=404, description="User tidak ditemukan")
     * )
     */
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
