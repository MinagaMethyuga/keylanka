<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Key Lanka - Manage Keys</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24
        }
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #c5c5c5; border-radius: 10px; border: 2px solid transparent; background-clip: padding-box; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
        .dark ::-webkit-scrollbar-thumb { background: #444; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #555; }
        * { scrollbar-width: thin; scrollbar-color: #c5c5c5 transparent; }
        .dark * { scrollbar-color: #444 transparent; }
    </style>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#121212",
                        "component-dark": "#1A1A1A",
                        "table-dark": "#2C2C2E",
                        "text-primary-dark": "#F5F5F7",
                        "text-secondary-dark": "#8A8A8E",
                        "action-blue": "#007AFF",
                        "destructive-red": "#FF3B30",
                    },
                    fontFamily: { "display": ["Space Grotesk", "sans-serif"] },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-primary-dark">

@if(session('success'))
    <div id="success-alert" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="error-alert" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('error') }}
    </div>
@endif

<div class="flex min-h-screen w-full">
    <x-AdminNavbar/>

    <main class="flex-1 p-8 h-screen overflow-y-auto">
        <div class="w-full max-w-7xl mx-auto">
            <header class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <h1 class="text-black dark:text-text-primary-dark text-4xl font-bold leading-tight">Manage Keys</h1>
            </header>

            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <label class="flex flex-col min-w-40 h-12 w-full">
                        <div class="flex w-full flex-1 items-stretch rounded-lg h-full bg-background-light dark:bg-table-dark">
                            <div class="text-gray-600 dark:text-text-secondary-dark flex items-center justify-center pl-4">
                                <span class="material-symbols-outlined">search</span>
                            </div>
                            <input id="searchInput" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden text-black dark:text-text-primary-dark focus:outline-0 focus:ring-0 border-none bg-transparent h-full placeholder:text-gray-500 dark:placeholder:text-text-secondary-dark px-4 pl-2 text-base font-normal leading-normal" placeholder="Search by Product Title or SKU..." value=""/>
                        </div>
                    </label>
                </div>
                <div class="flex gap-3 items-center flex-wrap">
                    <button class="flex h-12 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-background-light dark:bg-table-dark px-4 hover:bg-black/5 dark:hover:bg-white/5">
                        <p class="text-black dark:text-text-primary-dark text-sm font-medium leading-normal">Category</p>
                        <span class="material-symbols-outlined text-black dark:text-text-primary-dark text-xl">expand_more</span>
                    </button>
                    <button class="flex h-12 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-background-light dark:bg-table-dark px-4 hover:bg-black/5 dark:hover:bg-white/5">
                        <p class="text-black dark:text-text-primary-dark text-sm font-medium leading-normal">Stock Status</p>
                        <span class="material-symbols-outlined text-black dark:text-text-primary-dark text-xl">expand_more</span>
                    </button>
                </div>
            </div>

            <div class="bg-background-light dark:bg-table-dark rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="border-b border-gray-200 dark:border-white/10">
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase text-gray-500 dark:text-text-secondary-dark tracking-wider">Product</th>
                            <th class="p-4 text-xs font-semibold uppercase text-gray-500 dark:text-text-secondary-dark tracking-wider text-center">Category</th>
                            <th class="p-4 text-xs font-semibold uppercase text-gray-500 dark:text-text-secondary-dark tracking-wider text-center">Brand</th>
                            <th class="p-4 text-xs font-semibold uppercase text-gray-500 dark:text-text-secondary-dark tracking-wider text-center">Price</th>
                            <th class="p-4 text-xs font-semibold uppercase text-gray-500 dark:text-text-secondary-dark tracking-wider text-center">Stock</th>
                            <th class="p-4 text-xs font-semibold uppercase text-gray-500 dark:text-text-secondary-dark tracking-wider text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                        @foreach($items as $item)
                            <tr class="hover:bg-black/5 dark:hover:bg-white/5" data-title="{{ strtolower($item->title) }}">
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="bg-center bg-no-repeat aspect-square bg-contain rounded-md size-10"
                                             style="background-image: url('{{ asset($item->image) }}');"></div>
                                        <span class="font-medium text-black dark:text-text-primary-dark">{{$item->title}}</span>
                                    </div>
                                </td>
                                <td class="p-4 whitespace-nowrap text-center text-gray-600 dark:text-text-secondary-dark">
                                    {{$item->category}}
                                </td>
                                <td class="p-4 whitespace-nowrap text-center text-gray-600 dark:text-text-secondary-dark">
                                    {{ !empty($item->brand) ? $item->brand : '-' }}
                                </td>
                                <td class="p-4 whitespace-nowrap text-center text-gray-600 dark:text-text-secondary-dark">
                                    LKR {{number_format($item->price, 2)}}
                                </td>
                                <td class="p-4 whitespace-nowrap text-center">
                                    @if ($item->stock == 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                            Out Of Stock
                                        </span>
                                    @elseif ($item->stock < 20)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                            {{$item->stock}}
                                        </span>
                                    @elseif ($item->stock < 80)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">
                                            {{$item->stock}}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                            {{$item->stock}}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 whitespace-nowrap text-right">
                                    <button onclick="openEditModal({{$item->id}})" class="p-2 text-action-blue rounded-md hover:bg-action-blue/10">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </button>
                                    <button onclick="openDeleteModal({{$item->id}}, '{{$item->title}}')" class="p-2 text-destructive-red rounded-md hover:bg-red-500/40">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 flex items-center justify-between border-t border-gray-200 dark:border-white/10">
                    <p class="text-sm text-gray-600 dark:text-text-secondary-dark pagination-info">Showing 1 to 8 of {{ count($items) }} results</p>
                    <div class="flex items-center gap-2 pagination-buttons">
                        <button class="flex items-center justify-center size-8 rounded-md hover:bg-black/5 dark:hover:bg-white/5">
                            <span class="material-symbols-outlined text-xl text-gray-400 dark:text-text-secondary-dark/50">chevron_left</span>
                        </button>
                        <button class="flex items-center justify-center size-8 rounded-md hover:bg-black/5 dark:hover:bg-white/5">
                            <span class="material-symbols-outlined text-xl text-black dark:text-text-primary-dark">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Edit Product Modal -->
<div id="editModal" class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-background-light dark:bg-table-dark rounded-xl shadow-lg w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto">
        <h2 class="text-lg font-bold text-black dark:text-text-primary-dark mb-4">Edit Product</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-black dark:text-text-primary-dark mb-2">Title</label>
                    <input type="text" name="title" id="edit_title" required class="w-full px-4 py-2 rounded-lg bg-white dark:bg-component-dark text-black dark:text-text-primary-dark border border-gray-300 dark:border-white/10 focus:outline-none focus:ring-2 focus:ring-action-blue">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-black dark:text-text-primary-dark mb-2">Price (LKR)</label>
                        <input type="number" step="0.01" name="price" id="edit_price" required class="w-full px-4 py-2 rounded-lg bg-white dark:bg-component-dark text-black dark:text-text-primary-dark border border-gray-300 dark:border-white/10 focus:outline-none focus:ring-2 focus:ring-action-blue">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-black dark:text-text-primary-dark mb-2">Stock</label>
                        <input type="number" name="stock" id="edit_stock" required class="w-full px-4 py-2 rounded-lg bg-white dark:bg-component-dark text-black dark:text-text-primary-dark border border-gray-300 dark:border-white/10 focus:outline-none focus:ring-2 focus:ring-action-blue">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-black dark:text-text-primary-dark mb-2">Category</label>
                        <input type="text" name="category" id="edit_category" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-component-dark text-black dark:text-text-primary-dark border border-gray-300 dark:border-white/10 focus:outline-none focus:ring-2 focus:ring-action-blue">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-black dark:text-text-primary-dark mb-2">Brand</label>
                        <input type="text" name="brand" id="edit_brand" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-component-dark text-black dark:text-text-primary-dark border border-gray-300 dark:border-white/10 focus:outline-none focus:ring-2 focus:ring-action-blue">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-black dark:text-text-primary-dark mb-2">Description</label>
                    <textarea name="description" id="edit_description" rows="4" required class="w-full px-4 py-2 rounded-lg bg-white dark:bg-component-dark text-black dark:text-text-primary-dark border border-gray-300 dark:border-white/10 focus:outline-none focus:ring-2 focus:ring-action-blue"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-black dark:text-text-primary-dark mb-2">Image (leave empty to keep current)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-component-dark text-black dark:text-text-primary-dark border border-gray-300 dark:border-white/10">
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-lg text-sm font-semibold bg-gray-200 dark:bg-white/10 text-black dark:text-text-primary-dark hover:bg-gray-300 dark:hover:bg-white/20">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-lg text-sm font-semibold bg-action-blue text-white hover:bg-action-blue/90">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-background-light dark:bg-table-dark rounded-xl shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-bold text-black dark:text-text-primary-dark">Confirm Deletion</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-text-secondary-dark">Are you sure you want to delete "<span id="deleteProductName"></span>"? This action cannot be undone.</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded-lg text-sm font-semibold bg-gray-200 dark:bg-white/10 text-black dark:text-text-primary-dark hover:bg-gray-300 dark:hover:bg-white/20">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-lg text-sm font-semibold bg-destructive-red text-white hover:bg-destructive-red/90">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
    const ITEMS_PER_PAGE = 8;
    let currentPage = 1;
    let allRows = [];
    let filteredRows = [];

    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.querySelector('tbody');
        allRows = Array.from(tbody.querySelectorAll('tr'));
        filteredRows = [...allRows];

        renderPage(1);

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();

            if (searchTerm === '') {
                filteredRows = [...allRows];
            } else {
                filteredRows = allRows.filter(row => {
                    const title = row.dataset.title;
                    return title.includes(searchTerm);
                });
            }

            currentPage = 1;
            renderPage(1);
        });

        // Auto-hide alerts
        setTimeout(() => {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert) errorAlert.style.display = 'none';
        }, 3000);
    });

    function renderPage(page) {
        const totalPages = Math.ceil(filteredRows.length / ITEMS_PER_PAGE);
        const startIndex = (page - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;

        allRows.forEach(row => row.style.display = 'none');
        filteredRows.slice(startIndex, endIndex).forEach(row => row.style.display = '');

        const showingText = document.querySelector('.pagination-info');
        if (showingText) {
            showingText.textContent = `Showing ${filteredRows.length > 0 ? startIndex + 1 : 0} to ${Math.min(endIndex, filteredRows.length)} of ${filteredRows.length} results`;
        }

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        const paginationContainer = document.querySelector('.pagination-buttons');
        if (!paginationContainer) return;

        const buttons = paginationContainer.querySelectorAll('button');
        buttons.forEach((btn, idx) => {
            if (idx > 0 && idx < buttons.length - 1) btn.remove();
        });

        const prevButton = paginationContainer.querySelector('button:first-child');
        const nextButton = paginationContainer.querySelector('button:last-child');

        const pageNumbers = getPageNumbers(currentPage, totalPages);

        pageNumbers.forEach(page => {
            if (page === '...') {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'px-2 text-gray-600 dark:text-text-secondary-dark';
                ellipsis.textContent = '...';
                paginationContainer.insertBefore(ellipsis, nextButton);
            } else {
                const button = document.createElement('button');
                button.className = `flex items-center justify-center size-8 rounded-md text-sm ${
                    currentPage === page ? 'bg-action-blue text-white' : 'hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-text-primary-dark'
                }`;
                button.textContent = page;
                button.onclick = () => goToPage(page);
                paginationContainer.insertBefore(button, nextButton);
            }
        });

        prevButton.disabled = currentPage === 1;
        prevButton.onclick = () => goToPage(currentPage - 1);
        prevButton.querySelector('span').className = currentPage === 1
            ? 'material-symbols-outlined text-xl text-gray-400 dark:text-text-secondary-dark/50'
            : 'material-symbols-outlined text-xl text-black dark:text-text-primary-dark';

        nextButton.disabled = currentPage === totalPages;
        nextButton.onclick = () => goToPage(currentPage + 1);
        nextButton.querySelector('span').className = currentPage === totalPages
            ? 'material-symbols-outlined text-xl text-gray-400 dark:text-text-secondary-dark/50'
            : 'material-symbols-outlined text-xl text-black dark:text-text-primary-dark';
    }

    function goToPage(page) {
        const totalPages = Math.ceil(filteredRows.length / ITEMS_PER_PAGE);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        renderPage(page);
    }

    function getPageNumbers(current, total) {
        const pages = [];
        const maxVisible = 5;

        if (total <= maxVisible) {
            for (let i = 1; i <= total; i++) pages.push(i);
        } else {
            if (current <= 3) {
                for (let i = 1; i <= 4; i++) pages.push(i);
                pages.push('...');
                pages.push(total);
            } else if (current >= total - 2) {
                pages.push(1);
                pages.push('...');
                for (let i = total - 3; i <= total; i++) pages.push(i);
            } else {
                pages.push(1);
                pages.push('...');
                pages.push(current - 1);
                pages.push(current);
                pages.push(current + 1);
                pages.push('...');
                pages.push(total);
            }
        }
        return pages;
    }

    function openEditModal(productId) {
        fetch(`/admin/products/${productId}`)
            .then(response => response.json())
            .then(product => {
                document.getElementById('edit_title').value = product.title;
                document.getElementById('edit_price').value = product.price;
                document.getElementById('edit_stock').value = product.stock;
                document.getElementById('edit_category').value = product.category || '';
                document.getElementById('edit_brand').value = product.brand || '';
                document.getElementById('edit_description').value = product.description;

                document.getElementById('editForm').action = `/admin/products/${productId}`;
                document.getElementById('editModal').classList.remove('hidden');
            });
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDeleteModal(productId, productName) {
        document.getElementById('deleteProductName').textContent = productName;
        document.getElementById('deleteForm').action = `/admin/products/${productId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
</body>
</html>
