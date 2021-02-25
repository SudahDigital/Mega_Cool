@extends('layouts.master')
@if(Route::is('users.edit'))
    @section('title') Edit User @endsection
    @section('content')

        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <!-- Form Create -->
        <form id="form_validation" method="POST" enctype="multipart/form-data" action="{{route('users.update',[$user->id])}}">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" value="{{$user->name}}" name="name" autocomplete="off" required>
                    <label class="form-label">Name</label>
                </div>
            </div>
            
            <!--
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" value="{{$user->username}}" name="username" autocomplete="off" required disabled>
                    <label class="form-label">UserName</label>
                </div>
            </div>
            -->
            <h2 class="card-inside-title">Status</h2>
            <div class="form-group">
                <input type="radio" value="ACTIVE" name="status" id="ACTIVE" {{$user->status == 'ACTIVE' ? 'checked' : ''}}>
                <label for="ACTIVE">ACTIVE</label>
                                &nbsp;
                <input type="radio" value="INACTIVE" name="status" id="INACTIVE" {{$user->status == 'INACTIVE' ? 'checked' : ''}}>
                <label for="INACTIVE">INACTIVE</label>
            </div>

            <h2 class="card-inside-title">Roles</h2>
            <div class="form-group">
                <input 
                type="radio"
                {{in_array("SUPERADMIN", json_decode($user->roles)) ? "checked" : ""}} 
                name="roles[]" 
                class="form-control {{$errors->first('roles') ? "is-invalid" : "" }}"
                id="ADMIN" 
                value="SUPERADMIN"> 
                <label for="ADMIN">Super Admin</label>

                <input 
                type="radio"
                {{in_array("ADMIN", json_decode($user->roles)) ? "checked" : ""}} 
                name="roles[]" 
                class="form-control {{$errors->first('roles') ? "is-invalid" : "" }}"
                id="STAFF" 
                value="ADMIN"> 
                <label for="STAFF">Admin</label>

                <div class="invalid-feedback">
                    {{$errors->first('roles')}}
                </div>
                
            </div>

            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" value="{{$user->phone}}" name="phone" minlength="10" maxlength="12" autocomplete="off" required>
                    <label class="form-label">Phone Number</label>
                </div>
                <div class="help-info">Min.10, Max. 12 Characters</div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <textarea name="address" rows="4" class="form-control no-resize" placeholder="Address" autocomplete="off" required>{{$user->address}}</textarea>
                </div>
            </div>

            <h2 class="card-inside-title">Avatar Image</h2>
            <div class="form-group">
            <div class="form-line">
                @if($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" width="120px"/>
                @else
                No Avatar
                @endif
                <input type="file" name="avatar" class="form-control" id="avatar" autocomplete="off">
                </div>
            </div>

            <div class="form-group form-float">
                <div class="form-line">
                    <input type="email" value="{{$user->email}}" class="form-control" name="email" autocomplete="off" disabled="disabled" required>
                    <label class="form-label">Email</label>
                </div>
            </div>

            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>&nbsp;
            <a href="{{route('users.index')}}" class="btn bg-deep-orange waves-effect" >&nbsp;CLOSE&nbsp;</a>
        </form>

        <!-- #END#  -->		

    @endsection
@endif

@if(Route::is('sales.edit'))
    @section('title') Edit Sales @endsection
    @section('content')

        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <!-- Form Create -->
        <form id="form_validation" method="POST" enctype="multipart/form-data" action="{{route('sales.update',[$user->id])}}">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" value="{{$user->name}}" name="name" autocomplete="off" required>
                    <label class="form-label">Name</label>
                </div>
            </div>
            
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" value="{{$user->phone}}" name="phone" minlength="10" maxlength="13" autocomplete="off" required>
                    <label class="form-label">Phone Number</label>
                </div>
                <div class="help-info">Min.10, Max. 13 Characters</div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <address><small><b>Address</b></small></address>
                    <textarea name="address" rows="2" class="form-control no-resize" placeholder="Address" id="address" autocomplete="off" required>{{$user->address}}</textarea>
                </div>
            </div>

            <div class="form-group form-float">
                <div class="form-line">
                    <input type="email" value="{{$user->email}}" class="form-control" name="email" autocomplete="off" disabled="disabled" required>
                    <label class="form-label">Email</label>
                </div>
            </div>

            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="sales_area" value="{{$user->sales_area}}"autocomplete="off" required>
                    <label class="form-label">Sales Area</label>
                </div>
            </div>
            <!--
            <small><b>Sales Area</b></small>
            <select name="city_id"  id="city_id" class="form-control"></select>
            <br>
            <br>
            -->
            <!--
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" value="{{$user->username}}" name="username" autocomplete="off" required disabled>
                    <label class="form-label">UserName</label>
                </div>
            </div>
            -->
            <h2 class="card-inside-title">Status</h2>
            <div class="form-group">
                <input type="radio" value="ACTIVE" name="status" id="ACTIVE" {{$user->status == 'ACTIVE' ? 'checked' : ''}}>
                <label for="ACTIVE">ACTIVE</label>
                                &nbsp;
                <input type="radio" value="INACTIVE" name="status" id="INACTIVE" {{$user->status == 'INACTIVE' ? 'checked' : ''}}>
                <label for="INACTIVE">INACTIVE</label>
            </div>

            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>&nbsp;
            <a href="{{route('sales.index')}}" class="btn bg-deep-orange waves-effect" >&nbsp;CLOSE&nbsp;</a>
        </form>

        <!-- #END#  -->		

    @endsection
    
    @section('footer-scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            $('#city_id').select2({
            placeholder: 'Select an item',
            ajax: {
                url: '{{URL::to('/ajax/cities/search')}}',
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                                id: item.id,
                                text: item.city_name
                            
                        }
                    })
                };
                }
                
            }
            });

            var cities = JSON.stringify([{!! $user->cities !!}]);
            cities = JSON.parse(cities);
            cities.forEach(function(city){
            var option = new Option(city.city_name, city.id, true, true);
            $('#city_id').append(option).trigger('change');
            });
        </script>
    @endsection

@endif