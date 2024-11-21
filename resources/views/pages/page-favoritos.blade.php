<div>
@if ($ofertas->isEmpty())
    @include('errors.error-list-favoritos')
@else
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            <div class="flex flex-col gap-2">
                @foreach ($ofertas as $favorito)
                    <div
                        class="
            scale-100 p-6 bg-white border-2 from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20  motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500 ">
                        <div class="">
                            <div class="flex justify-between">
                                <div class="flex flex-row gap-5">
                                    <div class="flex flex-row gap-2 w-11/12">
                                        <div class="flex justify-center items-center">
                                            <span
                                                class="bg-gray-200 rounded-md px-2 py-1 text-gray-600 text-sm font-bold ">nuevo
                                                empleo</span>
                                        </div>
                                        <div class="flex justify-center items-center">

                                            <span
                                                class="bg-gray-200 rounded-md px-2 py-1 text-gray-600 text-sm font-bold ">
                                                <i class="fa-solid fa-building"></i> {{ $favorito->oferta_laboral->category->name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="shadow-md shadow-gray-500 rounded-md px-2 py-1">
                                        <img src="{{ $favorito->oferta_laboral->empresa->image ? Storage::url($favorito->oferta_laboral->empresa->image->url) : '/img/no_imagen.jpg' }}"
                                            class="max-w-[5rem]" alt="">
                                    </div>
                                </div>
                                <div class=" w-1/12">
                                    <span wire:click="$emit('deleteItem',{{ $favorito->id }})""
                                        class="text-xl text-gray-600 px-4 py-2 flex justify-center items-center bg-transparent hover:bg-gray-200 hover:rounded-md hover:text-black ">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </span>
                                </div>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 text-start">{{ $favorito->oferta_laboral->titulo }}
                            </h2>




                            <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                <span class="flex justify-start items-center text-sm ">{{ $favorito->oferta_laboral->empresa->ra_social }}</span>
                                <samp class="font-bold text-sm ">5.0<i class="fa-solid fa-star fa-xs "></i></samp>
                            </div>
                            <span class="flex justify-start items-center text-sm">
                                @if (
                                    empty($favorito->oferta_laboral?->departamento?->name) || 
                                    empty($favorito->oferta_laboral?->provincia?->name) || 
                                    empty($favorito->oferta_laboral?->distrito?->name)
                                )
                                    no hay ubicación
                                @else
                                    {{ $favorito->oferta_laboral->departamento->name }} 
                                    {{ $favorito->oferta_laboral->provincia->name }} 
                                    {{ $favorito->oferta_laboral->distrito->name }}
                                @endif
                            </span>
                            <div class="flex fle-row gap-2 justify-start items-center pt-2">
                                <div class="flex fle-row gap-2 font-bold bg-green-200 rounded-md py-1 px-2">
                                    <span
                                        class="flex justify-start items-center text-sm ">{{ $favorito->oferta_laboral->remuneracion }}</span>
                                    <samp><i class="fa-solid fa-heart"></i></samp>
                                </div>
                                <div class="flex fle-row gap-2 font-bold bg-gray-200 rounded-md py-1.5 px-2">
                                    <span class="flex justify-start items-center text-sm gap-1">
                                        <i class="fa-solid fa-building"></i> {{ $favorito->oferta_laboral->category->name }}
                                    </span>
                                </div>
                            </div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="py-5">
                                            <div class="flex flex-row gap-1">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" focusable="false"
                                                        role="img" fill="#2557A7" viewBox="0 0 24 24"
                                                        aria-hidden="true" class="w-6 h-6">
                                                        <path
                                                            d="M2.344 4.018a.25.25 0 00-.33.31l1.897 5.895a.5.5 0 00.371.335l7.72 1.44-7.72 1.44a.5.5 0 00-.371.335l-1.898 5.896a.25.25 0 00.33.31l19.494-7.749a.25.25 0 000-.464L2.344 4.018z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span>Postulación vía Indeed</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pb-5 text-gray-500">
                                            <ul class="list-disc mt-0 mb-5 pl-5">
                                                <li class="mb-0 text-start line-clamp-2">
                                                    {{ $favorito->oferta_laboral->descripcion }}
                                                </li>

                                                <li class="text-start">
                                                    <p class="line-clamp-3"> {{ $favorito->oferta_laboral->body }}</p>
                                                </li>
                                            </ul>
                                            <span>
                                                <div class="text-sm text-start">Activo hace 2 días</div>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
             
            </div>
           
        </div>
    </div>
@endif
    <!--Scripts - Sweetalert   -->
    @push('js')
        <script>
            Livewire.on('deleteItem', id => {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //alert("del");
                        Livewire.emitTo('page-favoritos', 'removeFavorite', id);
                        Swal.fire(
                            '¡Eliminado!',
                            'Su archivo ha sido eliminado.',
                            'success'
                        )

                    }
                })
            });
        </script>
    @endpush
</div>