<nav class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 dark:text-gray-200">
                    {{ config('app.name', 'CRM') }}
                </a>
            </div>

            <!-- Center / Links -->
            <div class="hidden sm:flex sm:space-x-8 sm:ml-10">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                              {{ request()->routeIs('dashboard') 
                                 ? 'border-indigo-500 text-gray-900' 
                                 : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('clients.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                              {{ request()->is('clients*') 
                                 ? 'border-indigo-500 text-gray-900' 
                                 : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        Clients
                    </a>
                    <a href="{{ route('ad_accounts.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                              {{ request()->is('ad_accounts*') 
                                 ? 'border-indigo-500 text-gray-900' 
                                 : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        Ad Accounts
                    </a>
                    <a href="{{ route('ad_account_topups.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                              {{ request()->is('ad_account_topups*') 
                                 ? 'border-indigo-500 text-gray-900' 
                                 : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        Top-Ups
                    </a>
                    <a href="{{ route('ad_expenses.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                              {{ request()->is('ad_expenses*') 
                                 ? 'border-indigo-500 text-gray-900' 
                                 : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        Expenses
                    </a>
                    <a href="{{ route('payments.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                              {{ request()->is('payments*') 
                                 ? 'border-indigo-500 text-gray-900' 
                                 : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        Payments
                    </a>
                    <a href="{{ route('personal.expenses.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                              {{ request()->is('personal/expenses*') 
                                 ? 'border-indigo-500 text-gray-900' 
                                 : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        My Expenses
                    </a>
                    <a href="{{ route('personal.installments.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                              {{ request()->is('personal/installments*') 
                                 ? 'border-indigo-500 text-gray-900' 
                                 : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        Installments
                    </a>
                @endauth
            </div>

            <!-- Right side: Authentication Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-200">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none"
                        aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed. -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide via JS (optional) -->
    <div class="sm:hidden" id="mobile-menu">
        @auth
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium
                      {{ request()->routeIs('dashboard') 
                         ? 'bg-indigo-50 border-indigo-500 text-indigo-700' 
                         : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                Dashboard
            </a>
            <!-- Repeat links similarly for mobile -->
        </div>
        @endauth
    </div>
</nav>
