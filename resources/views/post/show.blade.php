@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header lead">
                        <p>{{ $post->town }} </p>

                        <p>  {{ $post->code }} </p>
                        <small> Amount of parcels: {{$post->getParcels->count()}} </small>
                    </div>

                    <div class="card-body justify-content-between shadow-wrapper pt-3">
                        @foreach ($parcels as $parcel)
                            @if ($parcel->post_id == $post->id)
                                
                            {{ $parcel->weight }} {{ $parcel->phone }}
                            <hr>
                            {{ $parcel->info }}
                            <hr>
                            @endif
                        @endforeach
                        <hr>
                        <form method="GET" action="{{ route('post.pdf', [$post]) }}">
                            <div class="btn-group mt-5 d-flex justify-content-between ">
                                @csrf
                                <div><a href="{{ URL::previous() }}" class="btn btn-dark btn-md"><i class="fas fa-arrow-left mr-2"></i>BACK</a></div>
                                <div><a href="{{ route('post.edit', [$post]) }}"
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

@section('title'){{ $post->weight }} @endsection