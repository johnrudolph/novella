<div class="">
    <div class="max-w-lg mx-auto">
        <div class="sticky top-0 py-8 bg-tan">
            <h1 class="text-2xl font-bold">{{ $this->story->title }}</h1>
        </div>
        @foreach ($this->story_state->canon() as $entry)
            <div class="flex flex-row relative hover:text-aqua pb-8 group">
                @if ($entry->type === 'new_chapter')
                    <h2 class="text-md font-bold pb-8">{{ $entry->content }}</h2>
                @else
                    {!! $entry->content !!}
                @endif
                <div class="absolute left-full text-xs ml-4 w-full top-0 flex flex-col hidden group-hover:flex">
                    <div class="flex flex-row space-x-1">
                        <div>
                            {{ $entry->author()->name }}
                        </div>
                        <div class="bg-aqua px-2 rounded-md text-tan">
                            {{ $entry->author()->clout }}
                        </div>
                    </div>
                    <div class="flex flex-row space-x-2 opacity-80">
                        <div>
                            {{ $entry->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
