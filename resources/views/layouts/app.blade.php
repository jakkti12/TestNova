<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ร้านค้าออนไลน์') - Laravel Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <!-- Navigation -->
    <nav class="py-md">
        <div class="container">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-primary">
                    🛒 LaravelShop
                </a>

                <div class="flex items-center gap-lg">
                    <a href="{{ route('home') }}">หน้าแรก</a>
                    <a href="{{ route('products.index') }}">สินค้าทั้งหมด</a>

                    @auth
                        <a href="{{ route('orders.index') }}">คำสั่งซื้อ</a>
                        <a href="{{ route('profile') }}">โปรไฟล์</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-danger">ออกจากระบบ</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">เข้าสู่ระบบ</a>
                        <a href="{{ route('register') }}">สมัครสมาชิก</a>
                    @endauth

                    <a href="{{ route('cart.index') }}" class="btn btn-primary btn-sm" x-data="cartWidget"
                        x-init="loadCart()">
                        🛍️ ตะกร้า (<span x-text="itemCount">0</span>)
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container mt-lg">
            <div class="alert alert-success animate-fade-in">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-lg">
            <div class="alert alert-error animate-fade-in">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="container mt-lg">
            <div class="alert alert-error animate-fade-in">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-2xl mt-3xl">
        <div class="container">
            <div class="grid grid-cols-3">
                <div>
                    <h5 class="text-white mb-md">เกี่ยวกับเรา</h5>
                    <p class="text-gray">ร้านค้าออนไลน์ที่ให้บริการสินค้าคุณภาพ</p>
                </div>
                <div>
                    <h5 class="text-white mb-md">ลิงก์ด่วน</h5>
                    <div class="flex flex-col gap-sm">
                        <a href="{{ route('products.index') }}">สินค้าทั้งหมด</a>
                        <a href="{{ route('home') }}">หน้าแรก</a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white mb-md">ติดต่อเรา</h5>
                    <p class="text-gray">Email: support@laravelshop.com<br>Tel: 02-123-4567</p>
                </div>
            </div>
            <div class="text-center mt-xl"
                style="padding-top: var(--spacing-xl); border-top: 1px solid var(--color-gray);">
                <p class="text-gray">&copy; 2026 LaravelShop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cartWidget', () => ({
                itemCount: 0,
                async loadCart() {
                    try {
                        const response = await fetch('{{ route("cart.data") }}');
                        const data = await response.json();
                        this.itemCount = data.item_count;
                    } catch (error) {
                        console.error('Failed to load cart:', error);
                    }
                },
                init() {
                    // Listen for cart updates
                    window.addEventListener('cart-updated', (e) => {
                        this.itemCount = e.detail.item_count;
                    });
                }
            }));
        });
    </script>

    @stack('scripts')
</body>

</html>