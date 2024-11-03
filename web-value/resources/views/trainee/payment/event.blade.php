@extends('trainee.layouts.app')

@section('title', 'Events List')

@section('content')
    <h1>Payment Post</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Total Amount: {{ $order->total_amount }}</p>
    <h2>Payment Methods</h2>
    <ul>
        @foreach ($paymentMethods as $method)
            <li>{{ $method->name }}</li>
        @endforeach
    </ul>
@endsection
