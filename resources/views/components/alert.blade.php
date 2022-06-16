<div {{ $attributes->merge(['class' => '
        alert rounded-lg py-5 border px-6 mb-3 
        text-base items-center 
        w-full alert-dismissible fade show
        '])
    }} role="alert">
    {{ $slot }}
    <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-secondary-50 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-secondary hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>
</div>