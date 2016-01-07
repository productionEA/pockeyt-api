@extends('layout')


@section('content')

    <div class="row">
        <div class="col-md-12">

            <h1>All Profiles</h1>

            <div class="alert alert-info">
                All created profiles are listed below along with their approval status and related information.
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            @if(count($profiles) > 0)
                @foreach($profiles as $profile)

                    <div class="profile-list-item" id="profile-{{ $profile->id }}">
                        <div class="row profile-list-row">
                            <div class="col-md-3 text-center">

                                @if(is_null($profile->logo))
                                    <strong class="profile-list-item-logo">No logo</strong>
                                @else
                                    <img class="profile-list-item-logo" src="{{ $profile->logo->url }}">
                                @endif

                                <div class="profile-list-item-status text-center alert {{ $profile->approved ? 'alert-success' : 'alert-danger'}}">
                                    <p>This profile is <strong>{{ $profile->approved ? 'approved' : 'not approved'}}</strong></p>
                                        <form action="/profiles/{{ $profile->id }}/{{ $profile->approved ? 'unapprove' : 'approve'}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn {{ $profile->approved ? 'btn-danger' : 'btn-success'}}" value="{{ $profile->approved ? 'Un-approve' : 'Approve'}}">
                                        </form>
                                </div>

                                <table class="table profile-list-item-table">
                                    <tbody>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $profile->created_at }} UTC</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ $profile->updated_at }} UTC</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-9">

                                <div class="profile-list-item-header" {!! !is_null($profile->hero) ? 'style="background-image: url(\'' . $profile->hero->url . '\');"' : '' !!}>
                                    <div class="profile-list-item-header-screen"></div>
                                    <h2>{{ $profile->business_name }}</h2>
                                </div>

                                <div class="profile-list-item-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Website:</strong> <a target="_blank" href="{{ $profile->website }}">{{ $profile->website }}</a></p>
                                            <p><strong>Description:</strong></p>
                                            <textarea class="form-control" readonly="readonly">{{ $profile->description }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Owner's name:</strong> {{ $profile->owner->name }}</p>
                                            <p><strong>Owner's email:</strong> <a href="mailto:{{ $profile->owner->email }}">{{ $profile->owner->email }}</a></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                @endforeach
            @else

                <div class="alert alert-danger">No profiles found.</div>

            @endif

        </div>
    </div>

@stop