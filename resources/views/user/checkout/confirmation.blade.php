@extends('user.layouts.master-layouts.plain')

@section('title', 'Order Confirmation')

@section('content')
<div class="container mx-auto my-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-green-600 mb-4">🎉 Thank You! Your Order is Confirmed</h2>
        <p class="text-gray-600 mb-6">Your order <strong>#{{ $order->id }}</strong> has been successfully placed.</p>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Order Details</h3>
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Product</th>
                        <th class="p-2 border">Size</th>
                        <th class="p-2 border">Color</th>
                        <th class="p-2 border">Qty</th>
                        <th class="p-2 border">Price</th>
                        <th class="p-2 border">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td class="p-2 border">{{ $item->product->name ?? 'N/A' }}</td>
                            <td class="p-2 border">{{ $item->size?->name ?? '-' }}</td>
                            <td class="p-2 border">{{ $item->color?->name ?? '-' }}</td>
                            <td class="p-2 border">{{ $item->quantity }}</td>
                            <td class="p-2 border">Rs {{ number_format($item->price, 0) }}</td>
                            <td class="p-2 border">Rs {{ number_format($item->total, 0) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-right mb-6">
            <p><strong>Subtotal:</strong> Rs {{ number_format($order->subtotal, 0) }}</p>
            <p><strong>Shipping:</strong> Rs {{ number_format($order->shipping, 250) }}</p>
            <p><strong>Discount:</strong> Rs {{ number_format($order->discount, 0) }}</p>
            <p class="text-xl font-bold mt-2">Total: Rs {{ number_format($order->total, 0) }}</p>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('product') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">🛍️ Continue Shopping</a>
            <a href="{{ route('order.invoice.download', $order->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">⬇️ Download Invoice</a>
        </div>
    </div>
</div>
@endsection
