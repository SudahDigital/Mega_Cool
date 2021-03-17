@extends('layouts.master')
@section('title') Group Paket List @endsection
@section('content')
@if(session('status'))
	<div class="alert alert-success">
		{{session('status')}}
	</div>
@endif

<form action="{{route('products.index')}}">
	<div class="row">
		<div class="col-md-12">
			<a href="{{route('groups.create')}}" class="btn bg-cyan pull-right">Create Group Paket</a>
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
				<th>Display Name</th>
				<th>Product Group</th>
				<th>Status</th>
				<th width="25%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($groups as $p)
			<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>{{$p->group_name}}</td>
				<td>{{$p->display_name}}</td>
				<td align="left">
					<ul style="margin-left: -25px;">
						@foreach($p->item_active as $p_group)
						<li><small>{{$p_group->Product_name}}</small></li>
						@endforeach
					</ul>
					<button type="button" class="btn bg-deep-purple btn-xs waves-effect" data-toggle="modal" data-target="#addItemModal{{$p->id}}">
						<i class="material-icons" style="font-size: 1em;">add</i><small>Add item</small> 
					</button>
					<!-- Modal add item -->
		            <div class="modal fade" id="addItemModal{{$p->id}}" tabindex="-1" role="dialog">
		                <div class="modal-dialog" role="document">
		                    <div class="modal-content">
		                        <div class="modal-header">
		                            <h4 class="modal-title" id="deleteModalLabel">Add Item Group</h4>
		                        </div>
		                        <div class="modal-body">
									<form action="{{route('groups.add_item')}}" method="POST">
										@csrf
										<input type="hidden" name="group_id" value="{{$p->id}}">
										<select class="products" multiple="multiple" name="product_id[]" style="width: 100%;">
											@foreach ($products_list as $product_list)
												<option value="{{ $product_list->id }}">
													{{ $product_list->Product_name }}
												</option>
											@endforeach
										</select>
								<div class="modal-footer">
		                        		<button type="submit" class="btn bg-teal waves-effect">Add</button>
										<button type="button" class="btn bg-grey waves-effect" data-dismiss="modal">Close</button>
									</form>
		                        </div>
		                    </div>
		                </div>
		            </div>
				</td>
				<td>
					@if($p->status=="INACTIVE")
					<span class="badge bg-dark text-white">{{$p->status}}</span>
						@else
					<span class="badge bg-green">{{$p->status}}</span>
					@endif

				</td>
				<td>
					<a class="btn btn-info btn-xs" href="{{route('groups.edit',[$p->id])}}"><i class="material-icons">edit</i></a>
					<button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#deleteModal{{$p->id}}"><i class="material-icons">delete</i></button>
					
					<!-- Modal Delete -->
		            <div class="modal fade" id="deleteModal{{$p->id}}" tabindex="-1" role="dialog">
		                <div class="modal-dialog modal-sm" role="document">
		                    <div class="modal-content modal-col-red">
		                        <div class="modal-header">
		                            <h4 class="modal-title" id="deleteModalLabel">Delete Group</h4>
		                        </div>
		                        <div class="modal-body">
		                           Delete this group
		                        <div class="modal-footer">
		                        	<form action="{{route('groups.destroy',[$p->id])}}" method="POST">
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
@section('footer-scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(".products").select2({
            width: 'resolve' // need to override the changed default
        });

    </script>

@endsection