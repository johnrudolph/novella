<div>
    <flux:tab.group>
        <flux:tabs>
            <flux:tab name="story" icon="newspaper">{{ $this->story->title }}</flux:tab>
            <flux:tab name="what-happens-next" icon="pencil">What happens next</flux:tab>
        </flux:tabs>
        <flux:tab.panel name="story">
            <div class="text-black dark:text-white font-serif">
                <div class="top-0 pb-6 bg-tan z-10">
                    <h1 class="text-2xl font-bold ">{{ $this->story->title }}</h1>
                </div>
                @foreach ($this->story_state->canon() as $entry)
                    <div class="flex flex-row relative hover:text-aqua pb-6 group">
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
            </div>
        </flux:tab.panel>
        <flux:tab.panel name="what-happens-next">
            <div wire:ignore class="text-black dark:text-white">
                <!-- Include stylesheet -->
                <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
            
                <!-- Create the editor container -->
                <div id="{{ $quillId }}" wire:ignore></div>
            
                <!-- Include the Quill library -->
                <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
            
                <!-- Initialize Quill editor -->
                <script>
                    const quill = new Quill('#{{ $quillId }}', {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                ['bold', 'italic', 'underline', 'strike'],
                            ]
                        }
                    });

                    quill.on('text-change', function () {
                        let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
                        @this.set('value', value)
                    })
                </script>
            </div>
            <flux:button wire:click="submit">Submit</flux:button>
        </flux:tab.panel>
    </flux:tab-group>
</div>