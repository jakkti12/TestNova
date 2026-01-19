@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="py-2xl">
        <div class="container">
            <div class="grid grid-cols-2" style="gap: var(--spacing-2xl);">
                <!-- Product Image -->
                <div>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            style="width: 100%; border-radius: var(--radius-xl); box-shadow: var(--shadow-xl);">
                    @else
                        <div
                            style="width: 100%; height: 500px; background: var(--gradient-primary); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; font-size: 6rem; color: white;">
                            📦
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div>
                    @if($product->category)
                        <span class="badge badge-primary mb-md">{{ $product->category->name }}</span>
                    @endif

                    <h1 style="margin-bottom: var(--spacing-md);">{{ $product->name }}</h1>

                    <div class="mb-xl">
                        <span class="text-3xl font-bold text-primary">{{ number_format($product->price, 0) }} ฿</span>
                    </div>

                    @if($product->description)
                        <p class="text-lg mb-xl" style="line-height: 1.8;">{{ $product->description }}</p>
                    @endif

                    <!-- Stock Status -->
                    <div class="mb-xl">
                        @if($product->stock > 0)
                            <p class="text-success font-semibold">✓ มีสินค้าพร้อมส่ง ({{ $product->stock }} ชิ้น)</p>
                        @else
                            <p class="text-danger font-semibold">✗ สินค้าหมด</p>
                        @endif
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" x-data="{ quantity: 1 }">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="form-group">
                            <label class="form-label">จำนวน</label>
                            <div class="flex gap-md">
                                <input type="number" name="quantity" x-model="quantity" min="1" max="{{ $product->stock }}"
                                    class="form-control" style="width: 100px;">
                                <button type="submit" class="btn btn-primary btn-lg" style="flex: 1;" @if($product->stock < 1) disabled @endif>
                                    เพิ่มลงตะกร้า
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Product Features -->
                    <div class="mt-xl card card-glass">
                        <div class="card-body">
                            <h5 class="mb-md">คุณสมบัติเด่น</h5>
                            <ul class="flex flex-col gap-sm" style="list-style: none;">
                                <li>✓ จัดส่งฟรี สำหรับคำสั่งซื้อมูลค่า 1,000 บาทขึ้นไป</li>
                                <li>✓ รับประกันคุณภาพ</li>
                                <li>✓ คืนสินค้าภายใน 7 วัน</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->isNotEmpty())
                <div class="mt-3xl">
                    <h2 class="mb-xl">สินค้าที่เกี่ยวข้อง</h2>
                    <div class="grid grid-cols-4">
                        @foreach($relatedProducts as $related)
                            <x-product-card :product="$related" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection