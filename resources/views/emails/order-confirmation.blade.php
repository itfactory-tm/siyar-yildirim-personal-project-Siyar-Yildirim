<x-mail::message>
    # Dear {{ auth()->user()->name }},

    Thank you for your order.
    The records will be delivered as soon as possible.

    Order summary:
    @foreach ($data['products'] as $product)
        {{ $product['qty'] }} x {{ $product['name'] }}
    @endforeach

    Total price: $ {{ $data['total'] }}

    Shipping address:
    {{ $data['address'] }}
    {{ $data['zip'] }} {{ $data['city'] }}
    {{ $data['country'] }}

    @if(!empty($data['notes']))Notes: {{ $data['notes'] }}@endif

    @if(count($data['backorder']) > 0)
        Backorder:
        @foreach ($data['backorder'] as $item)
            {{ $item }}
        @endforeach
    @endif

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
