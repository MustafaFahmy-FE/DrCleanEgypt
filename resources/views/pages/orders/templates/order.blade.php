<div class="col-lg-4 col-md-4 col-sm-6" id="order-item">
    <div class="data_item cust">
        {{ $item->name }}
        <span> العدد : {{ $quantity }} </span>
        <span> النوع : {{$status}} </span>
        <span>  السعر : {{ $price }} </span>
        <a class="fas fa-times icon_link delete-button" data-id="{{ $item->id }}" title="حذف الصنف"></a>
    </div>

</div>
