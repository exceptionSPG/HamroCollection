<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi..{{ Auth::user()->name }}
        </h2>
    </x-slot>

    <p>This is home page</p>


</x-app-layout>