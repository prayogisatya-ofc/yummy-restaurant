<x-mail::message>
# Your Booking Status : {{ isset($data['status']) ? $data['status'] : 'pending' }}

Dear {{ $data['name'] }},

@if (isset($data['status']))
@if ($data['status'] == 'pending')
Your booking is currently Pending and will be reviewed by our team. We will notify you as soon as possible via email once your booking status has been updated.
@elseif ($data['status'] == 'success')
Your booking has been Success. We will prepare everything for your arrival. Don't forget to check your booking status regularly.
@else
Your booking has been Failed. Please try again later.
@endif
@else
Your booking is currently Pending and will be reviewed by our team. We will notify you as soon as possible via email once your booking status has been updated.
@endif

<ul>
    <li>Type: {{ $data['type'] }}</li>
    <li>Name: {{ $data['name'] }}</li>
    <li>Email: {{ $data['email'] }}</li>
    <li>Phone: {{ $data['phone'] }}</li>
    <li>Date: {{ $data['date'] }}</li>
    <li>Time: {{ $data['time'] }}</li>
    <li>People: {{ $data['people'] }}</li>
    <li>Amount: Rp {{ number_format($data['amount'], 0, ',', '.') }}</li>
    <li>Message: {{ $data['messages'] }}</li>
</ul>

Please do not hesitate to contact us if you have any questions. 

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
