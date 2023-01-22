<div class="modal-content">
    <div class="modal-body text-center">
        <button class="icon_link" data-dismiss="modal">
            <i class="fa fa-times"></i>
        </button>
        <div class="modal_title">
            <i class="far fa-user"></i> تعديل بيانات المستخدم
        </div>
        <form class="ajax-form" method="put" action="{{ route('users.update', ['id' => $user->id]) }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> إسم المستخدم </label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> البريد الألكترونى </label>
                        <input type="email" class="form-control en" name="email" value="{{ $user->email }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> كلمة المرور </label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> الوظيفة </label>
                        <select class="form-control" name="role">
                            <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">مدير</option>
                            <option {{ $user->role == 'cachier' ? 'selected' : '' }} value="cachier">كاشير
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="link"><span> حفظ المعلومات </span></button>
        </form>
    </div>
</div>
