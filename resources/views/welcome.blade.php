<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
<style>
    *{
        width: 100%;
        padding-top: 30px;
        height: 50px;
        margin: auto;
    }
    /* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
    .flip-card {
        /* background-color: transparent; */
        width: 300px;
        height: 200px;
        /* border: 1px solid #f1f1f1; */
        perspective: 1000px; /* Remove this if you don't want the 3D effect */
    }
  
    /* This container is needed to position the front and back side */
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }
  
    /* Do an horizontal flip when you move the mouse over the flip box container */
    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }
  
    /* Position the front and back side */
    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden; /* Safari */
        backface-visibility: hidden;
    }
  
    /* Style the front side (fallback if image is missing) */
    .flip-card-front {
        background-color: rgb(79, 230, 117);
        color: black;
    }
  
    /* Style the back side */
    .flip-card-back {
        background-color: dodgerblue;
        color: white;
        transform: rotateY(180deg);
    }

    .tengah{
        margin-top: 100%;
    }

    .btn {
        line-height: 50px;
        height: 50px;
        text-align: center;
        width: 250px;
        cursor: pointer;
    }
</style>
<div class="flip-card">
    <div class="flip-card-inner">
      <div class="flip-card-front">
        <h1><span style="font-family: 'Noto Sans JP', sans-serif;" class="tengah">{{ $kanji->kanji_hiragana }}</span></h1>
      </div>
      <div class="flip-card-back">
        <h1><span style="font-family: 'Noto Sans JP', sans-serif;" class="tengah">{{ $kanji->kanji_show }}</span></h1>
      </div>
    </div>
</div>
<div class="box-1">
    <div class="btn btn-one">
        <form action="{{ url('next') }}" type="post">
            <input type="hidden" value="{{ $kanji->kanji_id }}" name="kanji_id">
            <button type="submit">Next</button>
        </form>
    </div>
</div>