<div class="profile-list-item-status text-center alert {{ $profile->approved ? 'alert-success' : 'alert-danger'}}">
    <p>This profile is <strong>{{ $profile->approved ? 'approved' : 'not approved'}}</strong></p>
    <form action="/profiles/{{ $profile->id }}/{{ $profile->approved ? 'unapprove' : 'approve'}}" method="post">
        {{ csrf_field() }}
        <input type="submit" class="btn {{ $profile->approved ? 'btn-danger' : 'btn-success'}}" value="{{ $profile->approved ? 'Un-approve' : 'Approve'}}">
    </form>
</div>