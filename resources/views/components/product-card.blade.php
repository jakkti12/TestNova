<div class="card product-card h-full flex flex-col {{ $product->stock <= 0 ? 'opacity-75 grayscale' : '' }}"
    style="position: relative; overflow: hidden;">

    <!-- Badges -->
    <div
        style="position: absolute; top: 10px; right: 10px; z-index: 10; display: flex; flex-direction: column; gap: 5px; align-items: flex-end;">
        @if($product->stock <= 0)
            <span class="badge badge-danger shadow-sm">สินค้าหมด</span>
        @elseif($product->stock < 5)
            <span class="badge badge-warning shadow-sm">เหลือน้อย</span>
        @endif

        @if($product->created_at->diffInDays(now()) < 7)
            <span class="badge badge-success shadow-sm">ใหม่</span>
        @endif
    </div>

    @if($product->image)
        <a href="{{ route('products.show', $product->slug) }}" class="block overflow-hidden">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="product-image transition-transform hover:scale-105 duration-300">
        </a>
    @else
        <a href="{{ route('products.show', $product->slug) }}"
            class="product-image block transition-transform hover:scale-105 duration-300"
            style="background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; font-size: 4rem; color: white;">
            📦
        </a>
    @endif

    <div class="card-body flex flex-col flex-1">
        @if($product->category)
            <div class="mb-sm">
                <a href="{{ route('products.index', ['category' => $product->category->id]) }}"
                    class="text-xs text-primary hover:underline uppercase tracking-wide font-bold">
                    {{ $product->category->name }}
                </a>
            </div>
        @endif

        <h4 style="margin-bottom: var(--spacing-xs);">
            <a href="{{ route('products.show', $product->slug) }}"
                style="text-decoration: none; color: inherit; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                {{ $product->name }}
            </a>
        </h4>

        @if($product->description)
            <p class="text-sm text-gray mb-md flex-1"
                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.5em;">
                {{ $product->description }}
            </p>
        @else
            <div class="flex-1"></div>
        @endif

        <div class="mt-auto pt-md" style="border-top: 1px solid var(--color-gray-light);">
            <div class="flex items-center justify-between mb-md">
                <span class="text-xl font-bold text-primary">{{ number_format($product->price, 0) }} ฿</span>

                @if($product->stock > 0)
                    <span class="text-xs text-gray">เหลือ {{ $product->stock }} ชิ้น</span>
                @endif
            </div>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit"
                    class="btn btn-primary w-full flex items-center justify-center gap-xs shadow-sm hover:shadow-md transition"
                    @if($product->stock < 1) disabled style="opacity: 0.6; cursor: not-allowed;" @endif>
                    <span>{{ $product->stock > 0 ? 'เพิ่มลงตะกร้า' : 'สินค้าหมด' }}</span>
                </button>
            </form>
        </div>
    </div>
</div>