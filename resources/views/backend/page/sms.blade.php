@extends('layouts.app')

@section('content')

<div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Create Reminder Message</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('lawyers.index') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <div class="table w-full mt-8 bg-white rounded">
            <form action="" method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
                @csrf
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Phone
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="phone" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Reminder Message
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <textarea name="message" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" value="{{ old('email') }}"></textarea>
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Send Reminder
                        </button>
                    </div>
                </div>
            </form>        
        </div>
        
    </div>

    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Cases</h2>
            </div>
        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Case Title</div>
                <div class="w-3/12 px-4 py-3">Case Description</div>
                <div class="w-2/12 px-4 py-3">Plaintiff Names</div>
                <div class="w-2/12 px-4 py-3">Next Hearing</div>
                <div class="w-2/12 px-4 py-3">Plaintiff Phone Number</div>
            </div>
            @foreach ($kesis as $kesi)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $kesi->title }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $kesi->description }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $kesi->p_name}}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $kesi->next_hearing }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $kesi->p_phone }}</div>
                    
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $kesis->links() }}
        </div>

        @include('backend.modals.delete',['name' => 'kesi'])
    </div>

@endsection