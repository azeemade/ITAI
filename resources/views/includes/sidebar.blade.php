<div class="px-7 pt-8 flex flex-col items-center">
    <p class="mb-16 text-2xl">
        <strong class="text-primary">MEDIA </strong> <strong class="text-secondary">TRUST</strong></p>
    <div>
        <ul class="flex-col flex space-y-10 h-full">
            <li class="">
                <a href="{{ route('overview') }}" class="inline-block px-6 py-2.5  
                            font-medium text-sm leading-tight rounded hover:bg-primary 
                            hover:shadow-md hover:text-white transition duration-150 ease-in-out
                            {{ (request()->is('/')) ? 'border-primary-50 text-primary-50 bg-primary-50/50 shadow-md border font-semibold' : 'bg-transparent text-dark' }}">
                    <i class="bi bi-grid-1x2 mr-2"></i>
                    Overview
                </a>
            </li>
            <li class="">
                <a href="{{ route('assets') }}"  class="inline-block px-6 py-2.5  
                            font-medium text-sm leading-tight rounded hover:bg-primary 
                            hover:shadow-md hover:text-white transition duration-150 ease-in-out
                            {{ (request()->is('assets*')) ? 'border-primary-50 text-primary-50 bg-primary-50/50 shadow-md border font-semibold' : 'bg-transparent text-dark' }}">
                    <i class="bi bi-pc-display mr-2"></i>
                    Assets
                </a>
            </li>
            <li class="">
                <a href="{{ route('maintenance') }}"  class="inline-block px-6 py-2.5  
                            font-medium text-sm leading-tight rounded hover:bg-primary 
                            hover:shadow-md hover:text-white transition duration-150 ease-in-out
                            {{ (request()->is('maintenance*')) ? 'border-primary-50 text-primary-50 bg-primary-50/50 shadow-md border font-semibold' : 'bg-transparent text-dark' }}">
                    <i class="bi bi-wrench-adjustable-circle mr-2"></i>
                    Maintenance
                </a>
            </li>
            <li class="">
                <a href="{{ route('users') }}"  class="inline-block px-6 py-2.5  
                            font-medium text-sm leading-tight rounded hover:bg-primary 
                            hover:shadow-md hover:text-white transition duration-150 ease-in-out
                            {{ (request()->is('users*')) ? 'border-primary-50 text-primary-50 bg-primary-50/50 shadow-md border font-semibold' : 'bg-transparent text-dark' }}">
                <i class="bi bi-people mr-2"></i>
                    Users
                </a>
            </li>
        </ul>
    </div>
</div>