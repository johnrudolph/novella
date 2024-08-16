@php
    $currentStory = App\Models\Story::all()->last();
@endphp

<livewire:story-page :story="{{currentStory()}}" />