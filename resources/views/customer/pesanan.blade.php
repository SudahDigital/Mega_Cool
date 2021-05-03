@extends('customer.layouts.template-nocart')
@section('title') Profil @endsection
@section('content')
<style>
    .style-badge{
        padding:7px 10px; 
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius:0;
        border-bottom-left-radius:0;
    }
</style>

    <div class="container" style="">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-0">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li id="prf-brd" class="breadcrumb-profil-item active mt-1" aria-current="page">Daftar Pesanan</li>&nbsp;
                        <li class="breadcrumb-profil-item" style="color: #000!important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center" >
            <div class="col-10">
                <div class="row section_content" style="z-index:3;">
                @if($order_count < 1)
                <div class="alert alert-success" role="alert" style="position:fixed;top:40%; width:90%; z-index:9999; margin: 0 auto;  border:none; color:#FDD8AF; font-weight:bold;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    Tidak ada pesanan
                </div>
            
                @else
                
                <div class="table-responsive" style="z-index:3">
                    <table class="table table-striped table-hover" style="font-size:13px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Toko</th>
                                <th>Qty & Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0;?>
                            @foreach($orders as $order)
                            <?php $no++;?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>
                                    @if($order->status == "SUBMIT")
                                    <span class="style-badge badge bg-warning text-light">{{$order->status}}</span>
                                    @elseif($order->status == "PROCESS")
                                    <span class="style-badge style-badge badge bg-info text-light">{{$order->status}}</span>
                                    @elseif($order->status == "FINISH")
                                    <span class="style-badge  badge bg-success text-light">{{$order->status}}</span>
                                    @elseif($order->status == "CANCEL")
                                    <span class="style-badge badge bg-danger text-light">{{$order->status}}</span>
                                    @endif
                                </td>
                                <td>Tgl Pesan : {{$order->created_at}}<br>
                                    {{$order->customers->store_name}}
						            @if($order->customers->status == 'NEW')<span class="badge bg-pink">New</span>@endif
                                </td>
                                <td>Total Qty :<b> {{$order->totalQuantity}}</b><br>
                                    Total Hrg :<b> Rp. {{number_format($order->total_price)}}</b><br>
                                    <span class="style-badge badge bg-dark text-light"
                                        style="padding:5px 10px;">
                                        <small><b>Detail Pesanan</b></small>
                                    </span>
                                </td>
                                <!--
                                <td>
                                    <button type="button" class="btn btn_default" style="background:#6a3137;color:#fff;font-size:10px"data-toggle="modal" data-target="#detailModal{{$order->id}}">Detail</button>
                                    // Modal Detail
                                    <div class="modal fade" id="detailModal{{$order->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-lg" style="background: #FDD8AF;">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="detailModalLabel">Detail Pesanan</h6>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row card-body">
                                                        @foreach($order->products as $detil)
                                                        <div class="col-6 col-sm-4 card-img-top" >
                                                            <img src="{{ asset('storage/'.$detil->image)}}" style="height:auto" class="card-img-top" alt="...">
                                                        </div>       
                                                        <div class="col-6 col-sm-8 card-img-top"> 
                                                            <h6>{{$detil->description}}</h6>
                                                            <h6>{{$detil->pivot->quantity}} Pc(s)</h6>
                                                            <p>Rp. {{ number_format($detil->price * $detil->pivot->quantity)}}</p>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn default" style="background:#6a3137;color:#fff" data-dismiss="modal">Close</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                </div>
                
                
                <!--
                <div class="row justify-content-center" >
                    <div style="margin-top:-3rem; margin-bottom:1rem;">{{ $orders->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
                -->
                @endif
            </div>
            </div>
            
        </div>
    </div>
    <script>
        if ($(window).width() <= 600) {
            $('#prf-brd').removeClass('mt-1');
            //$('#prf-brd').addClass('mt-2');
        } 
        if ($(window).width() <= 411) {
            $('.col-9').addClass('ml-n3');
            //$('.contact-row').addClass('mt-5');
        } 
    </script>
@endsection
