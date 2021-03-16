@extends('layouts.master')
@section('title') Create Group Paket @endsection
@section('content')

	@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
		</div>
	@endif
	<!-- Form Create -->
    <form id="form_validation" method="POST" enctype="multipart/form-data" action="{{route('groups.store')}}">
    	@csrf
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="group_name" autocomplete="off" required>
                <label class="form-label">Group Name</label>
            </div>
        </div>
        
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="display_name" autocomplete="off" required>
                <label class="form-label">Display Name</label>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="product0">
                            <td>
                                <select name="products[]" id="sl0" class="products" style="width: 100%;">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->Product_name }}
                                        </option>
                                    @endforeach   
                                </select>
                            </td>
                        </tr>
                        <tr id="product1"></tr>
                    </tbody>
                </table>
                <div class="col-md-12">
                    <button id="add_row" class="btn bg-light-green waves-effect">+ Add Row</button>
                    <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                </div>
            </div>
            <div class="row">
            </div>
        </div>

        <div id="test">
            <div id="tooltest0" class="tooltest0">
                <label>Tool Name :</label>
                <select class="toollist" name="FSR_tool_id[]" id="FSR_tool_id0" style="width: 350px" />
                <option></option>
                <option value="1">bla 1</option>
                </select>
            </div>
            <div id="tool-placeholder"></div>
            <div>
                <input type="button" value="Add another" />
            </div>
        </div>
       
        <button class="btn btn-primary  " name="save_action" value="SAVE" type="submit">SAVE</button>
    </form>
    <!-- #END#  -->		

@endsection
@section('footer-scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    /*
     $('.products').select2();
    $(document).ready(function(){
        let row_number = 1;
        $("#add_row").click(function(e){
        $('.products').select2('destroy');
 
        e.preventDefault();
        let new_row_number = row_number - 1;
        $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
        $('#products_table').append('<tr id="product' + (row_number + 1) + '">\
            <select name="products[]" id="sl0" class="products" style="width: 100%;">\
                                    @foreach ($products as $product)\
                                        <option value="{{ $product->id }}">\
                                            {{ $product->Product_name }}\
                                        </option> @endforeach </select>\
        </tr>');
        //$('#sl'+row_number ).select2({});
        row_number++;
        //$('.products').select2();
        });

        $("#delete_row").click(function(e){
        e.preventDefault();
        if(row_number > 1){
            $("#product" + (row_number - 1)).html('');
            row_number--;
        }
        });
    });
   */

   $('.toollist').select2({ //apply select2 to my element
    placeholder: "Search your Tool",
    allowClear: true
});


$('input[type=button]').click(function () {
    $('.toollist').select2('destroy');
    
    //$('.toollist').select2("destroy");
    var noOfDivs = $('.tooltest0').length;
    var clonedDiv = $('.tooltest0').first().clone(true);
    clonedDiv.insertBefore("#tool-placeholder");
    clonedDiv.attr('id', 'tooltest' + noOfDivs);
    

    $('.toollist').select2({ //apply select2 to my element
        placeholder: "Search your Tool",
        allowClear: true
    });



});
    
</script>
@endsection