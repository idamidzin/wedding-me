@extends('management.layouts.main')
@section('title', 'Hadiah')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-sm-6">
						<form action="" method="GET">
							<div class="row">
								<div class="col-sm-6">
									<select name="for" class="form-control">
										<option @if($for == 'cpp') selected @endif value="cpp">Calon Pengantin Pria (CPP)</option>
										<option @if($for == 'cpw') selected @endif value="cpw">Calon Pengantin Wanita (CPW)</option>
										<option @if($for == 'kita') selected @endif value="cpw">Kita Bersama</option>
									</select>
								</div>
								<div class="col-sm-6">
									<button type="submit" class="btn btn-warning btn-md text-white">Tampilkan</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-6 text-right">
						<a href="{{ route('mgt.gift.create') }}?for=kita" class="btn btn-warning btn-sm">Tambah Hadiah KITA</a>
						<a href="{{ route('mgt.gift.create') }}?for=cpp" class="btn btn-primary btn-sm">Tambah Hadiah CPP</a>
						<a href="{{ route('mgt.gift.create') }}?for=cpw" class="btn btn-info btn-sm">Tambah Hadiah CPW</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				@if( session('msg') )
				<?php $msg = session('msg'); ?>
				<div class="alert alert-{{ $msg['type'] }} alert-remove">
					{!! $msg['text'] !!}
				</div>
				@endif
				<div class="table-responsive">
					<table id="table" class="table table-bordered table-hover table-sm" width="100%">
						<tfoot id="search">
							<tr>
								<th>No</th>
								<th class="text-center">Aksi</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Untuk</th>
								<th class="text-center">Jumlah</th>
							</tr>
						</tfoot>
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama</th>
								<th>Untuk</th>
								<th>Jumlah</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($gifts as $row)
							<tr>
								<td class="text-center">{{ $loop->iteration }}</td>
								<td class="text-left">{{ $row->name }} </td>
								<td class="text-center">
									{{ $row->for }}
								</td>
								<td class="text-right" style="font-size: 18px;">{{ 'Rp ' . number_format($row->amount, 0, ',', '.') }} </td>
								<td class="text-center" width="150px">
									<a href="{{ route('mgt.gift.edit', $row->id) }}" class="btn btn-success btn-sm mt-1 mb-1"><i class="fas fa-edit"></i></a>
									<button type="button" class="btn btn-sm btn-danger btn-delete mt-1 mb-1" data-id="{{ $row->id }}"><i class="fas fa-trash"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<script>

	$(document).ready(function() {
		$('#table thead tr').clone(true).appendTo( '#table thead' );
		$('#table thead tr:eq(1) th').each( function (i) {
			var title = $(this).text();

			if (title !== 'No' && title !== 'Aksi') {
				$(this).html('<input class="form-control" style="font-size:13px;" type="text" placeholder="Cari" />' );
			}else{
				$(this).html('');
			}

			$('input', this).on('keyup change', function () {
				if (table.column(i).search() !== this.value) {
					table
					.column(i)
					.search(this.value)
					.draw();
				}
			});
		});

		var table = $('#table').DataTable( {
			orderCellsTop: true,
			fixedHeader: true,
			pageLength: 100,
			lengthMenu: [100, 200, 300, 400],
		});

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).on('click','.btn-delete', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			Swal.fire({
				title: 'Hapus Hadiah?',
				text: 'Data hadiah akan dihapus!',
				icon: 'warning',
				showLoaderOnConfirm: true,
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Ya, Hapus!',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Batal',
				preConfirm: () => {
					return fetch('gift/'+ id, {
						headers: {
							"X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
						},
						method: 'delete'
					}).then(res => {
						if (!res.ok) {
							throw new Error(res.statusText);
						}
						return res.json();
					}).catch(err => console.error(err));
				},
				allowOutsideClick: () => !Swal.isLoading()
			}).then(function(result) {
				if (result.value) {
					Swal.fire({
						title: 'Terhapus!',
						text: 'Data hadiah telah dihapus.',
						icon: 'success',
						onClose: function() {
							location.reload();
						}
					});
				}
			});
		});

	});

</script>
@endpush
