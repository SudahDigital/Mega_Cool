@extends('layouts.master')
@section('title') Create Paket @endsection
@section('content')

	@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
		</div>
	@endif
	<!-- Form Create -->
    <form id="form_validation" method="POST" enctype="multipart/form-data" action="{{route('paket.store')}}">
    	@csrf
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="paket_name" autocomplete="off" required>
                <label class="form-label">Paket Name</label>
            </div>
        </div>
        <h2 class="card-inside-title">Groups</h2>
        <select name="groups"  id="groups" class="form-control" required></select>
        <br>
        <br>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="display_name" autocomplete="off" required>
                <label class="form-label">Display Name</label>
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="bonus_quantity" autocomplete="off" required>
                <label class="form-label">Bonus Quantity</label>
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="purchase_quantity" autocomplete="off" required>
                <label class="form-label">Purchase Quantity</label>
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="price" autocomplete="off" required>
                <label class="form-label">Product Price /Box (IDR)</label>
            </div>
        </div>

        <button class="btn btn-primary waves-effect" name="save_action" value="PUBLISH" type="submit">PUBLISH</button>
    </form>
    <!-- #END#  -->		

@endsection

@section('footer-scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $('#groups').select2({
      placeholder: 'Select an item',
      ajax: {
        url: '{{URL::to('/ajax/groups/search')}}',
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                        id: item.id,
                        text: item.display_name
                      
                  }
              })
          };
        }
        
      }
    });
    </script>

@endsection