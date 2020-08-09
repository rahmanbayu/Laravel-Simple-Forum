<div class="card-header">
  <div class="d-flex justify-content-between">
    <div>
      <img src="{{ Gravatar::src($discussion->user->email) }}" width="40px" style="border-radius: 50%" alt="">
      <span class="font-weight-bold ml-3">{{ ucwords($discussion->user->name) }}</span>
    </div>
    <div>
      <a href="{{ route('discussions.show', $discussion) }}" class="btn btn-success btn-sm">View Discussion</a>
    </div>
  </div>
</div>