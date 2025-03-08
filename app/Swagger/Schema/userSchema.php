<?php

namespace App\Swagger\Schema;

/**
 * @OA\Schema(
 *     schema="User",
 *     title="User",
 *     description="User model schema",
 *     @OA\Property(property="id", type="string", example="uuid"),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", example="john@example.com"),
 *     @OA\Property(property="age", type="integer", example=25)
 * )
 */
class UserSchema {}
