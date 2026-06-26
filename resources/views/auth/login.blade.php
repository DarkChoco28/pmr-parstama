<x-guest-layout title="Login Admin">
    <div style="margin-bottom: 28px; text-align: center;">
        <img src="{{ asset('parstama_logo.png') }}" alt="PMR" style="height: 96px; margin-bottom: 16px; object-fit: contain;">
        <h2 style="font-family: 'Sansita', Georgia, serif; font-size: 25.2px; font-weight: 700; color: #fff; margin-bottom: 4px;">Login Admin</h2>
        <p style="font-size: 14.4px; color: #888;">Masuk ke panel administrasi PMR PARSTAMA</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div style="margin-bottom: 16px;">
            <label for="email" style="display: block; font-size: 14.4px; font-weight: 600; color: #aaa; margin-bottom: 6px;">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,.1); border-radius: 3.6px; font-size: 16.2px; color: #fff; background: rgba(255,255,255,.04); outline: none; transition: border-color .25s, box-shadow .25s;"
                onfocus="this.style.borderColor='#DC2626'; this.style.boxShadow='0 0 0 2px rgba(220,38,38,.15)'"
                onblur="this.style.borderColor='rgba(255,255,255,.1)'; this.style.boxShadow='none'">
            @error('email')
                <p style="font-size: 12.6px; color: #EF4444; margin-top: 4px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div style="margin-bottom: 16px;">
            <label for="password" style="display: block; font-size: 14.4px; font-weight: 600; color: #aaa; margin-bottom: 6px;">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                style="width: 100%; padding: 12px 16px; border: 1px solid rgba(255,255,255,.1); border-radius: 3.6px; font-size: 16.2px; color: #fff; background: rgba(255,255,255,.04); outline: none; transition: border-color .25s, box-shadow .25s;"
                onfocus="this.style.borderColor='#DC2626'; this.style.boxShadow='0 0 0 2px rgba(220,38,38,.15)'"
                onblur="this.style.borderColor='rgba(255,255,255,.1)'; this.style.boxShadow='none'">
            @error('password')
                <p style="font-size: 12.6px; color: #EF4444; margin-top: 4px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div style="margin-bottom: 24px;">
            <label for="remember_me" style="display: inline-flex; align-items: center; cursor: pointer; font-size: 14.4px; color: #aaa;">
                <input id="remember_me" type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color: #DC2626; margin-right: 8px;">
                <span>Remember me</span>
            </label>
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-family: 'Sansita', Georgia, serif, sans-serif, monospace; font-size: 12.6px; color: #888; text-decoration: none; letter-spacing: .5px; transition: color .2s;"
                   onmouseover="this.style.color='#EF4444'" onmouseout="this.style.color='#888'">
                    Forgot password?
                </a>
            @endif

            <button type="submit" style="background: linear-gradient(135deg, #DC2626, #991B1B); color: #FFFFFF; font-weight: 600; font-size: 14.4px; padding: 12px 28px; border-radius: 7.2px; border: none; cursor: pointer; transition: opacity .2s, transform .2s, box-shadow .2s; box-shadow: 0 4px 20px rgba(220,38,38,.3);"
                    onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 32px rgba(220,38,38,.45)'"
                    onmouseout="this.style.opacity='1'; this.style.transform='none'; this.style.boxShadow='0 4px 20px rgba(220,38,38,.3)'">
                Log in
            </button>
        </div>

        <div style="margin-top: 24px; text-align: center;">
            <a href="{{ url('/') }}" style="font-family: 'Sansita', Georgia, serif, sans-serif, monospace; font-size: 12.6px; color: #555; text-decoration: none; letter-spacing: .5px; transition: color .2s;"
               onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#555'">
                &larr; Kembali ke beranda
            </a>
        </div>
    </form>
</x-guest-layout>
