<div>
    <flux:heading>Create your first story</flux:heading>
    <flux:subheading>In Novella, you only move forward, and don't make revisions. So you won't be able to change this title once you choose it.</flux:subheading>
    <flux:card class="mt-6">
        <flux:input wire:model="title" label="Title" placeholder="My first story" />
        <flux:button class="mt-6" variant="primary" wire:click="create">
            Create
        </flux:button>
    </flux:card>
</div>
