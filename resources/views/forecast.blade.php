@extends('layouts.master')

@push('header')
@include('components.header')
@endpush()
<style>
    .play_now {
        margin-top: 130px;
    }

    @media (max-width: 992px) {
        .play_now {
            margin-top: 30px;
            display: none;
        }

        .play_now1 {
            display: none;
        }
    }

    @media(min-width: 992px) {
        .play_now {
            margin-top: 130px;
        }

    }
</style>

@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">
        @foreach ($image as $index => $show)
        <div class="carousel-item{{ $index == 0 ? ' active' : '' }}">
            <a href="{{$show->link}}" target="_blank" class="w-100">
                <img src="{{ asset('storage/images/'.$show->image) }}" class="d-block w-100" alt="...">
            </a>
        </div>
        @endforeach
    </div>


    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@php
$gameEndTime = strtotime($operator_game[count($operator_game) - 1]->end_time);
$currentTime = time();

$tomorrowStart = strtotime('tomorrow 12:00 AM');
$todayHotNumbers = ($gameEndTime <= strtotime('today 10:45 PM') && $gameEndTime> $tomorrowStart);
    $tomorrowHotNumbers = ($gameEndTime > strtotime('today 10:45 PM') && $gameEndTime < $tomorrowStart); @endphp <div class="col-md-10 mx-auto mt-10">
        <div class="row">
            <div class="col-md-12 mb-40">
                <h4 class="text-express">
                    <strong id="header">
                        @if ($todayHotNumbers)
                        Hot Numbers For Today
                        @elseif ($tomorrowHotNumbers)
                        Hot Numbers For Tomorrow
                        @endif
                    </strong>
                    <span id="countdown" style="display: none;"></span>
                </h4>
            </div>

            @if ($tomorrowHotNumbers)
            @php
            $countdownDate = strtotime('today 10:45 PM') + 2*3600 + 15*60;
            @endphp
            <span id="countdown" style="display: inline;"></span>
            <script>
                var now = new Date().getTime();
                var countdownDate = new Date("{{ $countdownDate }}").getTime();
                var distance = countdownDate - now;
                if (distance > 0) {
                    var countdownTimer = setInterval(function() {
                        now = new Date().getTime();
                        distance = countdownDate - now;
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        document.getElementById("countdown").innerHTML = "<br /><h1 style='text-align:center; text-transform:uppercase'>Game starts in " + hours + "h " + minutes + "m " + seconds + "s</h1>";
                        if (distance < 0) {
                            clearInterval(countdownTimer);
                            document.getElementById("countdown").innerHTML = "Game has started!";
                        }
                    }, 1000);
                } else {
                    document.getElementById("countdown").innerHTML = "Game has started!";
                }
            </script>
            @endif
        </div>
        </div>




        @if(count($forecast) >= 1)
        @foreach ($forecast as $key => $forecast_)

        <?php
        $_forcast_current = date(explode(" ", $forecast_->created_at)[0]);
        $_compare_date = date("Y-m-d");
        ?>

        @if($_forcast_current == $_compare_date)

        @foreach($operator_game as $opt_gm)
        @foreach($allDays as $_day)
        <?php
        $_today_date = strtotime(date('Y-m-d'));
        $_today_day = date('l', $_today_date);
        // echo $_day;
        ?>
        @if(($opt_gm->game_id == $forecast_->game_id) && ($opt_gm->day_id == $forecast_->day_id) && ($_today_day == $_day))
        <?php
        // echo '1  '.$_forcast_current.'<br>  ';
        // echo '2  '.$_compare_date.'<br>  ';
        ?>
        <?php

        $_end_time = strtotime($opt_gm->end_time);
        $_current_time = strtotime(date("Y-m-d H:i:s"));
        $_forcast_current = date(explode(" ", $forecast_->created_at)[0]);
        // echo $_end_time;
        ?>
        @if((($_end_time - $_current_time) > 0) && ($opt_gm->day_id == $forecast_->day_id))
        <div class="col-md-6">
            <div class="card mb-3 result_bg">
                <div class="card-body">
                    <!----Start-->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="imag-container mb-3 mt-5">
                                @foreach($operator as $opt)
                                @if($opt->operator_id == $forecast_->operator)
                                <img src="{{asset('logos/'.$opt->operator_logo)}}" alt="" class="img_thumbnail">
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-start align-items-center">
                            <div>
                                <p class="font-weight-bolder d mb-0 mlhcolor">

                                    @foreach($operator_game as $opt_gm)
                                    @if(($forecast_->game_id == $opt_gm->game_id) && ($opt_gm->day_id == $forecast_->day_id))
                                    {{$opt_gm->game_name}}
                                    @endif
                                    @endforeach

                                </p>
                                <p class="fw-light mlhcolor">
                                    Draw Time:
                                    @foreach($operator_game as $opt_gm)

                                    @if(($forecast_->game_id == $opt_gm->game_id) && ($forecast_->day_id == $opt_gm->day_id))
                                    <?php echo date("jS M, Y | h:ia", strtotime($opt_gm->end_time)) ?>

                                    @endif
                                    @endforeach
                                </p>

                                <?php
                                $_option_a = preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $forecast_->option_a))));
                                $_option_b = preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $forecast_->option_b))));
                                $_option_c = preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $forecast_->option_c))));
                                ?>


                                @if(count(array_intersect($_option_a, array('0'))) == 0)
                                Option A<br />
                                <div class="row">
                                    @foreach ($_option_a as $key => $val)
                                    <div class="col-2">
                                        <div class="border countdown text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                            <span>{{$val}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif

                                @if(count(array_intersect($_option_b, array('0'))) == 0)
                                Option B<br />
                                <div class="row">
                                    @foreach ($_option_b as $key => $val)
                                    <div class="col-2">
                                        <div class="border countdown text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                            <span>{{$val}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif

                                @if(count(array_intersect($_option_c, array('0'))) == 0)
                                Option C<br />
                                <div class="row">
                                    @foreach ($_option_c as $key => $val)
                                    <div class="col-2">
                                        <div class="border countdown text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                            <span>{{$val}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            @if(count(array_intersect($_option_a, array('0'))) == 0)
                            @foreach($operator_game as $opt_gm)
                            @if(($opt_gm->game_id == $forecast_->game_id) && ($opt_gm->day_id == $forecast_->day_id))
                            <div class="play_now">
                                <button class="countdown" type="button">
                                    @if ($opt_gm->operator == 42)
                                    <a href="https://goldenchancelotto.com/?RefferalCode=0q6ua5wm" target="_blank" class="text-white"> Play Now</a>
                                    @else
                                    <a href="https://www.mylottohub.com/welcome" target="_blank" class="text-white"> Play Now</a>
                                    @endif
                                </button>
                            </div>
                            @endif
                            @endforeach
                            @endif
                            @if(count(array_intersect($_option_b, array('0'))) == 0)
                            @foreach($operator_game as $opt_gm)
                            @if(($opt_gm->game_id == $forecast_->game_id) && ($opt_gm->day_id == $forecast_->day_id))
                            <div class="mt-3">
                                <button class="countdown" type="button">
                                    @if ($opt_gm->operator == 42)
                                    <a href="https://goldenchancelotto.com/?RefferalCode=0q6ua5wm" target="_blank" class="text-white"> Play Now</a>
                                    @else
                                    <a href="https://www.mylottohub.com/welcome" target="_blank" class="text-white"> Play Now</a>
                                    @endif
                                </button>
                            </div>
                            @endif
                            @endforeach
                            @endif
                            @if(count(array_intersect($_option_b, array('0'))) == 0)
                            @foreach($operator_game as $opt_gm)
                            @if(($opt_gm->game_id == $forecast_->game_id) && ($opt_gm->day_id == $forecast_->day_id))
                            <div class="play_now1 mt-3">
                                <button class="countdown" type="button">
                                    @if ($opt_gm->operator == 42)
                                    <a href="https://goldenchancelotto.com/?RefferalCode=0q6ua5wm" target="_blank" class="text-white"> Play Now</a>
                                    @else
                                    <a href="https://www.mylottohub.com/welcome" target="_blank" class="text-white"> Play Now</a>
                                    @endif
                                </button>
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif
        @endforeach
        @endforeach
        @endif
        @endforeach
        @endif

        </div>
        </div>
        <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('js/modernizr-3.6.0.min.js')}}"></script>
        <script src="{{asset('js/plugins.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/magnific-popup.min.js')}}"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('js/countdown.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-popover-x.min.js')}}"></script>
        <script src="{{asset('js/amd.js')}}"></script>
        <script src="{{asset('js/nice-select.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{asset('js/main-js.js')}}"></script>
        @endsection

        @push('footer')
        @include('components.footer')
        @endpush()