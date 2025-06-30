<div x-data="{ showSuccess: @entangle('showSuccessModal'), showError: @entangle('showErrorModal') }">

    <div x-show="showSuccess" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-lg font-bold mb-4 text-green-700">Success!</h2>
            <p>Your message has been sent successfully.</p>
            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded" @click="showSuccess = false">
                Close
            </button>
        </div>
    </div>

    <div x-show="showError" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-lg font-bold mb-4 text-red-700">Error</h2>
            <p>Something went wrong while sending your message. Please try again.</p>
            <button class="mt-4 px-4 py-2 bg-red-600 text-white rounded" @click="showError = false">
                Close
            </button>
        </div>
    </div>

    {{-- 💬 Contact Form --}}
    <form wire:submit.prevent="sendEmail" class="grid grid-cols-2 gap-4">
        <div class="col-span-2 md:col-span-1">
            <x-label for="name" value="Name" />
            <x-input id="name" wire:model.live.debounce.500ms="name" type="text" class="w-full" />
            <x-input-error for="name" class="mt-1" />
        </div>

        <div class="col-span-2 md:col-span-1">
            <x-label for="email" value="Email" />
            <x-input id="email" wire:model.live.blur="email" type="email" class="w-full" />
            <x-input-error for="email" class="mt-1" />
        </div>

        <div class="col-span-2">
            <x-label for="message" value="Message" />
            <x-tmk.form.textarea id="message" wire:model.live.debounce.500ms="message" rows="5" class="w-full" />
            <x-input-error for="message" class="mt-1" />
        </div>

        <div class="col-span-2">
            <x-tmk.form.button type="submit" :disabled="!$canSubmit" color="primary" class="w-full col-span-2">
                Send Message
            </x-tmk.form.button>
        </div>
    </form>
</div>
