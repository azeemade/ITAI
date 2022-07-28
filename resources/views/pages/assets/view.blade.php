@extends('layouts.app')
@section('content')
    <div class="mt-16 px-16 bg-white rounded-lg py-8">
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4 flex flex-col justify-center items-center">
                @if($asset->image === null)
                    <i class="bi bi-pc-display text-5xl"></i>
                @else
                    <img src="{{ $asset->image }}" alt="{{ $asset->name }}">
                @endif
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-dark/50">Name:</p>
                    <p class="text-dark font-medium">{{ $asset->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Brand:</p>
                    <p class="text-dark font-medium">{{ $asset->brand }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Model:</p>
                    <p class="text-dark font-medium">{{ $asset->model }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Serial number:</p>
                    <p class="text-dark font-medium">{{ $asset->serial_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Tag:</p>
                    <p class="text-dark font-medium">{{ $asset->tag }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Registered by:</p>
                    <p class="text-dark font-medium">{{ $asset->user_id }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Registered on:</p>
                    <p class="text-dark font-medium">{{ \Carbon\Carbon::parse($asset->created_at)->format('j F Y') }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-dark/50">Location:</p>
                    <p class="text-dark font-medium">{{ $asset->location->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Department:</p>
                    <p class="text-dark font-medium">{{ $asset->department->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Category:</p>
                    <p class="text-dark font-medium">{{ $asset->category->name }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-dark/50">Disposition:</p>
                    <p class="text-dark font-medium">{{ $asset->disposition }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Status:</p>
                    <p class="text-dark font-medium">{{ $asset->status }}</p>
                </div>
                <div>
                    <p class="text-sm text-dark/50">Functionality:</p>
                    <p class="text-dark font-medium">{{ $asset->functionality }}</p>
                </div>
            </div>
            <div class="col-span-2 mb-4">
                <div>
                    <p class="text-sm text-dark/50">Note:</p>
                    <p class="text-dark font-medium">{{ $asset->note }}</p>
                </div>
            </div>
            <div class="mb-4 p-3 border rounded">
                <p class="text-dark mb-4 uppercase">others</p>
                @if( count($asset->others) > 0)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($asset->others as $item)
                            <div>
                                <p class="text-sm text-dark/50">{{ $item->name }}:</p>
                                <p class="text-dark font-medium">{{ $item->value }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div>
                        <p class="text-lg text-dark font-medium">Other not found ! </p>
                    </div>
                @endif
            </div>
            <div class="mb-4">
                <p class="text-dark mb-4 uppercase">Assigned to</p>
                @if( count($asset->staffs) > 0)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($asset->staffs as $item)
                            <div>
                                <p class="text-dark font-medium">Staff {{ $item->staff_id }}</p>
                                <p class="text-sm text-dark/50">{{ $item->firstname }} {{ $item->lastname }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div>
                        <p class="text-lg text-dark font-medium">Asset not assigned yet ! </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('includes.maintenance')
@stop