<button {{ $attributes->merge(['class' => 'inline-block px-6 !bg-primary-50 py-2.5 text-white font-medium 
        text-sm leading-tight rounded shadow-md 
        hover:!bg-primary hover:shadow-lg transition duration-150 ease-in-out'])}}>
    {{ $slot }}
    {{ $spinner }}
</button>