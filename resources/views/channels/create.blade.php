<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Channel') }}
        </h2>
    </x-slot>

    @if($errors->any())

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>

    @endif
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="channel_form" method="post" action="{{ route('channels.store') }}">
                        @csrf
                        <div class="p-2 flex items-center">
                            <label for="title" class="w-40">Channel Name:</label>
                            <input type="text" class="rounded-md border-gray-300 hover:border-gray-600 flex-1" name="name"
                             value="{{ old('name', '') }}"/>
                        </div>
                        <div class="p-2 flex items-center">
                            <label for="body" class="w-40">Description:</label>
                            <input type="text" class="rounded-md border-gray-300 hover:border-gray-600 flex-1" name="description" 
                            value="{{ old('description', '') }}" />
                        </div>
                       
                        {{-- <div class="p-2 flex items-center">
                            <label for="body" class="w-40">Status:</label>                                                        
                            <input type="radio" name="is_active" value="1" checked />&nbsp;Active &nbsp;
                            <input type="radio" name="is_active" value="0" /> &nbsp;DeActive
                        </div> --}}
                        <div class="p-6">                                                      
                                <button type="submit" id="submit-button" class="text-white font-semibold bg-blue-500 hover:bg-blue-700
                                border-blue-700 border-b hover:border-indigo-900 
                                transition-all px-6 py-2 rounded-full">
                                Add Channel
                                </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">        
       
    </x-slot>
</x-app-layout>