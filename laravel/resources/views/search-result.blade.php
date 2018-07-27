@extends('landing')


@section('content')

<div class="content-body"><!-- Search form-->
	<section id="search-website" class="card overflow-hidden">
		<div class="card-body collapse in">
	    	<div class="card-block pb-0">
	    		<form id="form-cari" action="{{ url('/search') }}" method="get" class="form">
	    			@csrf
		            <fieldset class="form-group position-relative mb-0">
		                <input id="cari" type="text" name="q" value="{!! isset($_GET['q']) ? $_GET['q'] : null !!}" class="form-control form-control-lg input-lg" required>
		                <div class="form-control-position">
		                    <!-- <i class="icon-microphone2 font-medium-4"></i> -->
		                </div>
		            </fieldset>
		        </form>
	        </div>

	        <!--Search Result-->
        	<div id="search-results" class="card-block">
        		<div class="col-lg-8">
        			<ul class="media-list row">

        			@if(count($row) > 0)

        				<li class="media search-list">
        					<div class="media-body">
        						<p class="lead mb-0">
        							<span class="text-bold-600">{{ $row[0]->nomor }}</span> tentang
        							<span class="text-bold-600">{{ strip_tags($row[0]->tentang) }}</span>
        						</p>
        						<p>
	                            	<span class="text-muted">{{ $row[0]->updated_at }} - </span>
	                            	{{ strip_tags($row[0]->abstrak) }}
	                            </p>
	                        </div>
	                        <a href="{{ url('data/peraturan/'.$row[0]->nama_file) }}"
	                           class="btn btn-primary btn-md"
	                           target="_blank">
	                        	<i class="icon-download5"></i> Download
	                        </a>
        				</li>
        				<div class="py-1 text-xs-center">
                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="icon-facebook3"></span></a>
                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="icon-twitter3"></span></a>
                        </div>

        			@else

        				<li class="media">
        					<div class="media-body">
        						<p>Dokumen peraturan tidak ditemukan.</p>
        					</div>
        				</li>

        			@endif

        			</ul>
        		</div>
        		<div class="col-lg-4">
        			<div class="card border-grey border-lighten-2">
        				<div class="card-block">
	                        <h4 class="card-title">Peraturan Terbaru</h4>
	                    </div>
	                    <!-- <div class="card-block">
	                        <ul class="list-group">
	                            <li class="list-group-item"><strong>Website :</strong> <a href="#" class="card-link">https://pixinvent.com/</a></li>
	                            <li class="list-group-item"><strong>Customer service :</strong> 022 8888 9999</li>
	                            <li class="list-group-item"><strong>Founder :</strong> PIXINVENT</li>
	                            <li class="list-group-item"><strong>Founded :</strong> 2017</li>
	                            <li class="list-group-item"><strong>Support:</strong> <a href="#">support@pixinvent.com</a></li>
	                        </ul>
	                    </div> -->
        			</div>
        		</div>
        	</div>
	    </div>
	</section>
</div>

@endsection
