@extends('landing')


@section('content')

<div class="content-header row">
</div>

<div class="content-body">
  <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
    <div class="px-2 py-3 row mb-0 mt-3">
      {{--<img class="img-fluid mx-auto d-block pb-3 pt-4 width-65-per" src="{{ asset('template/robust/app-assets/images/logo/robust-logo-dark-big.png') }}" alt="Robust Search">--}}
      <img class="img-fluid mx-auto d-block pb-3 pt-4" src="{{ asset('data/img/ship.png') }}" alt="Robust Search" height="88" width="88">
      <form id="form-cari" action="{{ url('/search') }}" method="get" class="form">
        @csrf
        <fieldset class="form-group position-relative">
          <input id="cari" type="text" name="q" value="{!! isset($_GET['q']) ? $_GET['q'] : null !!}" class="form-control form-control-lg input-lg" placeholder="Tanya Kami ..." required>
          <div class="form-control-position">
              <!-- <i class="icon-search7 font-medium-4"></i> -->
          </div>
        </fieldset>
        <div class="row py-2">
          <div class="col-xs-12 text-xs-center">
            <button class="btn btn-primary btn-md" id="btn-cari" type="submit">
              <i class="icon-ios-search-strong"></i> Pencarian Biasa
            </button>
            <!-- <button class="btn btn-warning btn-md" id="btn-lanjut" type="button">
              <i class="icon-smile"></i> Pencarian Lanjut
            </button> -->
            <!-- <span class="dropdown">
              <button id="btnSearchDrop" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-warning  btn-md dropdown-toggle dropdown-menu-right">
                <i class="icon-cog3"></i> Pencarian Lanjut
              </button>
              <span aria-labelledby="btnSearchDrop" class="dropdown-menu mt-1 dropdown-menu-right">
                  <a href="search-website.html" class="dropdown-item"><i class="icon-link4"></i> Web</a>
                  <a href="#" class="dropdown-item"><i class="icon-image4"></i> Images</a>
                  <a href="#" class="dropdown-item"><i class="icon-video2"></i> Videos</a>
                  <a href="#" class="dropdown-item"><i class="icon-map6"></i> Maps</a>
                  <span class="dropdown-divider block"></span>
                  <a href="#" class="dropdown-item"><i class="icon-smile"></i> I'm Feeling Lucky</a>
              </span>
            </span> -->
          </div>
        </div>
      </form>
      <div class="row py-1">
        <div class="text-xs-center">
          <a href="{{ $facebook }}" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="icon-facebook3"></span></a>
          <a href="{{ $twitter }}" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="icon-twitter3"></span></a>
          <!-- <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span class="icon-linkedin3 font-medium-4"></span></a>
          <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github"><span class="icon-github font-medium-4"></span></a> -->
        </div>
      </div>
    </div>
  </div>

</div>

@endsection


@section('script')

<script>
    jquery(document).ready(function(){

        jQuery('#btn-cari').click(function() {
            if(jQuery('#cari').val() === ''){
                alert('Kolom pencarian tidak boleh kosong.');
                return false;
            }
        });

    });
</script>

@endsection