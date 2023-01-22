<!DOCTYPE html>
<html
  lang="ar"
  dir="rtl"
  style="
      padding: 0;
    margin: 0;
    text-align: center;
    box-sizing: border-box;
  "
>
  <head>
    <meta charset="utf-8" />
    <link   rel="stylesheet"   href="https://drcleanegypt.com/public/css/style.css"  />
    
        <style>
     .assets_bill {
        height: auto;
        text-align: start;
        background-color: #fff;
        margin: 0 auto;
        border: 0;
        box-sizing: border-box;
        color: #000;
        
      }
        .assets_bill ul{
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
            box-sizing: border-box;
            line-height: 20px;
        }
        .assets_bill .info{
                width: 4cm !important;
    height: 2.5cm !important;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            line-height: 0;
        }
   .asset_item {
    box-sizing: border-box;
     width: 4cm !important;
    height: 2.5cm !important;
      padding: 10px 0;
    display: block;
    margin: 12px auto;
    text-align: center;
    border: 1px solid #000;
}
      .asset_item li {
        margin: 0;
        width: 100%;
        overflow: hidden;
        font-size: 18px;
        line-height: 22px;
        font-weight: bolder;
        box-sizing: border-box;
        color: #000 !important;
      }
      .asset_item li span {
        border: 0;
        float: none;
        margin: 0 5px 0 0;
        padding: 0;
        line-height: 22px;
        font-size: 18px;
        color: #000!important;
      }
      .asset_item .title{
          font-size: 8px;
          margin: 0;
      }
      .link{
          display: block;
    padding: 0 5px;
    font-size: 12px;
    width: 80%;
    line-height: 35px;
    margin: auto auto 5px;
    font-family: sans-serif;
      }
      @media    print{
          .print_btn{
              display: none;
          }
      }
    </style>
  </head>

<body style="
      height: auto;
      overflow: visible;
      padding: 25px 0;
      margin: 0;
      box-sizing: border-box;
      background: #fff;
    font-family: sans-serif;font-weight: bolder;" class="TotalExt-Lang-en">
  @for ($i = 0; $i < $order->details()->sum('quantity'); $i++)
    <div class="assets_bill" >
      <div class="asset_item">
        <div class="info">
          <ul>
            <li class="w-100">
            الفاتورة  # {{ $order->id }} 
            </li>
            <li class="w-100">
            {{ $order->created_at->format('d-m-Y') }}
            </li>
              <li class="w-100">
           {{ $order->client->name }} 
            </li>
          </ul>
        </div>
      </div>
    </div>
    @endfor
    <div class="w-100 text-center mt-25 print_btn">
      <button class="link green_bc print_btn" onclick="window.print();">
        <span> طباعة ال assets </span>
      </button>
      <a class="link blue_bc widget_link" href="{{ url()->previous() }}">
        <span> الرجوع للخلف </span>
      </a>
    </div>

    <!-- JS & Vendor Files
    ==========================================-->
    <script src="https://drcleanegypt.com/dev/public/vendor/jquery/jquery.js"></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script src="https://drcleanegypt.com/dev/public/vendor/bootstrap/bootstrap.min.js"></script>
  </body>
</html>
