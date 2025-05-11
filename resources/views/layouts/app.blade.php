<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>@yield('title','CRMHub')</title>

  {{-- 1) Tailwind via CDN --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- 2) Immediately after, load DaisyUI as a Tailwind plugin --}}
  <script type="module">
    import daisyui from 'https://cdn.jsdelivr.net/npm/daisyui@5.0.35/+esm'

    tailwind.config = {
      plugins: [daisyui],
      daisyui: {
        themes: ['light'], // pick your theme(s)
      },
    }
  </script>
</head>
<body class="drawer drawer-mobile h-screen bg-base-100">

  {{-- Sidebar toggle --}}
  <input id="sidebar-toggle" type="checkbox" class="drawer-toggle"/>

  {{-- Main content --}}
  <div class="drawer-content flex flex-col">

    {{-- Top navbar --}}
    <div class="navbar bg-base-200 border-b">
      {{-- Mobile menu button --}}
      <div class="flex-none lg:hidden">
        <label for="sidebar-toggle" class="btn btn-square btn-ghost">
          <i class="ti ti-menu-2"></i>
        </label>
      </div>

      {{-- Search box --}}
      <div class="flex-1 px-2">
        <div class="form-control">
          <div class="input-group">
            <input type="text" placeholder="Search…" class="input input-bordered w-full"/>
            <button class="btn btn-square">
              <i class="ti ti-search"></i>
            </button>
          </div>
        </div>
      </div>

      {{-- Icons & user dropdown --}}
      <div class="flex-none space-x-2">
        <button class="btn btn-ghost btn-square"><i class="ti ti-bell"></i></button>
        <button class="btn btn-ghost btn-square"><i class="ti ti-plus"></i></button>
        <div class="dropdown dropdown-end">
          <label tabindex="0" class="btn btn-ghost btn-circle avatar">
            <div class="w-8 rounded-full">
              <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/32' }}" alt="Avatar"/>
            </div>
          </label>
          <ul tabindex="0"
              class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
            <li><a href="#">Profile</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>

    {{-- Page content --}}
    <main class="p-6 overflow-auto">
      @yield('content')
    </main>
  </div>

  {{-- Sidebar --}}
  <div class="drawer-side">
    <label for="sidebar-toggle" class="drawer-overlay"></label>
    <aside class="w-64 bg-base-200 p-4">
      <a href="{{ route('dashboard') }}" class="text-2xl font-bold block mb-6">CRMHub</a>
      <ul class="menu">
        <li><a href="{{ route('dashboard') }}"      class="{{ request()->routeIs('dashboard') ? 'active':'' }}"><i class="ti ti-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('clients.index') }}"  class="{{ request()->is('clients*')     ?'active':'' }}"><i class="ti ti-users"></i> Clients</a></li>
        <li><a href="{{ route('ad_accounts.index') }}" class="{{ request()->is('ad_accounts*')?'active':'' }}"><i class="ti ti-brand-facebook"></i> Ad Accounts</a></li>
        <li><a href="{{ route('ad_expenses.index') }}" class="{{ request()->is('ad_expenses*')?'active':'' }}"><i class="ti ti-credit-card"></i> Expenses</a></li>
        <li><a href="{{ route('payments.index') }}" class="{{ request()->is('payments*')    ?'active':'' }}"><i class="ti ti-currency-cedi"></i> Payments</a></li>
        <li><a href="{{ route('personal.expenses.index') }}" class="{{ request()->is('personal/expenses*')?'active':'' }}"><i class="ti ti-wallet"></i> My Expenses</a></li>
        <li><a href="{{ route('personal.installments.index') }}" class="{{ request()->is('personal/installments*')?'active':'' }}"><i class="ti ti-calendar"></i> Installments</a></li>
      </ul>
    </aside>
  </div>

</body>
</html>
