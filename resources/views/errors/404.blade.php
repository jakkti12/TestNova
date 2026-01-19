@extends('layouts.app')

@section('title', 'ไม่พบหน้าที่ต้องการ')

@section('content')
    <div class="container py-3xl">
        <div class="card p-3xl text-center animate-fade-in" style="max-width: 600px; margin: 0 auto;">
            <div style="font-size: 5rem; margin-bottom: var(--spacing-md); line-height: 1;">🤔</div>

            <h1 class="text-3xl font-bold text-primary mb-md">ไม่พบหน้าที่คุณต้องการ</h1>

            <p class="text-gray mb-xl text-lg">
                ขออภัยครับ หน้านี้อาจถูกลบไปแล้ว หรือลิงก์ที่คุณเรียกใช้งานไม่ถูกต้อง
            </p>

            <div class="flex flex-col gap-md items-center justify-center">
                <div class="flex gap-md">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        🏠 กลับหน้าแรก
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline">
                        🛍️ ดูสินค้าทั้งหมด
                    </a>
                </div>

                <div class="mt-lg pt-lg w-full" style="border-top: 1px solid var(--color-gray-light);">
                    <p class="text-sm text-gray mb-sm">หรือลองค้นหาสินค้าดูไหมครับ?</p>
                    <form action="{{ route('products.index') }}" method="GET" class="flex justify-center">
                        <input type="text" name="search" placeholder="ค้นหาสินค้า..." class="form-control"
                            style="max-width: 300px;">
                        <button type="submit" class="btn btn-primary ml-sm">ค้นหา</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection