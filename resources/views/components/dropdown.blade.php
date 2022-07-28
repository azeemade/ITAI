<div class="dropdown relative">
    <a class="
        dropdown-toggle
        px-2.5
        py-2.5
        bg-transparent
        text-dark
        font-medium
        text-xs
        rounded
        border
        border-secondary-50
        focus:outline-none focus:ring-0
        active:text-secondary"
        type="button"
        id="assetsTableDropdown"
        data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="bi bi-three-dots-vertical"></i>
    </a>
    <ul
        class="
        dropdown-menu
        min-w-max
        absolute
        hidden
        bg-white
        text-base
        z-50
        float-left
        py-2
        list-none
        text-left
        rounded-lg
        shadow-lg
        mt-1
        m-0
        bg-clip-padding
        border-none
        "
        aria-labelledby="assetsTableDropdown">
        {{ $slot }}
    </ul>
</div>