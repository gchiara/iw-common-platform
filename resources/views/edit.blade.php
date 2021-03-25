<x-app-layout>
<x-slot name="header">
    <h2 class="text-white leading-tight">
        {{ __('Edit Dataset') }}
    </h2>
    <div class="header-description">You can use this form to edit the information related to the dataset you selected.</div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-5">
        
            <form method="POST" action="/dataset/{{ $dataset->id }}" class="admin-form">
                <div class="form-group">
                    <label class="form-field-label" for="name">Title</label>
                    <input name="title" id="name" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Title' value="{{ $dataset->title }}" />  
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                    <label class="form-field-label" for="description">Description</label>
                    <textarea name="description" id="description" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">{{ $dataset->description }}</textarea>	
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <label class="form-field-label" for="country">Country</label>
                    <select id="country" name="country" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">
                        @foreach($selectableCountries as $country)
                            <option value="{{$country}}" {{$country == $dataset->country ? 'selected':''}}>{{$country}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('country'))
                        <span class="text-danger">{{ $errors->first('country') }}</span>
                    @endif
                    @if (auth()->user()->isAdmin())
                    <label class="form-field-label" for="owner">Owner Account</label>
                    <select id="owner" name="owner" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">
                        @foreach($editors as $editor)
                        <option value="{{$editor->id}}" {{$editor->id == $dataset->user_id ? 'selected':''}}>{{$editor->name}} | {{$editor->email}}</option>
                        @endforeach
                    </select>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" name="update" class="btn-default btn-large">Update dataset</button>
                </div>
            {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
</x-app-layout>