@extends("admin.layouts.master-layouts.plain")

<title>Add Product | Grocery Store</title>

@push("script")
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#10b981',
                    secondary: '#1f2937'
                }
            }
        }
    }
</script>
@endpush

@push("script")
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#10b981',
                    secondary: '#1f2937'
                }
            }
        }
    }
</script>
@endpush

@push("style")
<style>
    .image-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
    }
    .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        cursor: pointer;
    }
    .gallery-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    
    /* CKEditor Custom Styles */
    .ck-editor__editable {
        min-height: 400px;
        border-radius: 0.5rem !important;
        border: 1px solid #e5e7eb !important;
    }
    
    .ck.ck-editor {
        width: 100% !important;
    }
    
    .ck.ck-toolbar {
        border-radius: 0.5rem 0.5rem 0 0 !important;
        background: #f9fafb !important;
        border: 1px solid #e5e7eb !important;
        border-bottom: none !important;
        flex-wrap: wrap !important;
    }
    
    .ck.ck-toolbar .ck-toolbar__items {
        flex-wrap: wrap !important;
    }
    
    /* Make toolbar buttons more visible */
    .ck.ck-button {
        min-height: 32px !important;
    }
    
    .ck.ck-toolbar .ck.ck-toolbar__separator {
        background: #e5e7eb !important;
    }
</style>
@endpush

@section("content")
<div 
    x-data="{ sidebarOpen: false }" 
    @close-sidebar.window="sidebarOpen = false" 
    class="flex h-screen overflow-hidden"
>
<button @click="sidebarOpen = true" 
        class="fixed top-4 left-4 z-40 p-2 bg-gray-900 text-white rounded-md lg:hidden">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile backdrop -->
    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>


    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-cloak
    >
        @include("admin.layouts.partial.sidebar")
    </aside>


    <div class="flex-1 flex flex-col overflow-hidden lg:ml-64 bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Main Content -->
        <!-- Top Bar -->
        <header class="bg-white shadow-sm z-10">
            <div class="flex justify-between items-center p-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Add New Product</h2>
                    <nav class="text-sm text-gray-500">
                        <ol class="list-none p-0 inline-flex">
                            <li class="flex items-center">
                                <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                            </li>
                            <li class="flex items-center">
                                <a href="#" class="text-gray-500 hover:text-primary">Products</a>
                                <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                            </li>
                            <li class="flex items-center">
                                <span class="text-gray-700">Add Product</span>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="flex items-center">
                    <button class="p-2 rounded-full hover:bg-gray-100 relative">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="ml-4 relative">
                        <button class="flex items-center focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-700">Admin</span>
                            <i class="fas fa-chevron-down ml-1 text-gray-500 text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Product Form -->
            <form id="productForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Product Details Section -->
                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Product Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                            <input type="text" id="product_name" name="product_name" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                        
                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="category" name="category_id" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                            <input type="number" id="price" name="price" step="0.01" min="0" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        
                        <div>
                            <label for="cut_price" class="block text-sm font-medium text-gray-700 mb-1">Cut Price</label>
                            <input type="number" id="cut_price" name="cut_price"  
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <input type="number" id="rating" name="rating" step="0.01" max="5" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                        
                        <!-- SKU -->
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                            <input type="text" id="sku" name="sku" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <!-- Is Featured -->
                        <div class="flex items-center gap-3 mt-4">
                            <input
                                type="checkbox"
                                name="is_top_selling"
                                id="is_top_selling"
                                value="1"
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary"
                            >
                            <label for="is_featured" class="text-sm font-medium text-gray-700">
                                Top Selling Product
                            </label>
                        </div>
                        
                        <!-- Description with CKEditor -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="15"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"></textarea>
                            <p class="text-sm text-gray-500 mt-2">Use the toolbar to format your product description with rich text, images, tables, and more.</p>
                        </div>
                        
                        <!-- Status -->
                        <div class="md:col-span-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="status" name="status" value="active" checked
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="status" class="ml-2 block text-sm text-gray-700">Active Product</label>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Product Default Images Section -->
                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Product Default Images</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Default Image -->
                        <div>
                            <label for="default_image" class="block text-sm font-medium text-gray-700 mb-2">Default Image</label>
                            <p class="text-sm text-gray-500 mb-3">This will be the main product image displayed on listings</p>
                            <input type="file" id="default_image" name="default_image" accept="image/*" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                            <div id="defaultImagePreview" class="mt-3 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                <img src="" alt="Default image preview" class="image-preview">
                            </div>
                        </div>
                        
                        <!-- Gallery Images -->
                        <div>
                            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
                            <p class="text-sm text-gray-500 mb-3">Additional product images for gallery view</p>
                            <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                            <div id="galleryPreview" class="mt-3 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                <div class="gallery-preview" id="galleryImagesContainer">
                                    <!-- Gallery image previews will be added here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Product Colors Section -->
                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Product Colors</h3>
                        <button type="button" id="addColorBtn" 
                            class="bg-primary hover:bg-emerald-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Color
                        </button>
                    </div>
                    
                    <div id="colorsContainer" class="space-y-4">
                        <!-- Colors will be dynamically added here -->
                    </div>
                </section>
                
                <!-- Product Sizes Section -->
                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Product Sizes</h3>
                        <button type="button" id="addSizeBtn" 
                            class="bg-primary hover:bg-emerald-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Size
                        </button>
                    </div>
                    
                    <div id="sizesContainer" class="space-y-4">
                        <!-- Sizes will be dynamically added here -->
                    </div>
                </section>
                
                <!-- Save Product Button -->
                <div class="fixed bottom-4 right-4 flex space-x-3">
                    <a href="{{ route('admin.products') }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl shadow-lg flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                    </a>
                    <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl shadow-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Product
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection

