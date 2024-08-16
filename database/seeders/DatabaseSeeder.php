<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Events\RoundEnded;
use App\States\StoryState;
use App\Events\UserCreated;
use App\Events\StoryCreated;
use Thunk\Verbs\Facades\Verbs;
use App\Events\SubmissionAdded;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Verbs::commitImmediately();

        $user_id = UserCreated::fire(
            name: 'John Drexler',
            email: 'john@thunk.dev',
            encrypted_password: bcrypt('password'),
        )->user_id;

        $john = User::find($user_id);

        $user_id = UserCreated::fire(
            name: 'Daniel Coulbourne',
            email: 'daniel@thunk.dev',
            encrypted_password: bcrypt('password'),
        )->user_id;

        $daniel = User::find($user_id);

        $user_id = UserCreated::fire(
            name: 'Jacob Davis',
            email: 'jacob@thunk.dev',
            encrypted_password: bcrypt('password'),
        )->user_id;

        $jacob = User::find($user_id);

        $story_id = StoryCreated::fire(
            title: 'Small Tokens',
            user_id: $john->id,
        )->story_id;

        $story = StoryState::load($story_id);

        SubmissionAdded::fire(
            user_id: $daniel->id,
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            type: 'paragraph', 
            content: 'The sun was setting on the horizon, casting long shadows across the land.',
        );

        RoundEnded::fire(
            story_id: $story_id,
            round_id: $story->currentRound()->id,
        );
    }
}
