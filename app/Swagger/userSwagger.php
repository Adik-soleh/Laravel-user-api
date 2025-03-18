<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="User API",
 *      description="Dokumentasi API untuk manajemen User",
 *      @OA\Contact(
 *          email="adiksoleh4@gmail.com"
 *      )
 * )
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
 *      @OA\Response(
 *          response=200,
 *          description="Berhasil mendapatkan user",
 *          @OA\JsonContent(ref="#/components/schemas/User")
 *      ),
 *      @OA\Response(response=404, description="User tidak ditemukan")
 * )
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
class UserSwagger {}
