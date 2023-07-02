@extends('layouts.master')

@push('header')
    @include('components.header')
@endpush()

@section('content')
<style>
    .div_lgrey{
    background: rgba(0, 0, 0, 0.05) !important;
border-radius: 5px;
    color: #406777;
    padding: 20px;
}


.numboxgreen {
    border-radius: 50%;
    behavior: url(PIE.htc);
    width: 100%!important;
    height: 50px;
    padding: 14px;
    background: #27AE60;
    color: #FFF;
    text-align: center;
    font-size: 18px;
    border-radius: 50px;
}

.numboxred {
    border-radius: 50%; 
    behavior: url(PIE.htc);
    background: #FF0013;
    color: #FFF;
    text-align: center;
    border-radius: 5px;
    width: 50px;
    height: 50px;
    padding: 14px;
    font-size: 18px;
    border-radius: 50px;
}

.img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
}

@media(max-width:760px){
    .numboxred {
        font-size: 15px;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .numboxgreen {
        font-size: 15px;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .img-responsive {
    display: block;
    max-width: 40%;
    height: auto;
    margin: auto;
}

.countLotto div {
 text-align: center;
}

.countnext {
  margin-top: 20px;
}

.div_lgrey p {
  font-size: 15px!important;
}

br {
    display: none;
  }
}
</style>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach ($image as $index => $show)
                    <div class="carousel-item{{ $index == 0 ? ' active' : '' }}">
                        <img src="{{ asset('storage/images/'.$show->image) }}" class="d-block w-100" alt="...">
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

  <div class="container p-5">
      <h4 class="text-express mb-5"><strong>Latest Results</strong></h4>
      <table cellpadding="3">
            <tbody><tr>
                <td><table cellpadding="3">
                        <tbody><tr>
                            <td><div class="numboxgreen">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                            <td>Winning</td>
                        </tr>
                    </tbody></table></td>
                    <td><table cellpadding="3">
                        <tbody><tr>
                            <td><div class="numboxred">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                            <td>Machine</td>
                        </tr>
                    </tbody></table></td>
            </tr>
        </tbody>
    </table><br />
    <div class="clearfix"></div>
        <div class="div_lgrey" style='padding: 0px;'>
        <div class='row countLotto'>
        
            <div class='col-md-2 col-xs-4 mt-1' style='padding: 0px;'>
                <img src="{{ asset('logos/' . $operator[0]->operator_logo) }}" class="img-responsive">
            </div>
            <div class='col-md-6 col-xs-8' style='padding-top: 20px;'>
            @if($next_game)
                <strong>{{ $next_game->game_name }}</strong> <br /><br />
                {{ date('M d, Y | h:i:s a', strtotime($next_game->end_time)) }}<br /><br />
                <a  class="countdown p-2" target="_blank" href="https://www.mylottohub.com/play/plotto" class='btn btn-blue'>Play Now</a>
            @else
                <strong>No game available</strong>
            @endif
            </div>
            <div class='col-md-4 col-xs-12'>
            @if($next_game)
                <table cellpadding='10' width='100%'>
                    <tr>
                        <th><p class="countdown countnext p-2" align='center'>Countdown to Next Game Draw</p></th>
                    </tr>
                    <tr>
                        <td align='center'  class="next_margin"><br/><br/>
                            <span align="center" data-countdown="{{ date('Y/m/d H:i:s', strtotime($next_game->end_time)) }}"></span>
                        </td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>

          
    <div class="row mt-5">
  @if(count($results) >= 1)
    @php $game_name = ''; @endphp
    @foreach($results as $result)
      @php
        $game_name = '';
        foreach($operator_games as $opt_gm) {
          if($opt_gm->game_id == $result->game_id && $opt_gm->operator == $result->operator_id) {
            $game_name = $opt_gm->game_name;
            break;
          }
        }
      @endphp
      @if ($game_name != '')
        <div class='col-sm-4 mb-4'>
          <div class="div_lgrey">
            <p align='center'><strong>{{ $game_name }}</strong></p><br />
            <p align='center'><small>Draw Time: {{ date('M d, Y | h:i:s a', strtotime($result->created_at)) }}</small></p><br />
            <?php
              $winning_num = preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $result->winning_num))));
              $machine_num = preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $result->machine_num))));
            ?>
            <table cellpadding="3" align="center">
              <tbody>
                <tr>
                  @foreach($winning_num as $win_num)
                    <td>
                      <div class="numboxgreen">{{ $win_num }}</div>
                    </td>
                  @endforeach
                </tr>
                <tr>
                  @foreach($machine_num as $mac_num)
                    @if ($mac_num === '0')
                      <td>
                        <div class="numboxred mb-3"></div>
                      </td>
                    @else
                      <td>
                        <div class="numboxred mb-3">{{ $mac_num }}</div>
                      </td>
                    @endif
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      @endif
    @endforeach
  @else
</div>

                <div class="alert alert-success">
                    <strong>Results Dropping Soon</strong>
                </div>                                      
            @endif
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
<script>
    $('[data-countdown]').each(function() {
         var $this = $(this),
             finalDate = $(this).data('countdown');
         $this.countdown(finalDate, function(event) {
            $this.html(event.strftime("<small><span class='countdown_box'>%D days</span> <span class='countdown_box'>%H hrs</span> <span class='countdown_box'>%M mins</span> <span class='countdown_box'>%S secs</span></small>"));
         });
     });
 </script>



@endsection

@push('footer')
    @include('components.footer')
@endpush()
