<div class="bg-white my-8 rounded-lg w-full" id="maintenanceLog">
    <div class="text-xl font-medium flex items-center justify-between py-4 px-3">
        <div>
            Maintenance Log (<strong>{{ $asset->maintenance->count()}}</strong>) 
        </div>
        <div class="flex space-x-4">
            <x-button type="button" class="!bg-white hover:!bg-secondary/70 hover:!text-secondary/50 !text-dark border !border-secondary">
                <span id="filter">
                    <i class="bi bi-cloud-download mr-2"></i>
                    Generate CSV
                </span>
                <x-slot:spinner></x-slot>
            </x-button>
            <a href="{{ route('new maintenance', [$asset->id]) }}" class="inline-block px-6 py-2.5 bg-primary-50 text-white font-medium 
                                text-sm leading-tight rounded shadow-md 
                                hover:bg-primary hover:shadow-lg transition duration-150 ease-in-out">
                <i class="bi bi-plus mr-2"></i>
                New issue
            </a>
        </div>
    </div>
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-secondary-50/50 border-b border-secondary">
                <th class="pl-3">ID</th>
                <th>Issue</th>
                <th>Description</th>
                <th>Status</th>
                <th>Asset ID</th>
                <th>Service type</th>
                <th>Staff ID</th>
                <th>Serviced by</th>
                <th>Fault date</th>
                <th>Repaired date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($asset->maintenance) > 0)
                @foreach($asset->maintenance as $item)
                    <tr>
                        <td class="pl-3">{{ $item->id }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->asset_id }}</td>
                        <td>{{ $item->service_type }}</td>
                        <td>{{ $item->staff_id }}</td>
                        <td>{{ $item->serviced_by }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('j F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->repaired_at)->format('j F Y') }}</td>
                        <td>
                            <x-dropdown>
                                <li>
                                    <a class="dropdown-item text-sm py-2 px-4 font-normal 
                                                block w-full whitespace-nowrap text-gray-700 
                                                hover:bg-gray-100"
                                        href="{{ route('show maintenance', [$item->id]) }}">
                                        View
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-sm py-2 px-4 font-normal 
                                                block w-full whitespace-nowrap text-gray-700 
                                                hover:bg-gray-100"
                                        data-bs-toggle="modal" data-bs-target="#maintenanceModal">
                                        Edit
                                    </a>
                                    <x-modal.maintenance :asset="$item" />
                                </li>
                                <li>
                                    <a class="dropdown-item text-sm py-2 px-4 font-normal 
                                            block w-full whitespace-nowrap text-red-700
                                            hover:bg-gray-100"
                                    href="{{ url("/assets/{$item->id}#maintenanceLog") }}">
                                    Delete
                                    </a>
                                </li>
                            </x-dropdown>
                        </td>
                    </tr>
                @endforeach
            @else
                <x-error.table>
                    <x-slot:image>
                        <img src="{{ asset('image/24.png')}}" alt="error image" class="w-96">
                    </x-slot>
                    <span>
                        <a href="{{ route('new maintenance', [$asset->id]) }}" class="mb-3 inline-block px-6 py-2.5 bg-primary-50 text-white font-medium 
                        text-sm leading-tight rounded shadow-md 
                        hover:bg-primary hover:shadow-lg transition duration-150 ease-in-out">
                            <i class="bi bi-plus mr-2"></i>
                            New issue
                        </a>
                    </span>
                </x-error.table>
            @endif
        </tbody>
    </table>
</div>