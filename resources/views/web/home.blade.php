@extends('web.templates.index')
@section('style')
    <style>
        @media (min-width: 768px) { 
            .carousel-inner{
                height: 430px;
            }
         }
    </style>
@endsection
@section('content')
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://www.gkikotawisata.org/wp-content/uploads/2022/08/140822-KR.jpeg" class="d-block w-100" alt="...">
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <section class="content">
                <h1>KATEKISASI</h1>
                {!! (count($beranda) > 0) ? $beranda->beranda : '' !!}
            </section>
        </div>
    </div>
</div>
@endsection
