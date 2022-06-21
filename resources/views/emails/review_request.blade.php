@component('mail::message')

Hi {{$order->customer->first_name}} {{$order->customer->last_name}},

Thanks for getting in touch with Scholarly Help! We hope you’re happy with our services.
We’d love to get your feedback on the service.

@component('mail::table')
**Order Number** ({{$order->number}}) **Order Date** ({{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
$order->dead_line)->format('Y-m-d H:i:s')}})
@endcomponent

@component('mail::button', ['url' => route('orders_rating', ['order' => $order->id ])])
Review My Order!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent