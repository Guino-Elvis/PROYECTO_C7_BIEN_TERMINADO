<div class="px-4 py-4 my-2 mx-2">
    <div class="text-start text-black text-sm rounded-t-lg">
        {{ $title }}
    </div>
    <div class="flex justify-between  text-zinc-600 group-hover:text-indigo-400">
        <div>
            <h1 class="text-4xl font-semibold">
                {{ $amount ?? '' }}
            </h1>
            <div class="text-sm flex gap-2 justify-center items-center">
                <div class="bg-yellow-100 rounded-md py-0.5 px-3">
                    {{ $porcentaje ?? '' }}
                </div>
                <div>
                    desde el anterior mes
                </div>
            </div>
        </div>
        <div>
            {{ $slot ?? '' }}
        </div>
    </div>
</div>
