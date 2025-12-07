<table class="messenger-list-item favorite-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
            <div class="avatar av-m"
                 style="background-image: url('{{ $user->avatar_url ?? asset("avatars/avatar.png") }}');">
            </div>
        </td>
    </tr>
</table>
