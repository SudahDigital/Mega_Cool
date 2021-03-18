@extends('layouts.master')
@section('title') Edit Group Paket @endsection
@section('content')
    <!-- Modal add item -->
    <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Item Group</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('groups.update',[$groups->id])}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <select class="products" multiple="multiple" name="product_id[]" style="width: 100%;" required>
                            @foreach ($products_list as $product_list)
                                <option value="{{ $product_list->id }}">
                                    {{ $product_list->Product_name }}
                                </option>
                            @endforeach
                        </select>
                </div>
                <div class="modal-footer">
                        <button type="submit" name="save_action" value="ADD" class="btn bg-teal waves-effect">Add</button>
                        <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(session('status_group'))
        <div class="alert alert-success">
            {{session('status_group')}}
        </div>
    @endif
    <!-- Form Create -->
    <form id="form_validation" method="POST" enctype="multipart/form-data" action="{{route('groups.update',[$groups->id])}}">
    	@csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="group_name" value="{{$groups->group_name}}" autocomplete="off" required readonly>
                <label class="form-label">Group Name</label>
            </div>
            <label id="name-error" class=""></label>
            <small class=""></small>
        </div>
        
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="display_name"  value="{{$groups->display_name}}" autocomplete="off" required>
                <label class="form-label">Display Name</label>
            </div>
        </div>
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
        <div class="card">
            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Status</th>
                            <th>ON Display</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups->products as $p)
                            <tr>
                                <td>
                                    {{$p->Product_name}}
                                </td>
                                <td>
                                    {{$p->pivot->status}}
                                </td>
                                <td>
                                    @if($p->pivot->status == 'ACTIVE')
                                        <span class="label bg-teal">ON</span>
                                    @else
                                        <span class="label bg-red">OFF</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#deleteModal{{$p->pivot->id}}"><i class="material-icons">delete</i></button>
                                    <button type="button" class="btn bg-{{$p->pivot->status == 'ACTIVE' ? 'orange' : 'cyan'}} btn-xs" data-toggle="modal" data-target="#activeModal{{$p->pivot->id}}"><small>{{$p->pivot->status == 'ACTIVE' ? 'DEACTIVATE' : 'ACTIVATE'}}</small></button>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal{{$p->pivot->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content modal-col-red">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Item</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Delete this item ?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('groups.update',[$groups->id])}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="del_id" value="{{$p->pivot->id}}">
                                                        <button type="submit" name="save_action" value="DELETE_ITEM" class="btn-link waves-effect">Delete</button>
                                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal deactivate -->
                                    <div class="modal fade" id="activeModal{{$p->pivot->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content modal-col-{{$p->pivot->status == 'ACTIVE' ? 'orange' : 'cyan'}}">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{$p->pivot->status == 'ACTIVE' ? 'Deactivate Item' : 'Activate Item'}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {{$p->pivot->status == 'ACTIVE' ? 'Deactivate this item ?' : 'Activate this item ?'}}
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('groups.update',[$groups->id])}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="{{$p->pivot->status == 'ACTIVE' ? 'deactivate_id' : 'activate_id'}}" value="{{$p->pivot->id}}">
                                                        <button type="submit" name="save_action" value="{{$p->pivot->status == 'ACTIVE' ? 'DEACTIVATE' : 'ACTIVATE'}}" class="btn btn-link waves-effect">{{$p->pivot->status == 'ACTIVE' ? 'DEACTIVATE' : 'ACTIVATE'}}</button>
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
                <button type="button" class="btn bg-deep-purple waves-effect" data-toggle="modal" data-target="#addItemModal" style="margin-left:20px;margin-bottom:20px;">
                    <i class="material-icons" style="font-size:1.2em;">add</i>Add item 
                </button>
            </div>
        </div>
        <button class="btn btn-primary" name="save_action" id="save" value="UPDATE" type="submit" style="margin-top:20px;">UPDATE</button>
        <a href="{{route('groups.index')}}" class="btn bg-grey" style="margin-top:20px;margin-left:10px;">LIST GROUP</a>
    </form>
    <!-- #END#  -->		

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