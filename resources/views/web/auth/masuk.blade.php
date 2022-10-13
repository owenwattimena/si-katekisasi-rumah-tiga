@extends('web.templates.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mb-5">
            <h4 class="mt-5 mb-3">MASUK</h4>
            <form action="{{ route('masuk.post') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control rounded-0" id="username" name="username" placeholder="Username" required>
                            @error('nik')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control rounded-0" id="password" name="password" placeholder="Kata Sandi" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-5">
                        <button type="submit" class="btn w100 btn-primary form-control rounded-0 my-3 mb-5">MASUK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
