<!DOCTYPE html>
<html lang="ar" dir="rtl"
    style="width: 110mm; max-width:110mm; padding: 0;margin: 0;    box-sizing: border-box;">

<head>
    <!-- Meta Tags
        ==============================-->
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}" />
    <style>
        .bill .title {
            border: 1px solid #000;
            font-size: 14px;
            padding: 7px 5px;
            margin: 15px 0;
        }

        .bill .hint {
            border: 1px solid #000;
            color: #000;
        }

        .bill ul li span {
            border: 1px solid #000;
            margin-left: 5px;

        }

        .bill .price ul li span {
            color: #000;
            min-width: 48%;
            border: 1px solid #000;
        }

        .bill .hint p {
            font-size: 10px;
            line-height: 25px;
            margin: 0;
            color: #000;
        }

    </style>
</head>

<body
    style="width: 110mm; max-width:110mm;     overflow: visible;padding: 0;margin: 0;    box-sizing: border-box;">

    <div class="bill"
        style="width: 110mm;max-width:110mm; text-align: start;background-color: #fff;padding: 10px;margin: 0; border: 0;    box-sizing: border-box; color: #000;">
        <div class="info">
            <ul>
                <li class="w-100">
                    رقم الفاتورة
                    <span> # {{ $order->id }} </span>
                </li>
                <li class="w-100">
                    تاريخ الأستلام
                    <span> {{ $order->created_at->format('d-m-Y') }}</span>
                </li>
                <li class="w-100">
                    تاريخ التسليم
                    <span> {{ $order->working_days_count()->format('d-m-Y') }}</span>
                </li>
                <li class="w-100">
                    إسم الموظف
                    <span> {{ $order->employee_name }}</span>
                </li>
            </ul>
            <img style="filter: none;" src="{{ asset('public/images/logo_gray.png') }}" />
        </div>
        <div class="user">
            <div class="title">العميل</div>
            <ul>
                <li class="w-100">
                    الأسم
                    <span> {{ $order->client->name }} </span>
                </li>
                <li class="w-100">
                    تليفون
                    <span> {{ $order->client->phone }} </span>
                </li>

                <li class="w-100">
                    منطقة
                    <span> {{ $order->client->address }} </span>
                </li>

                <li>
                    بناية
                    <span> {{ $order->client->building }} </span>
                </li>
                <li>
                    طابق
                    <span> {{ $order->client->floor }} </span>
                </li>
                <li>
                    شقة
                    <span> {{ $order->client->apartment }} </span>
                </li>
               
            </ul>
        </div>
        <div class="items">
            <ul>
                <li style="
    border: 1px solid #000;
    font-size: 14px;
    padding: 5px;
    min-width: 96%;
    width: 96%;
">
                    
                    <span> الصنف (القسم)</span>
                    
                    <span> الخدمة </span>
                    
                    <span>السعر </span>
                    <span> الكمية </span>
                    <span> الإجمالى </span>
                </li>
                @foreach ($order->details as $detail)
                    <li>
                        
                       <span style="font-size: 16px;"> 
                            {{ $detail->item->name }}
                            @if($detail->item->category->id == 1)
                                (ر)
                            @elseif($detail->item->category->id == 2)
                                (ح)
                            @elseif($detail->item->category->id == 3)
                                (أ)
                            @elseif($detail->item->category->id == 5)
                                (م)
                            @else
                                (س)
                            @endif
                       </span> <!-- الصنف  -->
                       <span> {{ $detail->status }} </span> <!-- الخدمة  -->
                       <span> {{ $detail->price/$detail->quantity }}   </span> <!-- السعر -->
                       <span> {{ $detail->quantity }} </span> <!-- الكمية  -->
                       <span> {{ $detail->price }}  </span> <!-- الاجمالى -->
                       
                        <!--<span> {{ $detail->item->category->name }} </span>-->
                    </li>
                @endforeach
                <li style="
    border: 1px solid #000;
    font-size: 14px;
    padding: 5px;
    min-width: 96%;
    width: 96%;
"> عدد الأصناف <span> {{ $order->details()->count() }} </span></li>
            </ul>
        </div>
        <div class="info price">
            <ul>
                  <li class="w-100">
                    توصيل للمنزل
                    <span> {{ $order->delivery }} </span>
                </li>
                <li class="w-100">
                    خدمات إضافية
                    <span> {{ $order->service }} </span>
                </li>
                <li class="w-100">
                    إجمالى المبيعات
                    <span> {{ $order->total_before_item_discount() }} جنيه </span>
                </li>
                <li class="w-100">
                    خصم 
                    <span> {{ $order->total_discount() }} جنيه </span>
                </li>
                <li class="w-100">
                    الأجمالى
                    <span> {{ $order->total_price_after_discount() }} جنيه</span>
                </li>
            </ul>
            <div class="hint">
                <p>- لا تسلم الطلبات إلا مع إيصال الأستلام</p>
                <p>
                    - الشركة غير مسؤلة عن الملابس المصبوغة والألوان غير
                    الثابتة وعيوب الصناعة مالم يتم الأبلاغ عنها
                </p>
                <p>- الشركة غير مسؤلة عن البضاعه بعد شهر من إيداعها</p>
                <p>
                    - فى حالى الفقد لا يتجاوز التعويض 5 أمثال قيمة الخدمة
                </p>
                <p>
                    - الرقم الضريبي : 663-221-476 </p>
            </div>
        </div>
        <div class="w-100 text-center mt-25">
            <button class="link green_bc print_btn" onclick="window.print();"  style="font-family: sans-serif; font-size: 14px;">
                <span> طباعة الفاتورة </span>
            </button>
            <a href="{{ route('orders.show' , ['id' => $order->id]) }}" class="link blue_bc return_btn" >
                <span> العودة للخلف</span>
            </a>
        </div>
    </div>


    <!-- JS & Vendor Files
    ==========================================-->
    <script src="{{ asset('public/vendor/jquery/jquery.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="{{ asset('public/vendor/bootstrap/bootstrap.min.js') }}"></script>
</body>

</html>
