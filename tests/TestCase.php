<?php

namespace Tests;

use App\Models\User;
use App\Models\Guild;
use Thunk\Verbs\Facades\Verbs;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public User $john;

    public User $jacob;

    public User $daniel;

    public Guild $universal_guild;

    public Guild $private_guild;

    public function runSeeder()
    {
        Verbs::commitImmediately();

        $seeder = new DatabaseSeeder();
        $seeder->run();

        $this->john = User::firstWhere('email', "john@thunk.dev");
        $this->jacob = User::firstWhere('email', "jacob@thunk.dev");
        $this->daniel = User::firstWhere('email', "daniel@thunk.dev");
        $this->universal_guild = Guild::firstWhere('name', 'Universal Guild');
        $this->private_guild = Guild::firstWhere('name', "Inklings");
    }
}
