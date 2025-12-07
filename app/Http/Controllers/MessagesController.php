<?php

namespace App\Http\Controllers;

use Chatify\Http\Controllers\MessagesController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\ChMessage as Message;
use App\Models\ChFavorite as Favorite;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\DB;

class MessagesController extends BaseController
{
  protected $perPage = 30;

    /**
     * Authenticate the connection for pusher
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function pusherAuth(Request $request)
    {
        return Chatify::pusherAuth(
            $request->user(),
            Auth::user(),
            $request['channel_name'],
            $request['socket_id']
        );
    }

    /**
     * Returning the view of the app with the required data.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
  public function index($id = null)
{
    $messenger_color = Auth::user()->messenger_color;

    // Exclude admin + self right from page load
    $users = User::where('id', '!=', Auth::id())
        ->whereIn('account_type', ['startup', 'investor'])
        ->get();

    $user = null;
    if ($id) {
        $user = $users->where('id', $id)->first();
    }

    return view('Chatify::pages.app', [
        'id' => $id ?? 0,
        'messengerColor' => $messenger_color ? $messenger_color : Chatify::getFallbackColor(),
        'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
        'users' => $users,   // ✅ pass filtered users to the view
        'user' => $user,
    ]);
}





    public function search(Request $request)
    {

        $input = trim(filter_var($request['input']));
        $getRecords = null;

        $records = User::where('id', '!=', Auth::id())
            ->whereIn('account_type', ['startup', 'investor']) // ✅ exclude admins
            ->where('name', 'LIKE', "%{$input}%")
            ->paginate($request->per_page ?? $this->perPage);

        foreach ($records->items() as $record) {
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'user' => $record,
            ])->render();
        }

        if ($records->total() < 1) {
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }

        return Response::json([
            'records'   => $getRecords,
            'total'     => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }

    /**
     * Override contacts: exclude admins + self
     */
    public function getContacts(Request $request)
    {
        $users = Message::join('users', function ($join) {
                $join->on('ch_messages.from_id', '=', 'users.id')
                     ->orOn('ch_messages.to_id', '=', 'users.id');
            })
            ->where(function ($q) {
                $q->where('ch_messages.from_id', Auth::id())
                  ->orWhere('ch_messages.to_id', Auth::id());
            })
            ->where('users.id', '!=', Auth::id())
            ->whereIn('users.account_type', ['startup', 'investor']) // ✅ exclude admins
            ->select('users.*', DB::raw('MAX(ch_messages.created_at) as max_created_at'))
            ->orderBy('max_created_at', 'desc')
            ->groupBy('users.id')
            ->paginate($request->per_page ?? $this->perPage);

        $usersList = $users->items();
        $contacts = '';

        if (count($usersList) > 0) {
            foreach ($usersList as $user) {
                $contacts .= view('Chatify::layouts.listItem', [
                    'get'           => 'users',
                    'user'          => $user,
                    'lastMessage'   => Chatify::lastMessage($user->id),
                    'unseenCounter' => Chatify::unseenCounter($user->id),
                ])->render();
            }
        } else {
            $contacts = '<p class="message-hint center-el"><span>Your contact list is empty</span></p>';
        }

        return Response::json([
            'contacts'  => $contacts,
            'total'     => $users->total() ?? 0,
            'last_page' => $users->lastPage() ?? 1,
        ], 200);
    }

    /**
     * Override favorites: exclude admins + self
     */
    public function getFavorites(Request $request)
    {
        $favoritesList = null;
        $favorites = Favorite::where('user_id', Auth::id())->get();

        foreach ($favorites as $favorite) {
            $user = User::where('id', $favorite->favorite_id)
                        ->whereIn('account_type', ['startup', 'investor']) // ✅ exclude admins
                        ->where('id', '!=', Auth::id()) // ✅ exclude self
                        ->first();

            if ($user) {
                $favoritesList .= view('Chatify::layouts.favorite', [
                    'user' => $user,
                ]);
            }
        }

        return Response::json([
            'count'     => $favorites->count(),
            'favorites' => $favoritesList ?: 0,
        ], 200);
    }
}
?>