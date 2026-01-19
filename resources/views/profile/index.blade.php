@extends('layouts.app')

@section('title', 'โปรไฟล์')

@section('content')
    <section class="py-2xl">
        <div class="container container-sm">
            <h1 class="mb-xl">โปรไฟล์ของฉัน</h1>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h4 class="mb-lg">ข้อมูลส่วนตัว</h4>

                        <div class="form-group">
                            <label class="form-label">ชื่อ-นามสกุล</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">อีเมล</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">เบอร์โทรศัพท์</label>
                            <input type="tel" name="phone" class="form-control"
                                value="{{ old('phone', auth()->user()->phone) }}">
                            @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">ที่อยู่</label>
                            <textarea name="address"
                                class="form-control">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <hr style="margin: var(--spacing-xl) 0;">

                        <h4 class="mb-lg">เปลี่ยนรหัสผ่าน</h4>

                        <div class="form-group">
                            <label class="form-label">รหัสผ่านปัจจุบัน</label>
                            <input type="password" name="current_password" class="form-control">
                            @error('current_password')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">รหัสผ่านใหม่</label>
                            <input type="password" name="new_password" class="form-control">
                            @error('new_password')<span class="form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">ยืนยันรหัสผ่านใหม่</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">บันทึกข้อมูล</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection