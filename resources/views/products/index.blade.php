@extends('layouts.app')

@section('title', 'สินค้าทั้งหมด')

@section('content')
    <section class="py-2xl">
        <div class="container">
            <h1 class="mb-xl">สินค้าทั้งหมด</h1>

            <!-- Filters -->
            <div class="card mb-xl">
                <div class="card-body">
                    <form method="GET" action="{{ route('products.index') }}" class="flex gap-md items-center">
                        <input type="text" name="search" placeholder="ค้นหาสินค้า..." class="form-control"
                            value="{{ request('search') }}" style="flex: 1;">

                        <select name="category" class="form-control" style="width: 200px;">
                            <option value="">ทุกหมวดหมู่</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>

                        <select name="sort" class="form-control" style="width: 200px;">
                            <option value="latest" @selected(request('sort') == 'latest')>ล่าสุด</option>
                            <option value="price_low" @selected(request('sort') == 'price_low')>ราคาน้อย-มาก</option>
                            <option value="price_high" @selected(request('sort') == 'price_high')>ราคามาก-น้อย</option>
                            <option value="name" @selected(request('sort') == 'name')>ชื่อ A-Z</option>
                        </select>

                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </form>
                </div>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-3xl animate-fade-in card p-2xl">
                    <div style="font-size: 4rem; margin-bottom: var(--spacing-md);">🔍</div>
                    <h3 class="text-gray mb-md">ไม่พบสินค้าที่คุณค้นหา</h3>
                    <p class="text-gray-light mb-lg">ลองเปลี่ยนคำค้นหาหรือเลือกหมวดหมู่อื่นดูนะครับ</p>
                    <a href="{{ route('products.index') }}" class="btn btn-outline">ดูสินค้าทั้งหมด</a>
                </div>
            @else
                <div class="grid grid-cols-4">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <div class="mt-xl">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection