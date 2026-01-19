@extends('layouts.app')

@section('title', 'ไม่มีสิทธิ์เข้าถึง')

@section('content')
    <div class="container py-3xl">
        <div class="card p-3xl text-center animate-fade-in" style="max-width: 600px; margin: 0 auto;">
            <div style="font-size: 5rem; margin-bottom: var(--spacing-md); line-height: 1;">🛑</div>

            <h1 class="text-3xl font-bold text-danger mb-md">คุณไม่มีสิทธิ์เข้าถึงหน้านี้</h1>

            <p class="text-gray mb-xl text-lg">
                ระบบไม่อนุญาตให้คุณเข้าใช้งานในส่วนนี้<br>
                หากคุณคิดว่านี่คือข้อผิดพลาด โปรดติดต่อผู้ดูแลระบบครับ
            </p>

            <div class="flex gap-md justify-center">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    🏠 กลับหน้าแรก
                </a>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-outline">
                            สลับบัญชีผู้ใช้
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">
                        เข้าสู่ระบบ
                    </a>
                @endauth
            </div>
        </div>
    </div>
@endsection