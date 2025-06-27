<x-mail::message>
    # Dear {{ $data['name'] }},
    Thanks for your message.
    We'll contact you as soon as possible.

    Your name:{{ $data['name'] }}
    Your email: {{ $data['email'] }}

    Your message: {!! nl2br($data['message']) !!}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
