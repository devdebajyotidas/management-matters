@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <div class="container-fluid">
        <canvas id="world" style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;"></canvas>
        <div class="row m-t-20">
            <div class="hidden">
                <input type="hidden" class="award-flag" value="{{count($awards) > 0 ? 1 : 0}}">
            </div>
            <div class="col-md-12">
                <ul class="timeline">
                    @if(isset($awards))
                        @foreach($awards as $num=>$award)
                            <li class="{{(($num % 2)==0) ? ' ': 'timeline-inverted' }}">
                                <div class="timeline-badge ">
                                    <img class="img-responsive" alt="user" src="{{asset('assets/img/title.png')}}">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{ $award->title }}</h4>
                                        <p>
                                            <small class="text-muted"><i class="fa fa-clock-o"></i> {{ $award->created_at->format('m/d/Y') }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection