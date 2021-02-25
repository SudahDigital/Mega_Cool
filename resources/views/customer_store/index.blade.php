@extends('layouts.master')
@section('title') Customer List @endsection
@section('content')
@if(session('status'))
	<div class="alert alert-success">
		{{session('status')}}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger">
		{{session('error')}}
	</div>
@endif

<form action="{{route('customers.index')}}">
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
				<li role="presentation" class="{{Request::get('status') == NULL && Request::path() == 'customers' ? 'active' : ''}}">
					<a href="{{route('customers.index')}}" aria-expanded="true" >All</a>
				</li>
				<li role="presentation" class="{{Request::get('status') == 'active' ?'active' : '' }}">
					<a href="{{route('customers.index', ['status' =>'active'])}}" >ACTIVE</a>
				</li>
				<li role="presentation" class="{{Request::get('status') == 'nonactive' ?'active' : '' }}">
					<a href="{{route('customers.index', ['status' =>'nonactive'])}}">NON ACTIVE</a>
				</li>
			</ul>
		</div>
		<div class="col-md-6">&nbsp;</div>
		<div class="col-md-12">
			<a href="{{route('customers.import')}}" class="btn btn-success ">Import Excel (<small>New</small>) </a>&nbsp;
			<a href="{{route('customers.export')}}" class="btn btn-success ">Export Excel </a>&nbsp;
			<a href="{{route('customers.create')}}" class="btn bg-cyan">Create Customer</a>
		</div>
	</div>
</form>	
<hr>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover dataTable js-basic-example">
		<thead>
			<tr>
				<th>No</th>
				<th>Search Key</th>
				<th>Name</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Contact Person</th>
				<th>Payment Term</th>
				<th>Sales Rep</th>
				<th>Status</th>
				<th width="10%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($customers as $c)
			<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>
					@if($c->store_code)
					{{$c->store_code}}
					@else
					-
					@endif
				</td>
				<td>{{$c->store_name}}</td>
				<td>{{$c->address}}</td>
				<td>{{$c->phone}}</td>
				<td>{{$c->name}}</td>
				<td>{{$c->payment_term}}</td>
				<td>@if($c->user_id > 0)
					{{$c->users->name}}
					@else
					-
					@endif
				</td>
				<td>
					@if($c->status=="NONACTIVE")
					<span class="badge bg-red text-white">{{$c->status}}</span>
						@else
					<span class="badge bg-green">{{$c->status}}</span>
					@endif

				</td>
				<td>
					<a class="btn btn-info btn-xs" href="{{route('customers.edit',[$c->id])}}"><i class="material-icons">edit</i></a>&nbsp;
					<button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#deleteModal{{$c->id}}"><i class="material-icons">delete</i></button>&nbsp;
					<!-- Modal Delete -->
		            <div class="modal fade" id="deleteModal{{$c->id}}" tabindex="-1" role="dialog">
		                <div class="modal-dialog modal-sm" role="document">
		                    <div class="modal-content modal-col-red">
		                        <div class="modal-header">
		                            <h4 class="modal-title" id="deleteModalLabel">Delete Customer</h4>
		                        </div>
		                        <div class="modal-body">
		                           Delete this customer ..? 
		                        </div>
		                        <div class="modal-footer">
		                        	<form action="{{route('customers.delete-permanent',[$c->id])}}" method="POST">
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