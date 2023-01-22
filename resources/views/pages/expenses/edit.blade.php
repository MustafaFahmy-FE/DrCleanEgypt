<div class="modal-content">
    <div class="modal-body text-center">
        <button class="icon_link" data-dismiss="modal">
            <i class="fa fa-times"></i>
        </button>
        <div class="modal_title">
            <i class="fa fa-info"></i> تعديل بيانات المصروف
        </div>
        <form class="ajax-form" method="put" action="{{ route('expenses.update', ['id' => $expense->id]) }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label> إسم المصروف </label>
                        <input type="text" class="form-control" name="name" value="{{ $expense->name }}" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label> نوع المصروف </label>
                        <select class="form-control" name="type">
                            <option value="0">إختر</option>
                            <option {{ $expense->type == 'مصروفات كهرباء' ? 'selected' : '' }} value="مصروفات كهرباء">مصروفات كهرباء</option>
                            <option {{ $expense->type == 'مصروفات عمومية' ? 'selected' : '' }} value="مصروفات عمومية">مصروفات عمومية</option>
                            <option {{ $expense->type == 'صيانة أجهزه' ? 'selected' : '' }} value="صيانة أجهزه">صيانة أجهزه</option>
                            <option {{ $expense->type == 'أجور ومرتبات' ? 'selected' : '' }} value="أجور ومرتبات">أجور ومرتبات</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label> إسم المصروف </label>
                        <input type="number" class="form-control" name="price" value="{{ $expense->price }}" />
                    </div>
                </div>
            </div>
            <button class="link"><span> حفظ المعلومات </span></button>
        </form>
    </div>
</div>
