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
        			<p class="text-muted font-small-3">Terdapat {{ $jml }} hasil pencarian<!-- (0.58 seconds) --></p>
        			<ul class="media-list row" id="jar">

        			@if(count($rows) > 0)

        				@foreach($rows as $result)

        				<li class="media search-list">
        					<div class="media-body">
        						<p class="lead mb-0">
        							<a href="{{ url('/search-result/'.$result->id) }}">
        								<span class="text-bold-600">{{ $result->nomor }}</span> tentang
        								{{ strip_tags($result->tentang) }}
        							</a>
        						</p>
        						<p>
	                            	<span class="text-muted">{{ $result->updated_at }} - </span>
	                            	{{ strip_tags(substr($result->abstrak,0,88)) }}...
	                            </p>
	                        </div>
        				</li>

        				@endforeach

        				<div class="text-xs-center">
        					<nav class="pagination" aria-label="Page navigation"></nav>
        				</div>

        			@else

        				<li class="media">
        					<div class="media-body">
        						<p>Hasil pencarian dengan kata kunci "{!! $_GET['q'] !!}" tidak ditemukan.</p>
        					</div>
        				</li>

        			@endif

        			</ul>
        		</div>
        		<div class="col-lg-4">
        			<div class="card border-grey border-lighten-2">
        				<div class="card-block">
	                        <h4 class="card-title">Lima Peraturan Terbaru</h4>
	                        <ul class="list-group">

	                        @foreach($new_peraturan as $peraturan)
	                            <li class="list-group-item">
	                            	<strong>{{ $peraturan->nomor }}</strong> tentang
	                            	<a href="{{ url('/search-result/'.$peraturan->id) }}" class="card-link">
	                            		{{ $peraturan->tentang }}
	                            	</a>
	                            	<br>
	                            	<span style="font-size:12px;">
	                            		<em>diposting pada {{ $peraturan->tgl_update }}</em>
	                            	</span>
	                            </li>
	                        @endforeach

	                        </ul>
	                    </div>
        			</div>
        		</div>
        	</div>
	    </div>
	</section>
</div>

@endsection


@section('script')

<script>
	jQuery(document).ready(function(){
		
		// Number of items and limits the number of items per page
	    var numberOfItems = $("#jar .search-list").length;
	    var limitPerPage = 5;
	    // Total pages rounded upwards
	    var totalPages = Math.ceil(numberOfItems / limitPerPage);
	    /* Number of buttons at the top, not counting prev/next, but including the dotted buttons.
	       Must be at least 5: */
	    var paginationSize = 10; 
	    var currentPage;

	    function showPage(whichPage) {
	        if (whichPage < 1 || whichPage > totalPages) return false;
	        currentPage = whichPage;
	        $("#jar .search-list").hide()
	            .slice((currentPage-1) * limitPerPage, 
	                    currentPage * limitPerPage).show();
	        // Replace the navigation items (not prev/next):
	        $(".pagination li").slice(1, -1).remove();
	        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
	            $("<li>").addClass("page-item")
	                     .addClass(item ? "current-page" : "disabled")
	                     .toggleClass("active", item === currentPage).append(
	                $("<a>").addClass("page-link").attr({
	                    href: "javascript:void(0)"}).text(item || "...")
	            ).insertBefore("#next-page");
	        });
	        // Disable prev/next when at first/last page:
	        $("#previous-page").toggleClass("disabled", currentPage === 1);
	        $("#next-page").toggleClass("disabled", currentPage === totalPages);
	        return true;
	    }

	    // Include the prev/next buttons:
	    $(".pagination").append(
	        $("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
	            $("<a>").addClass("page-link").attr({
	                href: "javascript:void(0)"}).text("Prev")
	        ),
	        $("<li>").addClass("page-item").attr({ id: "next-page" }).append(
	            $("<a>").addClass("page-link").attr({
	                href: "javascript:void(0)"}).text("Next")
	        )
	    );
	    // Show the page links
	    $("#jar").show();
	    showPage(1);

	    // Use event delegation, as these items are recreated later    
	    $(document).on("click", ".pagination li.current-page:not(.active)", function () {
	        return showPage(+$(this).text());
	    });
	    $("#next-page").on("click", function () {
	        return showPage(currentPage+1);
	    });

	    $("#previous-page").on("click", function () {
	        return showPage(currentPage-1);
	    });

	});
</script>

@endsection
