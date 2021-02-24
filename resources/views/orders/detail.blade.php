@extends('layouts.master')
@section('title') Details Order @endsection
@section('content')

	@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
		</div>
	@endif
	<!-- Form Create -->
    <form id="form_validation" method="POST" action="{{route('orders.update', [$order->id])}}">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <!--
        <div class="form-group form-float">
            <div class="form-line">
                <label class="form-label">Invoice number</label>
                <input type="text" class="form-control" autocomplete="off" value="" disabled>
            </div>
        </div>
        -->
        <div class="form-group form-float">
            <label class="form-label">Customer</label>
                <ul>
                    <small><b>Name :</b> {{$order->customers->store_name}}</small>
					@if($order->customers->status == 'NEW')<span class="badge bg-pink">New</span>@endif
					<br>
					<small><b>Email :</b> {{$order->customers->email}}</small><br>
					<small><b>Addr :</b> {{$order->customers->address}}</small><br>
					<small><b>Phone :</b> {{$order->customers->phone}}</small><br>
					<small><b>Sales Rep :</b> {{$order->users->name}}<span class="badge {{$order->user_loc == 'On Location' ? 'bg-green' : 'bg-black'}}">{{$order->user_loc}}</span></small><br>
                    <small><b>Payment Term :</b> 
						@if($order->payment_method == 'Non Tunai')
						{{$order->customers->payment_term}}
						@else
						{{$order->payment_method}}
						@endif
					</small>
                </ul>
                    <!--<input type="text" class="form-control" autocomplete="off" value="" disabled>-->
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control"  autocomplete="off"  value="{{$order->created_at}}" disabled>
                <label class="form-label">Order date</label>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Product Orders</label>
            <!--
            <ul>
                @foreach($order->products as $p)
                <li>{{$p->description}} <b>({{$p->pivot->quantity}})</b></li>
                 @endforeach
            </ul>
            -->
            <table width="100%" class="table table-hover">
                <thead>
                    <th width="" style="padding-left:10px;"><small>Product</small></th>
                    <th width="" style="padding-left:10px;"><small>Quantity </small> </th>
                    <th width="" style="padding-left:10px;"><small>Price</small> </th>
                    <!--<th width="" style="padding-left:10px;"><small>Discount(%)</small> </th>
                    <th width="" style="padding-left:10px;"><small>Price After Discount</small></th>-->
                    <th width="" class="text-right"><small>Sub Total</small></th>
                </thead>
                <tbody>
                    @foreach($order->products as $p)
                    <tr>
                        <td style="padding-top:10px;">{{$p->description}}</td>
                        <td style="padding-top:5px;">{{$p->pivot->quantity}}</td>
                        <td style="padding-top:5px;">Rp. {{number_format($p->pivot->price_item, 0, ',', '.')}}</td>
                        <!--<td style="padding-top:5px;">{{$p->pivot->discount_item}}</td>
                        <td style="padding-top:5px;">
                            @if(($p->pivot->price_item_promo != NULL) && ($p->pivot->price_item_promo > 0))
                            {{number_format($p->pivot->price_item_promo, 0, ',', '.')}}
                            @else
                            ---
                            @endif
                        </td>-->
                        <td align="right">
                            @if(($p->pivot->discount_item != NULL) && ($p->pivot->discount_item > 0))
                            Rp. {{number_format($p->pivot->price_item_promo * $p->pivot->quantity, 0, ',', '.')}}
                            @else
                            Rp. {{number_format($p->pivot->price_item * $p->pivot->quantity, 0, ',', '.')}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <!--<td colspan="5" align="right"><b>Voucher Discount</b> <small>
                            @if($order->id_voucher !=NULL)
                            {{($order->vouchers['description'])}}
                            @endif
                        </small> <b>:</b></td>
                        <td align="right">
                            @if(($order->id_voucher !=NULL)&&($order->vouchers['type'] == 1))
                            <b>{{$order->vouchers->discount_amount}}%</b>
                            @elseif(($order->id_voucher !=NULL)&&($order->vouchers['type'] == 2))
                            <b>{{number_format($order->vouchers->discount_amount, 0, ',', '.')}}</b>
                            @else
                            <b>0</b>
                            @endif
                        </td>-->
                    </tr>
                    <tr>
                        <td colspan="3" align="right" width="85%"><b>Total Price :</b></td>
                        <td align="right"><b>Rp. {{number_format($order->total_price, 0, ',', '.')}}</b></td>
                    </tr>
                    <!--
                    <tr>
                        <td colspan="5" align="right" ><b>Shipping Cost :</b></td>
                        <td align="right"><b>{{number_format(15000, 0, ',', '.')}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right" ><b>Total Cost :</b></td>
                        <td align="right"><b>{{number_format($order->total_price + 15000, 0, ',', '.')}}</b></td>
                    </tr>
                    -->
                .</tbody>
            </table>

        </div>
        <!--
        <div class="form-group">
            <div class="form-line">
                <input type="text" class="form-control"  autocomplete="off"  value="{{$order->total_price}}" disabled>
                <label class="form-label">Total Price</label>
            </div>
        </div>
        -->
        <label class="form-label">Status</label>
        <div class="form-group">
            <input type="radio" value="SUBMIT" name="status" id="SUBMIT" {{$order->status == 'SUBMIT' ? 'checked' : ''}}>
            <label for="SUBMIT">SUBMIT</label>
            &nbsp;
            <input type="radio" value="PROCESS" name="status" id="PROCESS" {{$order->status == 'PROCESS' ? 'checked' : ''}}>
            <label for="PROCESS">PROCESS</label>
            &nbsp;
            <input type="radio" value="FINISH" name="status" id="FINISH" {{$order->status == 'FINISH' ? 'checked' : ''}}>
            <label for="FINISH">FINISH</label>
            &nbsp;
            <input type="radio" value="CANCEL" name="status" id="CANCEL" {{$order->status == 'CANCEL' ? 'checked' : ''}}>
            <label for="CANCEL">CANCEL</label>
        </div>

        <input type="submit" class="btn btn-primary waves-effect" value="UPDATE">
        
    </form>
    <!-- #END#  -->		

@endsection

