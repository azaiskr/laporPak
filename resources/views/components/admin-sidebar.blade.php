<aside class="p-2 w-full bg-slate-800 text-white h-full flex flex-col gap-3">
    <div>
        <div class="px-3 py-2 text-3xl">Logo</div>
        <div class="flex gap-4 px-3 py-2 items-center">
            <div class="bg-white aspect-square w-8 rounded-full"></div>
            @auth
            <div>{{ Auth::user()->name }}</div>
            @else
            <div>Admin Name</div>
            @endauth
        </div>
    </div>
    <hr/>
    <div>
        <nav>
            <ul class="flex flex-col gap-2">
                <li>
                    <a href="{{ route('admin-dashboard') }}">
                        <div class="{{ Route::currentRouteName() == 'admin-dashboard' ? 'bg-blue-500 w-full' : '' }} px-3 py-2 rounded-md">
                            Dashboard
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin-report') }}">
                        <div class="{{ Route::currentRouteName() == 'admin-report' ? 'bg-blue-500 w-full' : '' }} px-3 py-2 rounded-md">
                            Laporan
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
