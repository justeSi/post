@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <p>Add new post</p>
                    </div>

                    <div class="card-body shadow-wrapper">
                        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Town:</label>
                                <input type="text" name="post_town" class="form-control" value="{{ old('post_town') }}">
                                <small class="form-text text-muted">Enter town</small>
                            </div>

                            <div class="form-group">
                                <label>Capacity:</label>
                                <input type="text" name="post_capacity" class="form-control"
                                    value="{{ old('post_capacity') }}">
                                <small class="form-text text-muted">Enter capacity</small>
                            </div>

                            <div class="form-group">
                                <label>Code:</label>
                                <input type="text" name="post_code" class="form-control" value="{{ old('post_code') }}">
                                <small class="form-text text-muted">Enter code</small>
                            </div>

                            @csrf
                            <button type="submit" class="btn btn-dark btn-sm">Add</button>
                            <a href="{{ URL::previous() }}" class="btn btn-dark btn-sm">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')Add new post @endsection
