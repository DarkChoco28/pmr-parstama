<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Auth\User;

/**
 * HTTP Request Methods
 * @method TestResponse get(string $uri, array $headers = [])
 * @method TestResponse post(string $uri, array $data = [], array $headers = [])
 * @method TestResponse put(string $uri, array $data = [], array $headers = [])
 * @method TestResponse patch(string $uri, array $data = [], array $headers = [])
 * @method TestResponse delete(string $uri, array $headers = [])
 * @method TestResponse options(string $uri, array $headers = [])
 * @method TestResponse head(string $uri, array $headers = [])
 * @method TestResponse json(string $method, string $uri, array $data = [], array $headers = [])
 *
 * Authentication Methods
 * @method $this actingAs(\Illuminate\Contracts\Auth\Authenticatable $user, string $guard = null)
 * @method $this be(\Illuminate\Contracts\Auth\Authenticatable $user, string $guard = null)
 *
 * Database Assertion Methods
 * @method void assertDatabaseHas(string $table, array $data, string $connection = null)
 * @method void assertDatabaseCount(string $table, int $count, string $connection = null)
 * @method void assertDatabaseMissing(string $table, array $data, string $connection = null)
 * @method void assertDeleted(\Illuminate\Database\Eloquent\Model $model, string $connection = null)
 * @method void assertModelMissing(\Illuminate\Database\Eloquent\Model $model)
 * @method void assertDatabaseEmpty(string $table, string $connection = null)
 *
 * Property Declarations
 * @property \Illuminate\Contracts\Auth\Authenticatable $user
 */
abstract class TestCase extends BaseTestCase
{
    //
}
