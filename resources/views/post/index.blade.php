@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" >
                    <div class="card-header">
                        <p>List of posts</p>
                    </div>
                    <div class="card-body shadow-wrapper " >
                        @foreach ($posts as $post)

                            <div class="border-bottom d-flex justify-content-between p-2">
                                <div>
                                    <p> {{ $post->town }} {{ $post->capacity }} {{ $post->code }}</p>
                                    <p>Turi siuntinių: {{ $post->getParcels->count() }}</p>
                                </div>


                                <form method="POST" action="{{ route('post.destroy', [$post]) }}">
                                    <div class="btn-group d-flex">
                                        @csrf
                                        <a href="{{ route('post.edit', [$post]) }}" class="btn btn-dark btn-sm m-1"
                                            title="edit"><i class="fas fa-user-edit"></i></a>
                                        <button type="submit" class="btn btn-dark btn-sm m-1" title="delete"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                        <div class="mt-3 pagination-dark justify-content-center pagination-md d-flex flex-sm-wrap">
                            {{ $posts->onEachSide(0)->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('title')List of posts @endsection
