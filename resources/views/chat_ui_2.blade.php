<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Knowledge Sharing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-0 text-gray-900">
                    {{-- <div>
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
                            </div> 
                        </form>
                    </div> --}}
                    <!-- component -->
                    <!-- This is an example component -->
                    <div class="container mx-auto shadow-lg rounded-lg">
                        <!-- headaer -->
                    <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
                    <div class="font-semibold text-2xl">Tech Club</div>
                    <div class="w-1/2">
                        {{-- <input type="text" name=""  id="" placeholder="search IRL"
                        class="rounded-2xl bg-gray-100 py-3 px-5 w-full"
                        /> --}}
                    </div>
                    <div id="total_users" class="h-12 w-12 p-2 bg-yellow-500 rounded-full text-white font-semibold flex items-center justify-center">
                        0
                    </div>
                    </div>
                    <!-- end header -->
                    <!-- Chatting -->
                    <div class="flex flex-row justify-between bg-white">
                    <!-- message -->                    
                        <div id="chat_box_parent" class="w-full px-5 flex flex-col scroll-smooth justify-between overflow-y-auto">
                            <div class="flex flex-col mt-5" id="chat_box">         
                                {{-- <div class="join-room"><span><b>&nbsp;&nbsp;ALI</b> <i>has joined the conversation.</i></span></div> --}}
                                

                                {{-- <div class="single-msg">
                                <span><b>&nbsp;&nbsp;Usman</b></span>
                                <div class="flex justify-start mb-4">
                                    <div class="ml-2 py-3 px-4 bg-blue-400 rounded-br-3xl rounded-tr-3xl 
                                    rounded-tlxl text-white">message</div>
                                </div>
                                </div> --}}
                                
                                {{-- <div class="flex justify-start mb-4">
                                    <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"  class="object-cover h-8 w-8 rounded-full"  alt="" /> 
                                    <span><b>User 1</b></span>
                                    <div class="ml-2 py-3 px-4 bg-blue-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
                                    at praesentium, 
                                    </div>
                                </div>
                                <div class="flex justify-end mb-4">
                                    <div class="mr-2 py-3 px-4 bg-gray-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white" >
                                    Welcome to group everyone !
                                    </div>
                                    <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600" class="object-cover h-8 w-8 rounded-full" alt=""  /> 
                                    <span><b>Me</b></span>
                                </div>  --}}
                            </div>                           
                        </div>                    
                    </div>
                    <div class="py-5 px-4">
                        <div id="typing"></div>
                        <form id="form"> 
                        <input id="input-message" name="input-message" class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" placeholder="type your message here..." />
                        </form>
                        </div>
                    </div>
                    </div>
    
                </div>
            </div>
        </div>

    </div>
    <script>
        const currentUser = {!! auth()->user()->toJson() !!};
        const chatParentHeight = 20;
        document.getElementById("chat_box_parent").style.height = chatParentHeight+"rem";       
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])  
</x-app-layout>
