@extends('layouts.app')

@section('content')

<div class="card text-left mb-3">
  @include('includes.card-header')
  <div class="card-body">
    <div class="text-center">
      <p class="font-weight-bold">{{ $discussion->title }}</p>
    </div>
    <hr>

    {!! $discussion->content !!}


    <div class="d-flex justify-content-end">
      <p class="m-0 p-0">{{ $discussion->created_at->diffForHumans() }}</p>
    </div>

  </div>
</div>

@if ($discussion->getBestReply)
<div class="card text-white bg-primary mb-3">
  <div class="card-header">
    <div class="d-flex justify-content-between">
      <div>
        <img src="{{ Gravatar::src($discussion->getBestReply->owner->email) }}" width="40px" style="border-radius: 50%" alt="">
        <span class="font-weight-bold">{{ $discussion->getBestReply->owner->name }}</span>
      </div>
      <div>
        <p class="font-weight-bold text-light mt-2">Best Reply</p>
      </div>
    </div>
  </div>
  <div class="card-body">
    {!! $discussion->getBestReply->content !!}

    <div class="d-flex justify-content-end">
      <p class="m-0 p-0">{{ $discussion->getBestReply->created_at->diffForHumans() }}</p>
    </div>
  </div>
</div>
@endif


  @foreach ($discussion->replies()->paginate(3) as $reply)
      <div class="card text-left mb-3">
        <div class="card-header">
          <div class="d-flex justify-content-lg-between">
            <div>
              <img src="{{ Gravatar::src($reply->owner->email) }}"  width="40px" style="border-radius: 50%" alt="">
              <span class="font-weight-bold ml-2">{{ ucwords($reply->owner->name) }}</span>
            </div>
            <div>
              @if (Auth::id() == $discussion->user->id)
                <form action="{{ route('discussions.bestreply', [$discussion, $reply]) }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-primary btn-sm">Best Reply</button>
                </form>
              @endif
            </div>
          </div>

        </div>
        <div class="card-body">
          {!! $reply->content !!}

          <div class="d-flex justify-content-end">
            <p>{{ $reply->created_at->diffForHumans() }}</p>
          </div>

        </div>
      </div>

      @endforeach

      {{$discussion->replies()->paginate(3)->links()}}





<div class="card text-left">
  <div class="card-header">Add Reply</div>
  <div class="card-body">
    @auth
    <form action="{{ route('replies.store', $discussion) }}" method="post">
      @csrf
      <div class="form-group">
          <input id="content" type="hidden" name="content">
          <trix-editor input="content"></trix-editor>
      </div>
      
      <button type="submit" class="btn btn-success">Add Reply</button>
    </form>
    @else
    <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Login to add reply.</a>
    @endauth
  </div>
</div>

@endsection
@push('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix-core.min.js" integrity="sha512-mkHLzAlxKPAQ5D44qWDgb4nGsSy+tX+6aIoTsGtoraY5TIzGBjX2qduLLYerALUvRBOH6b6XuER3Mx544JxdsQ==" crossorigin="anonymous"></script>
@endpush

@push('custom-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.css" integrity="sha512-sC2S9lQxuqpjeJeom8VeDu/jUJrVfJM7pJJVuH9bqrZZYqGe7VhTASUb3doXVk6WtjD0O4DTS+xBx2Zpr1vRvg==" crossorigin="anonymous" />
@endpush
