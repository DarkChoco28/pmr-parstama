<?php

/**
 * This file helps IDEs understand the Pest testing framework setup.
 * It documents the methods available in test closures.
 * 
 * @see https://pestphp.com
 */

namespace Pest {

    /**
     * Pest Test Context
     * 
     * In Pest test files, the closure passed to `it()` has `$this` bound to the TestCase instance,
     * which provides access to Laravel's testing methods like:
     * 
     * HTTP Requests:
     * - $this->get($uri, $headers = [])
     * - $this->post($uri, $data = [], $headers = [])
     * - $this->put($uri, $data = [], $headers = [])
     * - $this->patch($uri, $data = [], $headers = [])
     * - $this->delete($uri, $headers = [])
     * 
     * Authentication:
     * - $this->actingAs($user, $guard = null)
     * 
     * Database Assertions:
     * - $this->assertDatabaseHas($table, $data)
     * - $this->assertDatabaseCount($table, $count)
     * - $this->assertDatabaseMissing($table, $data)
     * 
     * For more information, see:
     * @see \Illuminate\Foundation\Testing\Concerns\MakesHttpRequests
     * @see \Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication
     * @see \Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase
     */
    class TestContext {}
}
