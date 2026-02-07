@extends('user.layouts.master-layouts.auth')

@section('content')
<style>
    /* Inline styles to bridge Tailwind with your custom theme variables */
    .bg-theme-background { background-color: var(--background-color); }
    .bg-theme-primary { background-color: var(--primary-color); }
    .bg-theme-primary:hover { background-color: var(--primary-hover); }
    .text-theme-primary { color: var(--primary-color); }
    .text-theme-accent { color: var(--accent-color); }
    .border-theme { border-color: var(--border-color); }
    .focus-ring-theme:focus { 
        border-color: var(--accent-color); 
        box-shadow: 0 0 0 3px rgba(140, 94, 60, 0.2); 
    }
</style>

<div class="min-h-screen flex items-center justify-center bg-theme-background px-4">
    <div class="w-full max-w-md bg-white p-10 shadow-2xl rounded-2xl border border-theme">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-extrabold text-theme-primary tracking-tight">Welcome Back</h2>
            <p class="text-gray-500 mt-2">Please enter your details to sign in</p>
        </div>

        @if(session('success') || session('info') || session('error') || $errors->any())
            <div class="mb-6 text-sm">
                @if(session('success'))
                    <div class="p-3 rounded-lg bg-green-50 text-green-700 border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-3 rounded-lg bg-red-50 text-red-700 border border-red-200">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       placeholder="name@company.com"
                       class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border">
            </div>

            <div>
                <div class="flex justify-between mb-1">
                    <label class="block text-sm font-semibold text-gray-700">Password</label>
                    <a href="{{ route('password.request') }}" class="text-theme-accent hover:text-theme-primary text-xs font-medium transition">
                        Forgot password?
                    </a>
                </div>
                <input type="password" name="password" required 
                       placeholder="••••••••"
                       class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border">
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 rounded border-gray-300 text-theme-primary focus:ring-theme-accent">
                <label for="remember" class="ml-2 block text-sm text-gray-600">Remember me for 7 days</label>
            </div>

            <button type="submit" 
                    class="w-full bg-theme-primary text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform transition-all active:scale-[0.98]">
                Sign In
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-theme text-center">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('user.register') }}" class="text-theme-primary font-bold hover:underline ml-1">Create account</a>
            </p>
        </div>
    </div>
</div>
@endsection