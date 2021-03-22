<x-app-layout>
<x-slot name="header">
    <h2 class="text-white leading-tight">
        {{ __('Platforms') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-5">
            <div class="flex list-top-area">
                <div class="list-title flex-auto text-2xl mb-4">Platforms List</div>
                <div class="list-actions-container flex-auto text-right">
                    @if (auth()->user()->isAdmin())
                    <a href="/platform" class="btn-default btn-large">
                        <i class="fas fa-plus btn-icon-medium"></i>Add new Platform
                    </a>
                    @endif
                </div>
            </div>
            <!-- Table list -->
            <table class="data-entry-table w-full text-md rounded mb-4">
                <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Platform</th>
                    <th class="actions-column text-right p-3 px-5">Actions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($platforms as $platform)
                    <tr class="border-b">
                        <td class="p-3 px-5">
                            <div class="data-entry-title">{{$platform->title}}</div>
                            <div class="data-entry-url">{{$platform->url}}</div>
                            <div class="data-entry-description">{{$platform->description}}</div>
                        </td>
                        <td class="text-right p-3 px-5">
                            @if (auth()->user()->isAdmin())
                            <a href="/platform/{{$platform->id}}" name="edit" class="btn-default mr-1 focus:outline-none focus:shadow-outline">
                                <i class="fas fa-pen btn-icon-small"></i>Edit
                            </a>
                            <form action="/platform/{{$platform->id}}" class="inline-block">
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
                    @foreach ($platforms as $platform)
                    <div class="data-box">
                        <div class="data-box-inner">
                            <div class="data-entry-title">{{$platform->title}}</div>
                            <div class="data-entry-url">{{$platform->url}}</div>
                            <div class="data-entry-description">{{$platform->description}}</div>
                            <div class="data-box-actions">
                                @if (auth()->user()->isAdmin())
                                <a href="/platform/{{$platform->id}}" name="edit" class="btn-default mr-1 focus:outline-none focus:shadow-outline">
                                    <i class="fas fa-pen btn-icon-small"></i>Edit
                                </a>
                                <form action="/platform/{{$platform->id}}" class="inline-block">
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
            
        </div>
    </div>
</div>
</x-app-layout>