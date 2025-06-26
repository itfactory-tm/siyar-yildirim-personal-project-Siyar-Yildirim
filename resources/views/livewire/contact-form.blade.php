<form wire:submit.prevent="sendEmail" class="space-y-4">
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-2 md:col-span-1">
            <x-label for="name" value="Name"/>
            <x-input id="name" type="text" wire:model.live.debounce.500ms="name" class="w-full" placeholder="Your name"/>
            <x-input-error for="name" class="mt-1"/>
        </div>

        <div class="col-span-2 md:col-span-1">
            <x-label for="email" value="Email"/>
            <x-input id="email" type="email" wire:model.live.blur="email" class="w-full" placeholder="Your email"/>
            <x-input-error for="email" class="mt-1"/>
        </div>

        <div class="col-span-2">
            <x-label for="message" value="Message"/>
            <textarea id="message" wire:model.live.debounce.500ms="message" class="w-full border rounded p-2" rows="5" placeholder="Your message"></textarea>
            <x-input-error for="message" class="mt-1"/>
        </div>

        <div class="col-span-2">
            <x-tmk.form.button type="submit" :disabled="!$canSubmit">Send Message</x-tmk.form.button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="text-green-500 mt-4">{{ session('success') }}</div>
    @endif
</form>
