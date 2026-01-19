@extends('layouts.app')

@section('title', 'เข้าสู่ระบบ')

@section('content')
    <section class="py-3xl">
        <div class="container container-sm" style="max-width: 500px;">
            <div class="card">
                <div class="card-body py-2xl">
                    <h2 class="text-center mb-xl">เข้าสู่ระบบ</h2>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">อีเมล</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                                autofocus>
                            @error('email')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">รหัสผ่าน</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label style="display: flex; align-items: center; gap: var(--spacing-sm); cursor: pointer;">
                                <input type="checkbox" name="remember">
                                <span>จำฉันไว้</span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">เข้าสู่ระบบ</button>
                    </form>

                    <div class="text-center mt-lg">
                        <p class="text-gray">ยังไม่มีบัญชี? <a href="{{ route('register') }}"
                                class="text-primary font-semibold" style="text-decoration: none;">สมัครสมาชิก</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection