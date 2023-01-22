<div class="modal-content">
    <div class="modal-body text-center">
        <button class="icon_link" data-dismiss="modal">
            <i class="fa fa-times"></i>
        </button>
        <div class="modal_title">
            <i class="fa fa-info"></i> تعديل بيانات القسم
        </div>
        <form class="ajax-form" method="put" action="{{ route('categories.update', ['id' => $category->id]) }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label> إسم القسم </label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}" />
                    </div>
                </div>
            </div>
            <button class="link"><span> حفظ المعلومات </span></button>
        </form>
    </div>
</div>
