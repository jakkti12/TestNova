@extends('layouts.app')

@section('title', 'คำสั่งซื้อ #' . $order->order_number)

@section('content')
    <section class="py-2xl">
        <div class="container container-sm">
            <div class="mb-xl">
                <a href="{{ route('orders.index') }}" class="text-primary" style="text-decoration: none;">←
                    กลับไปยังคำสั่งซื้อทั้งหมด</a>
            </div>

            <!-- Order Header -->
            <div class="card mb-xl">
                <div class="card-body">
                    <div class="flex justify-between items-center mb-md">
                        <div>
                            <h2 style="margin-bottom: var(--spacing-xs);">{{ $order->order_number }}</h2>
                            <p class="text-gray">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <span class="badge badge-{{ $order->status_color }}"
                            style="font-size: 1rem; padding: 0.5rem 1.5rem;">{{ $order->status_label }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2" style="gap: var(--spacing-lg);">
                <!-- Order Items -->
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-lg">รายการสินค้า</h4>

                            @foreach($order->items as $item)
                                <div class="flex gap-md mb-md"
                                    style="padding-bottom: var(--spacing-md); border-bottom: 1px solid var(--color-gray-light);">
                                    <div style="flex: 1;">
                                        <p class="font-semibold">{{ $item->product_name }}</p>
                                        <p class="text-sm text-gray">{{ number_format($item->product_price, 0) }} ฿ ×
                                            {{ $item->quantity }}</p>
                                    </div>
                                    <p class="font-bold">{{ number_format($item->subtotal, 0) }} ฿</p>
                                </div>
                            @endforeach

                            <div class="mt-lg">
                                <div class="flex justify-between mb-sm">
                                    <span>ยอดรวม</span>
                                    <span>{{ number_format($order->subtotal, 0) }} ฿</span>
                                </div>
                                <div class="flex justify-between mb-sm">
                                    <span>ค่าจัดส่ง</span>
                                    <span>{{ number_format($order->shipping, 0) }} ฿</span>
                                </div>
                                <div class="flex justify-between font-bold text-xl"
                                    style="padding-top: var(--spacing-md); border-top: 2px solid var(--color-dark);">
                                    <span>ยอดรวมทั้งหมด</span>
                                    <span class="text-primary">{{ number_format($order->total, 0) }} ฿</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Info -->
                <div>
                    <!-- Customer Info -->
                    <div class="card mb-lg">
                        <div class="card-body">
                            <h4 class="mb-md">ข้อมูลผู้สั่งซื้อ</h4>
                            <p><strong>ชื่อ:</strong> {{ $order->customer_name }}</p>
                            <p><strong>อีเมล:</strong> {{ $order->customer_email }}</p>
                            <p><strong>เบอร์โทร:</strong> {{ $order->customer_phone }}</p>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="card mb-lg">
                        <div class="card-body">
                            <h4 class="mb-md">ที่อยู่จัดส่ง</h4>
                            <p>{{ $order->shipping_address }}</p>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-md">วิธีชำระเงิน</h4>
                            <p>{{ $order->payment_method == 'transfer' ? 'โอนเงิน' : 'เก็บเงินปลายทาง' }}</p>
                            @if($order->notes)
                                <p class="mt-md"><strong>หมายเหตุ:</strong> {{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection