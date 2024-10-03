<div>
    <flux:heading size="xl" class="mb-8">Novella</flux:heading>

    <flux:card>
        <flux:heading>Write together daily.</flux:heading>

        <div class="flex flex-col space-y-2 mt-6 dark:text-slate-300">
            <div class="flex flex-row space-x-2">
                <flux:icon.pencil variant="solid"/>
                <p>Submit the next paragraph of your guild's story.</p>
            </div>
            <div class="flex flex-row space-x-2">
                <flux:icon.hand-thumb-up variant="solid" />
                <p>The most applauded submission is added to the story.</p>
            </div>
            <div class="flex flex-row space-x-2">
                <flux:icon.user-group variant="solid"/>
                <p>Start your own guilds, and invite your friends.</p>
            </div>
        </div>

        <div class="mt-8 flex flex-row space-x-4 mx-auto items-center">
            <flux:button href="{{ route('login') }}" variant="filled">Login</flux:button>
            <flux:button href="{{ route('register') }}" variant="primary">Sign up</flux:button>
        </div>
    </flux:card>
</div>
