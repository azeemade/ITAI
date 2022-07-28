<button {{ $attributes->merge(['class' => 'inline-block px-6 py-2.5 font-medium 
        text-sm leading-tight rounded shadow-md hover:shadow-lg transition duration-150 ease-in-out'])}}>
    {{ $slot }}
    {{ $spinner }}
</button>