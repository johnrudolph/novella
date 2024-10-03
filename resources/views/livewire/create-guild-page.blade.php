<div>
    <div class="mb-4">
        <flux:heading>Create a new Guild</flux:heading>
    </div>
    <flux:card>
        <flux:fieldset>
            <flux:input wire:model="name" label="Name" placeholder="Inklings" />

            <flux:textarea
                label="Motto"
                wire:model="motto"
                placeholder="There is nothing to writing. All you do is sit down at a typewriter and bleed"
                rows="auto"
            />

            <div class="mt-8 space-y-4">
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
        <flux:button class="mt-8" variant="primary" wire:click="create">
            Create
        </flux:button>
    </flux:card>
</div>
