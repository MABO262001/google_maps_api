@extends('Panza')

@section('PanzaArriba')
    Google Maps
@endsection

@section('PanzaAbajo')
    <div class="flex justify-center mt-4">
        <button onclick="window.location='{{ route('mapa.create') }}'"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Crear Punto En Mapa
        </button>
    </div>
    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-center">Ubicaciones Guardadas</h2>
        <div class="flex flex-col mt-5 items-center">
            <div class="overflow-x-auto max-w-4xl w-full">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Latitud
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Longitud
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Usuario ID
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($ubicaciones as $ubicacion)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $ubicacion->latitud }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $ubicacion->longitud }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $ubicacion->users_id }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <a href="{{ route('mapa.edit', $ubicacion->id) }}"
                                                    class="text-blue-500 font-bold mr-3 transition duration-300 transform hover:scale-110">
                                                    <i class="fas fa-edit fa-lg"></i>
                                                </a>
                                                <form action="{{ route('mapa.destroy', $ubicacion->id) }}" method="post"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 font-bold transition duration-300 transform hover:scale-110">
                                                        <i class="fas fa-trash fa-lg"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
