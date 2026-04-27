@extends("admin.layouts.master-layouts.plain")

<title>Add Product | Footwear Premium</title>

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
    .variant-card {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 0.5rem;
    }
    .color-dot {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid #e5e7eb;
    }
</style>
@endpush

@section("content")
<div class="flex h-screen overflow-hidden">
    <button @click="sidebarOpen = true" 
        class="fixed top-4 left-4 z-40 p-2 bg-gray-900 text-white rounded-md lg:hidden">
        <i class="fas fa-bars"></i>
    </button>

    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>

    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transform transition-transform duration-300 lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-cloak
    >
        @include("admin.layouts.partial.sidebar")
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden lg:ml-64 bg-gray-50">
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
                                <a href="{{ route('admin.products') }}" class="text-gray-500 hover:text-primary">Products</a>
                                <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                            </li>
                            <li class="flex items-center">
                                <span class="text-gray-700">Add Product</span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6">
            <form id="productForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf

                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                            <input type="text" id="product_name" name="product_name" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                        
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                            <select id="category" name="category_id" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Base Price (PKR) *</label>
                            <input type="number" id="price" name="price" step="0.01" min="0" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label for="cut_price" class="block text-sm font-medium text-gray-700 mb-1">Compare Price (PKR)</label>
                            <input type="number" id="cut_price" name="cut_price" step="0.01" min="0"
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                            <input type="text" id="sku" name="sku"
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating (0-5)</label>
                            <input type="number" id="rating" name="rating" step="0.1" min="0" max="5" value="0"
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="is_top_selling" id="is_top_selling" value="1"
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                            <label for="is_top_selling" class="text-sm font-medium text-gray-700">Top Selling</label>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <input type="checkbox" id="status" name="status" value="active" checked
                                class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="status" class="ml-2 block text-sm text-gray-700">Active Product</label>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="6"
                            class="w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"></textarea>
                    </div>
                </section>

                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Product Images</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="default_image" class="block text-sm font-medium text-gray-700 mb-2">Default Image *</label>
                            <input type="file" id="default_image" name="default_image" accept="image/*" required
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                        
                        <div>
                            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
                            <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple
                                class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Colors</h3>
                        <button type="button" onclick="addColor()" 
                            class="bg-primary hover:bg-emerald-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Color
                        </button>
                    </div>
                    
                    <div id="colorsContainer" class="space-y-4">
                        <p class="text-sm text-gray-500">No colors added yet. Click "Add Color" to add product colors.</p>
                    </div>
                </section>

                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Sizes</h3>
                        <button type="button" onclick="addSize()" 
                            class="bg-primary hover:bg-emerald-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Size
                        </button>
                    </div>
                    
                    <div id="sizesContainer" class="space-y-4">
                        <p class="text-sm text-gray-500">No sizes added yet. Click "Add Size" to add product sizes.</p>
                    </div>
                </section>

                <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Variant Stock (Optional)</h3>
                    <p class="text-sm text-gray-500 mb-4">Set specific stock for each color/size combination. If not set, stock will be managed automatically.</p>
                    
                    <div id="variantsInfo" class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600">Add colors and sizes above to see variants here.</p>
                    </div>
                </section>

                <div class="fixed bottom-4 right-4 flex space-x-3">
                    <a href="{{ route('admin.products') }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl shadow-lg flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Back
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
    let colorCounter = 0;
    let sizeCounter = 0;
    let colors = [];
    let sizes = [];

    function addColor() {
        colorCounter++;
        const colorHtml = `
            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50" id="color_${colorCounter}">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-medium text-gray-700">Color #${colorCounter}</span>
                    <button type="button" onclick="removeColor(${colorCounter})" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Color Name</label>
                        <input type="text" name="colors[${colorCounter}][name]" required placeholder="e.g., Black, White, Red"
                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hex Code</label>
                        <div class="flex items-center gap-2">
                            <input type="color" id="color_hex_${colorCounter}" class="h-10 w-10 border border-gray-300 rounded-md" value="#000000">
                            <input type="text" name="colors[${colorCounter}][hex]" id="color_hex_text_${colorCounter}" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3" placeholder="#000000" value="#000000">
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('colorsContainer').insertAdjacentHTML('beforeend', colorHtml);
        
        const colorHexInput = document.getElementById(`color_hex_${colorCounter}`);
        const colorHexTextInput = document.getElementById(`color_hex_text_${colorCounter}`);
        colorHexInput.addEventListener('input', () => {
            colorHexTextInput.value = colorHexInput.value;
        });
        
        colors.push(colorCounter);
        updateVariantsDisplay();
    }

    function removeColor(id) {
        document.getElementById(`color_${id}`)?.remove();
        colors = colors.filter(c => c !== id);
        updateVariantsDisplay();
    }

    function addSize() {
        sizeCounter++;
        const sizeHtml = `
            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50" id="size_${sizeCounter}">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-medium text-gray-700">Size #${sizeCounter}</span>
                    <button type="button" onclick="removeSize(${sizeCounter})" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Size Code</label>
                        <input type="text" name="sizes[${sizeCounter}][name]" required placeholder="e.g., S, M, L, 40, 42"
                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Display Name</label>
                        <input type="text" name="sizes[${sizeCounter}][display_name]" placeholder="e.g., Small, Medium, Large"
                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                    </div>
                </div>
            </div>
        `;
        document.getElementById('sizesContainer').insertAdjacentHTML('beforeend', sizeHtml);
        
        sizes.push(sizeCounter);
        updateVariantsDisplay();
    }

    function removeSize(id) {
        document.getElementById(`size_${id}`)?.remove();
        sizes = sizes.filter(s => s !== id);
        updateVariantsDisplay();
    }

    function updateVariantsDisplay() {
        const container = document.getElementById('variantsInfo');
        
        if (colors.length === 0 || sizes.length === 0) {
            if (colors.length === 0 && sizes.length === 0) {
                container.innerHTML = '<p class="text-sm text-gray-600">Add colors and sizes above to see variants here.</p>';
            } else if (colors.length === 0) {
                container.innerHTML = '<p class="text-sm text-gray-600">Add colors to generate variants.</p>';
            } else {
                container.innerHTML = '<p class="text-sm text-gray-600">Add sizes to generate variants.</p>';
            }
            return;
        }

        let html = '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">';
        colors.forEach(colorId => {
            const colorEl = document.querySelector(`input[name="colors[${colorId}][name]"]`);
            const colorName = colorEl?.value || `Color ${colorId}`;
            
            sizes.forEach(sizeId => {
                const sizeEl = document.querySelector(`input[name="sizes[${sizeId}][name]"]`);
                const sizeName = sizeEl?.value || `Size ${sizeId}`;
                const variantId = `variant_${colorId}_${sizeId}`;
                
                html += `
                    <div class="variant-card">
                        <p class="text-sm font-medium text-gray-800">${colorName} - ${sizeName}</p>
                        <div class="mt-2">
                            <input type="hidden" name="variants[${variantId}][color_id]" value="${colorId}">
                            <input type="hidden" name="variants[${variantId}][size_id]" value="${sizeId}">
                            <input type="number" name="variants[${variantId}][stock]" placeholder="Stock" min="0" value="0"
                                class="w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 text-sm">
                        </div>
                    </div>
                `;
            });
        });
        html += '</div>';
        container.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: ['bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link'],
                placeholder: 'Write product description here...'
            })
            .catch(error => console.error('CKEditor error:', error));
    });
</script>
@endpush