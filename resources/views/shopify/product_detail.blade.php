<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('product.update', ['id' => $product['id']]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $product['title']) }}" required>
        </div>

      

        <h3>Variants</h3>
        @foreach ($product['variants'] as $variant)
            <div class="variant-group">
                <h4>Variant {{ $variant['id'] }}</h4>
                <div class="form-group">
                    <label for="price_{{ $variant['id'] }}">Price:</label>
                    <input type="text" id="price_{{ $variant['id'] }}" name="variants[{{ $variant['id'] }}][price]" value="{{ old('variants.' . $variant['id'] . '.price', $variant['price']) }}" required>
                </div>
                <div class="form-group">
                    <label for="compare_at_price_{{ $variant['id'] }}">Compare at Price:</label>
                    <input type="text" id="compare_at_price_{{ $variant['id'] }}" name="variants[{{ $variant['id'] }}][compare_at_price]" value="{{ old('variants.' . $variant['id'] . '.compare_at_price', $variant['compare_at_price']) }}">
                </div>
                <div class="form-group">
                    <label for="inventory_quantity_{{ $variant['id'] }}">Inventory Quantity:</label>
                    <input type="text" id="inventory_quantity_{{ $variant['id'] }}" name="variants[{{ $variant['id'] }}][inventory_quantity]" value="{{ old('variants.' . $variant['id'] . '.inventory_quantity', $variant['inventory_quantity']) }}" required>
                </div>
            </div>
        @endforeach

        <h3>Discount Information</h3>
        <div class="form-group">
            <label for="discount_type">Discount Type:</label>
            <select id="discount_type" name="discount_type" required>
                <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                <option value="fixed_amount" {{ old('discount_type') == 'fixed_amount' ? 'selected' : '' }}>Fixed Amount</option>
            </select>
        </div>
        <div class="form-group">
            <label for="discount_value">Discount Value:</label>
            <input type="text" id="discount_value" name="discount_value" value="{{ old('discount_value') }}" required>
        </div>

        <h3>Apply to Collections</h3>
        <div class="form-group">
            <label for="collections">Collections:</label>
            <select id="collections" name="collections[]" multiple>
                @foreach ($collections as $collection)
                    <option value="{{ $collection['id'] }}" {{ in_array($collection['id'], old('collections', [])) ? 'selected' : '' }}>{{ $collection['title'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit">Update Product</button>
        </div>
    </form>
</body>
</html>
