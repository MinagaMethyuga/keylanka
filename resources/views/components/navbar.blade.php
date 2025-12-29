<div class="w-full bg-background-light/80 border-b border-border-light dark:border-border-dark relative z-20 select-none">
    <div class="w-[92%] sm:w-[90%] lg:w-[95%] xl:w-[80%] 2xl:w-[60%] h-16 mx-auto flex justify-between items-center">
        <a class="w-fit h-[90%]" href="{{route('home')}}">
            <img src="/Assets/Logo.jpg" class="h-full max-w-[120px] object-contain" alt="Key Lanka Logo"/>
        </a>

        {{-- Desktop Navigation --}}
        <div class="hidden h-full items-center gap-9 lg:flex" id="NavLinks">
            <a class="text-xs xl:text-sm font-medium hover:text-primary cursor-pointer transition-colors duration-200" href="{{route('products.index')}}" id="LocksmithTrigger">Locksmith Tools</a>
            <a class="text-xs xl:text-sm font-medium hover:text-primary cursor-pointer transition-colors duration-200" href="{{route('FlipKey.index')}}">Flip Keys</a>
            <a class="text-xs xl:text-sm font-medium hover:text-primary cursor-pointer transition-colors duration-200" href="{{route('KeyShells.index')}}">Key Shells</a>
            <a class="text-xs xl:text-sm font-medium hover:text-primary cursor-pointer transition-colors duration-200" href="{{route('Remote.index')}}" id="RemoteKeysTrigger">Remote Keys</a>
            <a class="text-xs xl:text-sm font-medium hover:text-primary cursor-pointer transition-colors duration-200" href="{{route('Smart.index')}}" id="SmartKeysTrigger">Smart Keys</a>
            <a class="text-xs xl:text-sm font-medium hover:text-primary cursor-pointer transition-colors duration-200" href="{{route('KeyCover.index')}}">Key Covers</a>
            <a class="text-xs xl:text-sm font-medium hover:text-primary cursor-pointer transition-colors duration-200" href="{{route('Other.index')}}">Others</a>
            <a class="text-xs xl:text-sm font-medium hover:text-primary cursor-pointer transition-colors duration-200" href="{{route('AboutUs')}}">Contact Us</a>
        </div>

        {{-- Action Buttons --}}
        <div class="w-fit h-full flex items-center gap-2">
            <button id="CartButton" class="hidden h-10 w-10 cursor-pointer items-center justify-center rounded-full border border-border-light bg-background-light hover:bg-border-light transition-colors duration-200 lg:flex relative">
                <span class="material-symbols-outlined text-xl">shopping_cart</span>
                <span id="CartCount" class="hidden absolute -top-2 -right-2 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
            </button>

            <button class="flex h-10 w-10 cursor-pointer items-center justify-center overflow-hidden rounded-full border border-border-light bg-background-light hover:bg-border-light transition-colors duration-200 lg:hidden" id="MobileMenuBtn">
                <span class="material-symbols-outlined text-xl">menu</span>
            </button>
        </div>
    </div>

    {{-- Desktop Dropdowns --}}
    <div class="w-full h-[0px] bg-white absolute top-16 left-0 z-30 transition-all duration-300 ease-out opacity-0 flex justify-center gap-10 items-center border-t border-gray-200 shadow-xl overflow-hidden pointer-events-none" id="LockSmithDropdown">
        <a class="h-[90%] w-[10rem] bg-neutral-400 rounded-md flex items-center justify-center text-white cursor-pointer hover:scale-105 transition-transform duration-200" href="{{route('products.KeyDiy')}}">KeyDiy</a>
        <a class="h-[90%] w-[10rem] bg-neutral-400 rounded-md flex items-center justify-center text-white cursor-pointer hover:scale-105 transition-transform duration-200" href="{{route('products.xHorse')}}">xHorse</a>
        <a class="h-[90%] w-[10rem] bg-neutral-400 rounded-md flex items-center justify-center text-white cursor-pointer hover:scale-105 transition-transform duration-200" href="{{route('products.Other')}}">Others</a>
    </div>

    <div class="w-full h-[0px] bg-white absolute top-16 left-0 z-30 transition-all duration-300 ease-out opacity-0 flex justify-center gap-10 items-center border-t border-gray-200 shadow-xl overflow-hidden pointer-events-none" id="RemoteKeysDropDown">
        @foreach(['Toyota', 'Honda', 'Suzuki', 'Nissan', 'Mazda', 'Benz', 'Daihatsu', 'Others'] as $brand)
            <a class="h-[90%] w-[10rem] bg-neutral-400 rounded-md flex items-center justify-center text-white cursor-pointer hover:scale-105 transition-transform duration-200" href="{{ route('Remote.brand', ['brand' => strtolower($brand)]) }}">{{ $brand }}</a>
        @endforeach
    </div>

    <div class="w-full h-[0px] bg-white absolute top-16 left-0 z-30 transition-all duration-300 ease-out opacity-0 flex justify-center gap-10 items-center border-t border-gray-200 shadow-xl overflow-hidden pointer-events-none" id="SmartKeysDropDown">
        @foreach(['Toyota', 'Honda', 'Suzuki', 'Nissan', 'Mazda', 'Benz', 'Daihatsu', 'Others'] as $brand)
            <a class="h-[90%] w-[10rem] bg-neutral-400 rounded-md flex items-center justify-center text-white cursor-pointer hover:scale-105 transition-transform duration-200" href="{{ route('Smart.brand', ['brand' => strtolower($brand)]) }}">{{ $brand }}</a>
        @endforeach
    </div>
</div>

