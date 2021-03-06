@extends('landing')


@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-form">Silakan mengisi survei singkat di bawah ini</h4>
      </div>
      <div class="card-body">
        <div class="card-block">

          <form class="form" id="form-survei">
          <input type="hidden" name="_token" id="_token">
          
          @for($i = 0; $i < count($rowsTanya); $i++)
            
            <div class="row" align="justify">
              <div class="col-md-7">
                <div class="form-group" align="justify">
                  <strong>
                    <label>{{ $rowsTanya[$i]->id }}.</label>
                    <label>{{ $rowsTanya[$i]->deskripsi }}</label>
                  </strong>
            
                  @if($rowsTanya[$i]->jenis == '1')
                    <br>
                    
                    @if($rowsTanya[$i]->id == 3 || $rowsTanya[$i]->id == 4)
                      <input type="text" id="{{ $rowsTanya[$i]->id }}" name="{{ $rowsTanya[$i]->id }}" class="form-control round val_num" required>
                    @else
                      <input type="text" id="{{ $rowsTanya[$i]->id }}" name="{{ $rowsTanya[$i]->id }}" class="form-control round" required>
                    @endif

                  @elseif($rowsTanya[$i]->jenis == '2')
                    <br>
                    <select id="usia" name="{{ $rowsTanya[$i]->id }}" class="form-control chosen" required></select>

                  @elseif($rowsTanya[$i]->jenis == '3')
                    <br>
                    <span class="radio" style="margin-right:50px;">
                      <label><input type="radio" value="1" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Tidak Puas</label>
                    </span>
                    <span class="radio" style="margin-right:50px;">
                      <label><input type="radio" value="2" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Kurang Puas</label>
                    </span>
                    <span class="radio" style="margin-right:50px;">
                      <label><input type="radio" value="3" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Cukup Puas</label>
                    </span>
                    <span class="radio" style="margin-right:50px;">
                      <label><input type="radio" value="4" name="{{ $rowsTanya[$i]->id }}" id="radio-{{ $rowsTanya[$i]->id }}" required="required"> Puas</label>
                    </span>
                    <span class="radio" style="margin-right:50px;">
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

            <button type="submit" class="btn btn-primary" id="simpan"><i class="icon-check2"></i> SUBMIT</button>
            <!-- <button type="submit" value="SUBMIT">SUBMIT</button> -->
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

      jQuery('#simpan').click(function(){
        jQuery('#simpan').html('Loading...');
        jQuery('#simpan').prop('disabled',true);
        jQuery.get('token', function(token){
          if(token){
              jQuery('#_token').val(token);
              var data=jQuery('#form-survei').serialize();
              jQuery.ajax({
                  url:'survei',
                  method:'POST',
                  data:data,
                  success:function(result){
                      if(result=='success'){
                          jQuery('#simpan').html('Simpan');
                          jQuery('#simpan').prop('disabled',false);
                          window.location.href='./';
                      }
                      else{
                          jQuery('#simpan').html('Simpan');
                          jQuery('#simpan').prop('disabled',false);
                          alertify.log(result);
                      }   
                  },
                  error:function(result){
                      jQuery('#simpan').html('Simpan');
                      jQuery('#simpan').prop('disabled',false);
                      alertify.log(result);
                  }
              });
          }
          else{
              jQuery('#simpan').html('Simpan');
              jQuery('#simpan').prop('disabled',false);
              alertify.log('Proses simpan gagal. Silahkan refresh halaman browser Anda!');
          }
        });
      });

    });
</script>
@endsection