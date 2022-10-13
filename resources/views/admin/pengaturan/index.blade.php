@extends('admin.templates.template')

@section('body')
<section class="content-header">
    <h1>
        Pengaturan
        {{-- <small>Data Daftar Hadir</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-cog"></i> Pengaturan</li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-bor`er">
            <h3 class="box-title">Pengaturan</h3>
        </div>
        <div class="box-body">
            <form action="{{ route('admin.pengaturan.post') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-flat" style="margin-bottom: 15px">SIMPAN</button>
                <textarea id="editor1" name="beranda" rows="10" cols="80">{!! count($pengaturan) > 0 ? $pengaturan[0]->beranda : '' !!}</textarea>
            </form>
        </div>
    </div>
</section>
@endsection


@section('script')
<script src="{{ asset('assets/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
    })

</script>
@endsection
