<x-app-layout>
<x-slot name="header">
    <h2 class="text-white leading-tight">
        {{ __('Platforms') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-5">
            <div class="flex">
                <div class="flex-auto text-2xl mb-4">Platforms List</div>
                
                <div class="flex-auto text-right mt-2">
                    @if (auth()->user()->isAdmin())
                    <a href="/platform" class="btn-default btn-large">
                        <i class="fas fa-plus btn-icon-medium"></i>Add new Platform
                    </a>
                    @endif
                </div>
            </div>
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
            
        </div>
    </div>
</div>
</x-app-layout>