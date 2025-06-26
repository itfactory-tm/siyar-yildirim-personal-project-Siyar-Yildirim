<x-earthify-layout>
    <x-slot name="description">Get in touch with Earthify to learn more about our environmental solutions</x-slot>
    <x-slot name="title">Contact info - Earthify</x-slot>

    <div class="grid grid-cols-4 gap-4">
        <x-tmk.section class="col-span-4 lg:col-span-3 lg:order-2">
            {{-- embed the Livewire ContactForm component --}}
            @livewire('contact-form')
        </x-tmk.section>
        <section class="col-span-4 lg:col-span-1 lg:order-1">
            <h3>Earthify Shop</h3>
            <p>Brederodestraat 16</p>
            <p class="pb-2 border-b">1000 Brussel - Belgium</p>
            <p class="flex items-center pt-2 cursor-pointer">
                <x-phosphor-phone-call class="w-6 mr-2 text-gray-400"/>
                <a href="tel:+3214562310" class="mr-2">+32 123 45 67 89</a>
            </p>
            <p class="flex items-center pt-2 cursor-pointer">
                <x-heroicon-o-envelope-open class="w-6 mr-2 text-gray-400"/>
                <a href="mailto:info@earthifyshop.com">info@earthifyshop.com</a>
            </p>
        </section>
    </div>


</x-earthify-layout>
