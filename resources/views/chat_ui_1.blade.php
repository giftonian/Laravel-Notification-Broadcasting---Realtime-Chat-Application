<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Knowledge Sharing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul id="list-messages">

                    </ul>
                    <span id="span-typing"></span>
                    <form id="form">                        
                        <div class="p-2 flex items-center">
                            <label for="title" class="w-40">Message:</label>
                            <input type="text" id="input-message" placeholder="Message..." class="rounded-md border-gray-300 hover:border-gray-600 flex-1" name="input-message" />
                        </div>                        
                        {{-- <div class="p-6">                                                      
                                <button type="submit" id="submit-button" class="text-white font-semibold bg-blue-500 hover:bg-blue-700
                                border-blue-700 border-b hover:border-indigo-900 
                                transition-all px-6 py-2 rounded-full">
                                Add Sender
                                </button>
                        </div> --}}
                    </form>
                    @vite(['resources/css/app.css', 'resources/js/app.js'])    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
