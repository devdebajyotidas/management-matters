@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <div class="container-fluid">
        <?php  $old_license=(session()->has('license')) ? session('license') : 1 ?>
        <!-- row -->
        <div class="white-box m-t-15">
            <div class="row ">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Purchase Licences
                            <label class="pull-right text-success payable-amount" >Payable Amount: &#36; {{$old_license * config('constants.BASE_PRICE')}}</label>
                        </div>
                        <div class="panel-body" >
                            <form class="form-horizontal" action="{{url('subscription/').'/'.$organization->id.'/process'}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="licenses">Licenses:</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="licenses" id="licenses" placeholder="Number of License" value="{{$old_license}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="name">Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name on Card" value="{{isset($organization->name_on_card) ? $organization->name_on_card : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="number">Card No:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="number" id="number" placeholder="Credit Card Number" value="{{isset($organization->card_number) ? $organization->card_number : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="expdate">Expiry Date:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="expdate" id="expdate" placeholder="YYYY-MM" value="{{isset($organization->expiry_date) ? $organization->expiry_date : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="cvv">CVV:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="cvv" id="cvv" placeholder="CVV" value="{{isset($organization->cvv) ? $organization->cvv : ''}}">
                                    </div>
                                </div>
                                <div class="form-group discount-text" style="display: none">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <span class="text-primary"></span>
                                        <label class="text-success m-t-10"></label>
                                    </div>
                                </div>
                                <div class="hidden">
                                    <input type="hidden" name="interval" value="{{isset($organization->subscription->billing_interval) ? $organization->subscription->billing_interval : ''}}">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success pull-right">Pay Now</button>
                                        <a class="btn btn-default pull-right m-r-10" href="{{url('organizations/').'/'.$organization->id.'/learners'}}">Go Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {
            $('#licenses').on('keyup',function(){
                var price="{{config('constants.price')}}";
                var discount="{{config('constants.discount')}}";
                var discountabove="{{config('constants.discountabove')}}";
                var licence=$(this).val();
                var amount=price*licence;
                if(parseInt(licence) >= parseInt(discountabove) ){
                    var discounted=parseFloat(amount*(discount/100));
                    amount=amount-discounted;
                    $('.discount-text').show().find('span').html('Applid '+discount+"% discount on bulk purchase of "+discountabove+" or more licenses" )
                    $('.discount-text').find('label').html('You saved &#36;'+ parseFloat(discounted).toFixed(2))
                }
                else{
                    $('.discount-text').hide().fadeOut('fast').find('span').html('');
                }
                $('.payable-amount').html('Payable Amount: &#36;'+amount);
            });

            @if(session()->has('success') || session('success'))
            setTimeout(function () {
                showToast('Success', '{{ session('success') }}', 'success');
            }, 500);
            @endif

            @if(isset($errors) && count($errors->all()) > 0 && $timeout = 700)
            @foreach ($errors->all() as $key => $error)
            setTimeout(function () {
                showToast('Error', '{{ $error }}', 'error');
            }, {{ $timeout * $key }});
            @endforeach
            @endif
        }
    </script>
@endsection