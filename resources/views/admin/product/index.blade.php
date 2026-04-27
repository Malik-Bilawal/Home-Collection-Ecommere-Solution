@extends("admin.layouts.master-layouts.plain")

<title>Product Management | Footwear Premium</title>

@push("script")
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
        <!-- Top Bar -->
        <header class="bg-white shadow-sm z-10">
                <div class="flex justify-between items-center p-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Product Management</h2>
                        <nav class="text-sm text-gray-500">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                                    <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                </li>
                                <li class="flex items-center">
                                    <span class="text-gray-700">Product Management</span>
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
            <section class="px-6 py-4 bg-white shadow-sm mt-1">
    <form method="GET" action="{{ route('admin.products') }}">
        <div class="flex flex-wrap items-center gap-4">

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="border rounded-md px-3 py-2 text-sm w-40">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" id="categoryFilter" class="border rounded-md px-3 py-2 text-sm w-40">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Subcategory Filter -->
   

            <!-- Apply Filters -->
            <div class="flex items-end">
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Apply Filters
                </button>
            </div>

            <!-- Reset Filters -->
            <a href="{{ route('admin.products') }}" 
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                Reset
            </a>

            <!-- Add Product Button -->
            <a href="{{ route('admin.products.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                + Add Product
            </a>

        </div>
    </form>
</section>



        <!-- Product Table -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $index => $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                        
                        <!-- Product Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                    @if($product->default_image)
                                        <img src="{{ $product->default_image }}" class="w-10 h-10 object-cover rounded-lg" alt="{{ $product->name }}">
                                    @else
                                        <i class="fas fa-box text-gray-600"></i>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $product->subcategory?->name ?? $product->category?->name ?? '-' }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Category Column -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->subcategory?->name ?? $product->category?->name ?? '-' }}
                        </td>

                        <!-- Price Column -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                            @if($product->allVariants->count() > 0)
                                Rs. {{ number_format($product->price, 2) }}
                            @else
                                Rs. {{ number_format($product->price, 2) }}
                            @endif
                        </td>

                        <!-- Stock Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $product->total_stock }}
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                @php
                                    $stockPercent = $product->total_stock > 0 ? min(100, ($product->total_stock / 100) * 100) : 0;
                                @endphp
                                <div class="bg-green-600 h-1.5 rounded-full" style="width: {{ $stockPercent }}%"></div>
                            </div>
                        </td>

                        <!-- Created At Column -->

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
    {{ optional($product->created_at)->format('Y-m-d') ?? 'N/A' }}
</td>

                        <!-- Actions Column -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $products->links() }}
        </div>
    </div>
</div>

    </div>

    <!-- Pagination -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        {{ $products->links() }} 
    </div>
</div>

            </main>
        </div>
    </div>

        </div>

@endsection


@push("script")
@endpush