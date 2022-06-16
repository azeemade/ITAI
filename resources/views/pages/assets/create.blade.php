@extends('layouts.app')
@section('content')
    <div class="mt-16 px-16 mb-8 bg-white rounded-lg py-8">
        <form id="newAsset" class="grid grid-cols-3 gap-8" method="POST"  action="{{ url('assets/store') }}" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4 col-span-2">
                <div class="form-group col-span-2"> 
                    <label for="assetname" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Name <strong class="text-red-500">*</strong>
                    </label>
                    <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="name" name="name">
                    @error('name')
                        <div class="text-red-600 py-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group"> 
                    <label for="brand" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Brand <strong class="text-red-500">*</strong>
                    </label>
                    <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="brand" name="brand">
                    @error('brand')
                        <div class="text-red-600 py-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group"> 
                    <label for="model" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Model
                    </label>
                    <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="model" name="model">
                </div>
                <div class="form-group"> 
                    <label for="serial_number" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Serial No.
                    </label>
                    <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="serial_number" name="serialnumber">
                </div>
                <div class="form-group"> 
                    <label for="tag" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Tag
                    </label>
                    <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="tag" name="tag">
                </div>
                <div class="form-group col-span-2">
                    <label for="note" class="form-label inline-block font-medium mb-2 text-dark text-sm">
                    Note
                    </label>
                    <textarea
                    class="
                        form-control
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                    "
                    id="note"
                    rows="3"
                    name="note"
                    ></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 col-span-2">
                    <div>
                        <div class="flex justify-between mb-4">
                            <p class="font-semibold text-dark text-sm">Others</p>
                            <a id="othersBtn" class="inline-block underline text-primary font-semibold 
                                        text-sm leading-tight transition duration-150 ease-in-out">
                                <i class="bi bi-plus"></i>
                                Add
                            </a>
                        </div>
                        <div id="others" class="grid grid-cols-2 gap-4">
                            <div class="form-group"> 
                                <label for="name" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                                    Name
                                </label>
                                <input class="form-control block w-full focus:border-primary 
                                            border border-solid border-gray-300
                                            focus:outline-none appearance-none text-sm 
                                            leading-6 text-dark/50 placeholder-dark/50
                                            rounded-md pl-7 py-1.5 shadow-sm" 
                                        type="text" aria-label="name" name="others[][name]">
                            </div>
                            <div class="form-group"> 
                                <label for="value" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                                    Value
                                </label>
                                <input class="form-control block w-full focus:border-primary 
                                            border border-solid border-gray-300
                                            focus:outline-none appearance-none text-sm 
                                            leading-6 text-dark/50 placeholder-dark/50
                                            rounded-md pl-7 py-1.5 shadow-sm" 
                                        type="text" aria-label="value" name="others[][value]">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-4">
                            <p class="font-semibold text-dark text-sm">Assign to</p>
                            {{-- <a id="addStaff" class="inline-block underline text-primary font-semibold 
                                        text-sm leading-tight transition duration-150 ease-in-out">
                                <i class="bi bi-plus"></i>
                                Add
                            </a> --}}
                        </div>
                        <div class="form-group mb-4" id="staffInputs"> 
                            <label for="staff_id" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                                Staff ID
                            </label>
                            <div class="relative">
                                <input class="form-control block w-full focus:border-primary 
                                        border border-solid border-gray-300
                                        focus:outline-none appearance-none text-sm 
                                        leading-6 text-dark/50 placeholder-dark/50
                                        rounded-md pl-7 py-1.5 shadow-sm" 
                                    type="text" aria-label="staff_id" name="sid" id="sid">
                                <button type="button" class="absolute right-2 bottom-1 text-xs hidden py-1 px-2 border !bg-primary-50 text-white rounded 
                                hover:!bg-primary hover:shadow-lg hover:text-white transition duration-150 ease-in-out" id="sidBtn">
                                    <div class="hidden justify-center items-center" id="sidSpinner">
                                        <div class="inline-block spinner-border text-white animate-spin w-4 h-4 border-4 rounded-full" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <span id="sidBtnText" class="hidden">Add</span>
                                </button>
                            </div>
                            
                            <div class="py-1 text-sm hidden" id="sidText"></div>
                            <x-modal.staff :department="$department" :location="$location"></x-modal.staff>
                            <div class="mb-3"></div>
                            {{-- <input class="form-control block w-full focus:border-primary 
                                    border border-solid border-gray-300
                                    focus:outline-none appearance-none text-sm 
                                    leading-6 text-dark/50 placeholder-dark/50
                                    rounded-md pl-7 py-1.5 shadow-sm" 
                                type="text" aria-label="staff_id" name="staff_id[]"> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 mb-8">
                <div class="form-group">
                    <div id="noPreview" class="flex-col flex items-center">
                        <div class="w-36 h-28 bg-gray-200 rounded flex justify-center items-center">
                            <i class="bi bi-pc-display text-3xl"></i>
                        </div>
                        <label for="file">
                            <input type="file" id="file" name="image" autocomplete="off" class="hidden">
                            <a class="text-primary flex justify-center font-medium text-sm mt-3">Upload image</a>
                        </label>
                    </div>
                    <div id="preview" class="relative hidden">
                        <div class="flex-col flex items-center">
                            <img src="" class="w-36 h-28 border border-gray-200 rounded" id="assetImage">
                        </div>
                        <label for="file"  class="">
                            <input type="file" id="file" name="image" autocomplete="off" class="hidden">
                            <a class="text-primary flex justify-center font-medium text-sm mt-3">Change image</a>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="location" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Location <strong class="text-red-500">*</strong>
                    </label>
                    <select class="form-select appearance-none
                        block
                        w-full
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
                        focus:text-gray-700 focus:bg-white focus:border-primary focus:shadow-gray-50 focus:outline-none" aria-label="Default select example"
                        name="location">
                        @foreach($location as $val)
                            <option value="{{ $val->id }}" {{$val == $val[0] ? 'selected' : ''}}>{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="department" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Department <strong class="text-red-500">*</strong>
                    </label>
                    <select class="form-select appearance-none
                        block
                        w-full
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
                        focus:text-gray-700 focus:bg-white focus:border-primary focus:shadow-gray-50 focus:outline-none" aria-label="Default select example"
                        name="department">
                        @foreach($department as $val)
                            <option value="{{ $val->id }}" {{$val == $val[0] ? 'selected' : ''}}>{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="category" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Category <strong class="text-red-500">*</strong>
                    </label>
                    <select class="form-select appearance-none
                        block
                        w-full
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
                        focus:text-gray-700 focus:bg-white focus:border-primary focus:shadow-gray-50 focus:outline-none" aria-label="Default select example"
                        name="category">
                        @foreach($category as $val)
                            <option value="{{ $val->id }}" {{$val == $val[0] ? 'selected' : ''}}>{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Status <strong class="text-red-500">*</strong>
                    </label>
                    <select class="form-select appearance-none
                        block
                        w-full
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
                        focus:text-gray-700 focus:bg-white focus:border-primary focus:shadow-gray-50 focus:outline-none" aria-label="Default select example"
                        name="status">
                        @foreach($status as $val)
                            <option value="{{ $val }}" {{$val == $val[0] ? 'selected' : ''}}>{{ rtrim($val, "_") }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="functionality" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Functionality <strong class="text-red-500">*</strong>
                    </label>
                    <select class="form-select appearance-none
                        block
                        w-full
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
                        focus:text-gray-700 focus:bg-white focus:border-primary focus:shadow-gray-50 focus:outline-none" aria-label="Default select example"
                        name="functionality">
                        @foreach($functionality as $val)
                            <option value="{{ $val }}" {{$val == $val[0] ? 'selected' : ''}}>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="disposition" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Disposition <strong class="text-red-500">*</strong>
                    </label>
                    <select class="form-select appearance-none
                        block
                        w-full
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
                        focus:text-gray-700 focus:bg-white focus:border-primary focus:shadow-gray-50 focus:outline-none" aria-label="Default select example"
                        name="disposition">
                        @foreach($disposition as $val)
                            <option value="{{ $val }}" {{$val == $val[0] ? 'selected' : ''}}>{{ rtrim($val, "_") }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-end-4 col-span-1 flex justify-end">
                <x-button type="submit">
                    <span id="title">Add asset</span>
                    <x-slot:spinner>
                        <div class="hidden justify-center items-center" id="spinner">
                            <div class="inline-block spinner-border animate-spin w-4 h-4 border-4 rounded-full" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </x-slot>
                </x-button>
            </div>
        </form>  
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(
            function() {

                var previewImage = function(input) {
                    if (input.files) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $("#assetImage").attr('src', event.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                };

                $('#file').on('change', function() {
                    $("#noPreview").hide()
                    $("#preview").show()
                    previewImage(this);
                });

                $('#sidBtn').on('click', function(){
                    var staff_id = $('#sid').val();
                    $('#staffInputs').append(`<div class="form-group mb-4">
                                        <label for="sid" class="form-label font-medium inline-block mb-1 text-dark text-sm">Staff ID</label>
                                        <input class="form-control block w-full focus:border-primary border border-solid border-gray-300 focus:outline-none appearance-none text-sm  leading-6 text-dark/50 placeholder-dark/50 rounded-md pl-7 py-1.5 shadow-sm" type="text" aria-label="sid" name="staff_id[]" value=${staff_id}>
                                    </div>`)
                    $('#sidText').empty();
                    $('#sidBtn').addClass('hidden').removeClass('inline-block');
                    
                })

                $('#othersBtn').on('click', function(){
                    $('#others').append('<div class="form-group">'+
                                            '<label for="name" class="form-label font-medium inline-block mb-2 text-dark text-sm">Name</label>' +
                                            '<input class="form-control block w-full focus:border-primary border border-solid border-gray-300 focus:outline-none appearance-none text-sm leading-6 text-dark/50 placeholder-dark/50 rounded-md pl-7 py-1.5 shadow-sm" type="text" aria-label="name" name="others[][name]">'+
                                        '</div>'+

                                        '<div class="form-group">'+ 
                                            '<label for="value" class="form-label font-medium inline-block mb-2 text-dark text-sm">Value</label>'+
                                            '<input class="form-control block w-full focus:border-primary  border border-solid border-gray-300 focus:outline-none appearance-none text-sm  leading-6 text-dark/50 placeholder-dark/50 rounded-md pl-7 py-1.5 shadow-sm" type="text" aria-label="value" name="others[][value]">'+
                                        '</div>')
                })

                $('#newAsset').on('submit', function(){
                    $('#title').hide()
                    $('#spinner').addClass('flex').removeClass('hidden');
                })

                $('#sid').on('change', function() {
                    $('#sidText').empty();
                    var staff_id = $('#sid').val();
                    if(staff_id.length >= 4){
                        $('#sidBtn').addClass('inline-block').removeClass('hidden');
                        $('#sidBtnText').addClass('hidden').removeClass('inline-block');
                        $('#sidSpinner').addClass('inline-block').removeClass('hidden');

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            method: "post",
                            url: "http://127.0.0.1:8000/staff/check-id",
                            data: {staff_id: staff_id},
                            success: function(res){
                                if(res.status == 'Success') {
                                    $('#sidBtnText').addClass('inline-block').removeClass('hidden');
                                    $('#sidSpinner').addClass('hidden').removeClass('inline-block');
                                    $('#sidText').addClass('inline-block').removeClass('hidden')
                                    .append(`<a class="inline-block text-green-500 font-medium text-xs">${res.message}</a>`);
                                }
                                else {
                                    $('#sidText').addClass('inline-block').removeClass('hidden')
                                    .append(`<a class="inline-block text-red-500 font-medium text-xs">${res.message} <strong class="underline text-primary" data-bs-toggle="modal" data-bs-target="#newStaffModal">Add new staff</strong></a>`)
                                    $('#sidBtn').addClass('hidden').removeClass('inline-block');
                                    $('#sidSpinner').addClass('hidden').removeClass('inline-block');
                                }
                            }
                        })
                    }
                })
            }
        );
        </script>
@stop