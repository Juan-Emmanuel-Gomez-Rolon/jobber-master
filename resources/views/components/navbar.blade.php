<nav class="bg-grayBackground p-8 px-64 flex items-center justify-between">
    {{-- search bar --}}
    <form class="relative text-grayDarkIcon focus-within:text-gray-400" action="{{ route('search') }}" method="GET">
        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                <i class="fas fa-search"></i>
            </button>
        </span>
        <input type="text" name="query" id="search"
            class="bg-grayDark placeholder-grayDarkIcon py-2 pl-10 pr-4 rounded-md w-96 focus:outline-none focus:bg-white"
            placeholder="Search">
    </form>

    {{-- icons --}}
    <div class="flex space-x-8">
        <a href="{{ route('dashboard') }}" class="text-grayDarkIcon text-2xl">
            <i class="fas fa-home"></i>
        </a>
        {{-- <a href="#" class="text-grayDarkIcon text-2xl">
            <i class="fas fa-users"></i> <!-- People icon -->
        </a> --}}
        {{-- if person is company --}}
        @if (auth()->user()->user_type == 'company')
            <a href="{{ route('createJob') }}" class="text-grayDarkIcon text-2xl">
                <i class="fas fa-suitcase"></i> <!-- Backpack icon -->
            </a>
        @else
            <a href="{{ route('applications') }}" class="text-grayDarkIcon text-2xl">
                <i class="fas fa-suitcase"></i> <!-- Backpack icon -->
            </a>
        @endif

        {{-- if person is candidate --}}
        {{-- <a href="#" class="text-grayDarkIcon text-2xl">
            <i class="fas fa-comment"></i> <!-- Bubble message icon -->
        </a> --}}
        <a href="{{ route('profile') }}" class="text-grayDarkIcon text-2xl">
            <i class="fas fa-user"></i>
        </a>
    </div>

    {{-- settings --}}
    <div class="relative group cursor-pointer">
        <i class="fas fa-th text-grayDarkIcon  text-2xl"></i> <!-- 9-dot shape icon -->
        <div
            class="hidden w-60 absolute right-0 bg-slate-50 border border-gray-300 text-grayDarkIcon p-2 rounded-md group-hover:block">
            {{-- Dropdown content here --}}
            <a href="{{ route('profile') }}" class="block hover:bg-grayDark py-1 px-2">Mi
                perfil</a>
            <a href="{{ route('logout') }}" class="block hover:bg-grayDark py-1 px-2">Cerrar sesión</a>
        </div>
    </div>
</nav>
