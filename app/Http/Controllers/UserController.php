<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

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
    public function index()
    {
        return response()->json(User::all());
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
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'age' => 'required|integer|min:1'
        ]);

        $user = User::create(array_merge($validated, ['id' => Str::uuid()]));

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => "sometimes|required|email|unique:users,email,{$id}",
            'age' => 'sometimes|required|integer|min:1'
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return response()->json($user);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
