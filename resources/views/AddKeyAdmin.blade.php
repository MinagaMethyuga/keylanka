<!DOCTYPE html>

<html class="dark" lang="en"><head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Add New Product - Key Lanka Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00A9FF",
                        "background-light": "#f6f6f8",
                        "background-dark": "#121212",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Dark mode */
        .dark ::-webkit-scrollbar-thumb {
            background: #444;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Firefox Scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: #c5c5c5 transparent;
        }

        .dark * {
            scrollbar-color: #444 transparent;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 24px;
        }

        .glass-card {
            background-color: rgba(30, 30, 30, 0.6); /* #1E1E1E with opacity */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(45, 45, 45, 0.5);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-white">
<div class="relative flex min-h-screen w-full flex-col">
    <div class="flex h-full grow flex-row">
        <x-AdminNavbar/>
        <main class="flex-1 p-8 h-screen overflow-x-auto">
            <div class="flex flex-col max-w-4xl mx-auto">
                <div class="flex flex-wrap gap-2 mb-4">
                    <a class="text-[#92a4c9] text-sm font-medium leading-normal hover:text-white" href="#">Dashboard</a>
                    <span class="text-[#92a4c9] text-sm font-medium leading-normal">/</span>
                    <a class="text-[#92a4c9] text-sm font-medium leading-normal hover:text-white" href="#">Products</a>
                    <span class="text-[#92a4c9] text-sm font-medium leading-normal">/</span>
                    <span class="text-white text-sm font-medium leading-normal">Add Product</span>
                </div>
                <div class="flex flex-wrap justify-between gap-3 mb-8">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em]">Add New Product</h1>
                </div>
                <div class="flex flex-col gap-8">
                    @if (session('success'))
                        <div class="alert p-4 mb-4 bg-green-500 text-white rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert p-4 mb-4 bg-red-500 text-white rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert p-4 mb-4 bg-red-500 text-white rounded-lg">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="glass-card rounded-xl border">
                        <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-6 pb-3 pt-5 border-b border-[#324467]/30">Product Information</h2>
                        <form action="{{ route('addProducts.store') }}" method="POST" enctype="multipart/form-data" class="p-0 m-0">
                            @csrf
                        <div class="p-6">
                            <div class="mb-6">
                                <label class="flex flex-col w-full">
                                    <p class="text-white text-base font-medium leading-normal pb-2">Main Category</p>
                                    <select
                                        id="main-category-select"
                                        name="category"
                                        class="form-select w-full appearance-none rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary border border-[#324467] bg-[#101622] h-14 placeholder:text-[#92a4c9] p-[15px] text-base font-normal leading-normal transition-all"
                                        onchange="showCategoryFields()">
                                        <option value="Hidden-section">Choose your option</option>
                                        <option value="locksmith-tools">Locksmith Tools</option>
                                        <option value="flip-key">Flip Keys</option>
                                        <option value="key-shell">Keys Shells</option>
                                        <option value="remote">Remote Keys</option>
                                        <option value="smart">Smart Keys</option>
                                        <option value="key-cover">Key Covers</option>
                                        <option value="other-list">Others</option>
                                    </select>
                                </label>
                            </div>
                            <!--Locksmith Tool Set -->
                            <x-ProductsPage.LocksmithTools/>
                            <!--Flip Keys -->
                            <x-ProductsPage.FlipKeys/>
                            <!--Key Shells -->
                            <x-ProductsPage.KeyShells/>
                            <!--Remote Keys -->
                            <x-ProductsPage.RemoteKeys/>
                            <!--Smart Keys Set-->
                            <x-ProductsPage.SmartKey/>
                            <!--Key Covers-->
                            <x-ProductsPage.KeyCover/>
                            <!--Others-->
                            <x-ProductsPage.Others/>
                            <div class="p-1 mt-5">
                                <!-- Upload Area -->
                                <div id="upload-area" class="flex flex-col items-center justify-center w-full border-2 border-dashed border-[#324467] rounded-lg p-8 text-center cursor-pointer hover:bg-primary/10 transition-colors">
                                    <span class="material-symbols-outlined text-primary text-5xl mb-3">upload_file</span>
                                    <p class="text-white font-medium">Drag & drop images here, or <span class="text-primary font-bold">click to browse</span></p>
                                    <p class="text-sm text-[#92a4c9] mt-1">PNG, JPG, GIF up to 10MB</p>
                                    <input type="file" id="file-input" multiple accept="image/*" class="hidden" name="image">
                                </div>

                                <!-- Preview Grid -->
                                <div id="preview-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-6"></div>

                                <div class="flex justify-end gap-4 mt-4">
{{--                                    <button class="px-6 py-3 rounded-lg text-white font-medium bg-[#324467] hover:bg-[#455a85] transition-colors">--}}
{{--                                        Cancel--}}
{{--                                    </button>--}}
                                    <button type="submit" class="px-6 py-3 rounded-lg text-white font-medium bg-primary hover:bg-primary/90 transition-colors">
                                        Add Product
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            // Fade out smoothly
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";

            // Remove from DOM after fade out
            setTimeout(() => alert.remove(), 500);
        }, 3000); // 3000ms = 3 seconds
    });

    function showCategoryFields() {
        const selector = document.getElementById('main-category-select');
        const selectedValue = selector.value;

        // Get all product sections by ID
        const locksmithTools = document.getElementById('locksmith-tools-set');
        const flipKeys = document.getElementById('flip-key-set');
        const keyShells = document.getElementById('key-shell-set');
        const remoteKeys = document.getElementById('remote-keys-set');
        const smartKeys = document.getElementById('smart-keys-set');
        const keyCovers = document.getElementById('key-cover-set');
        const others = document.getElementById('other-set');

        const allSections = [
            locksmithTools, flipKeys, keyShells,
            remoteKeys, smartKeys, keyCovers, others
        ];

        // Hide & disable all sections
        allSections.forEach(section => {
            if (section) {
                section.classList.add('hidden');

                // Disable all inputs inside hidden sections
                section.querySelectorAll('input, textarea, select')
                    .forEach(el => el.disabled = true);
            }
        });

        // Show the selected section
        let selectedSection;

        if (selectedValue === 'locksmith-tools') selectedSection = locksmithTools;
        else if (selectedValue === 'flip-key') selectedSection = flipKeys;
        else if (selectedValue === 'key-shell') selectedSection = keyShells;
        else if (selectedValue === 'remote') selectedSection = remoteKeys;
        else if (selectedValue === 'smart') selectedSection = smartKeys;
        else if (selectedValue === 'key-cover') selectedSection = keyCovers;
        else if (selectedValue === 'other-list') selectedSection = others;

        // Show & enable selected section
        if (selectedSection) {
            selectedSection.classList.remove('hidden');
            selectedSection.querySelectorAll('input, textarea, select')
                .forEach(el => el.disabled = false);
        }
    }
    // Call the function once the page loads to display the default selected option's fields
    document.addEventListener('DOMContentLoaded', showCategoryFields);


    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('file-input');
    const previewGrid = document.getElementById('preview-grid');
    let uploadedFiles = [];

    // Click to open file browser
    uploadArea.addEventListener('click', () => fileInput.click());

    // Handle file input selection
    fileInput.addEventListener('change', (e) => handleFiles(e.target.files));

    // Handle drag & drop
    uploadArea.addEventListener('dragover', (e) => e.preventDefault());
    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        handleFiles(e.dataTransfer.files);
    });

    // Handle files
    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            uploadedFiles.push(file);

            const reader = new FileReader();
            reader.onload = (e) => {
                const div = document.createElement('div');
                div.className = "relative group aspect-square";

                div.innerHTML = `
                <img class="w-full h-full object-cover rounded-lg" src="${e.target.result}" alt="${file.name}">
                <button class="absolute top-1 right-1 bg-black/50 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="material-symbols-outlined !text-base">close</span>
                </button>
            `;
                // Remove image on close click
                div.querySelector('button').addEventListener('click', () => {
                    uploadedFiles = uploadedFiles.filter(f => f !== file);
                    div.remove();
                });

                previewGrid.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
</script>
</body>
</html>
