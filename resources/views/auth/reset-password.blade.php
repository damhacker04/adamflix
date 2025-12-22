@extends('layouts.auth')

@section('title', 'Reset Password')
@section('page-title', 'Set New Password')

@section('content')
    <form class="form" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="email" value="{{ $request->email }}">

        <div class="mb-3 f-password">
            <input type="password" name="password"
                class="form-control form-password @error('password') is-invalid @enderror"
                id="InputPassword" required style="padding-right: 44px; background-image: none;">
            <label for="InputPassword" class="form-label form-label-password">New Password</label>
            <i class="fa fa-eye-slash toggle-password"></i>
        </div>
        <div class="mb-3 f-password">
            <input type="password" name="password_confirmation" class="form-control form-password"
                id="InputPasswordConfirmation" required style="padding-right: 44px;">
            <label for="InputPasswordConfirmation" class="form-label form-label-password">Confirm New Password</label>
            <i class="fa fa-eye-slash toggle-password"></i>
        </div>
        <button type="submit" class="btn btn-primary btn-sign-in">Reset Password</button>
    </form>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const input = toggle.closest('.f-password')?.querySelector('input');
                if (!input) return;
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                toggle.classList.toggle('fa-eye', isHidden);
                toggle.classList.toggle('fa-eye-slash', !isHidden);
            });
        });
    </script>
@endsection
