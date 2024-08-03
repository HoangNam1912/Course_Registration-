<form action="{{ route('product.update', ['id' => $product['id']]) }}" method="POST">
    @csrf
    @method('PUT')

    <h3>Product Information</h3>
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $product['title'] }}">
    </div>
    <div>
        <label for="body_html">Description:</label>
        <textarea id="body_html" name="body_html">{{ $product['body_html'] }}</textarea>
    </div>

    <h3>Variants</h3>
    @foreach ($product['variants'] as $variant)
        <div>
            <h4>Variant {{ $variant['id'] }}</h4>
            <label for="price_{{ $variant['id'] }}">Price:</label>
            <input type="text" id="price_{{ $variant['id'] }}" name="variants[{{ $variant['id'] }}][price]" value="{{ $variant['price'] }}">
            <label for="compare_at_price_{{ $variant['id'] }}">Compare at Price:</label>
            <input type="text" id="compare_at_price_{{ $variant['id'] }}" name="variants[{{ $variant['id'] }}][compare_at_price]" value="{{ $variant['compare_at_price'] }}">
            <label for="inventory_quantity_{{ $variant['id'] }}">Inventory Quantity:</label>
            <input type="text" id="inventory_quantity_{{ $variant['id'] }}" name="variants[{{ $variant['id'] }}][inventory_quantity]" value="{{ $variant['inventory_quantity'] }}">
        </div>
    @endforeach

    <h3>Discount Information</h3>
    <div>
        <label for="discount_type">Discount Type:</label>
        <select id="discount_type" name="discount_type">
            <option value="percentage">Percentage</option>
            <option value="fixed_amount">Fixed Amount</option>
        </select>
    </div>
    <div>
        <label for="discount_value">Discount Value:</label>
        <input type="text" id="discount_value" name="discount_value">
    </div>

    <h3>Apply to Collections</h3>
    <div>
        <label for="collections">Collections:</label>
        <select id="collections" name="collections[]" multiple>
            @foreach ($collections as $collection)
                <option value="{{ $collection['id'] }}">{{ $collection['title'] }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Update Product</button>
</form>