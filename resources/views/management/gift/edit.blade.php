@extends('management.layouts.main')
@section('title', 'Tambah Hadiah')

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card card-outline card-blue">
            <div class="card-header">
                <h3 class="card-title" id="card-title">Hadiah Baru Untuk {{ $for }}</h3>
                <div class="card-tools">
                    <a href="{{ route('mgt.gift.index') }}" class="btn btn-default"><i class="fas fa-reply"></i> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('mgt.gift.update', $gift->id) }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="for" value="{{ $for }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nama<strong class="text-danger">*</strong></label>
                                <input type="text" name="name" value="{{ $gift->name }}" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah<strong class="text-danger">*</strong></label>
                                <input type="text" name="amount" value="{{ $gift->amount }}" class="form-control" placeholder="Jumlah Hadiah" id="rupiah" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat<strong class="text-danger"></strong></label>
                                <textarea name="address" class="form-control" placeholder="Tuliskan alamat lengkap">{{ $gift->address }}</textarea>
                            </div>
                            <div class="text-right pt-3">
                                <button type="reset" class="btn btn-danger">Reset</button>&nbsp;
                                <button type="submit" class="btn btn-primary" id="btn-store">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp.');
    });

    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
    }
</script>
@endpush
