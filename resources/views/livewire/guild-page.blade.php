<div>
    <div class="mb-4">
        <flux:heading>{{ $this->guild->name }}</flux:heading>
        <flux:subheading>{{ $this->guild->motto }}</flux:subheading>
    </div>
    <flux:tab.group>
        <flux:tabs>
            <flux:tab name="stories" icon="newspaper">Stories</flux:tab>
            <flux:tab name="writers" icon="user-group">Writers</flux:tab>
            @if($this->is_admin)
                <flux:tab name="manage" icon="cog-6-tooth">Manage</flux:tab>
            @endif
        </flux:tabs>

        <flux:tab.panel name="stories">
            @foreach($this->stories as $story) 
                <flux:card>
                    <div class="flex justify-between items-center">
                        <flux:heading size="lg">{{ $story->title }}</flux:heading>
                        @if($story->status === 'in-progress')
                            <flux:badge color="green">In progress</flux:badge>
                        @elseif($story->status === 'complete')
                            <flux:badge color="zinc">Complete</flux:badge>
                        @endif
                    </div>

                    <flux:subheading class="mb-4">
                        <p></p>
                    </flux:subheading>
                </flux:card>
            @endforeach
        </flux:tab.panel>

        <flux:tab.panel name="writers">
            <flux:table>
                <flux:columns>
                    <flux:column>Writer</flux:column>
                    <flux:column>Applause</flux:column>
                    <flux:column>Role</flux:column>
                </flux:columns>

                <flux:rows>
                    @foreach ($this->writers as $writer)
                        <flux:row :key="$writer->id">
                            <flux:cell class="flex items-center gap-3">
                                {{ $writer->name }}
                            </flux:cell>

                            <flux:cell>{{ $writer->applause }}</flux:cell>

                            <flux:cell>
                                @if ($this->guild_state->admin_ids->contains($writer->id)) 
                                    <flux:badge size="sm" color="zinc" inset="top bottom">Admin</flux:badge>
                                @endif
                            </flux:cell>
                        </flux:row>
                    @endforeach
                </flux:rows>
            </flux:table>
        </flux:tab.panel>
        
        <flux:tab.panel name="manage">
            <flux:fieldset>
                <flux:input wire:model="name" label="Name" />

                <flux:textarea
                    label="Motto"
                    wire:model="motto"
                    placeholder="There is nothing to writing. All you do is sit down at a typewriter and bleed"
                    rows="auto"
                    class="mb-8"
                />

                <flux:legend>Permissions</flux:legend>

                <div class="space-y-4">
                    <flux:switch 
                        label="Allow anyone to read" 
                        description="Guild stories are available to the public to read." 
                        wire:model.live="is_public"
                        value="true"
                    />

                    <flux:separator variant="subtle" />
                    <flux:switch 
                        label="Allow anyone to join" 
                        description="Anyone can join this Guild, regardless of whether they were invited." 
                        wire:model.live="is_open"
                    />

                    <flux:separator variant="subtle" />
                </div>
            </flux:fieldset>
            <flux:button class="mt-8" variant="primary" wire:click="updateGuild" x-on:click="$wire.$refresh()">
                Save changes
            </flux:button>
        </flux:tab.panel>
    </flux:tab.group>
</div>
