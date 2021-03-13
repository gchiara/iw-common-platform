<x-app-layout>
<x-slot name="header">
    <h2 class="text-white leading-tight">
        Integrity Watch Datasets
    </h2>
    <div class="header-description">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent auctor, purus eu sagittis pulvinar, nisi tortor consequat tortor, sit amet fermentum nunc augue non nibh.
        Pellentesque nec semper tellus. Sed et pellentesque massa, quis vulputate orci. Aliquam tellus lorem, dapibus non leo ut, consequat malesuada tortor.<br />
        Cras in justo at mi ultricies suscipit nec vitae lorem. Donec id vestibulum mauris. Suspendisse rhoncus libero at nunc vulputate scelerisque. Nulla ultrices aliquet lorem, et pulvinar massa pretium eget. Curabitur vulputate erat lorem. Integer id justo libero. Curabitur ultricies semper metus id pharetra.
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="filters-container">
            @foreach($countries as $country)
            <form action="/dashboard" class="inline-block">
                <input type="hidden" name="country" value="{{ $country }}">
                <button type="submit" name="filter" value="true" formmethod="POST" class="btn-default focus:outline-none focus:shadow-outline">
                    {{ $country }}
                </button>
                {{ csrf_field() }}
            </form>
            @endforeach
            <form action="/dashboard" class="inline-block">
                <button type="submit" name="filter" value="true" formmethod="POST" class="btn-default btn-red focus:outline-none focus:shadow-outline">
                    View All
                </button>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-5">
            <div class="flex">
                @if($selected_country and $selected_country !== '')
                    <div class="list-title flex-auto text-2xl mb-4">Datasets - {{ $selected_country }}
                        <div class="list-count-text">Datasets available: {{ $datasets_num }}</div>
                    </div>
                @else
                    <div class="list-title flex-auto text-2xl mb-4">Datasets - All
                        <div class="list-count-text">Datasets available: {{ $datasets_num }}</div>
                    </div>
                @endif
                
                <div class="flex-auto text-right mt-2">
                    @if (auth()->user()->isAdmin() or auth()->user()->isEditor())
                    <a href="/dataset" class="btn-default btn-large">
                        <i class="fas fa-plus btn-icon-medium"></i>Add new Dataset
                    </a>
                    @endif
                </div>
            </div>
            <table class="data-entry-table w-full text-md rounded mb-4">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Dataset</th>
                        <th class="text-left p-3 px-5">Country</th>
                        <th class="actions-column text-right p-3 px-5">Actions</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($datasets as $dataset)
                    <tr class="border-b">
                        <td class="p-3 px-5">
                            <div class="data-entry-title">{{$dataset->title}}</div>
                            <div class="data-entry-description">{{$dataset->description}}</div>
                            @if (auth()->user()->isAdmin() or auth()->user()->isEditor())
                            <div class="data-entry-downloads"><strong>Downloads:</strong> {{$dataset->downloads_count}}</div>
                            @endif
                            <div class="data-entry-date"><strong>Last updated on:</strong> {{$dataset->updated_at}}</div>
                        </td>
                        <td class="p-3 px-5">
                        {{$dataset->country}}
                        </td>
                        <td class="text-right p-3 px-5">
                            <a href="download_dataset/{{$dataset->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline">
                                <i class="fas fa-download btn-icon-only"></i>
                            </a>
        
                            @can('edit-dataset', $dataset)
                            <a href="/dataset/{{$dataset->id}}" name="edit" class="btn-default mr-1 focus:outline-none focus:shadow-outline">
                                <i class="fas fa-pen btn-icon-small"></i>Edit
                            </a>
                            <form action="/dataset/{{$dataset->id}}" class="inline-block">
                                <button type="submit" name="delete" formmethod="POST" class="btn-default btn-red focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash btn-icon-small"></i>Delete
                                </button>
                                {{ csrf_field() }}
                            </form>
                            @endcan
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
</x-app-layout>