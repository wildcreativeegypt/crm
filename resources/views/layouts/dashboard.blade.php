<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet" type="text/css">

  <!-- DaisyUI core -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css">

  <!-- Optional: DaisyUI themes -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/themes.css" rel="stylesheet" type="text/css">

  <!-- Optional: Tabler Icons -->
  <link href="https://unpkg.com/tabler-icons@2.37.0/iconfont/tabler-icons.min.css" rel="stylesheet" type="text/css">

  <title>@yield('title','CRMHub')</title>
</head>
<body class="h-screen flex dark:bg-gray-900">

  {{-- Sidebar (Always Visible) --}}
  <aside class="w-64 bg-base-200 p-4 dark:bg-gray-800">
    <a href="{{ route('dashboard') }}" class="text-2xl font-bold block mb-6">
      CRMHub
    </a>
    <ul class="menu">
      <li><a href="{{ route('dashboard') }}"><i class="ti ti-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('clients.index') }}"><i class="ti ti-users"></i> Clients</a></li>
      <li><a href="{{ route('ad_accounts.index') }}"><i class="ti ti-brand-facebook"></i> Ad Accounts</a></li>
      <li><a href="{{ route('ad_account_topups.index') }}"><i class="ti ti-arrow-up-circle"></i> Top-Ups</a></li>
      <li><a href="{{ route('ad_expenses.index') }}"><i class="ti ti-credit-card"></i> Expenses</a></li>
      <li><a href="{{ route('payments.index') }}"><i class="ti ti-currency-cedi"></i> Payments</a></li>
      <li class="mt-4"><span class="text-xs uppercase">Personal</span></li>
      <li><a href="{{ route('personal.expenses.index') }}"><i class="ti ti-wallet"></i> My Expenses</a></li>
	  <li><a href="{{ route('reports.index') }}"><i class="ti ti-chart-line"></i> Reports</a></li>
      
      {{-- Installments Section --}}
      <li><a href="{{ route('installments.index') }}"><i class="ti ti-calendar"></i> Installments</a></li>
    </ul>
  </aside>

  {{-- Main content --}}
  <div class="flex-1 flex flex-col">
    {{-- Top navbar --}}
    <nav class="navbar bg-base-100 shadow-sm dark:bg-gray-800">
      <div class="container mx-auto flex justify-between items-center">

        {{-- Left: brand --}}
        <div class="navbar-start">
          <a href="{{ route('dashboard') }}" class="btn btn-ghost normal-case text-xl">
            CRMHub
          </a>
        </div>

        {{-- Center: search (hidden on mobile) --}}
        <div class="navbar-center hidden lg:flex">
          <input
            type="search"
            placeholder="Search…"
            class="input input-bordered w-full max-w-md"
          />
        </div>

        {{-- Right: icons + avatar --}}
        <div class="navbar-end flex items-center space-x-4">
          {{-- Bell Icon --}}
          <button class="btn btn-ghost btn-square">
            <i class="ti ti-bell"></i>
          </button>
          {{-- Plus Icon --}}
          <button class="btn btn-ghost btn-square">
            <i class="ti ti-plus"></i>
          </button>
          {{-- Avatar --}}
          <div class="dropdown dropdown-end z-50">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar flex items-center">
              <div class="w-10 h-10 rounded-full overflow-hidden">
                <img
                  src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}"
                  alt="Avatar"
                />
              </div>
            </label>
            <ul
              tabindex="0"
              class="menu menu-sm dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
            >
              {{-- Profile Link --}}
              <li><a href="{{ route('profile.show') }}">Profile</a></li>

              {{-- Settings Link --}}
              <li><a href="{{ route('settings.index') }}">Settings</a></li>

              {{-- Logout Button --}}
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
    </nav>

    {{-- Page content --}}
    <main class="container mx-auto p-6 bg-base-200 dark:bg-gray-900">
      @yield('content')
    </main>
  </div>
</body>
</html>