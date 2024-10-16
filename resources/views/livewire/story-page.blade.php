<div class="text-black dark:text-white font-serif">
    <flux:tab.group>
        <flux:tabs>
            <flux:tab name="story" icon="newspaper">{{ $this->story->title }}</flux:tab>
            @if($this->story->status === 'in-progress')
                <flux:tab name="what-happens-next" icon="pencil">What happens next</flux:tab>
            @endif
        </flux:tabs>

        {{-- story --}}
        <flux:tab.panel name="story">
            <div class="">
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

        {{-- what happens next --}}
        <flux:tab.panel name="what-happens-next">

            {{-- new submission --}}
            @unless($this->user_submission)
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
            @endunless

            {{-- existing submissions --}}
            <div class="flex flex-col space-y-4">
                @foreach($this->all_submissions as $sub)
                    <flux:card>
                        <div class="flex flex-row justify-between">
                            <flux:heading>
                                @if($sub->type === 'paragraph')

                                @elseif($sub->type === 'new_story')
                                    End story and begin a new one with the title: 
                                @elseif($sub->type === 'new_chapter')
                                    End chapter and begin a new one with the title:   
                                @endif
                            </flux:heading>
                            <div class="flex flex-row space-x-2">
                                <flux:icon.hand-thumb-up variant="solid" />
                                <p>{{ $sub->applause }}</p>
                            </div>
                        </div>
                        {!! $sub->content !!}
                    </flux:card>
                @endforeach
            </div>
        </flux:tab.panel>
    </flux:tab-group>
</div>