@extends('layouts.app')

@section('content')

@forelse ($discussions as $discussion)
    <div class="card text-left mb-3">
      @include('includes.card-header')
      <div class="card-body">
        <p>{{ $discussion->title }}</p>

        <div class="d-flex justify-content-end">
          <p class="m-0 p-0">{{ $discussion->created_at->diffForHumans() }}</p>
        </div>
      </div>
    </div>
@empty
    
@endforelse

<div class="d-flex justify-content-center">
  {{ $discussions->appends(['channel' => request()->query('channel')])->links()}}
</div>


@endsection
