@extends('home.app')

@section('content')
    <main class="sm:py-20 w-full ">
        <article class="bg-white mx-auto relative z-10 text-gray-900 md:rounded overflow-hidden sm:max-w-md">
            <header class="relative bg-black">
                <figure class="relative">
                    <img class="w-full h-auto" src="{{ Storage::url('images/events/' . $event->image) }}"
                         alt="{{$slug->meta_title}}"/>
                </figure>
            </header>
            <div class="text-center py-6 px-4 sm:p-8 border-b border-gray-100">
                <h1 class="text-2xl font-bold font-display uppercase leading-tight">
                    {{$event->title}}
                </h1>
                <h2 class="text-lg font-light text-gray-400">
                    {{$event->sub_title}}
                </h2>
            </div>
            <div>
                <ol>
                    @foreach ($event->dates as $date)
                        <li class="hover:bg-gray-100 cursor-pointer transition">
                            <a class="block focus:bg-gray-100 focus:outline-none">
                                <div
                                    class="px-4 sm:px-8 py-3 sm:py-4 flex  items-center border-b border-gray-100 justify-between">
                                    <div class="flex flex-1 items-center">
                                        <div>
                                            <time
                                                class="bg-black text-white rounded-sm h-12 w-12 items-center justify-center flex flex-col">
                                                <span class="text-xl font-bold font-display leading-none">
                                                    @if ($date->date)
                                                        {{ Carbon\Carbon::parse($date->date)->day }}
                                                    @endif
                                                </span>
                                                <span
                                                    class="text-xs font-bold font-display uppercase leading-none tracking-wide">
                                                      @if ($date->date)
                                                        {{ substr(Carbon\Carbon::parse($date->date)->monthName, 0, 3) }}
                                                    @endif
                                                </span>
                                            </time>
                                            <span
                                                class="w-12 truncate block text-center bg-gray-500 text-white text-xs
                                               uppercase leading-0 rounded-br-sm rounded-bl-sm px-1 -mt-px"
                                            >
                                              @if ($date->date)
                                                    {{ Carbon\Carbon::parse($date->date)->year }}
                                                @endif

                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-sm font-bold leading-none mb-1">
                                                @if ($date->venue)
                                                    {{$date->venue->name}}
                                                @else
                                                    Venue coming soon
                                                @endif
                                            </h3>
                                            <div class="flex flex-col">
                                                <p class="first-letter:uppercase flex items-center pl-3.5 relative text-gray-700 text-xs ">
                                                    <svg class="-ml-3.5 absolute fill-current mr-1 mt-0.5 top-0"
                                                         width="10" height="10" aria-hidden="true" role="img"
                                                         focusable="false" preserveAspectRatio="xMidYMid meet"
                                                         data-prefix="fal" data-icon="clock"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                              d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm216 248c0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216zm-148.9 88.3l-81.2-59c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h14c6.6 0 12 5.4 12 12v146.3l70.5 51.3c5.4 3.9 6.5 11.4 2.6 16.8l-8.2 11.3c-3.9 5.3-11.4 6.5-16.8 2.6z"></path>
                                                    </svg>
                                                    Torsdag - 20:00
                                                </p>
                                                @if ($date->venue)
                                                    <p class="flex items-center pl-3.5 relative text-gray-700 text-xs ">
                                                        <svg class="-ml-3.5 absolute fill-current mr-1 mt-0.5 top-0"
                                                             width="10" height="10" aria-hidden="true" role="img"
                                                             focusable="false" preserveAspectRatio="xMidYMid meet"
                                                             data-prefix="fal" data-icon="map-marker-alt"
                                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                            <path fill="currentColor"
                                                                  d="M192 96c-52.935 0-96 43.065-96 96s43.065 96 96 96 96-43.065 96-96-43.065-96-96-96zm0 160c-35.29 0-64-28.71-64-64s28.71-64 64-64 64 28.71 64 64-28.71 64-64 64zm0-256C85.961 0 0 85.961 0 192c0 77.413 26.97 99.031 172.268 309.67 9.534 13.772 29.929 13.774 39.465 0C357.03 291.031 384 269.413 384 192 384 85.961 298.039 0 192 0zm0 473.931C52.705 272.488 32 256.494 32 192c0-42.738 16.643-82.917 46.863-113.137S149.262 32 192 32s82.917 16.643 113.137 46.863S352 149.262 352 192c0 64.49-20.692 80.47-160 281.931z"></path>
                                                        </svg>
                                                        {{$date->venue->city}}, {{$date->venue->country}}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        @if ($date->status == \app\Enums\DateStatus::AVAILABLE)
                                            <button
                                                class="flex w-24 sm:w-36 justify-center items-center text-center rounded
                                                px-1 sm:px-4 border py-2 text-[.65rem] uppercase font-bold
                                                transition-colors border-black text-black hover:bg-black
                                                hover:border-black hover:text-white">
                                                Get tickets
                                            </button>

                                        @elseif ($date->status ==  \app\Enums\DateStatus::SOLDOUT)
                                            <button
                                                class="flex w-24 sm:w-36 justify-center items-center text-center rounded
                                                 px-1 sm:px-4 border py-2 text-[.65rem] uppercase font-bold
                                                 transition-colors border-red-500 py-2 text-red-500
                                                 uppercase font-bold ">
                                                {{\app\Enums\DateStatus::SOLDOUT->name()}}
                                            </button>
                                        @elseif ($date->status ==  \app\Enums\DateStatus::FEW)
                                            <button class="flex w-24 sm:w-36 justify-center items-center text-center rounded
                                                px-1 sm:px-4 border py-2 text-[.65rem] uppercase font-bold transition-colors
                                                border-orange-500 py-2 text-orange-500 font-bold hover:bg-orange-500 hover:text-white transition-colors">
                                                {{\app\Enums\DateStatus::FEW->name()}}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ol>
            </div>

        </article>
    </main>
    <div class="fixed inset-0 z-0 overlay-dotted hidden sm:block scale-110	blur-lg">
        <img class="absolute inset-0 w-full object-cover h-full lazy entered loaded"
             src="{{ Storage::url('images/events/' . $event->image) }}"
             alt="{{$slug->meta_title}}"/>
    </div>

@endsection
