@extends('landing')


@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="card-block">

          <form method="POST" action="{{ url('survei') }}">
          @csrf
          
          @for($i = 0; $i < count($rowsTanya); $i++)
            
            <div class="row" align="justify">
              <div class="col-md-7">
                <div class="form-group" align="justify">
                  <strong>
                    <label>{{ $rowsTanya[$i]->id."." }}</label>
                    <label>{{ $rowsTanya[$i]->deskripsi }}</label>
                  </strong>
            
                  @if($rowsTanya[$i]->jenis == '1')
                    <br>
                    <input type="text" id="{{ $rowsTanya[$i]->id }}" name="{{ $rowsTanya[$i]->id }}" required>

                  @elseif($rowsTanya[$i]->jenis == '2')
                    <br>
                    <select id="usia" name="{{ $rowsTanya[$i]->id }}" class="form-control chosen" required></select>

                  @elseif($rowsTanya[$i]->jenis == '3')
                    <br>
                    <span class="radio" style="margin-right:25px;">
                      <label><input type="radio" value="1" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Tidak Puas</label>
                    </span>
                    <span class="radio" style="margin-right:25px;">
                      <label><input type="radio" value="2" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Kurang Puas</label>
                    </span>
                    <span class="radio" style="margin-right:25px;">
                      <label><input type="radio" value="3" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Cukup Puas</label>
                    </span>
                    <span class="radio" style="margin-right:25px;">
                      <label><input type="radio" value="4" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Puas</label>
                    </span>
                    <span class="radio" style="margin-right:25px;">
                      <label><input type="radio" value="5" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Sangat Puas</label>
                    </span>

                  @elseif($rowsTanya[$i]->jenis == '4')
                    <br>
                      <div class="radio">
                        <input type="radio" name="18" value='Ya' required="required">Ya
                      </div>
                      <div class="radio">
                        <input type="radio" name="18" value='Tidak' required="required">Tidak
                      </div>
                      <input type="text" id="txtoptional" name="txtoptional" required>
                  @endif

                </div>
              </div>
            </div>

          @endfor

            <button type="submit" value="SUBMIT">SUBMIT</button>
          </form>

        </div>
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

      jQuery('input[name="18"]').click(function(e) {
            if(e.target.value === 'Ya') {
              jQuery('#txtoptional').show();
            } else {
              jQuery('#txtoptional').hide();
            }
      })
          jQuery('#txtoptional').hide();
    });
</script>
@endsection