@extends('layouts.master')

@push('header')
    @include('components.header')
@endpush()

@section('content')
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

    <div class="col-md-10 mx-auto mt-10">
        <div class="row mt-50 mb-50">
            <div class="col-md-3">
                <h4 class="filter-left text-express mb-40"><strong>Filter Options</strong></h4>
                <div class="card card_bg">
                    <div class="card-body">
                        <form action="" method="get">
                            @csrf
                            <select name="op" id="" class="mb-50">
                                <option selected value="">Select Operator</option>

                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->operator_id }}">{{ $operator->operator_name }}</option>
                                @endforeach
                            </select>

                            <select name="did" id="" class="">
                                <option value="" selected>Select Day</option>
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                                <option value="7">Sunday</option>
                            </select>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary countdown">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mx-auto">
                <h4 class="filter-left text-express table-responsive"><strong>Timetable</strong></h4>
                <table class="table table-borderless">
                    <thead class="register p-2 text-white">
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">GAME</th>
                            <th scope="col">DAY</th>
                            <th scope="col">CLOSING TIME</th>
                            <th scope="col">DRAW TIME</th>
                        </tr>
                    </thead>
                    <tbody class="express_table">
                        @foreach ($timetable as $timetables => $op)
                            <tr style="border-bottom: 2px solid #000;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ strtoupper($op['game_name']) }}</td>
                                <td>{{ $op['game_day'] }}</td>
                                <td>{{ date('h:i:s a', strtotime($op['end_time'])) }}</td>
                                <td>{{ date('h:i:s a', strtotime($op['start_time'])) }}</td>
                            </tr>                
                        @endforeach
                    </tbody>
                </table>
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
@endsection

@push('footer')
    @include('components.footer')
@endpush()
