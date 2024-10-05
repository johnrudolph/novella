<div class="text-black dark:text-white font-serif">
    <div class="max-w-lg mx-auto">
        <div class="sticky top-0 py-8 bg-tan z-10">
            <h1 class="text-2xl font-bold ">{{ $this->story->title }}</h1>
        </div>
        @foreach ($this->story_state->canon() as $entry)
            <div class="flex flex-row relative hover:text-aqua pb-8 group">
                @if ($entry->type === 'new_chapter')
                    <h2 class="text-md font-bold">{{ $entry->content }}</h2>
                @else
                    {!! $entry->content !!}
                @endif
                <div class="absolute left-full text-xs ml-4 w-full top-0 flex flex-col hidden group-hover:flex text-slate-700 dark:text-slate-300">
                    <div class="flex flex-row space-x-1">
                        <div>
                            {{ $entry->author()->name }}
                        </div>
                        <div class="bg-aqua px-2 rounded-md ">
                            {{ $entry->author()->applause }}
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
        
        {{-- text editor --}}
        <div class="pb-8 text-white">
            <!-- Include stylesheet -->
            <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

            <!-- Create the editor container -->
            <div id="editor">

            </div>

            <!-- Include the Quill library -->
            <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

            <!-- Initialize Quill editor -->
            <script>
                const quill = new Quill('#editor', {
                    theme: 'snow'
                });
            </script>
        </div>

    </div>
</div>
