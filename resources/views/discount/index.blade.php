<!-- resources/views/discounts/index.blade.php -->
<form action="{{ route('discounts.store') }}" method="POST">
    @csrf
    <!-- Các trường cho việc tạo quy tắc giảm giá -->
    <button type="submit">Tạo Quy Tắc Giảm Giá</button>
</form>

@foreach($discountRules as $discountRule)
    <form action="{{ route('discounts.toggleStatus', $discountRule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit">{{ $discountRule->status === 'on' ? 'Tắt' : 'Bật' }}</button>
    </form>
@endforeach
