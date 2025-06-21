<x-earthify-layout>

    <x-slot name="description">New description</x-slot>
    <x-slot name="title">Welcome Earthify</x-slot>

    <p>Welcome to the website of Earthify, a large online store with lots of sustainable products.</p>

    <hr class="my-4">
    <h2>heading 2</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium blanditiis commodi dolorem eaque error esse
        eum impedit iusto necessitatibus optio, perferendis possimus quaerat, quod rem sapiente suscipit voluptates!
        Repudiandae, tempore?</p>
    <h3>heading 3</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A at dolor dolorum fugit ipsam iusto laborum
        perferendis reprehenderit sapiente tenetur. Ab architecto autem dolorem illo maiores minima natus repellat
        vitae.</p>

    <h2>Search</h2>
    <x-tmk.form.search placeholder="Search..." />

    <section>
        <h2>Toggle switch</h2>
        <div class="flex items-center gap-4">
            <x-tmk.form.toggle-switch />
            <x-tmk.form.toggle-switch color="success" checked />
            <x-tmk.form.toggle-switch color="danger" class="rotate-90"/>
            <x-tmk.form.toggle-switch color="info" />
            <x-tmk.form.toggle-switch color="danger" checked disabled />
        </div>
    </section>

    <section class="my-4">
        <h2>Switch</h2>
        <div class="flex items-center gap-4">
            <x-tmk.form.switch />
            <x-tmk.form.switch checked color-off="bg-red-200"/>
            <x-tmk.form.switch disabled/>
            <x-tmk.form.switch checked name="save" value="Save me"
                               class="text-white shadow-lg !rounded-full w-28"
                               color-off="bg-orange-800" color-on="bg-sky-800"
                               text-off="switch off" text-on="switch on"/>
            <x-tmk.form.switch name="user" value="on"
                               class="!h-20 !text-5xl"
                               color-off="bg-red-200" color-on="bg-green-500"
                               text-on="😊" text-off="😩"/>
        </div>
    </section>
</x-earthify-layout>
