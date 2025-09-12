<!-- Overlay untuk klik di luar sidebar -->
<div id="overlay" class="hidden fixed inset-0 bg-black opacity-50 z-20"></div>

<!-- Sidebar (hanya satu sidebar untuk semua ukuran layar) -->
<div id="sidebar"
    class="hidden md:flex flex-col items-center w-52 min-h-screen h-full overflow-hidden text-gray-400 bg-gray-900 z-30 fixed">
    <a class="flex items-center w-full px-3 mt-3" href="/admin/dashboard">
        <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
        </svg>
        <span class="ml-2 text-sm font-bold">ADMIN</span>
    </a>
    <div class="w-full px-2">
        <div class="flex flex-col items-center w-full mt-3 border-t border-gray-700">
            <!-- Menu Items -->
            <a href="{{ route('admin.home') }}"
                class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 hover:text-gray-300">
                <span class="ml-2 text-sm font-medium">Home Data</span>
            </a>
            <a href="{{ route('admin.about') }}"
                class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 hover:text-gray-300">
                <span class="ml-2 text-sm font-medium">About Data</span>
            </a>
            <a href="{{ route('admin.skills') }}"
                class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 hover:text-gray-300">
                <span class="ml-2 text-sm font-medium">Skills Data</span>
            </a>
            <a href="{{ route('admin.project') }}"
                class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 hover:text-gray-300">
                <span class="ml-2 text-sm font-medium">Project Data</span>
            </a>
            <a href="{{ route('admin.certificate') }}"
                class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 hover:text-gray-300">
                <span class="ml-2 text-sm font-medium">Certificate Data</span>
            </a>
            <a href="{{ route('admin.contact') }}"
                class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 hover:text-gray-300">
                <span class="ml-2 text-sm font-medium">Contact Data</span>
            </a>
            <a href="{{ route('admin.message') }}"
                class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 hover:text-gray-300">
                <span class="ml-2 text-sm font-medium">Message Data</span>
                </a>
        </div>
    </div>
    <div class="relative w-full mt-auto">
        <a id="account-btn" class="flex items-center justify-center w-full h-16 mt-auto bg-gray-800 hover:bg-gray-700 hover:text-gray-300 cursor-pointer">
            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="ml-2 text-sm font-medium">Account</span>
        </a>

        <!-- Dropdown Menu untuk Account -->
        <div id="account-dropdown" class="hidden absolute bottom-16 left-0 w-full bg-gray-800 text-white">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-700">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full px-4 py-2 hover:bg-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Hamburger button for mobile -->
<div class="md:hidden fixed top-0 left-0 p-4">
    <button id="hamburger" class="flex items-center justify-center w-10 h-10 text-black bg-white rounded">
        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
                d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
        </svg>
    </button>
</div>

<script>
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    hamburger.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.add('hidden');
        overlay.classList.add('hidden');
    });

    const accountBtn = document.getElementById('account-btn');
    const accountDropdown = document.getElementById('account-dropdown');

    accountBtn.addEventListener('click', function() {
        accountDropdown.classList.toggle('hidden');
    });

    // Optional: close dropdown when clicked outside
    document.addEventListener('click', function(event) {
        const isClickInside = accountBtn.contains(event.target) || accountDropdown.contains(event.target);

        if (!isClickInside) {
            accountDropdown.classList.add('hidden');
        }
    });
</script>
