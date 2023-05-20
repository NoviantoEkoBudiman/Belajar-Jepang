@extends('index')

@section('main')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');


    .container{
        transform-style: preserve-3d;
    }

    .container .box{
        position: relative;
        width: 300px;
        height: 300px;
        margin: 20px;
        transform-style: preserve-3d;
        perspective: 1000px;
        cursor: pointer;
    }

    .container .box .body{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transition: 0.9s ease;
    }

    .container .box .body .imgContainer{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        background-image: linear-gradient(to bottom right, #00C0FF, #4218B8);
        padding: 20px;
    }

    .container .box .body .imgContainer img{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .container .box .body .content{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #333;
        backface-visibility: hidden;
        transform-style: preserve-3d;
        transform: rotateY(180deg);
    }

    .container .box:hover .body{
        transform: rotateY(180deg);
    }

    .container .box .body .content div{
        transform-style: preserve-3d;
        padding: 20px;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(to bottom right, #0100EC, #FB36F4);
        transform: translateZ(100px);
    }

    .container .box .body .content div h3{
        letter-spacing: 1px;
    }
</style>

{{-- @dd($card) --}}

<div class="container d-flex align-items-center justify-content-center flex-wrap">
    @if($card)
        <div class="box">
            <div class="body">
                <div class="imgContainer">
                    <h3 class="text-white fs-5">Question</h3>
                    <p class="fs-6 text-white">{{ $card->cards_question }}</p>
                </div>
                <div class="content d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <h3 class="text-white fs-5">Answer</h3>
                        <p class="fs-6 text-white">{{ $card->cards_answer }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div>
            Congratulation, you've finish the game!<br/>
            <a href="{{ route('finish',Request::segment(2)) }}" type="button" class="btn btn-outline-primary">Finish</a>
        </div>
    @endif
</div>

    <br>

    @if($card)
        <div class="container bg-light">
            <div class="col-md-12 text-center">
                {{-- <a type="button" class="btn btn-outline-info">Flip</a> --}}
                <a href="{{ url("/next/".Request::segment(2)."/".@$card->cards_id) }}" type="button" class="btn btn-outline-primary">Next</a>
            </div>
        </div>
    @endif
@endsection