<div class="col-sm-6">
    <div class="data_item">
        <i class="fa fa-info"></i>
        إسم العميل
        <span> {{ $client->name }} </span>
    </div>
</div>
<div class="col-sm-6">
    <div class="data_item">
        <i class="fa fa-phone"></i>
        رقم الهاتف
        <span class="en"> {{ $client->phone }} </span>
    </div>
</div>
<div class="col-sm-12">
    <div class="data_item">
        <i class="fa fa-map-marker-alt"></i>
        العنوان
        <span>
            {{ $client->address }}
        </span>
        <span> بلوك {{ $client->building }} - الدور {{ $client->floor }} - شقة {{ $client->apartment }} </span>
    </div>
</div>