{{-- Mobile Menu --}}
<div class="fixed inset-0 z-50 overflow-y-scroll overscroll-contain bg-background-light dark:bg-background-dark transition-transform duration-300 ease-out transform -translate-y-full lg:hidden" id="MobileMenu">

    {{-- Mobile Header --}}
    <div class="w-full h-16 flex justify-between items-center px-[5%] border-b border-border-light dark:border-border-dark sticky top-0 bg-background-light dark:bg-background-dark z-10">
        <div class="w-fit h-[90%] flex items-center">
            <img src="/Assets/Logo.jpg" class="h-full max-w-[120px] object-contain" alt="Key Lanka Logo"/>
        </div>

        <button class="h-10 w-10 cursor-pointer flex items-center justify-center rounded-full border border-border-light bg-card-light hover:bg-border-light dark:border-border-dark dark:bg-card-dark dark:hover:bg-border-dark transition-colors duration-200" id="CloseMobileMenu">
            <span class="material-symbols-outlined text-xl">close</span>
        </button>
    </div>

    {{-- Mobile Navigation --}}
    <div class="p-4 flex flex-col">

        {{-- Locksmith Tools --}}
        <div class="w-full">
            <button class="w-full flex justify-between items-center py-3 px-2 text-base font-semibold text-text-light-primary dark:text-text-dark-primary hover:bg-primary/10 rounded-lg transition-colors duration-200 whitespace-nowrap" id="MobileLocksmithTrigger">
                Locksmith Tools
                <span class="material-symbols-outlined text-xl transition-transform duration-300">expand_more</span>
            </button>
            <div class="hidden flex-col gap-1 pl-4 pb-2" id="MobileLocksmithDropdown">
                <a class="py-2 px-4 text-sm font-medium text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors duration-200 rounded-lg" href="{{route('products.KeyDiy')}}">- KeyDiy</a>
                <a class="py-2 px-4 text-sm font-medium text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors duration-200 rounded-lg" href="{{route('products.xHorse')}}">- xHorse</a>
                <a class="py-2 px-4 text-sm font-medium text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors duration-200 rounded-lg" href="{{route('products.Other')}}">- Others</a>
            </div>
        </div>

        <a class="text-base font-semibold py-3 px-2 text-text-light-primary dark:text-text-dark-primary hover:bg-primary/10 rounded-lg transition-colors duration-200" href="{{route('FlipKey.index')}}">Flip Keys</a>
        <a class="text-base font-semibold py-3 px-2 text-text-light-primary dark:text-text-dark-primary hover:bg-primary/10 rounded-lg transition-colors duration-200" href="{{route('KeyShells.index')}}">Key Shells</a>

        {{-- Remote --}}
        <div class="w-full">
            <button class="w-full flex justify-between items-center py-3 px-2 text-base font-semibold text-text-light-primary dark:text-text-dark-primary hover:bg-primary/10 rounded-lg transition-colors duration-200 whitespace-nowrap" id="MobileRemoteKeysTrigger">
                Remote Keys
                <span class="material-symbols-outlined text-xl transition-transform duration-300">expand_more</span>
            </button>
            <div class="hidden grid-cols-2 min-w-full gap-1 pl-4 pb-2" id="MobileRemoteKeysDropdown">
                @foreach(['Toyota','Honda','Suzuki','Nissan','Mazda','Benz','Daihatsu','Others'] as $brand)
                    <a class="py-2 px-4 text-sm font-medium text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors duration-200 rounded-lg" href="{{ route('Remote.brand', ['brand' => strtolower($brand)]) }}">- {{ $brand }}</a>
                @endforeach
            </div>
        </div>

        {{-- Smart --}}
        <div class="w-full">
            <button class="w-full flex justify-between items-center py-3 px-2 text-base font-semibold text-text-light-primary dark:text-text-dark-primary hover:bg-primary/10 rounded-lg transition-colors duration-200 whitespace-nowrap" id="MobileSmartKeysTrigger">
                Smart Keys
                <span class="material-symbols-outlined text-xl transition-transform duration-300">expand_more</span>
            </button>
            <div class="hidden grid-cols-2 min-w-full gap-1 pl-4 pb-2" id="MobileSmartKeysDropdown">
                @foreach(['Toyota','Honda','Suzuki','Nissan','Mazda','Benz','Daihatsu','Others'] as $brand)
                    <a class="py-2 px-4 text-sm font-medium text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors duration-200 rounded-lg" href="{{ route('Smart.brand', ['brand' => strtolower($brand)]) }}">- {{ $brand }}</a>
                @endforeach
            </div>
        </div>

        <a class="text-base font-semibold py-3 px-2 text-text-light-primary dark:text-text-dark-primary hover:bg-primary/10 rounded-lg transition-colors duration-200" href="{{route('KeyCover.index')}}">Key Covers</a>
        <a class="text-base font-semibold py-3 px-2 text-text-light-primary dark:text-text-dark-primary hover:bg-primary/10 rounded-lg transition-colors duration-200" href="{{route('Other.index')}}">Others</a>
        <a class="text-base font-semibold py-3 px-2 text-text-light-primary dark:text-text-dark-primary hover:bg-primary/10 rounded-lg transition-colors duration-200" href="{{route('AboutUs')}}">Contact Us</a>
    </div>

    {{-- Mobile Footer --}}
    <div class="p-5 flex flex-col gap-3 border-t border-border-light dark:border-border-dark">
        <button id="MobileCartButton" class="flex items-center gap-3 text-base font-medium text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors duration-200 relative">
            <span class="material-symbols-outlined">shopping_cart</span>
            Cart
            <span id="MobileCartCount" class="hidden absolute -top-1 left-5 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
        </button>
    </div>
</div>
