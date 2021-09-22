@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header lead">
                        <p>{{ $parcel->weight }} kg.</p>

                        <small> phone: {{ $parcel->phone }} </small>
                    </div>

                    <div class="card-body justify-content-between shadow-wrapper pt-3">
                        {!! $parcel->info !!}
                        <hr>
                        <p>{{$parcel->getPost->town}} {{$parcel->getPost->code}}</p>
                        <form method="GET" action="{{ route('parcel.pdf', [$parcel]) }}">
                            <div class="btn-group mt-5 d-flex justify-content-between ">
                                @csrf
                                <div><a href="{{ URL::previous() }}" class="btn btn-dark btn-md"><i class="fas fa-arrow-left mr-2"></i>BACK</a></div>
                                <div><a href="{{ route('parcel.edit', [$parcel]) }}"
                                    class="btn btn-dark btn-md"><i
                                    class="fas fa-user-edit mr-2"></i>EDIT</a></div>
                                <div><button type="submit" class="btn btn-dark btn-md"><i class="far fa-file-pdf mr-2"></i>PDF</button></div>
                                
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title'){{ $parcel->weight }} @endsection