@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Add new parcel</h4>
                    </div>

                    <div class="card-body shadow-wrapper">
                        <form method="POST" action="{{ route('parcel.store') }}" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Weight:</label>
                                <input type="text" name="parcel_weight" class="form-control"
                                    value="{{ old('parcel_weight') }}">
                                <small class="form-text text-muted">Enter weight</small>
                            </div>

                            <div class="form-group">
                                <label>Phone:</label>
                                <input type="text" name="parcel_phone" class="form-control"
                                    value="{{ old('parcel_phone') }}">
                                <small class="form-text text-muted">Enter phone</small>
                            </div>

                            <div class="form-group">
                                <label>Info:</label>
                                <textarea class="form-control" name="parcel_info"
                                    id="summernote">{{ old('parcel_info') }}</textarea>
                            </div>

                            <div class="form-group">

                                <label>Post:</label>
                                <select class="form-control" name="post_id">
                                    <option value="0" disabled selected>Select Post</option>
                                    @foreach ($posts as $post)
                                        <option value="{{ $post->id }}" @if (old('post_id') == $post->id)
                                            selected
                                    @endif>
                                    {{ $post->town }} code: {{ $post->code }} free space: {{ $post->capacity - $post->getParcels->count() }}
                                    </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Choose post</small>
                            </div>
                            @csrf
                            <a href="{{ URL::previous() }}" class="btn btn-dark btn-md"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                            <button type="submit" class="btn btn-dark btn-md"><i class="fas fa-check mr-2"></i>Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>@endsection

    @section('title')Add new parcel @endsection
