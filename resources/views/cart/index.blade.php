@extends('layouts.app')

@section('title', 'ตะกร้าสินค้า')

@section('content')
<section class="py-2xl" x-data="cartPage()">
    <div class="container container-sm">
        <h1 class="mb-xl">ตะกร้าสินค้า</h1>

        @if(!$cart || $cart->items->isEmpty())
            <div class="card text-center py-3xl">
                <div style="font-size: 4rem; margin-bottom: var(--spacing-lg);">🛍️</div>
                <h3>ตะกร้าสินค้าของคุณว่างเปล่า</h3>
                <p class="text-gray mt-md mb-xl">เริ่มช้อปปิ้งเลย!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">ดูสินค้าทั้งหมด</a>
            </div>
        @else
            <!-- Cart Items -->
            <div class="card mb-xl">
                <div class="card-body">
                    @foreach($cart->items as $item)
                        <div class="flex gap-md items-center" style="padding: var(--spacing-md) 0; border-bottom: 1px solid var(--color-gray-light);">
                            <!-- Product Image -->
                            <div style="width: 100px; height: 100px; flex-shrink: 0;">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-md);">
                                @else
                                    <div style="width: 100%; height: 100%; background: var(--color-gray-light); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                                        📦
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div style="flex: 1;">
                                <h5 style="margin-bottom: var(--spacing-xs);">
                                    <a href="{{ route('products.show', $item->product->slug) }}" style="text-decoration: none; color: inherit;">
                                        {{ $item->product->name }}
                                    </a>
                                </h5>
                                <p class="text-primary font-semibold">{{ number_format($item->product->price, 0) }} ฿</p>
                            </div>

                            <!-- Quantity -->
                            <div>
                                <input 
                                    type="number" 
                                    x-model="items[{{ $item->id }}]" 
                                    min="1" 
                                    max="{{ $item->product->stock }}" 
                                    class="form-control" 
                                    style="width: 80px;"
                                    @change="updateQuantity({{ $item->id }}, $event.target.value, {{ $item->product->stock }})"
                                >
                            </div>

                            <!-- Subtotal -->
                            <div style="width: 120px; text-align: right;">
                                <p class="font-bold" x-text="formatPrice({{ $item->product->price }} * items[{{ $item->id }}])"></p>
                            </div>

                            <!-- Remove -->
                            <div>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background: var(--color-danger); color: white;">ลบ</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-lg">สรุปคำสั่งซื้อ</h4>
                    
                    <div class="flex justify-between mb-md">
                        <span>ยอดรวม</span>
                        <span class="font-semibold" x-text="formatPrice(cartTotal)"></span>
                    </div>
                    
                    <div class="flex justify-between mb-md">
                        <span>ค่าจัดส่ง</span>
                        <span class="font-semibold">50 ฿</span>
                    </div>
                    
                    <div style="border-top: 2px solid var(--color-dark); padding-top: var(--spacing-md); margin-top: var(--spacing-md);">
                        <div class="flex justify-between mb-xl">
                            <span class="text-xl font-bold">ยอดรวมทั้งหมด</span>
                            <span class="text-2xl font-bold text-primary" x-text="formatPrice(cartTotal + 50)"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2" style="gap: var(--spacing-md);">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">ช้อปปิ้งต่อ</a>
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary">ชำระเงิน</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
function cartPage() {
    return {
        items: {
            @foreach($cart->items ?? [] as $item)
                {{ $item->id }}: {{ $item->quantity }},
            @endforeach
        },
        cartTotal: {{ $cart->total ?? 0 }},
        
        async updateQuantity(itemId, quantity, maxStock) {
            quantity = parseInt(quantity);
            
            if (quantity < 1) {
                this.items[itemId] = 1;
                return;
            }
            
            if (quantity > maxStock) {
                this.items[itemId] = maxStock;
                alert('จำนวนสินค้าเกินสต็อกที่มี');
                return;
            }
            
            try {
                const response = await fetch('{{ route("cart.update") }}', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        quantity: quantity
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.cartTotal = data.cart_total;
                    // อัพเดท cart widget
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: data }));
                } else {
                    alert(data.error || 'เกิดข้อผิดพลาด');
                    location.reload();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการอัพเดทตะกร้า');
                location.reload();
            }
        },
        
        formatPrice(price) {
            return new Intl.NumberFormat('th-TH').format(price) + ' ฿';
        }
    }
}
</script>
@endpush

