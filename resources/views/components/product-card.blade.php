<div class="card product-card">
    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
    @else
        <div class="product-image"
            style="background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; font-size: 4rem; color: white;">
            📦
        </div>
    @endif

    <div class="card-body">
        @if($product->category)
            <span class="badge badge-primary mb-sm">{{ $product->category->name }}</span>
        @endif

        <h4 style="margin-bottom: var(--spacing-sm);">
            <a href="{{ route('products.show', $product->slug) }}" style="text-decoration: none; color: inherit;">
                {{ $product->name }}
            </a>
        </h4>

        @if($product->description)
            <p class="text-sm text-gray mb-md"
                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {{ $product->description }}
            </p>
        @endif

        <div class="flex items-center justify-between">
            <div>
                <span class="text-2xl font-bold text-primary">{{ number_format($product->price, 0) }} ฿</span>
                @if($product->stock > 0)
                    <p class="text-sm text-success">มีสินค้า {{ $product->stock }} ชิ้น</p>
                @else
                    <p class="text-sm text-danger">สินค้าหมด</p>
                @endif
            </div>
        </div>

        <form action="{{ route('cart.add') }}" method="POST" class="mt-md">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-primary" style="width: 100%;" @if($product->stock < 1) disabled @endif>
                เพิ่มลงตะกร้า
            </button>
        </form>
    </div>
</div>