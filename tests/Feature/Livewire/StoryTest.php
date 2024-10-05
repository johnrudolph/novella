<?php

use Thunk\Verbs\Facades\Verbs;
use App\Events\SubmissionAdded;
use App\Models\Submission;

beforeEach( function () {
    Verbs::commitImmediately();
    $this->runSeeder();
});

it('normalizes line breaks in submsissions', function() {
    $id = SubmissionAdded::fire(
        user_id: $this->daniel->id,
        story_id: $this->universal_story->id,
        round_id: $this->universal_story->currentRound()->id,
        type: 'paragraph', 
        content: '<p>Test </br> Test </br> </br> </br> </br> </br> </br> </br> </br> Test</p>',
    )->submission_id;

    $submission = Submission::find($id);

    expect($submission->content)->toBe('<p>Test </br> </br> Test </br> </br>Test</p>');
});

it('Removes whitespace from submsissions', function() {
    $id = SubmissionAdded::fire(
        user_id: $this->daniel->id,
        story_id: $this->universal_story->id,
        round_id: $this->universal_story->currentRound()->id,
        type: 'paragraph', 
        content: '<p>   Test           test        .   </p>',
    )->submission_id;

    $submission = Submission::find($id);

    expect($submission->content)->toBe('<p> Test test . </p>');
});