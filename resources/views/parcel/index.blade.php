@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>List of parcels</h4>

                        <details>
                            <summary>Filter</summary>
                            {{-- FILTER --}}
                            <form action="{{ route('parcel.index') }}" method="get">
                                <div class="form-group ">
                                    <select class="form-control w-50" name="post_id">
                                        <option value="0" disabled selected>Select Post</option>
                                        @foreach ($posts as $post)
                                            <option value="{{ $post->id }}" @if ($post_id == $post->id) selected @endif>
                                                {{ $post->code }} ({{ $post->town }})</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text ">Select post from the list.</small>
                                </div>
                                <div class="mb-3">
                                    <button type=" submit" class="btn btn-dark btn-sm" name="filter"
                                        value="post">Filter</button>
                                    <a href="{{ route('parcel.index') }}" class="btn btn-dark btn-sm">Reset</a>
                                    <div class="form-check d-inline ml-2">
                                        <input class="form-check-input" type="radio" name="sort_dir" id="_1" value="asc"
                                            @if ('desc' != $sortDirection) checked @endif>
                                        <label class="form-check-label" for="_1">
                                            <p class="text-dark"><b>ASC</b></p>
                                            
                                        </label>
                                    </div>
                                    <div class="form-check d-inline ml-2">
                                        <input class="form-check-input" type="radio" name="sort_dir" id="_2" value="desc"
                                            @if ('desc' == $sortDirection) checked @endif>
                                        <label class="form-check-label" for="_2">
                                            <p class="text-dark"><b>DESC</b></p>
                                        </label>
                                    </div>
                                </div>
                            </form>
                            
                        </details>

                        <details>
                            <summary>Search</summary>
                            {{-- search --}}
                            <form action="{{ route('parcel.index') }}" method="get">
                                <div class="form-group ">
                                    <input class="form-control" type="text" placeholder="Search" name="s"
                                        value="{{ $s }}">
                                    <small class="form-text text-white">Search</small>
                                </div>
                                <div class="mb-3">

                                    <button type=" submit" class="btn btn-dark btn-sm" name="search"
                                        value="all"><i class="fas fa-search mr-2"></i>Search</button>
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
                                        <a href="{{ route('parcel.edit', [$parcel]) }}" class="btn btn-dark btn-sm m-1"
                                            title="edit"><i class="fas fa-user-edit"></i></a>
                                        <a href="{{ route('parcel.show', [$parcel]) }}" class="btn btn-dark btn-sm m-1"
                                            title="View"><i class="fas fa-binoculars"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm m-1" title="delete"><i
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
