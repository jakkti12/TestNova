@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <section class="py-2xl">
        <div class="container">
            <!-- Category Header -->
            <div class="card mb-xl" style="background: var(--gradient-primary); color: white;">
                <div class="card-body text-center py-2xl">
                    <h1 class="text-white">{{ $category->name }}</h1>
                    <p class="text-xl" style="opacity: 0.9;">{{ $products->total() }} สินค้า</p>
                </div>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-3xl">
                    <p class="text-xl text-gray">ยังไม่มีสินค้าในหมวดหมู่นี้</p>
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