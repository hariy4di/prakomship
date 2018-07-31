<table>
	<thead>
		<tr>
			<th>Nomor Peraturan</th>
			<th>Tahun</th>
			<th>Tentang</th>
		</tr>
	</thead>
	<tbody>
	
	@foreach($datas as $data)
		<tr>
			<td>{{ $data->nomor }}</td>
			<td>{{ $data->tahun }}</td>
			<td>{{ $data->tentang }}</td>
		</tr>
	@endforeach

	</tbody>
</table>