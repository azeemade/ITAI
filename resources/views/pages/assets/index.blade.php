@extends('layouts.app')
@section('content')
    <div class="mt-16">
        <div class="flex justify-end mb-6">
            <a href="{{ route('new asset') }}" class="inline-block px-6 py-2.5 bg-primary-50 text-white font-medium 
                                    text-sm leading-tight rounded shadow-md 
                                    hover:bg-primary hover:shadow-lg transition duration-150 ease-in-out">
                <i class="bi bi-plus mr-2"></i>
                New asset
            </a>
        </div>
        <div class="flex justify-around p-4 bg-white items-end rounded-lg shadow">
            <div>
                <label for="exampleFormControlInput1" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                    Search for name or brand
                </label>
                <form class="group relative">
                    <i class="bi bi-search absolute left-3 top-1/2 -mt-2.5 text-sm text-dark/50 
                    pointer-events-none group-focus-within:text-primary"></i>
                    <input class="focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none w-64 text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="Search" placeholder="Search" name="search" id="searchbar">
                </form>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                    Category
                </label>
                <select class="form-select appearance-none
                    block
                    w-48
                    px-3
                    py-1.5
                    text-sm
                    text-dark/50
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0 focus:border-2
                    focus:text-gray-700 focus:bg-white focus:border-primary focus:shadow-gray-50 focus:outline-none" aria-label="Default select example"                                                                      focus:bg-white focus:border-primary focus:outline-none" aria-label="Default select example"
                    name="category" id="category">
                    <option value="All" selected>All</option>
                    @foreach($categories as $val)
                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                    Department
                </label>
                <select class="form-select appearance-none
                    block
                    w-48
                    px-3
                    py-1.5
                    text-sm
                    text-dark/50
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-primary focus:outline-none" aria-label="Default select example"
                    name="department" id="department">
                    <option value="All" selected>All</option>
                    @foreach($departments as $val)
                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-button type="button" class="!bg-secondary-50 hover:!bg-secondary !text-white">
                    <span id="filter">Filter</span>
                    <x-slot:spinner></x-slot>
                </x-button>
            </div>
        </div>

        <div class="bg-white my-5 rounded-lg shadow-md">
            <table class="table-auto w-full">
                <caption class="text-xl font-medium text-left py-4 pl-3">
                    All Assets (<strong>{{ $assets->count() }}</strong>)
                </caption>
                <thead>
                    <tr class="bg-secondary-50/50 border-b border-secondary">
                        <th class="pl-3">ID</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Serial No.</th>
                        <th>Status</th>
                        <th>Department</th>
                        <th>Category</th>
                        <th>Registered by</th>
                        <th>Registered on</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assets as $asset)
                        <tr>
                            <td class="pl-3">{{ $asset->id }}</td>
                            <td>{{ $asset->name }}</td>
                            <td>{{ $asset->brand }}</td>
                            <td>{{ $asset->model }}</td>
                            <td>{{ $asset->serial_number || '--' }}</td>
                            <td>{{ $asset->status }}</td>
                            <td>{{ $asset->department->name }}</td>
                            <td>{{ $asset->category->name }}</td>
                            <td>{{ $asset->user_id }}</td>
                            <td>{{ \Carbon\Carbon::parse($asset->created_at)->format('j F Y') }}</td>
                            <td>
                                <x-dropdown>
                                    <li>
                                        <a class="dropdown-item text-sm py-2 px-4 font-normal 
                                                    block w-full whitespace-nowrap text-gray-700 
                                                    hover:bg-gray-100"
                                            {{-- href="{{ route('show asset', [$asset->id]) }}"> --}}
                                            View
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-sm py-2 px-4 font-normal 
                                                    block w-full whitespace-nowrap text-gray-700 
                                                    hover:bg-gray-100"
                                            {{-- href="{{ route('edit asset', [$asset->id]) }}"> --}}
                                            Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-sm py-2 px-4 font-normal 
                                                block w-full whitespace-nowrap text-gray-700
                                                hover:bg-gray-100"
                                        href="{{ url("/assets/{$asset->id}#maintenanceLog") }}">
                                        Maintenance Log
                                        </a>
                                    </li>
                                </x-dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-modal.overlay class="hidden" id="assetOverlay" style="background-color: rgba(0, 0, 0, 0.3)" />
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(
            function() {
                $('#filter').on('click', function(){
                    $('#assetOverlay').removeClass('hidden').addClass('flex')
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: "post",
                        url: "http://127.0.0.1:8000/assets/filter",
                        data: {
                            search: $('[name=search]').val(),
                            category:$('[name=category]').val(),
                            department:  $('[name=department]').val(),
                        },
                        success: function(res){
                            $('#assetOverlay').removeClass('flex').addClass('hidden')
                            if(res.status == true) {
                                $('tbody').html(res.data);
                            }
                            else {
                                $('tbody').html(` 
                                                    <x-error.table>
                                                        <x-slot:image>
                                                            <img src="{{ asset('image/23.png')}}" alt="error image" class="w-96">
                                                        </x-slot>
                                                        <span>
                                                            <a href="{{ route('new asset') }}" class="mb-3 inline-block px-6 py-2.5 bg-primary-50 text-white font-medium 
                                                                                    text-sm leading-tight rounded shadow-md 
                                                                                    hover:bg-primary hover:shadow-lg transition duration-150 ease-in-out">
                                                                <i class="bi bi-plus mr-2"></i>
                                                                New asset
                                                            </a>
                                                        </span>
                                                </x-error.table> `)
                            }
                        }
                    })
                });

                // $('#searchbar').on('keypress', function(e){
                //     // e.preventDefault()
                //     if(e.keyCode === 13) {
                //         filterData();
                //     }
                // });
            }
        )
    </script>
@stop