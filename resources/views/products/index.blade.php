<x-guest-layout>
    <h1>Products index</h1>

    @forelse ($products as $product)
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->type }}</p>
    @empty
        <p>No Products</p>
    @endforelse
</x-guest-layout>
