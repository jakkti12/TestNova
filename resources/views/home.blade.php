@extends('layouts.app')

@section('title', 'หน้าแรก')

@section('content')
    <!-- Hero Section -->
    <section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;" class="py-3xl">
        <div class="container text-center">
            <h1 class="text-white" style="font-size: 3.5rem; margin-bottom: var(--spacing-lg);">
                ยินดีต้อนรับสู่ LaravelShop
            </h1>
            <p class="text-xl mb-xl" style="color: rgba(255,255,255,0.9);">ช้อปสินค้าคุณภาพ ส่งตรงถึงบ้านคุณ</p>
            <a href="{{ route('products.index') }}" class="btn btn-lg" style="background: white; color: #667eea;">
                เริ่มช้อปปิ้ง →
            </a>
        </div>
    </section>

    <!-- Categories -->
    @if($categories->isNotEmpty())
        <section class="py-2xl">
            <div class="container">
                <h2 class="text-center mb-xl">หมวดหมู่สินค้า</h2>
                <div class="grid grid-cols-4">
                    @foreach($categories as $category)
                        <a href="{{ route('products.category', $category->slug) }}" class="card card-glass"
                            style="text-decoration: none; color: inherit;">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    style="width: 100%; height: 150px; object-fit: cover;">
                            @else
                                <div
                                    style="width: 100%; height: 150px; background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                                    📦
                                </div>
                            @endif
                            <div class="card-body text-center">
                                <h4 style="margin-bottom: var(--spacing-xs);">{{ $category->name }}</h4>
                                <p class="text-sm text-gray">{{ $category->active_products_count }} สินค้า</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Featured Products -->
    <section class="py-2xl" style="background: var(--color-white);">
        <div class="container">
            <h2 class="text-center mb-xl">สินค้าแนะนำ</h2>

            @if($featuredProducts->isEmpty())
                <div class="text-center py-3xl">
                    <p class="text-xl text-gray">ยังไม่มีสินค้า</p>
                </div>
            @else
                <div class="grid grid-cols-4">
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            @endif

            <div class="text-center mt-xl">
                <a href="{{ route('products.index') }}" class="btn btn-primary">ดูสินค้าทั้งหมด</a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-3xl" style="background: var(--color-light);">
        <div class="container">
            <div class="grid grid-cols-3">
                <div class="text-center">
                    <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">🚚</div>
                    <h4>จัดส่งฟรี</h4>
                    <p class="text-gray">สำหรับคำสั่งซื้อมูลค่า 1,000 บาทขึ้นไป</p>
                </div>
                <div class="text-center">
                    <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">🔒</div>
                    <h4>ปลอดภัย 100%</h4>
                    <p class="text-gray">ระบบการชำระเงินที่ปลอดภัย</p>
                </div>
                <div class="text-center">
                    <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">↩️</div>
                    <h4>คืนสินค้าง่าย</h4>
                    <p class="text-gray">รับประกันความพึงพอใจ 100%</p>
                </div>
            </div>
        </div>
    </section>
@endsection