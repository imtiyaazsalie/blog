@extends('layouts.app')
@section('page-css')
    <style>
        .wrap {
            width: 250px;
            height: 50px;
            background: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border-radius: 10px;
        }
        .stars {
            width: fit-content;
            margin: 0 auto;
            cursor: pointer;
        }
        .star {
            color: #0085A1 !important;
        }
        .rate {
            height: 50px;
            margin-left: -5px;
            padding: 5px;
            font-size: 25px;
            position: relative;
            cursor: pointer;
        }
        .rate input[type="radio"] {
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,0%);
            pointer-events: none;
        }
        .star-over::after {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 16px;
            content: "\f005";
            display: inline-block;
            color: #01afd4;
            z-index: 1;
            position: absolute;
            top: 17px;
            left: 10px;
        }

        .rate:nth-child(1) .face::after {
            content: "\f119"; /* ☹ */
        }
        .rate:nth-child(2) .face::after {
            content: "\f11a"; /* 😐 */
        }
        .rate:nth-child(3) .face::after {
            content: "\f118"; /* 🙂 */
        }
        .rate:nth-child(4) .face::after {
            content: "\f580"; /* 😊 */
        }
        .rate:nth-child(5) .face::after {
            content: "\f59a"; /* 😄 */
        }
        .face {
            opacity: 0;
            position: absolute;
            width: 35px;
            height: 35px;
            background: #0085A1;
            border-radius: 5px;
            top: -50px;
            left: 2px;
            transition: 0.2s;
            pointer-events: none;
        }
        .face::before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            content: "\f0dd";
            display: inline-block;
            color: #0085A1;
            z-index: 1;
            position: absolute;
            left: 9px;
            bottom: -15px;
        }
        .face::after {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            display: inline-block;
            color: #fff;
            z-index: 1;
            position: absolute;
            left: 5px;
            top: -1px;
        }

        .rate:hover .face {
            opacity: 1;
        }
    </style>
@endsection
@section('content')


    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <h2>{!! $post->title !!}</h2>
                    <p>{!! $post->body !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="btn-group" role="group">
                        <a href="/blog" class="btn btn-secondary">Go back</a>
                        @if(auth()->check() && auth()->user()->id == $post->user_id)
                            <a href="/blog/{{ $post->id }}/edit" class="btn btn-secondary">Edit</a>
                            <form id="delete-form" class="" action="/blog/{{ $post->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-secondary">Delete</button>
                            </form>
                        @endif
                    </div>
                    <div class="wrap">
                        <div class="stars">
                            <label class="rate">
                                <input type="radio" name="radio1" id="star1" value="1">
                                <div class="face"></div>
                                <i class="far fa-star star one-star"></i>
                            </label>
                            <label class="rate">
                                <input type="radio" name="radio1" id="star2" value="2">
                                <div class="face"></div>
                                <i class="far fa-star star two-star"></i>
                            </label>
                            <label class="rate">
                                <input type="radio" name="radio1" id="star3" value="3">
                                <div class="face"></div>
                                <i class="far fa-star star three-star"></i>
                            </label>
                            <label class="rate">
                                <input type="radio" name="radio1" id="star4" value="4">
                                <div class="face"></div>
                                <i class="far fa-star star four-star"></i>
                            </label>
                            <label class="rate">
                                <input type="radio" name="radio1" id="star5" value="5">
                                <div class="face"></div>
                                <i class="far fa-star star five-star"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <hr>

@endsection

@section('page-js')
    <script>
        $(function() {

            $(document).on({
                mouseover: function(event) {
                    $(this).find('.far').addClass('star-over');
                    $(this).prevAll().find('.far').addClass('star-over');
                },
                mouseleave: function(event) {
                    $(this).find('.far').removeClass('star-over');
                    $(this).prevAll().find('.far').removeClass('star-over');
                }
            }, '.rate');


            $(document).on('click', '.rate', function() {
                if ( !$(this).find('.star').hasClass('rate-active') ) {
                    $(this).siblings().find('.star').addClass('far').removeClass('fas rate-active');
                    $(this).find('.star').addClass('rate-active fas').removeClass('far star-over');
                    $(this).prevAll().find('.star').addClass('fas').removeClass('far star-over');
                } else {
                    console.log($( "input[type=radio]:checked" ).val());
                }
            });

        });

    </script>
@endsection
