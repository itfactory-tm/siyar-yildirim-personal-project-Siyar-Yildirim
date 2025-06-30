<div>
    <x-tmk.section
        class="!p-0 mb-4 flex flex-col gap-2">
        <div class="p-4 flex justify-between items-start gap-4">
            <div class="flex gap-4 flex-1">
                <div class="relative flex-1">
                    <x-input id="newSupplierName" type="text" placeholder="Supplier name"
                             @keydown.enter="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             @keydown.tab="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             @keydown.esc="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             wire:model="newSupplier.name"
                             wire:keydown.enter="create()"
                             wire:keydown.tab="create()"
                             wire:keydown.escape="resetValues()"
                             class="w-full shadow-md placeholder-gray-300"/>
                    <x-input-error for="newSupplier.name" class="mt-1"/>
                </div>
                <div class="relative flex-1">
                    <x-input id="newSupplierEmail" type="email" placeholder="Email address (optional)"
                             @keydown.enter="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             @keydown.tab="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             @keydown.esc="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             wire:model="newSupplier.email"
                             wire:keydown.enter="create()"
                             wire:keydown.tab="create()"
                             wire:keydown.escape="resetValues()"
                             class="w-full shadow-md placeholder-gray-300"/>
                    <x-input-error for="newSupplier.email" class="mt-1"/>
                </div>
                <div class="relative flex-1">
                    <x-input id="newSupplierPhone" type="tel" placeholder="Phone number (optional)"
                             @keydown.enter="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             @keydown.tab="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             @keydown.esc="if(!$el.disabled) { $el.setAttribute('disabled', true); }"
                             wire:model="newSupplier.phone"
                             wire:keydown.enter="create()"
                             wire:keydown.tab="create()"
                             wire:keydown.escape="resetValues()"
                             class="w-full shadow-md placeholder-gray-300"/>
                    <x-input-error for="newSupplier.phone" class="mt-1"/>
                </div>
                <button type="button"
                        wire:click="create()"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors whitespace-nowrap">
                    Add Supplier
                </button>
            </div>
        </div>

        {{-- Display delete error if any --}}
        <x-input-error for="delete" class="mx-4 mb-2"/>

        <x-phosphor-arrows-clockwise
            wire:loading
            wire:target="create"
            class="hidden size-5 text-gray-500 absolute top-3 right-2 animate-spin"/>

        <div
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-tmk.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    <b>A new supplier</b> can be added by filling in the name (required) and optionally email and phone, then pressing <b>enter</b>, <b>tab</b>, or clicking "Add Supplier". Press <b>escape</b> to clear the form.
                </li>
                <li>
                    <b>Edit a supplier</b> by clicking the
                    <x-phosphor-pencil-line-duotone class="w-5 inline-block"/>
                    icon or by clicking on the supplier name, email, or phone number. Press <b>enter</b> to save, <b>escape</b> to undo.
                </li>
                <li>
                    Clicking the
                    <x-heroicon-o-information-circle class="w-5 inline-block"/>
                    icon will toggle this message on and off.
                </li>
            </x-tmk.list>
        </div>
    </x-tmk.section>

    <x-tmk.section>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-16">
                <col class="w-8">
                <col class="w-24">
                <col class="w-24">
                <col class="w-32">
                <col class="w-32">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <x-tmk.table.sortable-header wire:click="resort('id')" position="center" :sortColumn="$sortColumn" :sortOrder="$sortOrder">
                    id
                </x-tmk.table.sortable-header>
                <x-tmk.table.sortable-header wire:click="resort('products_count')" position="center" :sortColumn="$sortColumn" :sortOrder="$sortOrder"></x-tmk.table.sortable-header>
                <th>Edit</th>
                <x-tmk.table.sortable-header wire:click="resort('name')" :sortColumn="$sortColumn" :sortOrder="$sortOrder">
                    Supplier
                </x-tmk.table.sortable-header>
                <x-tmk.table.sortable-header wire:click="resort('email')" :sortColumn="$sortColumn" :sortOrder="$sortOrder">
                    Email
                </x-tmk.table.sortable-header>
                <x-tmk.table.sortable-header wire:click="resort('phone')" :sortColumn="$sortColumn" :sortOrder="$sortOrder">
                    Phone number
                </x-tmk.table.sortable-header>
            </tr>
            </thead>
            <tbody>
            @foreach($suppliers as $supplier)
                <tr wire:key="{{ $supplier->id }}" class="border-t border-gray-300 [&>td]:p-2">
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->products_count }}</td>
                    <td>
                        @if($editSupplier['id'] !== $supplier->id)
                            <div class="flex gap-1 justify-center [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                                <x-phosphor-pencil-line-duotone
                                    wire:click="edit({{ $supplier->id }})"
                                    class="w-5 text-gray-300 hover:text-green-600"/>
                                @if($supplier->products_count == 0)
                                    <x-phosphor-trash-duotone
                                        wire:click="delete({{ $supplier->id }})"
                                        wire:confirm="Are you sure you want to delete this supplier?"
                                        class="w-5 text-gray-300 hover:text-red-600"/>
                                @else
                                    <x-phosphor-trash-duotone
                                        title="Cannot delete - supplier has {{ $supplier->products_count }} product(s)"
                                        class="w-5 text-gray-200 cursor-not-allowed"/>
                                @endif
                            </div>
                        @endif
                    </td>

                    {{-- Supplier Name Column --}}
                    @if($editSupplier['id'] !== $supplier->id)
                        <td class="text-left cursor-pointer" wire:click="edit({{ $supplier->id }})">
                            {{ $supplier->name }}
                        </td>
                    @else
                        <td>
                            <div class="flex flex-col text-left">
                                <x-input id="edit_name_{{ $supplier->id }}" type="text"
                                         x-init="$el.focus()"
                                         @keydown.enter="$el.setAttribute('disabled', true);"
                                         @keydown.tab="$el.setAttribute('disabled', true);"
                                         @keydown.esc="$el.setAttribute('disabled', true);"
                                         wire:model="editSupplier.name"
                                         wire:keydown.enter="update({{ $supplier->id }})"
                                         wire:keydown.tab="update({{ $supplier->id }})"
                                         wire:keydown.escape="resetValues()"
                                         class="w-48"/>
                                <x-input-error for="editSupplier.name" class="mt-2"/>
                            </div>
                        </td>
                    @endif

                    {{-- Email Column --}}
                    @if($editSupplier['id'] !== $supplier->id)
                        <td class="text-left cursor-pointer" wire:click="edit({{ $supplier->id }})">
                            {{ $supplier->email ?: '-' }}
                        </td>
                    @else
                        <td>
                            <div class="flex flex-col text-left">
                                <x-input id="edit_email_{{ $supplier->id }}" type="email"
                                         @keydown.enter="$el.setAttribute('disabled', true);"
                                         @keydown.tab="$el.setAttribute('disabled', true);"
                                         @keydown.esc="$el.setAttribute('disabled', true);"
                                         wire:model="editSupplier.email"
                                         wire:keydown.enter="update({{ $supplier->id }})"
                                         wire:keydown.tab="update({{ $supplier->id }})"
                                         wire:keydown.escape="resetValues()"
                                         placeholder="Email address"
                                         class="w-48"/>
                                <x-input-error for="editSupplier.email" class="mt-2"/>
                            </div>
                        </td>
                    @endif

                    {{-- Phone Column --}}
                    @if($editSupplier['id'] !== $supplier->id)
                        <td class="text-left cursor-pointer" wire:click="edit({{ $supplier->id }})">
                            {{ $supplier->phone ?: '-' }}
                        </td>
                    @else
                        <td>
                            <div class="flex flex-col text-left">
                                <x-input id="edit_phone_{{ $supplier->id }}" type="tel"
                                         @keydown.enter="$el.setAttribute('disabled', true);"
                                         @keydown.tab="$el.setAttribute('disabled', true);"
                                         @keydown.esc="$el.setAttribute('disabled', true);"
                                         wire:model="editSupplier.phone"
                                         wire:keydown.enter="update({{ $supplier->id }})"
                                         wire:keydown.tab="update({{ $supplier->id }})"
                                         wire:keydown.escape="resetValues()"
                                         placeholder="Phone number"
                                         class="w-48"/>
                                <x-input-error for="editSupplier.phone" class="mt-2"/>
                            </div>
                        </td>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </x-tmk.section>
</div>
