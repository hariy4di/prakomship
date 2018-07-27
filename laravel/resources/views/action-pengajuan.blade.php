<center>


@if($level=='01')
	<span class="dropdown">
		<button class="btn btn-success btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
			<i class="fa fa-check"></i>
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="javascript:;" id="{{ $id }}" class="proses-pengajuan">Proses ke Verifikator</a></li>
		</ul>
	</span>
@elseif($level=='02')
	<span class="dropdown">
		<button class="btn btn-success btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
			<i class="fa fa-check"></i>
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="javascript:;" id="{{ $id }}" class="proses-draft">Proses ke Administrator</a></li>
			<li><a href="javascript:;" id="{{ $id }}" class="tolak-pengajuan">Kembalikan ke Operator</a></li>
		</ul>
	</span>
@elseif($level=='00')
	<span class="dropdown">
		<button class="btn btn-success btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
			<i class="fa fa-check"></i>
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="javascript:;" id="{{ $id }}" class="proses-terbit">Terbitkan Peraturan</a></li>
			<li><a href="javascript:;" id="{{ $id }}" class="tolak-draft">Kembalikan ke Verifikator</a></li>
		</ul>
	</span>
@endif


@if(($status_id=='1' || $status_id=='5') && $level=='01')
	<a href="javascript:;" class="btn btn-primary btn-xs ubah" title="Ubah Data?" id="{{ $id }}">
		<i class="fa fa-pencil"></i>
	</a>
@endif


	<a href="{{ url('/data/peraturan/'.$nm_file) }}" class="btn btn-warning btn-xs" title="Download?" target="_blank">
		<i class="fa fa-download"></i>
	</a>
</center>