@push("script")
<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize CKEditor with Full MS Word-like Toolbar
ClassicEditor
    .create(document.querySelector('#description'), {
        toolbar: {
            items: [
                // Undo/Redo
                'undo', 'redo',
                '|',
                
                // Text Formatting
                'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript',
                '|',
                
                // Font & Size
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                '|',
                
                // Paragraph Styles
                'heading', 'style',
                '|',
                
                // Alignment
                'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify',
                '|',
                
                // Lists
                'bulletedList', 'numberedList', 'outdent', 'indent',
                '|',
                
                // Links & Media
                'link', 'imageInsert', 'insertTable', 'mediaEmbed',
                '|',
                
                // Blocks
                'blockQuote', 'codeBlock', 'htmlEmbed',
                '|',
                
                // Tools
                'findAndReplace', 'selectAll', 'sourceEditing',
                '|',
                
                // Formatting
                'removeFormat', 'specialCharacters', 'horizontalLine',
                '|',
                
                // Insert
                'pageBreak',
                '|',
                
                // Help
                'help'
            ],
            shouldNotGroupWhenFull: true
        },
        
        // Font Family Options
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        
        // Font Size Options
        fontSize: {
            options: [
                8, 9, 10, 11, 12, 14, 16, 18, 20, 22, 24, 26, 28, 36, 48, 72
            ],
            supportAllValues: true
        },
        
        // Font Color
        fontColor: {
            colors: [
                { color: 'hsl(0, 0%, 0%)', label: 'Black' },
                { color: 'hsl(0, 0%, 30%)', label: 'Dim grey' },
                { color: 'hsl(0, 0%, 60%)', label: 'Grey' },
                { color: 'hsl(0, 0%, 90%)', label: 'Light grey' },
                { color: 'hsl(0, 100%, 50%)', label: 'Red' },
                { color: 'hsl(30, 100%, 50%)', label: 'Orange' },
                { color: 'hsl(60, 100%, 50%)', label: 'Yellow' },
                { color: 'hsl(120, 100%, 50%)', label: 'Green' },
                { color: 'hsl(180, 100%, 50%)', label: 'Cyan' },
                { color: 'hsl(240, 100%, 50%)', label: 'Blue' },
                { color: 'hsl(300, 100%, 50%)', label: 'Magenta' }
            ]
        },
        
        // Background Color
        fontBackgroundColor: {
            colors: [
                { color: 'hsl(0, 0%, 100%)', label: 'White' },
                { color: 'hsl(0, 0%, 90%)', label: 'Light grey' },
                { color: 'hsl(0, 100%, 90%)', label: 'Light red' },
                { color: 'hsl(60, 100%, 90%)', label: 'Light yellow' },
                { color: 'hsl(120, 100%, 90%)', label: 'Light green' },
                { color: 'hsl(180, 100%, 90%)', label: 'Light cyan' },
                { color: 'hsl(240, 100%, 90%)', label: 'Light blue' }
            ]
        },
        
        // Heading Options
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        
        // Table Options
        table: {
            contentToolbar: [
                'tableColumn', 'tableRow', 'mergeTableCells',
                'tableProperties', 'tableCellProperties'
            ],
            tableProperties: {
                borderColors: [
                    { color: 'hsl(0, 0%, 0%)', label: 'Black' },
                    { color: 'hsl(0, 100%, 50%)', label: 'Red' },
                    { color: 'hsl(120, 100%, 50%)', label: 'Green' },
                    { color: 'hsl(240, 100%, 50%)', label: 'Blue' }
                ],
                backgroundColors: [
                    { color: 'hsl(0, 0%, 100%)', label: 'White' },
                    { color: 'hsl(0, 0%, 90%)', label: 'Light grey' }
                ]
            }
        },
        
        // Image Options
        image: {
            toolbar: [
                'imageTextAlternative', 'imageStyle:inline', 
                'imageStyle:block', 'imageStyle:side', 
                'linkImage'
            ],
            styles: [
                'full', 'side', 'alignLeft', 'alignCenter', 'alignRight'
            ]
        },
        
        // Link Options
        link: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'http://',
            decorators: {
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        
        // Alignment Options
        alignment: {
            options: [ 'left', 'center', 'right', 'justify' ]
        },
        
        // List Options
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        
        // HTML Embed
        htmlEmbed: {
            showPreviews: true
        },
        
        // Language
        language: 'en',
        
        // Enable placeholder
        placeholder: 'Write your product description here...',
        
        // Remove branding
        removePlugins: [],
        
        // Initial data
        initialData: '',
        
        // Styling
        shouldNotGroupWhenFull: true
    })
    .then(editor => {
        console.log('CKEditor initialized successfully with full toolbar');
        window.editor = editor;
        
        // Update textarea before form submission
        const form = document.getElementById('productForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const editorData = editor.getData();
                document.querySelector('#description').value = editorData;
                console.log('Form submitted with editor content');
            });
        }
    })
    .catch(error => {
        console.error('CKEditor initialization error:', error);
    });
        
        // Default image preview
        const defaultImageInput = document.getElementById('default_image');
        if (defaultImageInput) {
            const defaultImagePreview = document.getElementById('defaultImagePreview');
            const defaultImagePreviewImg = defaultImagePreview.querySelector('img');
            
            defaultImageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        defaultImagePreviewImg.src = e.target.result;
                        defaultImagePreview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    defaultImagePreview.classList.add('hidden');
                }
            });
        }
        
        // Gallery images preview
        const galleryImagesInput = document.getElementById('gallery_images');
        if (galleryImagesInput) {
            const galleryPreview = document.getElementById('galleryPreview');
            const galleryImagesContainer = document.getElementById('galleryImagesContainer');
            
            galleryImagesInput.addEventListener('change', function() {
                galleryImagesContainer.innerHTML = '';
                
                if (this.files && this.files.length > 0) {
                    for (let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const imageId = `gallery_image_${Date.now()}_${i}`;
                            const imageHtml = `
                                <div class="relative">
                                    <img src="${e.target.result}" alt="Gallery preview" class="image-preview">
                                    <button type="button" class="remove-btn remove-gallery-image" data-image="${imageId}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `;
                            galleryImagesContainer.insertAdjacentHTML('beforeend', imageHtml);
                            
                            document.querySelector(`[data-image="${imageId}"]`).addEventListener('click', function() {
                                this.closest('.relative').remove();
                            });
                        }
                        reader.readAsDataURL(file);
                    }
                    galleryPreview.classList.remove('hidden');
                } else {
                    galleryPreview.classList.add('hidden');
                }
            });
        }
        
        // Color management
        let colorCounter = 0;
        const addColorBtn = document.getElementById('addColorBtn');
        
        function addColor() {
            colorCounter++;
            const colorId = `color_${colorCounter}`;
            
            const colorHtml = `
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50" id="${colorId}">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-medium text-gray-800">Color #${colorCounter}</h4>
                        <button type="button" class="text-red-600 hover:text-red-800 remove-color">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="color_name_${colorCounter}" class="block text-sm font-medium text-gray-700 mb-1">Color Name</label>
                            <input type="text" id="color_name_${colorCounter}" name="colors[${colorCounter}][name]" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                placeholder="e.g., Red, Blue, Black">
                        </div>
                        <div>
                            <label for="color_hex_${colorCounter}" class="block text-sm font-medium text-gray-700 mb-1">Color Hex Code</label>
                            <div class="flex items-center">
                                <input type="color" id="color_hex_${colorCounter}" name="colors[${colorCounter}][hex]" 
                                    class="h-10 w-10 border border-gray-300 rounded-md shadow-sm mr-2">
                                <input type="text" id="color_hex_text_${colorCounter}" 
                                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                    placeholder="#FF0000">
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h6 class="text-sm font-medium text-gray-700">Color Images</h6>
                            <div>
                                <input type="file" name="colors[${colorCounter}][images][]" data-color="${colorId}" multiple accept="image/*" class="hidden file-input">
                                <button type="button" class="text-primary hover:text-emerald-600 text-sm upload-images" data-color="${colorId}">
                                    <i class="fas fa-upload mr-1"></i> Upload Images
                                </button>
                            </div>
                        </div>
                        <div class="images-preview grid grid-cols-3 gap-2 mt-2" id="images_${colorId}"></div>
                    </div>
                </div>
            `;
            
            document.getElementById('colorsContainer').insertAdjacentHTML('beforeend', colorHtml);
            
            // Remove color button
            document.querySelector(`#${colorId} .remove-color`).addEventListener('click', function() {
                document.getElementById(colorId).remove();
            });
            
            // Color hex sync
            const colorHexInput = document.getElementById(`color_hex_${colorCounter}`);
            const colorHexTextInput = document.getElementById(`color_hex_text_${colorCounter}`);
            
            if (colorHexInput && colorHexTextInput) {
                colorHexInput.addEventListener('input', function() {
                    colorHexTextInput.value = this.value;
                });
                
                colorHexTextInput.addEventListener('input', function() {
                    if (this.value.match(/^#[0-9A-F]{6}$/i)) {
                        colorHexInput.value = this.value;
                    }
                });
            }
            
            // Upload images
            document.querySelector(`#${colorId} .upload-images`).addEventListener('click', function() {
                const colorId = this.getAttribute('data-color');
                document.querySelector(`input[data-color="${colorId}"]`).click();
            });
            
            document.querySelector(`input[data-color="${colorId}"]`).addEventListener('change', function() {
                const colorId = this.getAttribute('data-color');
                const previewContainer = document.getElementById(`images_${colorId}`);
                
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const imageId = `image_${colorId}_${Date.now()}_${i}`;
                        const imageHtml = `
                            <div class="relative">
                                <img src="${e.target.result}" alt="Preview" class="image-preview">
                                <button type="button" class="remove-btn remove-image" data-image="${imageId}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        previewContainer.insertAdjacentHTML('beforeend', imageHtml);
                        
                        document.querySelector(`[data-image="${imageId}"]`).addEventListener('click', function() {
                            this.closest('.relative').remove();
                        });
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
        
        if (addColorBtn) {
            addColorBtn.addEventListener('click', addColor);
        }
        addColor();
        
        // Size management
        let sizeCounter = 0;
        const addSizeBtn = document.getElementById('addSizeBtn');
        
        function addSize() {
            sizeCounter++;
            const sizeId = `size_${sizeCounter}`;
            
            const sizeHtml = `
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50" id="${sizeId}">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-medium text-gray-800">Size #${sizeCounter}</h4>
                        <button type="button" class="text-red-600 hover:text-red-800 remove-size">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="size_name_${sizeCounter}" class="block text-sm font-medium text-gray-700 mb-1">Size Name</label>
                            <input type="text" id="size_name_${sizeCounter}" name="sizes[${sizeCounter}][name]" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                placeholder="e.g., Small, Medium, Large">
                        </div>
                        <div>
                            <label for="price_${sizeCounter}" class="block text-sm font-medium text-gray-700 mb-1">Price (PKR)</label>
                            <input type="number" step="0.01" id="price_${sizeCounter}" name="sizes[${sizeCounter}][price]" min="0" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                placeholder="e.g., 1200">
                        </div>
                        <div>
                            <label for="stock_${sizeCounter}" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                            <input type="number" id="stock_${sizeCounter}" name="sizes[${sizeCounter}][stock]" min="0"
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary"
                                placeholder="e.g., 25">
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('sizesContainer').insertAdjacentHTML('beforeend', sizeHtml);
            
            document.querySelector(`#${sizeId} .remove-size`).addEventListener('click', function() {
                document.getElementById(sizeId).remove();
            });
        }
        
        if (addSizeBtn) {
            addSizeBtn.addEventListener('click', addSize);
        }
        addSize();
    });
</script>
@endpush