@extends('layouts.app')
@section('content')
    <div class="mt-16 px-16 mb-8 bg-white rounded-lg py-8">
        <form id="newMaintenance" class="grid grid-cols-3 gap-8" method="POST"  action="{{ url("maintenance/{ request()->route('asset') }/store") }}" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4 col-span-2">
                <div class="form-group col-span-2"> 
                    <label for="subject" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Subject <strong class="text-red-500">*</strong>
                    </label>
                    <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="subject" name="subject">
                    @error('subject')
                        <div class="text-red-600 py-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-span-2">
                    <label for="description" class="form-label inline-block font-medium mb-2 text-dark text-sm">
                        Description <strong class="text-red-500">*</strong>
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
                    id="description"
                    rows="3"
                    name="description"
                    ></textarea>
                    @error('description')
                        <div class="text-red-600 py-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group" id="serviceType"> 
                    <label for="staff_id" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Staff ID
                    </label>
                    <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="staff_id" name="staff_id">
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
                    <label for="priority" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Priority <strong class="text-red-500">*</strong>
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
                        name="priority">
                        <option selected disabled>Select priority</option>
                        @foreach($priority as $val)
                            <option value="{{ $val }}" {{$val == $val[0] ? 'selected' : ''}}>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="service_type" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                        Service Type <strong class="text-red-500">*</strong>
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
                        name="service_type">
                        <option selected disabled>Select service type</option>
                        @foreach($serviceType as $val)
                            <option value="{{ $val }}" {{$val == $val[0] ? 'selected' : ''}}>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-end-4 col-span-1 flex justify-end">
                <x-button type="submit" class="!bg-primary-50 text-white hover:!bg-primary">
                    <span id="title">Create Issue</span>
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
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

                $('#newMaintenance').on('submit', function(){
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
    </script> --}}
@stop