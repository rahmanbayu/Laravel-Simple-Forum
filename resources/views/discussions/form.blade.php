@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">Create Discussion</div>

                <div class="card-body">
                  <form action="{{ route('discussions.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                      <label for="content">Content</label>
                        <input id="content" type="hidden" name="content">
                        <trix-editor input="content"></trix-editor>
                    </div>
                    <div class="form-group">
                      <label for="channel_id">Channel</label>
                      <select class="form-control" name="channel_id" id="channel_id">
                        @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                  </form>
                </div>
            </div>

@endsection

@push('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix-core.min.js" integrity="sha512-mkHLzAlxKPAQ5D44qWDgb4nGsSy+tX+6aIoTsGtoraY5TIzGBjX2qduLLYerALUvRBOH6b6XuER3Mx544JxdsQ==" crossorigin="anonymous"></script>
@endpush

@push('custom-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.css" integrity="sha512-sC2S9lQxuqpjeJeom8VeDu/jUJrVfJM7pJJVuH9bqrZZYqGe7VhTASUb3doXVk6WtjD0O4DTS+xBx2Zpr1vRvg==" crossorigin="anonymous" />
@endpush
