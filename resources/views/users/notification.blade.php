@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">Notifications</div>

                <div class="card-body">
                  <ul class="list-group">

                    @foreach ($notifications as $notification)
                      @if ($notification->type == 'App\Notifications\NewReplyAdded')
                        <li class="list-group-item">
                          <strong>{{$notification->data['discussion']['title']}}</strong><br>
                          A new reply was added to your discussion. 
                          <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}" class="btn btn-info btn-sm float-right">View Discussion</a>
                        </li>
                        @elseif($notification->type == 'App\Notifications\MarkAsBestReply')
                        <li class="list-group-item">
                          <strong>{{$notification->data['discussion']['title']}}</strong><br>
                          Your reply marked as best reply.. 
                          <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}" class="btn btn-info btn-sm float-right">View Discussion</a>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
            </div>

@endsection
