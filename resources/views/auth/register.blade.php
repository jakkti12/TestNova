@extends('layouts.app')

@section('title', 'สมัครสมาชิก')

@section('content')
    <section class="py-3xl">
        <div class="container container-sm" style="max-width: 500px;">
            <div class="card">
                <div class="card-body py-2xl">
                    <h2 class="text-center mb-xl">สมัครสมาชิก</h2>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">ชื่อ-นามสกุล</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required
                                autofocus>
                            @error('name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">อีเมล</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">เบอร์โทรศัพท์</label>
                            <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">ที่อยู่</label>
                            <textarea name="address" class="form-control"
                                style="min-height: 100px;">{{ old('address') }}</textarea>
                            @error('address')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">รหัสผ่าน</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">ยืนยันรหัสผ่าน</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">สมัครสมาชิก</button>
                    </form>

                    <div class="text-center mt-lg">
                        <p class="text-gray">มีบัญชีอยู่แล้ว? <a href="{{ route('login') }}"
                                class="text-primary font-semibold" style="text-decoration: none;">เข้าสู่ระบบ</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection