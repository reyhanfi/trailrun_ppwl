<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seed_creates_admin_and_user_accounts(): void
    {
        $this->artisan('db:seed')->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'email' => 'admin@jatrilrun.com',
            'level' => 'admin',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'user@jatrilrun.com',
            'level' => 'user',
        ]);
    }
}
