<x-app-layout>
<x-slot name="header">
    <h2 class="text-white leading-tight">
        Integrity Watch Data Hub
    </h2>
    <div class="header-description">
    Welcome to the Integrity Watch Data hub: a central database containing every dataset collected, cleaned, and harmonised for our Integrity Watch platforms. You can sort directly by country, use the search function for specific type of data and directly download the full datasets. The datahub will be regularly updated with new datasets as they are published on their respective Integrity Watch platform. Our aim is to foster further research and better understanding into the use of data to foster political integrity, transparency, and accountability in public institutions. Should you have any questions or would like to share your thoughts, feel free to reach out to our dedicated teams: <a href="mailto:datahbub@transparency.org">datahbub@transparency.org</a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Filters -->
        <div class="filters-container">
            @foreach($countries as $country)
            <form action="/dashboard" class="inline-block">
                <input type="hidden" name="country" value="{{ $country }}">
                @if($selected_country == $country)
                    <button type="submit" name="filter" value="true" formmethod="POST" class="btn-default active focus:outline-none focus:shadow-outline">
                        {{ $country }}
                    </button>
                @else
                    <button type="submit" name="filter" value="true" formmethod="POST" class="btn-default focus:outline-none focus:shadow-outline">
                        {{ $country }}
                    </button>
                @endif
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
        <!-- Main -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-5">
            <div class="flex list-top-area">
                @if($selected_country and $selected_country !== '')
                    <div class="list-title flex-auto text-2xl mb-4">Datasets - {{ $selected_country }}
                        <div class="list-count-text">Datasets available: {{ $datasets_num }}</div>
                    </div>
                @else
                    <div class="list-title flex-auto text-2xl mb-4">Datasets - All
                        <div class="list-count-text">Datasets available: {{ $datasets_num }}</div>
                    </div>
                @endif
                
                <div class="list-actions-container flex-auto text-right mt-2">
                    @if (auth()->user()->isAdmin() or auth()->user()->isEditor())
                        <a href="/dataset" class="btn-default btn-large mb-2">
                            <i class="fas fa-plus btn-icon-medium"></i>Add new Dataset
                        </a>
                        <a href="/download-datasets-list" class="btn-default btn-large">
                            <i class="fas fa-download btn-icon-medium"></i>Download list (CSV)
                        </a>
                    @endif
                </div>
            </div>
            <!-- Data table -->
            <table class="data-entry-table w-full text-md rounded mb-4">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Dataset</th>
                        <th class="text-left p-3 px-5">Country</th>
                        <th class="actions-column text-right p-3 px-5">
                            @if (auth()->user()->isAdmin() or auth()->user()->isEditor())
                            Actions
                            @else
                            Download
                            @endif
                        </th>
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
                            <a href="download-dataset/{{$dataset->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline">
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
            <!-- Data boxes - mobile -->
            <div class="data-entry-boxes-container">
                <div class="grid grid-cols-1 md:grid-cols-2 sm:grid-cols-2">
                    @foreach ($datasets as $dataset)
                    <div class="data-box">
                        <div class="data-box-inner">
                            <div class="data-entry-title">{{$dataset->title}}</div>
                            <div class="data-entry-country"><strong>{{$dataset->country}}</strong></div>
                            <div class="data-entry-description">{{$dataset->description}}</div>
                            @if (auth()->user()->isAdmin() or auth()->user()->isEditor())
                                <div class="data-entry-downloads"><strong>Downloads:</strong> {{$dataset->downloads_count}}</div>
                            @endif
                            <div class="data-entry-date"><strong>Last updated on:</strong> {{$dataset->updated_at}}</div>
                            <div class="data-box-actions">
                                <a href="download-dataset/{{$dataset->id}}" class="btn-default mr-1 focus:outline-none focus:shadow-outline">
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
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Pagination -->
            @if($selected_country == '')
            <div class="pagination-links-container">
                {{ $datasets->links() }}
            </div>
            @endif
            
        </div>
    </div>
</div>
</x-app-layout>