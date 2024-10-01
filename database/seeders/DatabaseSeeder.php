<?php

namespace Database\Seeders;

use App\Events\GuildCreated;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Events\RoundEnded;
use App\States\StoryState;
use App\Events\UserCreated;
use App\Events\StoryCreated;
use Thunk\Verbs\Facades\Verbs;
use App\Events\SubmissionAdded;
use App\Events\SubmissionUpvoted;
use App\Events\UserJoinedGuild;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Verbs::commitImmediately();

        $guild_id = GuildCreated::fire(
            name: "Universal Guild",
            is_open: true,
            is_public: true,
        )->guild_id;

        $user_id = UserCreated::fire(
            name: 'John Drexler',
            email: 'john@thunk.dev',
            encrypted_password: bcrypt('password'),
        )->user_id;

        UserJoinedGuild::fire(
            guild_id: $guild_id,
            user_id: $user_id,
        );

        $john = User::find($user_id);

        $user_id = UserCreated::fire(
            name: 'Daniel Coulbourne',
            email: 'daniel@thunk.dev',
            encrypted_password: bcrypt('password'),
        )->user_id;

        UserJoinedGuild::fire(
            guild_id: $guild_id,
            user_id: $user_id,
        );

        $daniel = User::find($user_id);

        $user_id = UserCreated::fire(
            name: 'Jacob Davis',
            email: 'jacob@thunk.dev',
            encrypted_password: bcrypt('password'),
        )->user_id;

        UserJoinedGuild::fire(
            guild_id: $guild_id,
            user_id: $user_id,
        );

        $jacob = User::find($user_id);

        $story_id = StoryCreated::fire(
            title: 'Small Tokens',
            user_id: $john->id,
            guild_id: $guild_id,
        )->story_id;

        $story = StoryState::load($story_id);

        SubmissionAdded::fire(
            user_id: $john->id,
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            type: 'new_chapter', 
            content: 'What happened to Marty',
        );

        RoundEnded::fire(
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            guild_id: $guild_id,
        );

        SubmissionAdded::fire(
            user_id: $daniel->id,
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            type: 'paragraph', 
            content: '<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur consequat, massa sit amet tincidunt facilisis, erat dolor ornare neque, a mollis mauris libero id leo. Aenean bibendum aliquet facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae dapibus tellus. Phasellus vel ligula vitae odio lobortis euismod interdum eget odio. Nullam ut convallis dui. Quisque et scelerisque mauris, et bibendum felis. Donec blandit, purus in suscipit rhoncus, augue magna dictum ante, ultricies convallis felis tortor vestibulum eros. Vestibulum libero dui, viverra a vulputate sit amet, rhoncus non turpis. Duis gravida sem et gravida auctor. Phasellus vitae purus varius, efficitur enim vitae, dapibus tellus. Etiam non turpis suscipit, commodo nisi id, tristique sapien. </br> Cras facilisis justo ut diam imperdiet feugiat. Mauris commodo nisl ac elit hendrerit viverra. Etiam malesuada nibh eget nisi consequat semper. Etiam porttitor euismod ullamcorper. Duis quis risus facilisis, semper lorem at, pulvinar lorem. Aenean pharetra aliquet lorem at elementum. Fusce maximus enim diam, at cursus sem ornare ut. Proin ut ex mattis, maximus augue vitae, facilisis velit. In hac habitasse platea dictumst. Vivamus ac magna at magna mollis lacinia. Etiam eget lacinia dolor. Fusce nisi turpis, vestibulum ac nulla et, semper dignissim odio. Proin mollis augue ut augue convallis porta. Pellentesque tincidunt aliquam nibh. Suspendisse potenti. Praesent sagittis erat magna, in eleifend nisl blandit quis.</p>',
        );

        SubmissionUpvoted::fire(
            user_id: $john->id,
            round_id: $story->currentRound()->id,
            submission_id: $story->currentRound()->submissions()->last()->id,
        );

        RoundEnded::fire(
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            guild_id: $guild_id,
        );

        SubmissionAdded::fire(
            user_id: $jacob->id,
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            type: 'paragraph', 
            content: '<p>Vestibulum suscipit eros id arcu gravida, in placerat tortor sodales. Nunc auctor eu purus a tincidunt. Nam et elementum tellus, nec varius lacus. Pellentesque interdum commodo justo, nec convallis enim dapibus nec. Sed blandit tristique erat a tempor. Mauris felis mi, ultrices quis nibh non, egestas scelerisque ante. In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc bibendum turpis ex, et efficitur lectus pellentesque eget. Sed commodo eros aliquet, tristique lectus nec, rhoncus dolor.</p>',
        );

        SubmissionUpvoted::fire(
            user_id: $john->id,
            round_id: $story->currentRound()->id,
            submission_id: $story->currentRound()->submissions()->last()->id,
        );

        SubmissionUpvoted::fire(
            user_id: $jacob->id,
            round_id: $story->currentRound()->id,
            submission_id: $story->currentRound()->submissions()->last()->id,
        );

        RoundEnded::fire(
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            guild_id: $guild_id,
        );

        SubmissionAdded::fire(
            user_id: $jacob->id,
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            type: 'paragraph', 
            content: '<p>Cras libero est, faucibus sed mauris sagittis, efficitur bibendum turpis. Nam imperdiet sed mi at condimentum. Nullam elementum, massa vitae commodo consectetur, enim nulla lacinia dui, suscipit faucibus ligula quam sit amet dolor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed ornare lacus metus, vitae euismod ex accumsan id. Pellentesque semper ornare vestibulum. Nullam lectus ante, varius eu semper ac, venenatis eu risus. Nullam maximus nisl eu lacus pretium faucibus. Fusce scelerisque, massa a facilisis euismod, orci nulla imperdiet mauris, vitae maximus dui mi sit amet ex. Nunc blandit risus ac nibh fermentum, quis aliquet metus varius. </br>Morbi eleifend neque metus, a convallis neque dignissim eget. Integer in lacus a arcu mattis sodales sit amet sit amet dolor. Duis bibendum velit ut libero pretium laoreet. Pellentesque at eros ac nisl gravida blandit. Mauris posuere, arcu ac ultricies mollis, lorem lacus dignissim neque, a mollis ipsum mi vitae elit. Praesent mollis quam lectus, id convallis risus hendrerit vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a viverra tellus, quis gravida ipsum. Vivamus eu est et ligula vestibulum pharetra. Praesent pretium tempus tortor, ac semper augue sollicitudin id. Curabitur dictum molestie sapien eget ullamcorper. Integer molestie, est et volutpat pellentesque, dui ex lobortis erat, ac rhoncus purus nunc eu risus. Fusce interdum libero a sapien imperdiet, vel facilisis mauris dapibus. Nam dignissim fringilla odio in ornare. Praesent et efficitur elit.</p>',
        );

        SubmissionUpvoted::fire(
            user_id: $john->id,
            round_id: $story->currentRound()->id,
            submission_id: $story->currentRound()->submissions()->last()->id,
        );

        SubmissionUpvoted::fire(
            user_id: $jacob->id,
            round_id: $story->currentRound()->id,
            submission_id: $story->currentRound()->submissions()->last()->id,
        );

        SubmissionUpvoted::fire(
            user_id: $daniel->id,
            round_id: $story->currentRound()->id,
            submission_id: $story->currentRound()->submissions()->last()->id,
        );

        RoundEnded::fire(
            story_id: $story_id,
            round_id: $story->currentRound()->id,
            guild_id: $guild_id,
        );

        $guild_id = GuildCreated::fire(
            name: "Inklings",
            is_open: false,
            is_public: false,
        )->guild_id;

        UserJoinedGuild::fire(
            guild_id: $guild_id,
            user_id: $john->id,
        );
    }
}
