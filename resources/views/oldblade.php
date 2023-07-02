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
            @foreach ($image as $show)
                <div class="carousel-item active">                    
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/images/'.$show->image) }}" class="d-block w-100" alt="...">
                        </div>                 
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

        <div class="col-md-10 mx-auto mt-10">
            <div class="row">
                <div class="col-md-12 mb-40">
                    <h4 class="text-express"><strong>Hot Numbers For Today</strong></h4>
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
                ?>
        @if(($opt_gm->game_id == $forecast_->game_id) && ($opt_gm->day_id == $forecast_->day_id) && ($_today_day == $_day))
                 <?php
                    // echo '1  '.$_forcast_current.'<br>  ';
                    // echo '2  '.$_compare_date.'<br>  ';
                    ?>
                        <?php
                                
                                $_end_time =strtotime($opt_gm->end_time);
                                // $_end_time =strtotime("2023-03-11 23:40:00");
                                // echo '<br>'.$_end_time;s
                                // $_current_time =strtotime(date("2023-03-11 8:00:00"));
                                $_current_time =strtotime(date("Y-m-d H:i:s"));
                                //    echo '<br>'.$_current_time; 
                                //    echo '<br>'.date("Y-m-d H:i:s");s
                                $_forcast_current = date(explode(" ", $forecast_->created_at)[0]);
                                // echo '<br>1'.$_forcast_current.'<br>';
                                // echo '<br>2'.date("Y-m-d");                                
                                
                        ?>
                                @if((($_end_time - $_current_time) > 0) && ($opt_gm->day_id == $forecast_->day_id) )

                                <?php
                                // echo '1 '.$_today_day.'<br>';
                                // echo '2 '.$_day.'<br>';
                                ?>
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
                                            <p class="fw-bold mb-0 mlhcolor">
                                            
                                    @foreach($operator_game as $opt_gm)                                      
                                        @if($opt_gm->game_id == $forecast_->game_id)
                                               {{$opt_gm->game_name}}
                                        @endif                                      
                                    @endforeach
                                            
                                        
                                        </p>
                                            <p class="fw-light mlhcolor">
                                            Draw Time: 
                                            @foreach($operator_game as $opt_gm)
                                        
                                        @if($opt_gm->game_id == $forecast_->game_id)
                                            <?php echo date("jS M, Y | h:ia", strtotime($opt_gm->end_time)) ?>
                                            @endif
                                        @endforeach
                                           </p>

                                           Option A<br />
                                           <div class="row">                                      
                                                <?php
                                                    $_option_a = preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $forecast_->option_a))));
                                                ?>

                                                @foreach ($_option_a as $key => $val)
                                                        <div class="col-2">
                                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                                <span>{{$val}}</span>
                                                            </div>
                                                        </div>
                                                @endforeach
                                          </div>

                                          Option B<br />
                                           <div class="row">                                      
                                                <?php
                                                    $_option_b = preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $forecast_->option_b))));
                                                ?>

                                                @foreach ($_option_b as $key => $val)
                                                        <div class="col-2">
                                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                                <span>{{$val}}</span>
                                                            </div>
                                                        </div>
                                                @endforeach
                                          </div>

                                          Option C<br />
                                           <div class="row">                                      
                                                <?php
                                                    $_option_c = preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $forecast_->option_c))));
                                                ?>

                                                @foreach ($_option_c as $key => $val)
                                                        <div class="col-2">
                                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                                <span>{{$val}}</span>
                                                            </div>
                                                        </div>
                                                @endforeach
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                              @foreach($operator_game as $opt_gm)
                                              @if(($opt_gm->game_id == $forecast_->game_id))
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

                                                @foreach($operator_game as $opt_gm)
                                                @if($opt_gm->game_id == $forecast_->game_id)
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

                                                @foreach($operator_game as $opt_gm)
                                                @if($opt_gm->game_id == $forecast_->game_id)
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
                                                
                                    </div>
                                </div>
<!----End-->

                                </div>
                            </div>
                        </div>
                             @endif
                          @endif
                        @endforeach
                      @endforeach
                    @endif              
                @endforeach
                @else
                <div class="alert alert-success">
                    <strong>Forecast Numbers Dropping Soon</strong>
                </div>                                      
            @endif
               
            </div>
        </div>
@endsection

@push('footer')
    @include('components.footer')
@endpush()
