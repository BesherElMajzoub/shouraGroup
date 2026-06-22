<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول | لوحة تحكم شورى</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: "Tajawal", system-ui, sans-serif; }
        .text-brand { color:#e11d26 } .bg-brand{ background-color:#e11d26 }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl ring-1 ring-black/5 p-8 relative overflow-hidden">
        <div class="pointer-events-none absolute -left-12 -bottom-12 w-48 h-48 opacity-[0.03] select-none">
            <img src="{{ asset('images/shora-logo.svg') }}" alt="" class="w-full h-full brightness-0">
        </div>
        
        <div class="flex flex-col items-center mb-8">
            <img src="{{ asset('images/shora-logo.svg') }}" alt="مجموعة شورى" class="h-16 w-auto mb-4">
            <h1 class="text-2xl font-black text-gray-900">لوحة التحكم</h1>
            <p class="text-sm text-gray-500 mt-1">سجل الدخول للمتابعة وإدارة محتوى الموقع</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-bold">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-xs font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all text-left" dir="ltr">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-gray-700 mb-2">كلمة المرور</label>
                <input type="password" id="password" name="password" required
                       class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all text-left" dir="ltr">
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-brand border-gray-300 rounded focus:ring-brand accent-[#e11d26]">
                    <span class="text-xs text-gray-600 font-medium">تذكرني على هذا الجهاز</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-brand hover:bg-red-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-brand/20 hover:shadow-brand/35 transition-all text-sm mt-2">
                تسجيل الدخول
            </button>
        </form>
    </div>
</body>
</html>
