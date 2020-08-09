@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            Dashboard
                        </div>
                        <div>
                            <a href="{{ route('discussions.create') }}" class="btn btn-success btn-sm">Add Discussion</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

@endsection
