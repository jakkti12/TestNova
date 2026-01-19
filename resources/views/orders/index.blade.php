@extends('layouts.app')

@section('title', 'คำสั่งซื้อของฉัน')

@section('content')
    <section class="py-2xl">
        <div class="container">
            <h1 class="mb-xl">คำสั่งซื้อของฉัน</h1>

            @if($orders->isEmpty())
                <div class="card text-center py-3xl">
                    <div style="font-size: 4rem; margin-bottom: var(--spacing-lg);">📦</div>
                    <h3>ยังไม่มีคำสั่งซื้อ</h3>
                    <p class="text-gray mt-md mb-xl">เริ่มช้อปปิ้งเลย!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">ดูสินค้าทั้งหมด</a>
                </div>
            @else
                <div class="grid" style="gap: var(--spacing-lg);">
                    @foreach($orders as $order)
                        <div class="card">
                            <div class="card-body">
                                <div class="flex justify-between items-center mb-md">
                                    <div>
                                        <h4 style="margin-bottom: var(--spacing-xs);">{{ $order->order_number }}</h4>
                                        <p class="text-sm text-gray">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <span class="badge badge-{{ $order->status_color }}">{{ $order->status_label }}</span>
                                </div>

                                <div class="flex justify-between items-center"
                                    style="padding-top: var(--spacing-md); border-top: 1px solid var(--color-gray-light);">
                                    <div>
                                        <p class="text-gray">{{ $order->items->count() }} รายการ</p>
                                        <p class="text-xl font-bold text-primary">{{ number_format($order->total, 0) }} ฿</p>
                                    </div>
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">ดูรายละเอียด →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-xl">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection