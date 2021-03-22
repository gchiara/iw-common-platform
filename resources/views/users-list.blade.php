<x-app-layout>
<x-slot name="header">
    <h2 class="text-white leading-tight">
        {{ __('Users') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-5">
            <div class="flex list-top-area">
                <div class="list-title flex-auto text-2xl mb-4">Users List</div>
                <div class="list-actions-container flex-auto text-right">
                    @if (auth()->user()->isAdmin())
                    <a href="/download-users" class="btn-default btn-large">
                        <i class="fas fa-download btn-icon-medium"></i>Download Users CSV
                    </a>
                    @endif
                </div>
            </div>
            <!-- Table list -->
            <table class="data-entry-table users-list w-full text-md rounded mb-4">
                <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Name</th>
                    <th class="text-left p-3 px-5">Email</th>
                    <th class="text-left p-3 px-5">Organization</th>
                    <th class="text-left p-3 px-5">Registration</th>
                    <th class="text-left p-3 px-5">Permissions</th>
                    <th class="actions-column text-right p-3 px-5">Actions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="border-b">
                        <td class="p-3 px-5">
                            <div class="user-name">{{$user->name}}</div>
                        </td>
                        <td class="p-3 px-5">
                            <div class="user-email">{{$user->email}}</div>
                        </td>
                        <td class="p-3 px-5">
                            <div class="user-org">{{$user->org_name}}</div>
                            <div class="user-org"><strong>{{$user->org_category}}</strong></div>
                        </td>
                        <td class="p-3 px-5">
                            <div class="user-date">{{$user->created_at}}</div>
                        </td>
                        <td class="p-3 px-5">
                            <div class="user-role">
                                @if ($user->is_admin)
                                    <strong>Admin</strong>
                                @elseif ($user->is_editor)
                                    <strong>Editor</strong>
                                @else 
                                    User
                                @endif
                            </div>
                        </td>
                        <td class="text-right p-3 px-5">
                            @if (auth()->user()->isAdmin())
                                @if ($user->is_editor and !$user->is_admin)
                                    <a href="/user-toggle-editor/{{$user->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                        Remove editor
                                    </a>
                                @elseif (!$user->is_admin)
                                    <a href="/user-toggle-editor/{{$user->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                        Make editor
                                    </a>
                                @endif
                                @if (auth()->user()->id == 1)
                                    @if ($user->is_admin and $user->id !== 1)
                                        <a href="/user-toggle-admin/{{$user->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                            Remove admin
                                        </a>
                                    @elseif (!$user->is_admin)
                                        <a href="/user-toggle-admin/{{$user->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                            Make admin
                                        </a>
                                    @endif
                                @endif
                            @endif
                            @if (auth()->user()->isAdmin() and auth()->user()->id !== $user->id and $user->id !== 1)
                                <form action="/user-remove/{{$user->id}}" class="inline-block">
                                    <button type="submit" name="delete" formmethod="POST" class="btn-default btn-red focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash btn-icon-small"></i>Delete
                                    </button>
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- Data boxes - mobile -->
            <div class="data-entry-boxes-container">
                <div class="grid grid-cols-1 md:grid-cols-2 sm:grid-cols-2">
                    @foreach ($users as $user)
                    <div class="data-box">
                        <div class="data-box-inner">
                            <div class="data-entry-title">{{$user->name}}</div>
                            <div class="data-entry-url">{{$user->email}}</div>
                            <div class="user-role">
                                @if ($user->is_admin)
                                    <strong>Admin</strong>
                                @elseif ($user->is_editor)
                                    <strong>Editor</strong>
                                @else 
                                    User
                                @endif
                            </div>
                            @if ($user->org_name or $user->org_category)
                            <div class="user-org"><strong>Organization:</strong></div>
                            <div class="user-org">{{$user->org_name}}</div>
                            <div class="user-org">{{$user->org_category}}</div>
                            @endif
                            <div class="data-box-actions">
                                @if (auth()->user()->isAdmin())
                                    @if ($user->is_editor and !$user->is_admin)
                                        <a href="/user-toggle-editor/{{$user->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                            Remove editor role
                                        </a>
                                    @elseif (!$user->is_admin)
                                        <a href="/user-toggle-editor/{{$user->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                            Give editor role
                                        </a>
                                    @endif
                                @endif
                                @if (auth()->user()->isAdmin() and auth()->user()->id !== $user->id and $user->id !== 1)
                                    <form action="/user-remove/{{$user->id}}" class="inline-block">
                                        <button type="submit" name="delete" formmethod="POST" class="btn-default btn-red focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash btn-icon-small"></i>Delete
                                        </button>
                                        {{ csrf_field() }}
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="pagination-links-container">
                {{ $users->links() }}
            </div>
            
        </div>
    </div>
</div>
</x-app-layout>