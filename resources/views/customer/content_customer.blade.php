@extends('customer.layouts.template')
@section('title')
Home    
@endsection
@section('content')
    
    <div class="container" style="">
        <div class="row ">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="" >
                    <ol class="breadcrumb pt-3 pb-0" style="background-color:#ffffff">
                        <h2 class="breadcrumb-item">Our</h2>
                        <h2 class="breadcrumb-item active" aria-current="page">Product</h2>
                    </ol>
                </nav>
            </div>
        </div>
    </div> 

    <!--menu categories-->
    <!--
    <div style="{{$top_count > 0 ? 'background:#693234;' : 'background:#FDD8AF'}}">
        <div class="container">
            <div class="row align-middle mt-0" style="">  
                <div class="col-sm-12 mt-4" style="">
                    @if($cat_count > 5)
                    <div class="col-md-12 mx-auto">
                        <table width="100%" style="margin-bottom: 20px;" >
                        <tbody>
                            <tr>
                                <td class="menu-filter" valign="middle">
                                    @if($count_data <= 3)
                                    <h3 class="cat_fil" id="cat_fil" style="color: #693234;">
                                        Filter Category 
                                    </h3>
                                    @else
                                    <h3 class="cat_fil" id="cat_fil" style="color: #ffffff; ">
                                        Filter Category 
                                    </h3>
                                    @endif
                                </td>
                                <td width="60%" align="left" valign="middle" class="menu-logo-filter">
                                    @if($count_data <=3)
                                        <button type="button" class="btn" data-toggle="collapse" data-target="#demo" style="background-color:#FDD8AF; border:none;">
                                            <i class="fas fa-sliders-h tombol" style="color:#693234"></i>
                                        </button>
                                    @else
                                    <button type="button" class="btn" data-toggle="collapse" data-target="#demo" style="background-color:#693234; border:none;">
                                        <i class="fas fa-sliders-h tombol" style="color:#fff;"></i>
                                    </button>
                                    @endif
                                </td>
                                //--
                                <td width="25%" align="right">
                                    
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb px-0 button_breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page" @if($count_data <= 3) style="color: #6a3137;margin-top:30px;" @else style="color: #fff;margin-top:30px;"@endif>Category Family Pack</li>
                                            </ol>
                                        </nav>
                                </td>
                            
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    <div id="demo" class="collapse" style="">
                        <div class="col-md-12" style="margin-bottom: 20px;">
                        <a href="{{url('/home_customer')}}" type="button" class="btn button_add_to_cart button-collapse mb=3">Semua Produk</a>
                        @foreach($categories as $key => $value)
                            <a href="{{route('category.index', ['id'=>$value->id] )}}" type="button" class="btn button_add_to_cart button-collapse mb-3">{{$value->name}}</a>
                        @endforeach
                        </div>
                    </div>
                    @else
                    <div class="col-md-12 mb-2" style="">
                        <a href="{{url('/home_customer')}}" type="button" class="btn button_add_to_cart button-collapse mb-3">Semua Produk</a>
                        @foreach($categories as $key => $value)
                            <a href="{{route('category.index', ['id'=>$value->id] )}}" type="button" class="btn button_add_to_cart button-collapse mb-3">{{$value->name}}</a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    -->
    <!--product-->
    <div style="background:#ffff">
        <img src="{{ asset('assets/image/dot-top-right-content.jpg') }}" class="dot-content-top-right" style="" alt="dot-top-right-content">
        <img src="{{ asset('assets/image/shape-content.jpg') }}" class="shape-content-bottom-right" style="" alt="shape-content">
        <img src="{{ asset('assets/image/dot-bottom-left-content.jpg') }}" class="dot-content-bottom-left" style="" alt="dot-bottom-left-content">
        <div class="container" style="">
            <div class="row mt-0">
                <div class="col-md-12 mt-4">
                    <div class="row section_content">
                    @foreach($product as $key => $value)
                    <div id="product_list"  class="col-6 col-md-3 d-flex mx-0" style="z-index: 1">
                        <div class="card mx-auto d-flex item_product">
                            @if($value->discount > 0)
                            <div class="ribbon"><span class="span-ribbon">{{$value->discount}}% OFF</span></div>
                            @endif
                            
                            <!--<a href="{{URL::route('product_detail', ['id'=>$value->id])}}">-->
                            <a href="#">
                                <img style="" src="{{ asset('storage/'.(($value->image!='') ? $value->image : '20200621_184223_0016.jpg').'') }}" class="img-fluid h-150 w-100 img-responsive" alt="...">
                            </a>
                            <div class="card-body" style="background-color:#1A4066;">
                                <div class="float-left px-1 py-2" style="width: 100%;">
                                    <p class="product-price-header mb-0" style="">
                                        {{$value->Product_name}}
                                    </p>
                                </div>
                                @if($value->discount > 0)
                                <div class="d-inline-block">
                                    <div class="text-left">
                                        <p class="product-price mt-0 mb-0 ml-1" style="color:#ffff;"><del><b><i>Rp. {{ number_format($value->price, 0, ',', '.') }}</i></b> </del></p>
                                    </div>
                                </div>
                                <div class="float-left px-1 py-2" style="">
                                    <p style="line-height:1; bottom:0" class="product-price mb-0 " id="productPrice{{$value->id}}" style="">Rp. {{ number_format($value->price_promo, 0, ',', '.') }}</p>
                                </div>
                                @else
                                <div class="float-left px-1 py-2" style="">
                                    <p style="line-height:1; bottom:0" class="product-price mb-0 " id="productPrice{{$value->id}}" style="">Rp. {{ number_format($value->price, 0, ',', '.') }},-</p>
                                </div>
                                @endif
                                @if($value->stock == 0)
                                    <div class="p-1 mb-0 text-dark text-center" style="border-radius:7px;background-color:#e9eff5;"><small><b>Sisa Stok {{$value->stock}}</b></small></div>
                                @endif
                                <table width="100%" class="hdr_tbl_cart">
                                    <tbody>
                                    <tr>
                                        <td class="tbl_cart" valign="middle" style="" rowspan="2">
                                            
                                            <input type="hidden" id="jumlah{{$value->id}}" name="quantity" value="1">
                                            <input type="hidden" id="harga{{$value->id}}" name="price" value="{{ $value->price }}">
                                            <input type="hidden" id="{{$value->id}}" name="Product_id" value="{{$value->id}}">
                                            <button class="btn btn-block button_add_to_cart respon" onclick="add_tocart('{{$value->id}}')" style="">Tambah</button>
                                            
                                        </td>
                                        <td width="10%" align="left" valign="middle" rowspan="2">
                                            <p id="show_{{$value->id}}" class="d-inline show" style="">1</p>
                                        </td>
                                        <td width="10%" align="center" valign="middle" bgcolor="#ffffff" style="border-top-left-radius:5px;border-top-right-radius:5px;">
                                            <a class="button_plus" onclick="button_plus('{{$value->id}}')" style=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%" align="center" valign="middle" bgcolor="#ffffff" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px;">
                                            <a class="button_minus" onclick="button_minus('{{$value->id}}')" id="btn_min" style=""><i class="fa fa-minus" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--
                                <table width="100%" class="hdr_tbl_cart mt-auto" style="bottom: 0">
                                    <tbody>
                                        <tr>
                                            <td width="10%" align="right" valign="middle">
                                                <input type="hidden" id="Product_id{{$value->id}}" name="Product_id" value="{{$value->id}}">
                                                <input type="hidden" id="quantity_add{{$value->id}}" name="quantity" value="1">
                                                @if($value->discount > 0)
                                                <input type="hidden" id="harga{{$value->id}}" name="price" value="{{$value->price_promo}}">
                                                @else
                                                <input type="hidden" id="harga{{$value->id}}" name="price" value="{{$value->price}}">
                                                @endif
                                                @if($value->stock > 0)
                                                <button class="btn button_minus" onclick="button_minus('{{$value->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                @else
                                                <button disabled class="btn button_minus" onclick="" style="background:none; border:none; color:#693234;outline:none;cursor: no-drop;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                @endif
                                            </td>
                                            <td width="10%" align="center" valign="middle">
                                                <?php
                                                //$ses_id = \Request::header('User-Agent');
                                                //$clientIP = \Request::getClientIp(true);
                                                $user =  \Auth::user()->id; 
                                                //$user = \Request::header('User-Agent'); 
                                                $view_pesan = \DB::select("SELECT orders.user_id, orders.status, orders.customer_id, 
                                                            products.description, products.image, products.price, order_product.id,
                                                            order_product.order_id,order_product.product_id,order_product.quantity
                                                            FROM order_product, products, orders WHERE 
                                                            orders.id = order_product.order_id AND order_product.product_id = $value->id AND 
                                                            order_product.product_id = products.id AND orders.status = 'SUBMIT' 
                                                            AND orders.user_id = '$user' AND orders.customer_id IS NULL ");
                                                $hitung = count($view_pesan);
                                                    if($hitung > 0){
                                                        foreach ($view_pesan as $key => $k) {
                                                        echo '<p id="show_'.$value->id.'" class="d-inline show" style="">'.$k->quantity.'</p>';
                                                        echo '<input type="hidden" id="jmlbrg_'.$value->id.'" name="quantity" value="'.$k->quantity.'">';
                                                        }
                                                    }
                                                    else{
                                                        echo '<input type="hidden" id="jmlbrg_'.$value->id.'" name="quantity" value="0">';
                                                        echo '<p id="show_'.$value->id.'" class="d-inline show" style="">0</p>';
                                                    }
                                                ?>
                                                <input type="hidden" id="stock{{$value->id}}" name="stock" value="{{$value->stock}}">
                                            </td>
                                            <td width="10%" align="left" valign="middle">
                                                @if($value->stock > 0)
                                                <button class="btn button_plus" onclick="button_plus('{{$value->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                @else
                                                <button disabled class="btn button_plus" onclick="" style="background:none; border:none; color:#693234;outline:none;cursor: no-drop;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                -->
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
    
    <div id="accordion" class="fixed-bottom" style="border-radius:0;">
        <div class="card" style="border-radius:0;">
            <a role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="collapsed">
                <div id="card-cart" class="card-header pt-1" style="border-radius:0;">
                    <table class="table borderless">
                        <tr>
                            <td align="left" width="50%">
                                <h5 style="color:#000">{{$total_item}} Item</h5>
                            </td>
                            <td align="right" width="50%">
                                <h5 class="pull-right" style="color: #000">Pesan Sekarang <i class="fa fa-paper-plane" aria-hidden="true" style="color: #FF0000 !important"></i></h5>
                            </td>
                        </tr>
                    </table>
                </div>
            </a>
               
                <!--
                <table  width="100%" style="margin-bottom: 40px;">
                    <tbody>
                        <tr>
                            <td width="5%" valign="middle">
                                <div id="ex4">
                               
                                    <span class="p1 fa-stack fa-2x has-badge" data-count="{{$total_item}}">
                                
                                        //--<i class="p2 fa fa-circle fa-stack-2x"></i>--//
                                        <i class="p3 fa fa-shopping-cart " data-count="4b" style=""></i>
                                    </span>
                                </div> 
                            </td>
                            <td width="25%" align="left" valign="middle">
                                @if($item!==null)
                            <h5 id="total_kr_">Rp. {{number_format($item->total_price , 0, ',', '.')}}</h5>
                            <input type="hidden" id="total_kr_val" value="{{$item->total_price}}">
                                @else
                            <h5 id="total_kr_">Rp. 0</h5>
                            <input type="hidden" id="total_kr_val" value="0">
                                @endif
                            </td>
                            <td width="5%" valign="middle" >
                                <a id="cv" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="collapsed">
                                    <i class="fas fa-chevron-up" style=""></i>
                                </a>
                            </td>
                            <td width="33%" align="right" valign="middle">
                               
                            <h5>({{$total_item}} Item)</h5>
                             
                            </td>
                        </tr>
                    </tbody>
                </table>
                -->
            <div id="{{$total_item > 0 ? 'collapse-4' : '' }}" class="collapse" data-parent="#accordion">
                <div class="card-body" id="card-detail" style="">
                    <div class="col-md-12" style="padding-bottom:6rem;">
                        <table class="table-detail" width="100%">
                            <tbody>
                                @foreach($keranjang as $detil)
                                <tr>
                                    <td width="25%" valign="middle">
                                        <img src="{{ asset('storage/'.$detil->image)}}" 
                                        class="image-detail"  alt="...">   
                                    </td>
                                    <td width="60%" align="left" valign="top">
                                        <p class="name-detail">{{ $detil->Product_name}}</p>
                                        <?php 
                                        if($detil->discount > 0){
                                            $total = $detil->price_promo * $detil->quantity;
                                        }else{
                                            $total=$detil->price * $detil->quantity;
                                        }
                                        ?>
                                        <h2 id="productPrice_kr{{$detil->product_id}}" style="font-weight:700;color: #153651;font-family: Montserrat;">Rp. {{ number_format($total, 0, ',', '.') }},-</h2>
                                        <table width="10%">
                                            <tbody>
                                                <tr>
                                                    <td width="10px" align="left" valign="middle">
                                                        <input type="hidden" id="order_id{{$detil->product_id}}" name="order_id" value="{{$detil->order_id}}">
                                                        @if($detil->discount > 0)
                                                        <input type="hidden" id="harga_kr{{$detil->product_id}}" name="price" value="{{$detil->price_promo}}">
                                                        @else
                                                        <input type="hidden" id="harga_kr{{$detil->product_id}}" name="price" value="{{$detil->price}}">
                                                        @endif
                                                        <input type="hidden" id="id_detil{{$detil->product_id}}" value="{{$detil->id}}">
                                                        <input type="hidden" id="jmlkr_{{$detil->product_id}}" name="quantity" value="{{$detil->quantity}}">    
                                                        <button class="button_minus" onclick="button_minus_kr('{{$detil->product_id}}')" style="background:none; border:none; color:#153651;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                    </td>
                                                    <td width="10px" align="middle" valign="middle">
                                                        <p id="show_kr_{{$detil->product_id}}" class="d-inline" style="">{{$detil->quantity}}</p>
                                                    </td>
                                                    <td width="10px" align="right" valign="middle">
                                                        <button class="button_plus" onclick="button_plus_kr('{{$detil->product_id}}')" style="background:none; border:none; color:#153651;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="15%" align="right" valign="top" style="padding-top: 5%;">
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
                        <hr>
                        <div id="desc_code" style="display: none;">
                            <div class="jumbotron jumbotron-fluid ml-2 py-4 mb-3">
                                <p class="lead"></p>
                            </div>
                        </div>
                    </div>
                        
                </div>
                <div class="fixed-bottom">
                    <div class="p-3" style="background-color:#e9eff5;border-bottom-right-radius:18px;border-bottom-left-radius:18px;">
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
                            -->
                            @if($item!==null)
                                <input type="hidden" name="total_pesanan" id="total_pesan_val_hide" value="{{$item->total_price}}">
                            @else
                                <input type="hidden" name="total_pesanan" id="total_pesan_val_hide" value="0">
                            @endif
                            <input type="hidden" id="order_id_cek" name="id" value="{{$item !==null ? $item->id : ''}}"/> 
                            <a type="button" id="beli_sekarang" class="btn button_add_to_pesan btn-block" onclick="show_modal()" style="padding: 10px 40px; ">Beli Sekarang</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pesan 
    <div class="modal fade ml-1" id="my_modal_content" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            //-- Modal content--//
            <div class="modal-content" style="background: #FDD8AF">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" target="_BLANK" action="{{ route('customer.keranjang.pesan') }}">
                    @csrf
                    
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <div class="card contact_card" style="border-radius:15px;">
                                <div class="card-body">
                                    <div class="form-group">
                                        @if($item!==null)
                                        <input type="hidden" name ="voucher_code_hide_modal" id="voucher_code_hide_modal">
                                        <input type="hidden" name="total_novoucher" id="total_novoucher_val">
                                        <input type="hidden" name="total_pesanan" id="total_pesan_val" value="{{$item->total_price}}">
                                            @else
                                            <input type="hidden" name ="voucher_code_hide_modal"  id="voucher_code_hide_modal">
                                            <input type="hidden" name="total_novoucher" id="total_novoucher_val">
                                            <input type="hidden" name="total_pesanan" id="total_pesan_val" >
                                        @endif
                                        
                                    <input type="text" value="{{$item_name !== null ? $item_name->username : ''}}" name="username" class="form-control contact_input @error('name') is-invalid @enderror" placeholder="Name" id="name" required autocomplete="off" autofocus value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                    <div class="form-group">
                                        <input type="email" value="{{$item_name !== null ? $item_name->email : ''}}" name="email" class="form-control contact_input @error('email') is-invalid @enderror" placeholder="Email" id="email" required autocomplete="off" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                    <div class="form-group">
                                        <textarea type="text"  name="address" class="form-control contact_input @error('address') is-invalid @enderror" placeholder="Address" id="address" required autocomplete="off" value="{{ old('address') }}">{{$item_name !== null ? $item_name->address : ''}}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                    <div class="form-group">
                                        <input type="tel" value="{{$item_name !== null ? $item_name->phone : ''}}" name="phone"  minlength="10" maxlength="13" class="form-control contact_input" placeholder="Phone" id="phone" required autocomplete="off" onkeypress="return hanyaAngka(event)">
                                        //--<label for="password-confirm" class="contact_label">{{ __('Konfirmasi Kata Sandi') }}</label>--//
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="order_id_pesan" name="id" value="{{$item !==null ? $item->id : ''}}"/>
                    <button type="submit" class="btn btn-block bt-wa" onclick="pesan_wa()"  style="color:#fff; background-color:#6a3137; "><i class="fab fa-whatsapp" style="font-weight: bold;"></i> &nbsp;{{__('Pesan') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    -->
    <!-- Modal validasi stok -->
    <div class="modal fade ml-1" id="modal_validasi" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="background: #FDD8AF">
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

@endsection


