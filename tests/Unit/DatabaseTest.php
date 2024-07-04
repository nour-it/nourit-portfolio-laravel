<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{

    use RefreshDatabase;

    public function test_migrate_database()
    {
        $this->refreshDatabase();
        $this->assertDatabaseEmpty("users");
    }

    public function test_seed()
    {   
        $this->seed();
        // $this->assertDatabaseCount("users", 4);
    }
}
