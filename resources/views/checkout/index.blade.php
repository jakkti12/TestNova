@extends('layouts.app')

@section('title', 'ชำระเงิน')

@section('content')
    <section class="py-2xl">
        <div class="container container-sm">
            <h1 class="mb-xl">ชำระเงิน</h1>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2" style="gap: var(--spacing-2xl);">
                    <!-- Shipping Information -->
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-lg">ข้อมูลจัดส่ง</h4>

                                <div class="form-group">
                                    <label class="form-label">ชื่อ-นามสกุล *</label>
                                    <input type="text" name="customer_name" class="form-control"
                                        value="{{ old('customer_name', auth()->user()->name) }}" required>
                                    @error('customer_name')<span class="form-error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">อีเมล *</label>
                                    <input type="email" name="customer_email" class="form-control"
                                        value="{{ old('customer_email', auth()->user()->email) }}" required>
                                    @error('customer_email')<span class="form-error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">เบอร์โทรศัพท์ *</label>
                                    <input type="tel" name="customer_phone" class="form-control"
                                        value="{{ old('customer_phone', auth()->user()->phone) }}" required>
                                    @error('customer_phone')<span class="form-error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">ที่อยู่จัดส่ง *</label>
                                    <textarea name="shipping_address" class="form-control"
                                        required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                                    @error('shipping_address')<span class="form-error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">วิธีชำระเงิน *</label>
                                    <select name="payment_method" class="form-control" required>
                                        <option value="transfer" @selected(old('payment_method') == 'transfer')>โอนเงิน
                                        </option>
                                        <option value="cod" @selected(old('payment_method') == 'cod')>เก็บเงินปลายทาง</option>
                                    </select>
                                    @error('payment_method')<span class="form-error">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">หมายเหตุ (ถ้ามี)</label>
                                    <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div>
                        <div class="card mb-lg">
                            <div class="card-body">
                                <h4 class="mb-lg">สรุปคำสั่งซื้อ</h4>

                                <div style="max-height: 300px; overflow-y: auto; margin-bottom: var(--spacing-lg);">
                                    @foreach($cart->items as $item)
                                        <div class="flex justify-between mb-md"
                                            style="padding-bottom: var(--spacing-sm); border-bottom: 1px solid var(--color-gray-light);">
                                            <div>
                                                <p class="font-semibold">{{ $item->product->name }}</p>
                                                <p class="text-sm text-gray">{{ number_format($item->product->price, 0) }} ฿ ×
                                                    {{ $item->quantity }}</p>
                                            </div>
                                            <p class="font-semibold">
                                                {{ number_format($item->product->price * $item->quantity, 0) }} ฿</p>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="flex justify-between mb-md">
                                    <span>ยอดรวม</span>
                                    <span class="font-semibold">{{ number_format($cart->total, 0) }} ฿</span>
                                </div>

                                <div class="flex justify-between mb-md">
                                    <span>ค่าจัดส่ง</span>
                                    <span class="font-semibold">50 ฿</span>
                                </div>

                                <div
                                    style="border-top: 2px solid var(--color-dark); padding-top: var(--spacing-md); margin-top: var(--spacing-md);">
                                    <div class="flex justify-between">
                                        <span class="text-xl font-bold">ยอดรวมทั้งหมด</span>
                                        <span
                                            class="text-2xl font-bold text-primary">{{ number_format($cart->total + 50, 0) }}
                                            ฿</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">ยืนยันคำสั่งซื้อ</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection