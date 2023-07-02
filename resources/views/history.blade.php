@extends('layouts.master')

@push('header')
@include('components.header')
@endpush()

@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <!--<div class="carousel-inner">-->
    <!--    @foreach ($image as $index => $show)-->
    <!--  <div class="carousel-item{{ $index == 0 ? ' active' : '' }}">-->

    <!--                    <img src="{{ asset('storage/images/'.$show->image) }}" class="d-block w-100" alt="...">-->

    <!--            </div>-->
    <!--        @endforeach-->
    <!--</div>-->
    <div class="carousel-inner">
        @foreach ($image as $index => $show)
        <div class="carousel-item{{ $index == 0 ? ' active' : '' }}">
            <!--<a href="{{$show->link}}" target="_blank" class="w-100">-->
            <!--  <img src="{{ asset('storage/images/'.$show->image) }}" class="d-block w-100" alt="...">-->
            <!--</a>-->
            <a href="{{$show->link}}" target="_blank" class="w-100">
                <img src="{{ asset('public/storage/images/'.$show->image) }}" class="d-block w-100" alt="...">
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

<div class="col-md-10 mx-auto mt-10">
    <div class="row">
        <div class="col-md-12 mb-2">
            <h4 class="text-express"><strong>Winning History</strong></h4>
        </div>
        <div class="col-md-12 p-2">
            <form action="" method="get">
                <div class="row">
                    @csrf
                    <div class="col-md-3">
                        <select name="op" id="operatorHistory" class="mb-50">
                            <option selected value="">Select Operator</option>

                            @foreach ($operators as $operator)
                            <option value="{{ $operator->operator_id }}">{{ $operator->operator_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">

                        <select name="did" id="whereGameName" class="mb-50">
                            <option selected value="">--Select Game--</option>
                        </select>

                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary countdown filter">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="showOnLoad2" style="display: none;" class="row">

        </div>

        <div id="showOnLoad" style="display: flex;" class="row">
            @foreach($results as $result)
            @php
            $forecast = \App\Models\forecast::where('game_id', $result->game_id)
            ->where('day_id', $result->day_id)
            ->whereDate('created_at', $result->created_at->toDateString())
            ->first();
            @endphp
            @if($forecast)
            <div class="table-responsive col-sm-6 mb-5">
                <table cellpadding="5" class="table table-hover table-striped">
                    <tr>
                        <td><strong>Operator: </strong></td>

                        <td>{{ $result->gamedetails->operator_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Game: </strong></td>
                        <td>{{ $result->gamedetails->game_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date:</strong></td>
                        <td>{{ $result->created_at->format('jS M Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Result:</strong></td>
                        <td>
                            <div class="row px-3">
                                <div class="col-sm-12 ">
                                    <div class="row">
                                        @if(str_contains($result->gamedetails->game_name, 'MACH') || str_contains($result->gamedetails->game_name, 'Mach'))
                                        @foreach($result->machine_num as $machineNumber)
                                        <div class="col-2">
                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $machineNumber }}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        @foreach($result->winning_num as $winningNumber)
                                        <div class="col-2">
                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $winningNumber }}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Option A:</strong></td>
                        <td>
                            <div class="row px-3">
                                <div class="col-12 mx-auto">
                                    <div class="row">
                                        @forelse($forecast->option_a as $aNumber)
                                        <div class="col-2">
                                            @if(in_array($aNumber, $result->machine_num))
                                            @if(str_contains($result->gamedetails->game_name, 'MACH') || str_contains($result->gamedetails->game_name, 'Mach'))
                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $aNumber }}</span>
                                            </div>
                                            @else
                                            <div class="border bg-danger text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $aNumber }}</span>
                                            </div>
                                            @endif
                                            @elseif(in_array($aNumber, $result->winning_num))
                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $aNumber }}</span>
                                            </div>
                                            @else
                                            <div class="border bg-danger text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $aNumber }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        @empty
                                        <span>No Option A Forecast</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Option B:</strong></td>
                        <td>
                            <div class="row px-3">
                                <div class="col-12 mx-auto">
                                    <div class="row">
                                        @forelse($forecast->option_b as $bNumber)
                                        <div class="col-2">
                                            @if(in_array($bNumber, $result->machine_num))
                                            @if(str_contains($result->gamedetails->game_name, 'MACH') || str_contains($result->gamedetails->game_name, 'Mach'))
                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $bNumber }}</span>
                                            </div>
                                            @else
                                            <div class="border bg-danger text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $bNumber }}</span>
                                            </div>
                                            @endif
                                            @elseif(in_array($bNumber, $result->winning_num))
                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $bNumber }}</span>
                                            </div>
                                            @else
                                            <div class="border bg-danger text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $bNumber }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        @empty
                                        <span>No Option A Forecast</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Option C:</strong></td>
                        <td>
                            <div class="row px-3">
                                <div class="col-12 mx-auto">
                                    <div class="row">
                                        @forelse($forecast->option_c as $cNumber)
                                        <div class="col-2">
                                            @if(in_array($cNumber, $result->machine_num))
                                            @if(str_contains($result->gamedetails->game_name, 'MACH') || str_contains($result->gamedetails->game_name, 'Mach'))
                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $cNumber }}</span>
                                            </div>
                                            @else
                                            <div class="border bg-danger text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $cNumber }}</span>
                                            </div>
                                            @endif
                                            @elseif(in_array($cNumber, $result->winning_num))
                                            <div class="border bg-success text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $cNumber }}</span>
                                            </div>
                                            @else
                                            <div class="border bg-danger text-white rounded-circle d-flex justify-content-center align-items-center square-smaller-circle">
                                                <span>{{ $cNumber }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        @empty
                                        <span>No Option A Forecast</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            @endif
            @endforeach
            <div class="col-12 text-center mb-5">
                {{ $results->links()}}
            </div>
        </div>

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
<script type="text/javascript">
    $('.filter').on('click', function() {
        $('#showOnLoad2').html('');

        var operatorHistory = document.getElementById("operatorHistory");
        var whereGameName = document.getElementById("whereGameName");
        var vm = $(this);
        if (operatorHistory.options[operatorHistory.selectedIndex].value !== '' && whereGameName.options[whereGameName.selectedIndex].value !== '') {
            $.ajax({
                url: "{{url('filter-game')}}",
                type: "post",
                dataType: 'json',
                data: {
                    operator_id: operatorHistory.options[operatorHistory.selectedIndex].value,
                    game_id: whereGameName.options[whereGameName.selectedIndex].value,

                    _token: "{{csrf_token()}}"
                },
                beforeSend: function() {
                    vm.text('Loading...').addClass('disabled');
                },
                success: function(res) {
                    var showOnLoad = document.getElementById('showOnLoad');
                    showOnLoad.style.setProperty('display', 'none');

                    var showOnLoad2 = document.getElementById('showOnLoad2');
                    showOnLoad2.style.setProperty('display', 'flex');
                    // alert(res);
                    var style_col = "col-sm-6";
                    if (res.length == 1) {
                        style_col = "col-sm-12"
                    }

                    if (res.length > 0) {
                        for (var i = 0; i < res.length; i++) {
                            var wining = '';
                            var opt_a = '';
                            var opt_b = '';
                            var opt_c = '';


                            var win = res[i].winning_num.toString().replace('[', '').replace(']', '').replaceAll('"', '').split(',');

                            var option_a = res[i].option_a.toString().replace('[', '').replace(']', '').replaceAll('"', '').split(',');
                            var option_b = res[i].option_b.toString().replace('[', '').replace(']', '').replaceAll('"', '').split(',');
                            var option_c = res[i].option_c.toString().replace('[', '').replace(']', '').replaceAll('"', '').split(',');

                            var check_1 = 0;
                            var check_2 = 0;
                            var check_3 = 0;

                            for (var ij = 0; ij < win.length; ij++) {
                                wining += '<div class="col-2"><div class="border bg-success text-white rounded-circle d-flex justify-content-center lign-items-center square-smaller-circle"><span>' + win[ij] + '</span></div></div>';

                                for (var aa = 0; aa < win.length; aa++) {

                                    if (option_a[ij] == win[aa]) {
                                        check_1 = 1;
                                    }
                                    if (option_b[ij] == win[aa]) {
                                        check_2 = 1;
                                    }
                                    if (ij < option_c.length) {
                                        if (option_c[ij] == win[aa]) {
                                            check_3 = 1;
                                        }
                                    }
                                }

                                if (check_1 == 1) {
                                    opt_a += '<div class="col-2"><div class="border bg-success text-white rounded-circle d-flex justify-content-center lign-items-center square-smaller-circle"><span>' + option_a[ij] + '</span></div></div>';
                                } else {
                                    opt_a += '<div class="col-2"><div class="border bg-danger text-white rounded-circle d-flex justify-content-center lign-items-center square-smaller-circle"><span>' + option_a[ij] + '</span></div></div>';
                                }


                                if (check_2 == 1) {
                                    opt_b += '<div class="col-2"><div class="border bg-success text-white rounded-circle d-flex justify-content-center lign-items-center square-smaller-circle"><span>' + option_b[ij] + '</span></div></div>';
                                } else {
                                    opt_b += '<div class="col-2"><div class="border bg-danger text-white rounded-circle d-flex justify-content-center lign-items-center square-smaller-circle"><span>' + option_b[ij] + '</span></div></div>';
                                }
                                if (ij < option_c.length) {
                                    if (check_3 == 1) {
                                        opt_c += '<div class="col-2"><div class="border bg-success text-white rounded-circle d-flex justify-content-center lign-items-center square-smaller-circle"><span>' + option_c[ij] + '</span></div></div>';
                                    } else {
                                        opt_c += '<div class="col-2"><div class="border bg-danger text-white rounded-circle d-flex justify-content-center lign-items-center square-smaller-circle"><span>' + option_c[ij] + '</span></div></div>';
                                    }
                                }

                                check_1 = 0;
                                check_2 = 0;
                                check_3 = 0;
                            }

                            var game_name = whereGameName.options[whereGameName.selectedIndex].text;

                            if (res[i].game_name !== '') {
                                game_name = res[i].game_name;
                            }

                            $('#showOnLoad2').append(`<div class="table-responsive mb-5 ` + style_col + `">
                                        <table cellpadding="5" class="table table-hover table-striped">
                                             <tr>
                                                  <td><strong>Operator: </strong></td>
                                                  <td>` + operatorHistory.options[operatorHistory.selectedIndex].text + `</td>
                                            </tr>
                                            <tr>
                                            <td><strong>Game: </strong></td>
                                    <td>` + game_name + `</td>
                                            </tr>
                                            
                                            <tr>
                                            <td><strong>Date:</strong></td>
                                    <td>` + res[i].created_at.toString().split(' ')[0] + `</td>
                                            </tr>
                                            <tr>
                                            <td><strong>Result:</strong></td>
                                    <td>
                                    <div class="row px-3">
                                            <div class="col-sm-12 ">
                                                <div class="row">` +
                                wining +
                                `                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                            </tr>


                                            <tr>
                                    <td><strong>Option A:</strong></td>           
                                    <td>
                                    <div class="row px-3">
                                            <div class="col-12 mx-auto">
                                                <div class="row">
                                                    ` +
                                opt_a +
                                `
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong>Option B:</strong></td>           
                                    <td>
                                    <div class="row px-3">
                                            <div class="col-12 mx-auto">
                                                <div class="row">
                                                    ` +
                                opt_b +
                                `
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong>Option C:</strong></td>           
                                    <td>
                                    <div class="row px-3">
                                            <div class="col-12 mx-auto">
                                                <div class="row">
                                                    ` +
                                opt_c +
                                `
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                
                                        </table>
                                       </div>`
                            );



                            wining = '';
                            opt_a = '';
                            opt_b = '';
                            opt_c = '';


                        }







                    } else {
                        $('#showOnLoad2').append(`<div style="margin:auto" class="text-center p-2 text-white mb-5 mx-auto bg-danger">Game not Found</div>`);
                    }
                    vm.text('Filter').removeClass('disabled');
                }
            });
        } else {
            alert('Please select game name');
        }

    });

    $("#operatorHistory").on('change', function() {
        var operatorHistory = document.getElementById("operatorHistory");
        // $("#res").text(operatorHistory.options[operatorHistory.selectedIndex].value);
        var vm = $(this);
        $.ajax({
            url: "{{url('select-game')}}",
            type: "post",
            dataType: "json",
            data: {
                operator_id: operatorHistory.options[operatorHistory.selectedIndex].value,
                _token: "{{csrf_token()}}"
            },
            beforeSend: function() {
                // operatorHistory.text('Loading...').addClass('disabled');
                var option = "<option value =''>Loading...</option>";
                $("#whereGameName").append(option);
            },

            success: function(res_) {
                $("#whereGameName").empty(); // clear existing options

                res = [...new Map(res_.map((m) => [m.game_id, m])).values()];
                var option = "<option value =''>--Select Game--</option><option value ='all'>All Games</option>";
                $("#whereGameName").append(option);
                for (var I = 0; I < res.length; I++) {
                    var option = "<option value ='" + res[I].game_id + "'> " + res[I].game_name + " </option>";
                    $("#whereGameName").append(option);
                }

                // $("#res").text(res.length);
            }


        });


    });
</script>


@endsection

@push('footer')
@include('components.footer')
@endpush()