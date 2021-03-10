@extends('layouts.master')
@section('title') Paket List @endsection
@section('content')
@if(session('status'))
	<div class="alert alert-success">
		{{session('status')}}
	</div>
@endif

<form action="{{route('products.index')}}">
	<div class="row">
		<!--
		<div class="col-md-3">
			<div class="input-group input-group-sm">
        		<div class="form-line">
	            	<input type="text" class="form-control" name="keyword" value="{{Request::get('keyword')}}" placeholder="Filter by product name" autocomplete="off" />
	    		</div>
	        </div>
		</div>
		<div class="col-md-2">
			<input type="submit" class="btn bg-blue pull-left" value="Filter">
		</div>
		-->
		<div class="col-md-6">
			<ul class="nav nav-tabs tab-col-pink pull-left" >
				<li role="presentation" class="{{Request::get('status') == NULL && Request::path() == 'products' ? 'active' : ''}}">
					<a href="{{route('products.index')}}" aria-expanded="true" >All</a>
				</li>
				<li role="presentation" class="{{Request::get('status') == 'publish' ?'active' : '' }}">
					<a href="{{route('products.index', ['status' =>'publish'])}}" >PUBLISH</a>
				</li>
				<li role="presentation" class="{{Request::get('status') == 'draft' ?'active' : '' }}">
					<a href="{{route('products.index', ['status' =>'draft'])}}">DRAFT</a>
				</li>
				<li role="presentation" class="">
					<a href="{{route('products.low_stock')}}">LOW STOCK</a>
				</li>
				<li role="presentation" class="">
					<a href="{{route('products.trash')}}" >TRUSH</a>
				</li>
			</ul>
		</div>
		<div class="col-md-6">&nbsp;</div>
		<div class="col-md-12">
			<a href="{{route('products.import_products')}}" class="btn btn-success "><i class="fas fa-file-excel fa-0x "></i> Import (<small>Update Stock</small>) </a>&nbsp;
			<a href="{{route('products.export_all')}}" class="btn btn-success "><i class="fas fa-file-excel fa-0x "></i> Export (<small>Products Stock</small>)</a>&nbsp;
			<a href="{{route('paket.create')}}" class="btn bg-cyan">Create Paket</a>
		</div>
		
	</div>
</form>	
<hr>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover dataTable js-basic-example">
		<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Group</th>
				<th>Bonus Quantity</th>
				<th>Purchase Quantity</th>
				<th>Display Name</th>
				<th>Status</th>
				<th width="25%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($pakets as $p)
			<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>{{$p->paket_name}}</td>
				<td>
					@foreach($p->groups as $groups)
						{{$groups->group_name}}
					@endforeach
					
				</td>
				<td>{{$p->display_name}}</td>
				<td>{{$p->bonus_quantity}}</td>
				<td>{{$p->purchase_quantity}}</td>
				<td>{{$p->display_name}}</td>
				<td>
					@if($p->status=="INACTIVE")
					<span class="badge bg-dark text-white">{{$p->status}}</span>
						@else
					<span class="badge bg-green">{{$p->status}}</span>
					@endif

				</td>
				<td>
					<a class="btn btn-info btn-xs" href="{{route('products.edit',[$p->id])}}"><i class="material-icons">edit</i></a>
					<button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#deleteModal{{$p->id}}"><i class="material-icons">delete</i></button>
					<button type="button" class="btn bg-grey waves-effect" data-toggle="modal" data-target="#detailModal{{$p->id}}" style="padding: 4px 8px;"><small>Detail</small></button>

					<!-- Modal Delete -->
		            <div class="modal fade" id="deleteModal{{$p->id}}" tabindex="-1" role="dialog">
		                <div class="modal-dialog modal-sm" role="document">
		                    <div class="modal-content modal-col-red">
		                        <div class="modal-header">
		                            <h4 class="modal-title" id="deleteModalLabel">Delete Product</h4>
		                        </div>
		                        <div class="modal-body">
		                           Delete this paket
		                        <div class="modal-footer">
		                        	<form action="{{route('products.destroy',[$p->id])}}" method="POST">
										@csrf
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit" class="btn btn-link waves-effect">Delete</button>
										<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
									</form>
		                        </div>
		                    </div>
		                </div>
		            </div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>

@endsection