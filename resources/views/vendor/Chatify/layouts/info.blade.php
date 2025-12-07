{{-- user info and avatar --}}


@if(isset($user))
    <div class="avatar av-l chatify-d-flex"
         style="background-image: url('{{ $user->avatar_url ?? asset("avatars/avatar.png") }}');"></div>
    <p class="info-name">{{ $user->name }}</p>
@else
    <div class="avatar av-l chatify-d-flex"
         style="background-image: url('{{ Auth::user()->avatar_url ?? asset("avatars/avatar.png") }}');"></div>
    <p class="info-name">{{ Auth::user()->name }}</p>
@endif

<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Delete Conversation</a>
</div>

{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div>