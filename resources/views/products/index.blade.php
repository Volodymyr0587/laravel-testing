<x-guest-layout>

    <h1>Products index</h1>
    @auth
        @if (auth()->user()->is_admin)
            <a href="/products/create" class="text-blue-500 underline hover:font-bold">Create</a>
        @endif
    @endauth

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    NAME
                </th>
                <th scope="col" class="px-6 py-3">
                    TYPE
                </th>
                <th scope="col" class="px-6 py-3">
                    PRICE
                </th>
                <th scope="col" class="px-6 py-3">
                    ACTIONS
                </th>
            </tr>
        </thead>
        <tbody>

            @forelse ($products as $product)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th>{{ $product->name }}</th>
                <th>{{ $product->type }}</th>
                <th>{{ $product->price }}</th>
                @auth
                    <th>
                        <button>Buy Product</button>
                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 underline hover:font-bold">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 underline hover:font-bold">
                                Delete
                            </button>
                        </form>
                    </th>
                @endauth
            @empty
                <th>No Products</th>
            @endforelse

        </tbody>

    </table>

</x-guest-layout>
