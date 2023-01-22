<div class="modal-content">
    <div class="modal-body text-center">
        <button class="icon_link" data-dismiss="modal">
            <i class="fa fa-times"></i>
        </button>
        <div class="modal_title">
            <i class="far fa-user"></i> تعديل بيانات العميل
        </div>
        <form method="put" action="{{ route('clients.update', ['id' => $client->id]) }}" class="ajax-form">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label> إسم العميل </label>
                        <input type="text" class="form-control" name="name" value="{{ $client->name }}" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label> العنوان </label>
                        <input type="text" class="form-control" name="address" value="{{ $client->address }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> رقم التليفون </label>
                        <input type="text" class="form-control" name="phone" value="{{ $client->phone }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> رقم المبنى </label>
                        <input type="text" class="form-control" value="{{ $client->building }}" name="building" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> الدور </label>
                        <input type="text" class="form-control" value="{{ $client->floor }}" name="floor" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> رقم الشقة </label>
                        <input type="text" class="form-control" value="{{ $client->apartment }}" name="apartment" />
                    </div>
                </div>
            </div>
            <button class="link" type="submit"><span> حفظ المعلومات </span></button>
        </form>
    </div>
</div>
