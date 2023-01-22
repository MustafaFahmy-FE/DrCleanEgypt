<div class="modal-content">
    <div class="modal-body text-center">
        <button class="icon_link" data-dismiss="modal">
            <i class="fa fa-times"></i>
        </button>
        <div class="modal_title">
            <i class="far fa-bookmark"></i> تعديل بيانات الصنف
        </div>
        <form method="put" action="{{ route('items.update', ['id' => $item->id]) }}" class="ajax-form">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> القسم </label>
                        <select class="form-control" name="category_id">
                            <option value="0">إختر القسم</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $item->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> إسم الصنف </label>
                        <input type="text" class="form-control" name="name" value="{{ $item->name }}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> سعر الغسيل </label>
                        <input type="text" class="form-control" name="laundry_price"
                            value="{{ $item->laundry_price }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> سعر الكي </label>
                        <input type="text" class="form-control" name="ironing_price"
                            value="{{ $item->ironing_price }}" />
                    </div>
                </div>
            </div>
            <button class="link"><span> حفظ المعلومات </span></button>
        </form>
    </div>
</div>
