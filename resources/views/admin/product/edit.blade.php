@extends("admin.layouts.master-layouts.plain")

<title>Edit Product | Grocery Store</title>

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
        border: none;
        outline: none;
    }
    .existing-image {
        position: relative;
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .gallery-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    .image-container {
        position: relative;
        display: inline-block;
        margin: 5px;
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
                    <h2 class="text-xl font-semibold text-gray-800">Edit Product</h2>
                    <nav class="text-sm text-gray-500">
                        <ol class="list-none p-0 inline-flex">
                            <li class="flex items-center">
                                <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                            </li>
                            <li class="flex items-center">
                                <a href="{{ route('admin.products') }}" class="text-gray-500 hover:text-primary">Products</a>
                                <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                            </li>
                            <li class="flex items-center">
                                <span class="text-gray-700">Edit Product</span>
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
            <form id="productForm" method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Product Details Section -->
                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Product Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                            <input type="text" id="product_name" name="product_name" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary"
                                value="{{ old('product_name', $product->name) }}">
                        </div>
                        
                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="category" name="category_id" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                            <input type="number" id="price" name="price" step="0.01" min="0" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary"
                                value="{{ old('price', $product->price) }}">
                        </div>

                        <div>
                            <label for="cut_price" class="block text-sm font-medium text-gray-700 mb-1">Cut Price ($)</label>
                            <input type="number" id="cut_price" name="cut_price" step="0.01" min="0" 
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary"
                                value="{{ old('cut_price', $product->cut_price) }}">
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <input type="number" id="rating" name="rating" step="0.01" max="5" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary"
                                value="{{ old('rating', $product->rating) }}">
                        </div>
                        
                        <!-- SKU -->
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                            <input type="text" id="sku" name="sku" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary"
                                value="{{ old('sku', $product->sku) }}">
                        </div>

                        <!-- Is Featured -->
                        <div class="flex items-center gap-3 mt-4">
                            <input
                                type="checkbox"
                                name="is_top_selling"
                                id="is_top_selling"
                                value="1"
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary"
                                {{ old('is_top_selling', $product->is_top_selling) ? 'checked' : '' }}
                            >
                            <label for="is_top_selling" class="text-sm font-medium text-gray-700">
                                Top Selling Product
                            </label>
                        </div>
                        
                        <!-- Description with CKEditor -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="15"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">{{ old('description', $product->description) }}</textarea>
                            <p class="text-sm text-gray-500 mt-2">Use the toolbar to format your product description with rich text, images, tables, and more.</p>
                        </div>
                        
                        <!-- Status -->
                        <div class="md:col-span-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="status" name="status" value="active" 
                                    {{ $product->status == 'active' ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="status" class="ml-2 block text-sm text-gray-700">Active Product</label>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Product Images Section -->
                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Product Images</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Default Image -->
                        <div>
                            <label for="default_image" class="block text-sm font-medium text-gray-700 mb-2">Default Image</label>
                            <p class="text-sm text-gray-500 mb-3">This will be the main product image displayed on listings</p>
                            <input type="file" id="default_image" name="default_image" accept="image/*"
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                            
                            <!-- Show existing default image with remove option -->
                            @if($product->defaultImage)
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Current Default Image:</p>
                                    <div class="image-container">
                                        <img src="{{ $product->defaultImage->image_path ? (Str::startsWith($product->defaultImage->image_path, 'http') ? $product->defaultImage->image_path : asset('storage/app/public/' . $product->defaultImage->image_path)) : '/placeholder-image.jpg' }}" 
                                             alt="Current product image" class="image-preview">
                                        <button type="button" class="remove-btn remove-existing-image" data-image-id="{{ $product->defaultImage->id }}" data-image-type="default">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="existing_default_image" value="{{ $product->defaultImage->id }}" id="existing_default_image">
                                </div>
                            @endif
                            
                            <div id="defaultImagePreview" class="mt-3 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">New Image Preview:</p>
                                <div class="image-container">
                                    <img src="" alt="Default image preview" class="image-preview">
                                    <button type="button" class="remove-btn remove-new-image" data-input="default_image">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gallery Images -->
                        <div>
                            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
                            <p class="text-sm text-gray-500 mb-3">Additional product images for gallery view</p>
                            <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                            
                            <!-- Show existing gallery images with remove options -->
                            @if($product->galleryImages && count($product->galleryImages) > 0)
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Current Gallery Images:</p>
                                    <div class="flex flex-wrap gap-2" id="existing-gallery-container">
                                        @foreach($product->galleryImages as $galleryImage)
                                            <div class="image-container">
                                                <img src="{{ $galleryImage->image_path ? (Str::startsWith($galleryImage->image_path, 'http') ? $galleryImage->image_path : asset('storage/app/public/' . $galleryImage->image_path)) : '/placeholder-image.jpg' }}" 
                                                     alt="Gallery image" class="image-preview">
                                                <button type="button" class="remove-btn remove-existing-image" data-image-id="{{ $galleryImage->id }}" data-image-type="gallery">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <input type="hidden" name="existing_gallery_images[]" value="{{ $galleryImage->id }}" class="existing-gallery-input">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <div id="galleryPreview" class="mt-3 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">New Images Preview:</p>
                                <div class="gallery-preview" id="galleryImagesContainer">
                                    <!-- New gallery image previews will be added here -->
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
                        <!-- Existing Colors -->
                        @if($product->colors && count($product->colors) > 0)
                            @foreach($product->colors as $index => $color)
                                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 color-section" id="color_{{ $color->id }}">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-md font-medium text-gray-800">Color: {{ $color->name }}</h4>
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-color" data-color-id="{{ $color->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <input type="hidden" name="colors[{{ $color->id }}][id]" value="{{ $color->id }}">
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="color_name_{{ $color->id }}" class="block text-sm font-medium text-gray-700 mb-1">Color Name</label>
                                            <input type="text" id="color_name_{{ $color->id }}" name="colors[{{ $color->id }}][name]" required
                                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                                placeholder="e.g., Red, Blue, Black"
                                                value="{{ $color->name }}">
                                        </div>
                                        <div>
                                            <label for="color_hex_{{ $color->id }}" class="block text-sm font-medium text-gray-700 mb-1">Color Hex Code</label>
                                            <div class="flex items-center">
                                                <input type="color" id="color_hex_{{ $color->id }}" name="colors[{{ $color->id }}][hex]" 
                                                    class="h-10 w-10 border border-gray-300 rounded-md shadow-sm mr-2"
                                                    value="{{ $color->hex_code }}">
                                                <input type="text" id="color_hex_text_{{ $color->id }}" 
                                                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                                    placeholder="#FF0000"
                                                    value="{{ $color->hex_code }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Color Images -->
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <h6 class="text-sm font-medium text-gray-700">Color Images</h6>
                                            <div>
                                                <input type="file" 
                                                       name="colors[{{ $color->id }}][images][]" 
                                                       data-color="{{ $color->id }}" 
                                                       multiple 
                                                       accept="image/*" 
                                                       class="hidden color-file-input">
                                                <button type="button" class="text-primary hover:text-emerald-600 text-sm upload-color-images" data-color="{{ $color->id }}">
                                                    <i class="fas fa-upload mr-1"></i> Upload Images
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Existing Color Images -->
                                        @if($color->images && count($color->images) > 0)
                                            <div class="mb-3">
                                                <p class="text-sm text-gray-600 mb-2">Existing Images:</p>
                                                <div class="flex flex-wrap gap-2 existing-color-images-container" id="existing_color_images_{{ $color->id }}">
                                                    @foreach($color->images as $image)
                                                        <div class="image-container">
                                                            <img src="{{ $image->image_path ? (Str::startsWith($image->image_path, 'http') ? $image->image_path : asset('storage/' . $image->image_path)) : '/placeholder-image.jpg' }}" 
                                                                 alt="Color image" class="image-preview">
                                                            <button type="button" class="remove-btn remove-existing-color-image" 
                                                                    data-image-id="{{ $image->id }}" 
                                                                    data-color-id="{{ $color->id }}">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                            <input type="hidden" name="colors[{{ $color->id }}][existing_images][]" value="{{ $image->id }}" class="existing-color-image-input">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- New Color Images Preview -->
                                        <div class="images-preview grid grid-cols-3 gap-2 mt-2" id="new_color_images_{{ $color->id }}">
                                            <!-- New image previews will be added here -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
                        <!-- Existing Sizes -->
                        @if($product->sizes && count($product->sizes) > 0)
                            @foreach($product->sizes as $index => $size)
                                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 size-section" id="size_{{ $size->id }}">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-md font-medium text-gray-800">Size: {{ $size->name }}</h4>
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-size" data-size-id="{{ $size->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <input type="hidden" name="sizes[{{ $size->id }}][id]" value="{{ $size->id }}">
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <!-- Size Name -->
                                        <div>
                                            <label for="size_name_{{ $size->id }}" class="block text-sm font-medium text-gray-700 mb-1">Size Name</label>
                                            <input type="text" id="size_name_{{ $size->id }}" name="sizes[{{ $size->id }}][name]" required
                                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                                placeholder="e.g., Small, Medium, Large"
                                                value="{{ $size->name }}">
                                        </div>

                                        <!-- Price -->
                                        <div>
                                            <label for="price_{{ $size->id }}" class="block text-sm font-medium text-gray-700 mb-1">Price (PKR)</label>
                                            <input type="number" step="0.01" id="price_{{ $size->id }}" name="sizes[{{ $size->id }}][price]" min="0" required
                                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                                placeholder="e.g., 1200"
                                                value="{{ $size->price }}">
                                        </div>

                                        <!-- Stock -->
                                        <div>
                                            <label for="stock_{{ $size->id }}" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                                            <input type="number" id="stock_{{ $size->id }}" name="sizes[{{ $size->id }}][stock]" min="0"
                                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary"
                                                placeholder="e.g., 25"
                                                value="{{ $size->stock }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </section>
                
                <!-- Hidden inputs for deleted items -->
                <input type="hidden" name="deleted_images" id="deleted_images" value="">
                <input type="hidden" name="deleted_colors" id="deleted_colors" value="">
                <input type="hidden" name="deleted_sizes" id="deleted_sizes" value="">
                
                <!-- Save Product Button -->
                <div class="fixed bottom-4 right-4 flex space-x-3">
                    <a href="{{ route('admin.products') }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl shadow-lg flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                    </a>
                    <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl shadow-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Product
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
                        'undo', 'redo',
                        '|',
                        'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript',
                        '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                        '|',
                        'heading',
                        '|',
                        'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify',
                        '|',
                        'bulletedList', 'numberedList', 'outdent', 'indent',
                        '|',
                        'link', 'insertTable',
                        '|',
                        'blockQuote', 'codeBlock',
                        '|',
                        'removeFormat', 'specialCharacters', 'horizontalLine',
                        '|',
                        'sourceEditing', 'selectAll',
                        '|',
                        'help'
                    ],
                    shouldNotGroupWhenFull: true
                },
                fontSize: {
                    options: [8, 9, 10, 11, 12, 14, 16, 18, 20, 22, 24, 26, 28, 36, 48, 72],
                    supportAllValues: true
                },
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontColor: {
                    colors: [
                        { color: '#000000', label: 'Black' },
                        { color: '#FF0000', label: 'Red' },
                        { color: '#00FF00', label: 'Green' },
                        { color: '#0000FF', label: 'Blue' },
                        { color: '#FFFF00', label: 'Yellow' },
                        { color: '#FF00FF', label: 'Magenta' },
                        { color: '#00FFFF', label: 'Cyan' }
                    ]
                },
                fontBackgroundColor: {
                    colors: [
                        { color: '#FFFFFF', label: 'White' },
                        { color: '#FFFF00', label: 'Yellow' },
                        { color: '#FFC0CB', label: 'Pink' },
                        { color: '#90EE90', label: 'Light Green' }
                    ]
                },
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
                alignment: {
                    options: ['left', 'center', 'right', 'justify']
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                placeholder: 'Write your product description here...',
                language: 'en',
                removePlugins: [],
                initialData: `{{ old('description', $product->description) }}`
            })
            .then(editor => {
                console.log('CKEditor initialized successfully');
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
        
        // Arrays to track deleted items
        let deletedImages = [];
        let deletedColors = [];
        let deletedSizes = [];

        // Default image preview
        const defaultImageInput = document.getElementById('default_image');
        const defaultImagePreview = document.getElementById('defaultImagePreview');
        const defaultImagePreviewImg = defaultImagePreview.querySelector('img');
        
        if (defaultImageInput) {
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
        const galleryPreview = document.getElementById('galleryPreview');
        const galleryImagesContainer = document.getElementById('galleryImagesContainer');
        
        if (galleryImagesInput) {
            galleryImagesInput.addEventListener('change', function() {
                // Clear previous previews
                galleryImagesContainer.innerHTML = '';
                
                if (this.files && this.files.length > 0) {
                    for (let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const imageId = `gallery_image_${Date.now()}_${i}`;
                            const imageHtml = `
                                <div class="image-container">
                                    <img src="${e.target.result}" alt="Gallery preview" class="image-preview">
                                    <button type="button" class="remove-btn remove-new-gallery-image" data-file-index="${i}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `;
                            
                            galleryImagesContainer.insertAdjacentHTML('beforeend', imageHtml);
                        }
                        
                        reader.readAsDataURL(file);
                    }
                    
                    galleryPreview.classList.remove('hidden');
                } else {
                    galleryPreview.classList.add('hidden');
                }
            });
        }

        // Remove existing image
        document.addEventListener('click', function(e) {
            // Remove existing images (default and gallery)
            if (e.target.classList.contains('remove-existing-image') || e.target.closest('.remove-existing-image')) {
                const button = e.target.classList.contains('remove-existing-image') ? e.target : e.target.closest('.remove-existing-image');
                const imageId = button.getAttribute('data-image-id');
                const imageType = button.getAttribute('data-image-type');
                
                // Add to deleted images array
                deletedImages.push(imageId);
                document.getElementById('deleted_images').value = JSON.stringify(deletedImages);
                
                // Remove the image container
                const imageContainer = button.closest('.image-container');
                if (imageContainer) {
                    imageContainer.remove();
                }
                
                // If it's the default image, also remove the hidden input
                if (imageType === 'default') {
                    const existingDefaultInput = document.getElementById('existing_default_image');
                    if (existingDefaultInput) {
                        existingDefaultInput.remove();
                    }
                }
            }

            // Remove new default image
            if (e.target.classList.contains('remove-new-image') || e.target.closest('.remove-new-image')) {
                const button = e.target.classList.contains('remove-new-image') ? e.target : e.target.closest('.remove-new-image');
                const inputId = button.getAttribute('data-input');
                
                // Clear the file input
                document.getElementById(inputId).value = '';
                
                // Hide the preview
                defaultImagePreview.classList.add('hidden');
            }

            // Remove new gallery image
            if (e.target.classList.contains('remove-new-gallery-image') || e.target.closest('.remove-new-gallery-image')) {
                const button = e.target.classList.contains('remove-new-gallery-image') ? e.target : e.target.closest('.remove-new-gallery-image');
                const fileIndex = button.getAttribute('data-file-index');
                
                // Remove the image container
                const imageContainer = button.closest('.image-container');
                if (imageContainer) {
                    imageContainer.remove();
                }
            }

            // Remove existing color image
            if (e.target.classList.contains('remove-existing-color-image') || e.target.closest('.remove-existing-color-image')) {
                const button = e.target.classList.contains('remove-existing-color-image') ? e.target : e.target.closest('.remove-existing-color-image');
                const imageId = button.getAttribute('data-image-id');
                const colorId = button.getAttribute('data-color-id');
                
                // Add to deleted images array
                deletedImages.push(imageId);
                document.getElementById('deleted_images').value = JSON.stringify(deletedImages);
                
                // Remove the image container
                const imageContainer = button.closest('.image-container');
                if (imageContainer) {
                    imageContainer.remove();
                }
            }

            // Remove color
            if (e.target.classList.contains('remove-color') || e.target.closest('.remove-color')) {
                const button = e.target.classList.contains('remove-color') ? e.target : e.target.closest('.remove-color');
                const colorId = button.getAttribute('data-color-id');
                
                // Add to deleted colors array
                deletedColors.push(colorId);
                document.getElementById('deleted_colors').value = JSON.stringify(deletedColors);
                
                // Remove the color section
                const colorSection = document.getElementById(`color_${colorId}`);
                if (colorSection) {
                    colorSection.remove();
                }
            }

            // Remove size
            if (e.target.classList.contains('remove-size') || e.target.closest('.remove-size')) {
                const button = e.target.classList.contains('remove-size') ? e.target : e.target.closest('.remove-size');
                const sizeId = button.getAttribute('data-size-id');
                
                // Add to deleted sizes array
                deletedSizes.push(sizeId);
                document.getElementById('deleted_sizes').value = JSON.stringify(deletedSizes);
                
                // Remove the size section
                const sizeSection = document.getElementById(`size_${sizeId}`);
                if (sizeSection) {
                    sizeSection.remove();
                }
            }
        });
        
        // Color counter for new colors
        let newColorCounter = {{ $product->colors ? count($product->colors) : 0 }};
        
        // Add color button
        const addColorBtn = document.getElementById('addColorBtn');
        if (addColorBtn) {
            addColorBtn.addEventListener('click', function() {
                addNewColor();
            });
        }
        
        // Function to add a new color (not existing in database)
        function addNewColor() {
            newColorCounter++;
            const colorId = `new_color_${newColorCounter}`;
            
            const colorHtml = `
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 color-section" id="${colorId}">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-medium text-gray-800">New Color #${newColorCounter}</h4>
                        <button type="button" class="text-red-600 hover:text-red-800 remove-new-color" data-color-id="${colorId}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="color_name_${colorId}" class="block text-sm font-medium text-gray-700 mb-1">Color Name</label>
                            <input type="text" id="color_name_${colorId}" name="new_colors[${newColorCounter}][name]" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                placeholder="e.g., Red, Blue, Black">
                        </div>
                        <div>
                            <label for="color_hex_${colorId}" class="block text-sm font-medium text-gray-700 mb-1">Color Hex Code</label>
                            <div class="flex items-center">
                                <input type="color" id="color_hex_${colorId}" name="new_colors[${newColorCounter}][hex]" 
                                    class="h-10 w-10 border border-gray-300 rounded-md shadow-sm mr-2" value="#FF0000">
                                <input type="text" id="color_hex_text_${colorId}" 
                                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                    placeholder="#FF0000" value="#FF0000">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Images Section -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h6 class="text-sm font-medium text-gray-700">Color Images</h6>
                            <div>
                                <input type="file" 
                                       name="new_colors[${newColorCounter}][images][]" 
                                       data-color="${colorId}" 
                                       multiple 
                                       accept="image/*" 
                                       class="hidden color-file-input">
                                <button type="button" class="text-primary hover:text-emerald-600 text-sm upload-color-images" data-color="${colorId}">
                                    <i class="fas fa-upload mr-1"></i> Upload Images
                                </button>
                            </div>
                        </div>
                        
                        <div class="images-preview grid grid-cols-3 gap-2 mt-2" id="new_color_images_${colorId}">
                            <!-- Image previews will be added here -->
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('colorsContainer').insertAdjacentHTML('beforeend', colorHtml);
            
            // Initialize color picker for new color
            const colorHexInput = document.getElementById(`color_hex_${colorId}`);
            const colorHexTextInput = document.getElementById(`color_hex_text_${colorId}`);
            
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
            
            // Add event listener for the upload images button
            document.querySelector(`#${colorId} .upload-color-images`).addEventListener('click', function() {
                const colorId = this.getAttribute('data-color');
                document.querySelector(`input[data-color="${colorId}"]`).click();
            });
            
            // Add event listener for the file input change
            document.querySelector(`input[data-color="${colorId}"]`).addEventListener('change', function() {
                const colorId = this.getAttribute('data-color');
                const previewContainer = document.getElementById(`new_color_images_${colorId}`);
                
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const imageId = `image_${colorId}_${Date.now()}_${i}`;
                        const imageHtml = `
                            <div class="image-container">
                                <img src="${e.target.result}" alt="Preview" class="image-preview">
                                <button type="button" class="remove-btn remove-new-color-image" data-color="${colorId}" data-file-index="${i}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        
                        previewContainer.insertAdjacentHTML('beforeend', imageHtml);
                    }
                    
                    reader.readAsDataURL(file);
                }
            });

            // Add event listener for removing new color
            document.querySelector(`#${colorId} .remove-new-color`).addEventListener('click', function() {
                const colorId = this.getAttribute('data-color-id');
                const colorSection = document.getElementById(colorId);
                if (colorSection) {
                    colorSection.remove();
                }
            });
        }
        
        // Initialize size counter for new sizes
        let newSizeCounter = {{ $product->sizes ? count($product->sizes) : 0 }};
        
        // Add size button
        const addSizeBtn = document.getElementById('addSizeBtn');
        if (addSizeBtn) {
            addSizeBtn.addEventListener('click', function() {
                addNewSize();
            });
        }
        
        // Function to add a new size (not existing in database)
        function addNewSize() {
            newSizeCounter++;
            const sizeId = `new_size_${newSizeCounter}`;
            
            const sizeHtml = `
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 size-section" id="${sizeId}">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-medium text-gray-800">New Size #${newSizeCounter}</h4>
                        <button type="button" class="text-red-600 hover:text-red-800 remove-new-size" data-size-id="${sizeId}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Size Name -->
                        <div>
                            <label for="size_name_${sizeId}" class="block text-sm font-medium text-gray-700 mb-1">Size Name</label>
                            <input type="text" id="size_name_${sizeId}" name="new_sizes[${newSizeCounter}][name]" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                placeholder="e.g., Small, Medium, Large">
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price_${sizeId}" class="block text-sm font-medium text-gray-700 mb-1">Price (PKR)</label>
                            <input type="number" step="0.01" id="price_${sizeId}" name="new_sizes[${newSizeCounter}][price]" min="0" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary" 
                                placeholder="e.g., 1200">
                        </div>

                        <!-- Stock -->
                        <div>
                            <label for="stock_${sizeId}" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                            <input type="number" id="stock_${sizeId}" name="new_sizes[${newSizeCounter}][stock]" min="0"
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary"
                                placeholder="e.g., 25">
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('sizesContainer').insertAdjacentHTML('beforeend', sizeHtml);

            // Add event listener for removing new size
            document.querySelector(`#${sizeId} .remove-new-size`).addEventListener('click', function() {
                const sizeId = this.getAttribute('data-size-id');
                const sizeSection = document.getElementById(sizeId);
                if (sizeSection) {
                    sizeSection.remove();
                }
            });
        }
        
        // Initialize color pickers for existing colors
        document.querySelectorAll('input[type="color"]').forEach(colorInput => {
            const id = colorInput.id;
            if (id.startsWith('color_hex_')) {
                const textInputId = id.replace('color_hex_', 'color_hex_text_');
                const textInput = document.getElementById(textInputId);
                
                if (textInput) {
                    colorInput.addEventListener('input', function() {
                        textInput.value = this.value;
                    });
                    
                    textInput.addEventListener('input', function() {
                        if (this.value.match(/^#[0-9A-F]{6}$/i)) {
                            colorInput.value = this.value;
                        }
                    });
                }
            }
        });
        
        // Initialize file inputs for existing colors
        document.querySelectorAll('.color-file-input').forEach(fileInput => {
            fileInput.addEventListener('change', function() {
                const colorId = this.getAttribute('data-color');
                const previewContainer = document.getElementById(`new_color_images_${colorId}`);
                
                if (previewContainer) {
                    for (let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const imageId = `image_${colorId}_${Date.now()}_${i}`;
                            const imageHtml = `
                                <div class="image-container">
                                    <img src="${e.target.result}" alt="Preview" class="image-preview">
                                    <button type="button" class="remove-btn remove-new-color-image" data-color="${colorId}" data-file-index="${i}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `;
                            
                            previewContainer.insertAdjacentHTML('beforeend', imageHtml);
                        }
                        
                        reader.readAsDataURL(file);
                    }
                }
            });
        });

        // Initialize upload buttons for existing colors
        document.querySelectorAll('.upload-color-images').forEach(button => {
            button.addEventListener('click', function() {
                const colorId = this.getAttribute('data-color');
                const fileInput = document.querySelector(`input[data-color="${colorId}"]`);
                if (fileInput) {
                    fileInput.click();
                }
            });
        });
    });
</script>
@endpush