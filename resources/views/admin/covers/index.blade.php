<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.covers.create') }}" class="btn btn-orange">
            Crear
        </a>
    </x-slot>

    <ul class="space-y-4" id="covers">
        @foreach ($covers as $cover)
            <li class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex cursor-move" data-id="{{ $cover->id }}">
                <img src="{{ $cover->image }}" alt=""
                    class="w-full lg:w-64 aspect-[3/1] object-cover object-center">

                <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-2 lg:space-y-0">
                    <div>
                        <h1 class="font-semibold">
                            {{ $cover->title }}
                        </h1>
                        <p>
                            @if ($cover->is_active)
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Activo</span>
                            @else
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Inactivo</span>
                            @endif
                        </p>
                    </div>

                    <div class="text-sm font-bold">
                        <p>
                            Fecha de inicio
                        </p>
                        <p>
                            {{ $cover->start_at->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="text-sm font-bold">
                        <p>
                            Fecha de finalización
                        </p>
                        <p>
                            {{ $cover->end_at ? $cover->end_at->format('d/m/Y') : '-' }}
                        </p>
                    </div>

                    <div>
                        <a class="btn btn-orange" href="{{ route('admin.covers.edit', $cover) }}">
                            Editar
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
        <script>
            new Sortable(covers, {
                animation: 150,
                ghostClass: 'bg-orange-200',
                store: {
                    set: (sortable) => {
                        const sorts = sortable.toArray();

                        axios.post("{{ route('api.sort.covers') }}", {
                            sorts: sorts
                        }).catch((error) => {
                            console.log(error);
                        })
                    }
                }
            });
        </script>
    @endpush


</x-admin-layout>
