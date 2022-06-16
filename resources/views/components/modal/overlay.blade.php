<div {{ $attributes->merge(['class' => 'fixed top-0 left-0 z-50 w-screen h-screen items-center justify-center' ]) }}>
    <div class="bg-white border py-2 px-5 rounded-lg flex items-center flex-col">
        <div class="inline-flex justify-center items-center" id="spinner">
            <div class="inline-block spinner-border animate-spin w-8 h-8 border-4 rounded-full" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="text-gray-500 text-xs font-medium mt-2 text-center">
            Loading results...
        </div>
        </div>
    </div>
</div>