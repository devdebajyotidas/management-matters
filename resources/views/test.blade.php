<pre>
{{--{{ dd($org) }}--}}
    {{ ($org) }}
    <hr>
    {{--@foreach($org->departments as $deparment)--}}
        {{--{{ ($deparment->name) }} | {{ count($deparment->learners) }} | {{ ($deparment->learners_count) }}--}}

        {{--@foreach($deparment->learners as $learner)--}}
            {{--{{ $learner->name }}--}}
        {{--@endforeach--}}
        {{--<hr>--}}
    {{--@endforeach--}}
</pre>
