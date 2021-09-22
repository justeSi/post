@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <p>List of parcels</p>

                        <details>
                            <summary>Options</summary>
                            {{-- FILTER --}}
                            <form action="{{ route('parcel.index') }}" method="get">
                                <p class="d-inline">Filter</p>
                                <div class="form-group ">
                                    <select class="form-control w-50" name="post_id">
                                        <option value="0" disabled selected>Select Post</option>
                                        @foreach ($posts as $post)
                                            <option value="{{ $post->id }}" @if ($post_id == $post->id) selected @endif>
                                                {{ $post->code }} </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text ">Select post from the list.</small>
                                </div>
                                <div class="mb-3">
                                    <button type=" submit" class="btn btn-dark btn-sm" name="filter"
                                        value="post">Filter</button>
                                    <a href="{{ route('parcel.index') }}" class="btn btn-dark btn-sm">Reset</a>
                                </div>
                            </form>
                        </details>
                    </div>
                    <div class="card-body shadow-wrapper ">
                        @foreach ($parcels as $parcel)
                            <div class="border-bottom d-flex justify-content-between p-2">
                                <div>
                                    <p>Weight: {{ $parcel->weight }} kg.</p>
                                    <p>Phone: {{ $parcel->phone }}</p>
                                    <p>Post code: {{ $parcel->getPost->code }}</p>
                                </div>


                                <form method="POST" action="{{ route('parcel.destroy', [$parcel]) }}">
                                    <div class="btn-group d-flex">
                                        @csrf
                                        <a href="{{ route('parcel.edit', [$parcel]) }}" class="btn btn-dark btn-sm m-1"><i
                                                class="fas fa-user-edit"></i></a>
                                        <button type="submit" class="btn btn-dark btn-sm m-1"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                        <div class="mt-3 pagination-dark justify-content-center pagination-md d-flex flex-sm-wrap">
                            {{ $parcels->onEachSide(0)->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('title')List of parcels @endsection
