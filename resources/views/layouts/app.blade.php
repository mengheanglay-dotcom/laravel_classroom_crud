<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ClassroomOS') · ClassroomOS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
      body{font-family:'DM Sans',sans-serif} h1,h2,h3,.brand{font-family:'Manrope',sans-serif}
      .nav-item{transition:all .18s ease}.nav-item:hover{background:#202a3b;color:#fff}
      .nav-item.active{background:#e8efff;color:#2449a8}
      .field{width:100%;border:1px solid #dbe2ea;border-radius:12px;padding:.75rem .9rem;background:#fff;outline:none}
      .field:focus{border-color:#5278d7;box-shadow:0 0 0 3px #5278d71c}
      .btn-primary{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;border-radius:12px;background:#3159b7;color:white;padding:.72rem 1rem;font-weight:700;transition:.18s}
      .btn-primary:hover{background:#24469a;transform:translateY(-1px)}
      .btn-secondary{display:inline-flex;align-items:center;justify-content:center;border:1px solid #dbe2ea;border-radius:12px;padding:.7rem 1rem;font-weight:600;background:white}
      .table-cell{padding:1rem 1.1rem;border-bottom:1px solid #edf0f5;vertical-align:middle}
      @media (max-width: 1023px) {
        .mobile-nav{scrollbar-width:none}
        .mobile-nav::-webkit-scrollbar{display:none}
      }
    </style>
</head>
<body class="min-h-screen bg-[#f5f7fb] text-slate-800 antialiased">
<div class="min-h-screen lg:flex">
  <aside class="bg-[#111827] text-slate-300 lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
    <div class="flex items-center gap-3 px-4 py-4 sm:px-6 sm:py-7">
      <div class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-blue-600 text-lg font-extrabold text-white sm:h-11 sm:w-11">C</div>
      <div><div class="brand text-lg font-extrabold tracking-tight text-white">ClassroomOS</div><div class="text-xs text-slate-400">Management workspace</div></div>
    </div>
    <div class="hidden px-4 pb-3 text-[10px] font-bold uppercase tracking-[.2em] text-slate-500 lg:block">Workspace</div>
    <nav class="mobile-nav flex gap-1 overflow-x-auto px-3 pb-3 lg:block lg:space-y-1 lg:overflow-visible lg:pb-0">
      <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }} flex shrink-0 items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold sm:px-4 lg:gap-3 lg:py-3"><span>▦</span> Overview</a>
      <a href="{{ route('students.index') }}" class="nav-item {{ request()->routeIs('students.*') ? 'active' : '' }} flex shrink-0 items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold sm:px-4 lg:gap-3 lg:py-3"><span>♙</span> Students</a>
      <a href="{{ route('teachers.index') }}" class="nav-item {{ request()->routeIs('teachers.*') ? 'active' : '' }} flex shrink-0 items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-semibold sm:px-4 lg:gap-3 lg:py-3"><span>♧</span> Teachers</a>
    </nav>
    <div class="mt-auto hidden p-5 lg:block"><div class="rounded-2xl border border-slate-700 bg-slate-800/70 p-4"><div class="text-sm font-semibold text-white">Keep things organized</div><p class="mt-1 text-xs leading-5 text-slate-400">Manage classroom records from one simple workspace.</p></div><div class="mt-5 text-xs text-slate-500">ClassroomOS · v1.0</div></div>
  </aside>
  <main class="min-w-0 flex-1 lg:ml-64">
    <header class="sticky top-0 z-10 flex items-center justify-between gap-3 border-b border-slate-200/80 bg-white/90 px-4 py-3 backdrop-blur sm:px-5 sm:py-4 md:px-9">
      <div class="min-w-0"><p class="text-[10px] font-semibold uppercase tracking-[.16em] text-slate-400 sm:text-xs">Classroom management</p><p class="mt-1 truncate text-sm font-bold text-slate-700">@yield('eyebrow','Workspace overview')</p></div>
      <div class="flex items-center gap-3"><div class="hidden text-right sm:block"><div class="text-sm font-bold text-slate-800">Administrator</div><div class="text-xs text-slate-400">Workspace access</div></div><div class="grid h-10 w-10 place-items-center rounded-full bg-blue-100 text-sm font-extrabold text-blue-700">AD</div></div>
    </header>
    <div class="mx-auto max-w-[1500px] p-4 sm:p-5 md:p-9">
      @if(session('success'))<div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800"><span>✓</span><span>{{ session('success') }}</span></div>@endif
      @if($errors->any())<div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800"><div class="font-bold">Please check the form</div><ul class="mt-1 list-inside list-disc">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
      @yield('content')
      <footer class="mt-10 border-t border-slate-200 pt-5 text-xs text-slate-400">© {{ date('Y') }} ClassroomOS · Built for a more organized classroom.</footer>
    </div>
  </main>
</div>
@stack('scripts')
</body></html>
