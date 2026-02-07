<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->role === 'admin')
                @include('dashboard.admin')

            @elseif(auth()->user()->role === 'petugas')
                @include('dashboard.petugas')

            @endif

        </div>
    </div>
</x-app-layout>