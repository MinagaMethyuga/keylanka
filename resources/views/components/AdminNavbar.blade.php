<aside class="flex w-64 flex-col bg-[#1E1E1E] p-4 text-[#A0A0A0] h-screen">
    <div class="flex flex-col gap-8">
        <div class="flex items-center gap-3 px-3">
            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Key Lanka company logo" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCrDFfJyR814zoQS6XzBScRcl_gS-GfG5sKNvgNg7w6_grnccnmIxEROdzrEpgYlEkvcccLhGj4UEmnB7a-XLshuwSpPiQDqeTytXGqoaz1HaZTITqLtHEjlJ5LWFJukOIdPtQmoN97MZul2-m1XSVwkM1SasrWF0NYlT0xnCFxyGRFDzuijh3lB0OypV8I55hGtjYgxdKHzXEnLMoLhGxnxT9Z7r9QS0DLPmV4UzYE3UaTd37NodF6fl4387wwygllEQEdTYGIEQ");'></div>
            <div class="flex flex-col">
                <h1 class="text-white text-base font-bold leading-normal">Key Lanka</h1>
                <p class="text-sm font-normal leading-normal">Admin Panel</p>
            </div>
        </div>
        <nav class="flex flex-col gap-2">
            <a class="flex items-center gap-3 rounded-lg px-3 py-2 bg-primary/20 text-primary" href="{{route('dashboard')}}">
                <span class="material-symbols-outlined text-primary">dashboard</span>
                <p class="text-sm font-medium leading-normal">Dashboard</p>
            </a>
            <a class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-primary/10 hover:text-white transition-colors duration-200" href="{{ route('add-key') }}">
                <span class="material-symbols-outlined">add_box</span>
                <p class="text-sm font-medium leading-normal">Add Product</p>
            </a>
            <a class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-primary/10 hover:text-white transition-colors duration-200" href="{{ route('Manage.Products.index') }}">
                <span class="material-symbols-outlined">key</span>
                <p class="text-sm font-medium leading-normal">Manage Products</p>
            </a>
            <a class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-primary/10 hover:text-white transition-colors duration-200" href="{{ route('admin.order.manage') }}">
                <span class="material-symbols-outlined">shopping_cart</span>
                <p class="text-sm font-medium leading-normal">Orders</p>
            </a>
        </nav>
    </div>
    <div class="mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-red-500/10 hover:text-red-400 transition-colors duration-200 text-[#A0A0A0]">
                <span class="material-symbols-outlined">logout</span>
                <p class="text-sm font-medium leading-normal">Logout</p>
            </button>
        </form>
    </div>
</aside>
