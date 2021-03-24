@extends('customer.layouts.template')
@section('title')
Home    
@endsection
@section('content')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>

    @if(session('sukses_peesan'))
    <div class="alert alert-success">
        {{session('sukses_pesan')}}
    </div>
    @endif
    
    <!--non product-->
    <div style="background:#ffff">
        <img src="{{ asset('assets/image/dot-topproduct.png') }}" class="dot-content-top-right" style="" alt="dot-topproduct">
        <img src="{{ asset('assets/image/shape-content.jpg') }}" class="shape-content-bottom-right" style="" alt="shape-content">
        <img src="{{ asset('assets/image/dot-bottom-left-content.jpg') }}" class="dot-content-bottom-left" style="" alt="dot-bottom-left-content">
        <div class="container mb-n4" style="">
            <div class="row">
                <div class="col-8">
                    <nav aria-label="breadcrumb" class="" >
                        <ol class="breadcrumb pt-4 mt-3" style="background-color:#fff !important;">
                            <h2 class="breadcrumb-item">Our</h2>
                            <h2 class="breadcrumb-item active" aria-current="page">Product</h2>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 ">
                    <div id="dropfilter" class="dropdown pt-4 mt-3 float-right">
                        <button class="btn filter_category" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Filter</b>
                            <i class="fas fa-caret-down fa-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto;max-height: 200px;overflow-x: hidden; border-bottom-left-radius:1rem;border-bottom-right-radius:1rem;">
                            <a class="dropdown-item" href="{{ url('/') }}" style="color: #1A4066;"><b>Semua Produk</b></a>
                            @foreach($categories as $key => $value)
                                <a class="dropdown-item" href="{{route('home_customer', ['cat'=>$value->id] )}}" style="color: #000;"><b>{{$value->name}}</b></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container list-product" style="">
            <div class="row mt-0">
                <div class="col-md-12 mt-4">
                    <div class="row section_content">
                    @foreach($product as $key => $value)
                        <div id="product_list"  class="col-6 col-md-4 d-flex mx-0" style="z-index: 1">
                            <div class="card mx-auto d-flex item_product">
                                <a class="" data-toggle="modal" href="#modalGroup{{$value->id}}">
                                    <img style="" src="{{ asset('storage/'.(($value->group_image!='') ? $value->group_image : '20200621_184223_0016.jpg').'') }}" class="img-fluid h-100 w-100 img-responsive" alt="...">
                                </a>
                                <div class="card-body h-100" style="background-color:#1A4066;">
                                    <a class="" data-toggle="modal" href="#modalGroup{{$value->id}}">
                                        <div class="px-auto py-2 text-center" style="width: 100%;">
                                            <p class="product-price-header mb-0" style="float:none;">
                                                {{$value->display_name}}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalGroup{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-body" >
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="head_pop_prod" style="">Paket {{$value->display_name}}</h4>
                                        <div class="container list-product" style="">
                                            <div class="row mt-0">
                                                <div class="col-md-12 mt-4">
                                                    <div class="row section_content px-3">
                                                        @foreach($value->item_active as $p_group)
                                                            <div id="product_list"  class="col-6 col-md-4 d-flex mx-0" style="">
                                                                <div class="card mx-auto d-flex item_product">
                                                                    <img style="" src="{{ asset('storage/'.(($p_group->image!='') ? $p_group->image : '20200621_184223_0016.jpg').'') }}" class="img-fluid h-100 w-100 img-responsive" alt="...">
                                                                    <div class="card-body" style="background-color:#ffff;">
                                                                    
                                                                        <div class="float-left px-1 py-2" style="width: 100%;">
                                                                            <p class="product-price-header mb-0" style="">
                                                                                {{$p_group->Product_name}}
                                                                            </p>
                                                                        </div>
                                                                            <div class="float-left px-1 py-2" style="">
                                                                                <p style="line-height:1; bottom:0" class="product-price mb-0 " id="productPrice{{$p_group->id}}" style="">Rp. {{ number_format($p_group->price, 0, ',', '.') }},-</p>
                                                                            </div>
                                                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!--
                    <div class="col-md-12">
                        <div class="row justify-content-center" >
                        <div class="page paging" style="margin-top:0; margin-bottom:1rem;">/*$product->appends(Request::all())->onEachSide(5)->links('vendor.pagination.bootstrap-4') */</div>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
    
    <div id="accordion" class="fixed-bottom" style="border-radius:0;z-index: 1;">
        <div class="card" style="border-radius:0;">
            <a role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="collapsed">
                <div id="card-cart" class="card-header pt-1" style="border-radius:0;">
                    <div class="card-cart container">
                        <table class="table borderless">
                            <tr>
                                <td align="left" id="td_itm" width="40%">
                                    <h5 style="color:#000">{{$total_item}} Item</h5>
                                </td>
                                <td align="middle"  id="td_crv" width="20%">
                                    <i class="fas fa-chevron-up" style=""></i>
                                </td>
                                <td align="right" id="td_krm-order" width="40%">
                                    <h5 class="pull-right" style="color: #000">Kirim Order&nbsp;&nbsp;<img src="{{ asset('assets/image/right-arrow.png') }}" width="20" class="my-auto" alt="right-arrow"></h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </a>
            
            <div id="{{$total_item > 0 ? 'collapse-4' : '' }}" class="collapse" data-parent="#accordion">
                <div id="cont-collapse" class="container">
                    <div class="card-body" id="card-detail" style="">
                        <div class="col-md-12" style="padding-bottom:10rem;">
                            <table class="table-detail" width="100%">
                                <tbody>
                                    @foreach($keranjang as $detil)
                                    <tr>
                                        <td width="30%" class="img-detail-cart" valign="middle" style="border-bottom: 1px solid #ddd;padding-top:3%;">
                                            <img src="{{ asset('storage/'.$detil->image)}}" 
                                            class="image-detail"  alt="...">   
                                        </td>
                                        <td width="60%" class="td-desc-detail" align="left" valign="top" style="border-bottom: 1px solid #ddd;padding-top:3%;">
                                            <p style="color: #000">{{ $detil->Product_name}}</p>
                                            <?php 
                                            if($detil->discount > 0){
                                                $total = $detil->price_promo * $detil->quantity;
                                            }else{
                                                $total=$detil->price * $detil->quantity;
                                            }
                                            ?>
                                            <h2 id="productPrice_kr{{$detil->product_id}}" style="font-weight:700;color: #153651;font-family: Montserrat;">Rp. {{ number_format($total, 0, ',', '.') }},-</h2>
                                            <table width="20%" class="tabel-quantity">
                                                <tbody>
                                                    <tr>
                                                        <td width="3%" class="" align="left" valign="middle" rowspan="2">
                                                            <p style="color: #000">Qty</p>
                                                            <input type="hidden" id="order_id{{$detil->product_id}}" name="order_id" value="{{$detil->order_id}}">
                                                            @if($detil->discount > 0)
                                                            <input type="hidden" id="harga_kr{{$detil->product_id}}" name="price" value="{{$detil->price_promo}}">
                                                            @else
                                                            <input type="hidden" id="harga_kr{{$detil->product_id}}" name="price" value="{{$detil->price}}">
                                                            @endif
                                                            <input type="hidden" id="id_detil{{$detil->product_id}}" value="{{$detil->id}}">
                                                            <input type="hidden" id="jmlkr_{{$detil->product_id}}" name="quantity" value="{{$detil->quantity}}">    
                                                        </td>
                                                        <td width="3%" class="" align="left" valign="middle" rowspan="2">
                                                            <p id="show_kr_{{$detil->product_id}}" class="d-inline" style="">{{$detil->quantity}}</p>
                                                        </td>
                                                        <td width="1%" align="center" valign="middle" bgcolor="#1A4066" style="border-top-left-radius:5px;border-top-right-radius:5px;">
                                                            <button class="button_plus" onclick="button_plus_kr('{{$detil->product_id}}')" style="background:none; border:none; color:#ffffff;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="1%" align="middle" valign="middle" bgcolor="#1A4066" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px;">
                                                            <button class="button_minus" onclick="button_minus_kr('{{$detil->product_id}}')" style="background:none; border:none; color:#ffffff;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="15%" align="right" valign="top" style="border-bottom: 1px solid #ddd;padding-top: 10%;">
                                            <button class="btn btn-default" onclick="delete_kr('{{$detil->product_id}}')" style="">X</button>
                                            <input type="hidden"  id="order_id_delete{{$detil->product_id}}" name="order_id" value="{{$detil->order_id}}">
                                            <input type="hidden"  id="quantity_delete{{$detil->product_id}}" name="quantity" value="{{$detil->quantity}}">
                                            @if($detil->discount > 0)
                                            <input type="hidden"  id="price_delete{{$detil->product_id}}" name="price" value="{{$detil->price_promo}}">
                                            @else
                                            <input type="hidden"  id="price_delete{{$detil->product_id}}" name="price" value="{{$detil->price}}">
                                            @endif
                                            <input type="hidden"  id="product_id_delete{{$detil->product_id}}"name="product_id" value="{{$detil->product_id}}">
                                            <input type="hidden" id="id_delete{{$detil->product_id}}" name="id" value="{{$detil->id}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td align="right" colspan="3">
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <div id="desc_code" style="display: none;">
                                <div class="jumbotron jumbotron-fluid ml-2 py-4 mb-3">
                                    <p class="lead"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fixed-bottom" style="background-color:#e9eff5;">
                        <div class="container">
                            <div class="col-md-12 py-3">
                                <input type="hidden" class="form-control" id="voucher_code_hide">
                            @if($total_item > 0)
                                <!--
                                <div class="input-group mb-2 mt-2">
                                    <input type="text" class="form-control" id="voucher_code" 
                                    placeholder="Gunakan Kode Diskon" aria-describedby="basic-addon2" required style="background:#ffcc94;outline:none;">
                                    <div class="input-group-append" required>
                                        <button class="btn " type="submit" onclick="btn_code('')" style="background:#6a3137;outline:none;color:white;">Terapkan</button>
                                    </div>
                                </div>
                                
                                <div id="divchecktunai" class="custom-control custom-checkbox checkbox-lg ml-n3 mb-4 mt-n2">
                                    <input  type="checkbox" class="custom-control-input" id="checktunai" checked value="Cash">
                                    <label class="custom-control-label" for="checktunai" style="color: #000;font-weight:600;">Pembayaran Tunai</label>
                                </div>
                                -->
                                <div id="div_total" class="row float-left mt-2">
                                    <p class="mt-1" style="color: #000;font-weight:bold; ">Total Harga</p>&nbsp;
                                    @if($item!==null)
                                    <h2 id="total_kr_" style="font-weight:700;color: #153651;font-family: Montserrat;">Rp. {{number_format($item->total_price , 0, ',', '.')}},-</h2>
                                    <input type="hidden" id="total_kr_val" value="{{$item->total_price}}">
                                        @else
                                    <h2 id="total_kr_" style="font-weight:700;color: #153651;font-family: Montserrat;">Rp. 0,-</h2>
                                    <input type="hidden" id="total_kr_val" value="0">
                                    @endif
                                </div>
                                

                                @if($item!==null)
                                    <input type="hidden" name="total_pesanan" id="total_pesan_val_hide" value="{{$item->total_price}}">
                                @else
                                    <input type="hidden" name="total_pesanan" id="total_pesan_val_hide" value="0">
                                @endif
                                <input type="hidden" id="order_id_cek" name="id" value="{{$item !==null ? $item->id : ''}}"/>
                                <div id="chk-bl-btn" class="row justify-content-end my-auto">
                                    <a type="button" id="beli_sekarang" class="btn button_add_to_pesan float-right mb-2" onclick="show_modal()" style="padding: 10px 20px; ">Pesan Sekarang <i class="fab fa-whatsapp" aria-hidden="true" style="color: #ffffff !important; font-weight:900;"></i></a>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal pesan wa--> 
    <div class="modal fade right ml-0" id="my_modal_content" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
            <div class="modal-content-full-width modal-content ">
                <div class="modal-body">
                    <img src="{{ asset('assets/image/dot-top-right.png') }}" class="dot-top-right"  
                    style="" alt="dot-top-right">
                    <img src="{{ asset('assets/image/dot-bottom-left.png') }}" class="dot-bottom-left"  
                    style="" alt="dot-bottom-left">
                    <img src="{{ asset('assets/image/shape-bottom-right.png') }}" class="shape-bottom-right"  
                    style="" alt="shape-bottom-right">
                    <button type="button" class="btn btn-warning btn-circle" data-dismiss="modal" style="position:absolute;z-index:99999;"><i class="fa fa-times"></i></button>
                    <div class="container">
                        <div class="d-flex justify-content-center mx-auto">
                            <div class="col-md-2 image-logo-login" style="z-index: 2">
                            <img src="{{ asset('assets/image/LOGO MEGACOOLS_DEFAULT.png') }}" class="img-thumbnail pt-4" style="background-color:transparent; border:none;" alt="LOGO MEGACOOLS_DEFAULT">  
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 login-label py-3" style="z-index: 2">
                        <h3 >Konfirmasi Pesanan</h3>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-5 login-label" style="z-index: 2">
                            <form class="form-inline" method="POST" id="ga_pesan_form" target="_BLANK" action="{{ route('customer.keranjang.pesan') }}">
                                @csrf
                                <div class="col-md-5 px-0 pt-3">
                                    <p class="text-left">Pilih Metode Pembayaran</p>
                                </div>
                                @if($item!==null)
                                <input type="hidden" name ="voucher_code_hide_modal" id="voucher_code_hide_modal">
                                <input type="hidden" name="total_novoucher" id="total_novoucher_val">
                                <input type="hidden" name="total_pesanan" id="total_pesan_val" value="{{$item->total_price}}">
                                @else
                                    <input type="hidden" name ="voucher_code_hide_modal"  id="voucher_code_hide_modal">
                                    <input type="hidden" name="total_novoucher" id="total_novoucher_val">
                                    <input type="hidden" name="total_pesanan" id="total_pesan_val" >
                                @endif
                                <div class="col-md-7 p-0 ">
                                    <select name="check_tunai_value"  id="check_tunai" style="width:100%;" class="form-control" required>
                                        <option data-icon="fa-check-circle" value="Cash">&nbsp;&nbsp;Cash</option>
                                        <option data-icon="fa-check-circle" value="TOP 7 Days">&nbsp;&nbsp;TOP 7 Days</option>
                                        <option data-icon="fa-check-circle" value="TOP 30 Days">&nbsp;&nbsp;TOP 30 Days</option>
                                    </select>
                                </div>
                                <div class="col-md-12 px-0 mt-4">
                                    <div class="form-group">
                                        <textarea name="notes" class="form-control p-3" rows="5" placeholder="Note..."
                                        style="width: 100%;
                                        border-top-left-radius:25px;
                                        border-top-right-radius:25px;
                                        border-bottom-right-radius:0;
                                        border-bottom-left-radius:0;"></textarea>
                                    </div>
                                </div>
                                <div class="mx-auto text-center">
                                    <input type="hidden" id="order_id_pesan" name="id" value="{{$item !==null ? $item->id : ''}}"/>
                                    <button type="submit" id="ga_pesan" onclick="pesan_wa()" class="btn btn_login_form"><i class="fab fa-whatsapp fa-1x" aria-hidden="true" style="color: #ffffff !important; font-weight:900;"></i>&nbsp;{{__('Pesan Sekarang') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal validasi stok -->
    <div class="modal fade ml-1" id="modal_validasi" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                        <div class="text-center mb-3">Mohon maaf...</div> 
                            <div id="body_alert">
                            </div>
                            <div class="text-center mt-3">Stok tidak mencukupi.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn " data-dismiss="modal" style="color:#fff; background-color:#6a3137; ">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<script>
    if ($(window).width() < 601) {
        $('#div_total').removeClass('float-left');
        //$('#div_total').addClass('justify-content-center');
        $('#div_total').removeClass('mt-2');
        $('#div_total').addClass('mb-2');
        $('#beli_sekarang').removeClass('float-right');
        $('#beli_sekarang').addClass('btn-block');
        $('#beli_sekarang').addClass('mb-0');
        $('#chk-bl-btn').removeClass('justify-content-end');
        $('#chk-bl-btn').addClass('justify-content-center');
        $('#divchecktunai').addClass('mb-2');
        $('#dropfilter').removeClass('mt-3');
        //$('#dropfilter').addClass('mt-2');
    }
    if ($(window).width() <= 480) {
        $('#cont-collapse').removeClass('container');
        //$('.card-cart').removeClass('container');
    }
     
</script>
@endsection


