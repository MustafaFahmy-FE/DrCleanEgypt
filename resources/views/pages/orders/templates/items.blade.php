<option value="0">إختر الصنف</option>
@foreach ($items as $item)
    <option value="{{ $item->id }}">{{ $item->name }}</option>
@endforeach
