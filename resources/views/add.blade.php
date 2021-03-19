<x-app-layout>
<x-slot name="header">
    <h2 class="text-white leading-tight">
        {{ __('Add Dataset') }}
    </h2>
    <div class="header-description">You can use this form to add a new dataset to the Integrity Watch Data Hub.<br />
    The uploaded dataset will be stored on the platform and will be visible and downloadable by registered users.</div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-5">
        
            <form method="POST" action="/dataset" enctype="multipart/form-data" class="admin-form">
                <div class="form-group">
                    <label class="form-field-label" for="name">Title</label>
                    <input id="name" name="title" class="form-field-default border border-gray-400 leading-normal resize-none w-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Title'></textarea>  
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                    <label class="form-field-label" for="description">Description</label>
                    <textarea id="description" name="description" class="form-field-default border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Description'></textarea>  
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <label class="form-field-label" for="country">Country</label>
                    <select id="country" name="country" class="form-field-default border border-gray-400 leading-normal resize-none w-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">
                        <option value="EU">EU</option>
                        <option value="Austria">Austria</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="Greece">Greece</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Italy">Italy</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Malta">Malta</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Romania">Romania</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Spain">Spain</option>
                        <option value="Sweden">Sweden</option>
                        <option value="United Kingdom">United Kingdom</option>
                    </select>
                    @if ($errors->has('country'))
                        <span class="text-danger">{{ $errors->first('country') }}</span>
                    @endif
                    <div class="custom-file">
                        <label class="form-field-label" for="chooseFile">Select dataset file (.json, .csv, .tsv)</label>
                        <input type="file" name="file" class="custom-file-input" id="chooseFile">
                        @if ($errors->has('file'))
                            <span class="text-danger">{{ $errors->first('file') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-default btn-large">Add dataset</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
</x-app-layout>