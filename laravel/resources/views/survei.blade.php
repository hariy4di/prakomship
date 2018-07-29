@extends('landing')


@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        @for($i = 0; $i < count($rowsTanya); $i++)
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{ $rowsTanya[$i]->deskripsi }}</label>
          
                  @if($rowsTanya[$i]->jenis == '1')

                  <br>
                  <input type="text" id="{{ $rowsTanya[$i]->id }}" name="{{ $rowsTanya[$i]->id }}">

                  @elseif($rowsTanya[$i]->jenis == '2')

                  <select id="usia" name="usia" class="form-control chosen"></select>

                  @else
                  
                  @endif
              </div>
            </div>
          </div>
        @endfor
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
    jQuery(document).ready(function(){
      jQuery('.chosen').chosen();

      jQuery.get('survei/usiaDropDown',function(result) {
        if(result) {
          jQuery('#usia').html(result).trigger('chosen:updated');
        }
      });
    });
</script>
@endsection