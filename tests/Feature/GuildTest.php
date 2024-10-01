<?php

use Thunk\Verbs\Facades\Verbs;
use Database\Seeders\DatabaseSeeder;

it('attaches guilds to users', function () {
    Verbs::commitImmediately();

    $this->runSeeder();

    expect($this->john->guilds->first()->id)
        ->toBe($this->universal_guild->id);

    expect($this->universal_guild->users->pluck('id')->contains($this->john->id))
        ->toBeTrue();
});
