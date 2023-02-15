<x-app-layout>
    <x-slot name="header"><!-- use this header as $header variable in main layout file, this is called named slot -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Channels') }}
        </h2>
    </x-slot>
    @if(session()->get('success'))
        <div class="p-2 bg-green-200 border-b border-green-400 rounded-md">
        {{ session()->get('success') }}
        </div>
    @elseif($errors->any())
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
                <a href="{{ route('channels.create')}}" class="inline-flex items-center px-4 py-2 mb-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    New Channel</a>
                    <table class="shadow-lg w-full">
                        <thead>
                            <tr class="bg-gray-400 text-white font-extrabold" >
                            <td class="px-4 py-1 text-center" >Sr. #</td>
                            <td class="px-4 py-1">Name</td>
                            <td class="px-4 py-1">Description</td>
                            <td class="px-1 py-1 text-center" colspan="2">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $iter = $data['rec_counter'];                              
                            @endphp
                            @foreach($data['items'] as $row)
                            <tr>
                                <td class="border px-4 py-1 text-center">{{ $iter }}</td>
                                <td class="border px-4 py-1">{{ $row->name }}</td>
                                <td class="border px-4 py-1">{{ $row->description }}</td>                                
                                <td class="border px-1 py-1 text-center">
                                    <a href="{{ route('channels.edit',$row->id)}}" class="inline-flex items-center px-4 py-1 bg-green-800 border border-transparent rounded-lg font-semibold text-xs text-white tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>
                                </td>
                                <td class="border px-1 py-1 text-center">
                                    <form id="form_{{$row->id}}" action="{{ route('channels.destroy', $row->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button value="form_{{$row->id}}" type="submit" class="submit-button inline-flex items-center px-4 py-1 bg-red-800 border border-transparent rounded-lg font-semibold text-xs text-white tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                             $iter++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table> <br/>
                    {!! $data['items']->links('pagination::tailwind') !!}
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script"> 
        @include('partials.scripts')       
        <script type="text/javascript">
        $(document).ready(function() {   
        $('.submit-button').click(function(event) {
            event.preventDefault();           
            if (confirm('Are you sure you want to delete the record?')) {
              $("#"+$(this).val()).submit();
            }
        });
        rowHighlighter();
        });
        </script>  
    </x-slot>
</x-app-layout>