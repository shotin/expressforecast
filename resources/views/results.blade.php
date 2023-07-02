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

.numboxwhite {
    /* border-radius: 50%; */
    behavior: url(PIE.htc);
    padding: 20px;
    color: #406777;
    text-align: center;
    font-size: 28px;
    width: 90px;
    height: 90px;
    border: 3px solid #406777;
    box-sizing: border-box;
    border-radius: 50px;
    display: flex;
        justify-content: center;
        align-items: center;
}

.img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
}
@media(max-width:760px){
    .numboxwhite {
        font-size: 15px;
        width: 50px;
        height: 50px;
        border-radius: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .allresults div {
    text-align: center;
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
      
      @if(count($resultsByOperator) >= 1)
    @foreach ($resultsByOperator as $operator_id => $operator_results) 
        <div class="div_lgrey" style='padding: 0px;'>
            <div class='row mt-5 allresults'>
                <div class='col-md-2 col-xs-4'>
                    @foreach($operators as $opt)
                        @if($opt->operator_id == $operator_id)
                            <img src="{{asset('logos/'.$opt->operator_logo)}}" class="img_thumbnail mt-5 ml-1">   
                        @endif
                    @endforeach        
                </div>
                <div class='col-md-6 col-xs-8' style='padding-top: 20px;'>
                    

                    @php
                            $game_name = '';
                            foreach($operator_games as $opt_gm) {
                                if($opt_gm->operator == $operator_id && $opt_gm->game_id == $operator_results[0]->game_id) {
                                    $game_name = $opt_gm->game_name;
                                    break;
                                }
                            }
                        @endphp
                        <strong>{{ $game_name }}</strong>
                    <p>Draw Time: {{ date('M d, Y | h:i:s a', strtotime($operator_results[0]->created_at)) }}</p>
                    <br /><br />
                    <?php
                        $winning_num =  preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $operator_results[0]->winning_num))));
                        $machine_num =  preg_split("/[,]/", str_replace('"', '', str_replace(']', '', str_replace('[', '', $operator_results[0]->machine_num))));
                    ?>
                    <table cellpadding="3" align="center">
                        <tbody>
                            <tr>
                            @foreach($winning_num as $win_num)
                                <td>
                                    <div class="numboxwhite">{{$win_num}}</div>
                                </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-right p-3">
                
                           @php
                             $game_more = 'View More>>';
                            foreach($operator_games as $opt_gm) {
                                if($opt_gm->operator == $operator_id && $opt_gm->game_id == $operator_results[0]->game_id) {
                                    $game_name = $opt_gm->game_name;
                                    break;
                                }
                            }
                        @endphp
                       
                        <a class="text-dark" href="{{ route('viewmore', ['operator_id' => $operator_id]) }}"><small style="font-weight:bolder">{{ $game_more }}</small></a> 
              
            </div>
        </div>
    @endforeach
         @else
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
<script src="{{asset('js/main-js.js')}}"></script>
@endsection

@push('footer')
    @include('components.footer')
@endpush()
