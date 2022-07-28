<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="newStaffModal" tabindex="-1" aria-labelledby="maintenanceModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
      <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
          <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
            Update Issue
          </h5>
          <button type="button"
            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
            data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body relative p-4">
            <form id="newMaintenance" class="grid grid-cols-3 gap-8" method="post"  action="{{ url("maintenance/{$asset->id}/store") }}" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                    <div class="form-group col-span-2">
                        <label for="comment" class="form-label inline-block font-medium mb-2 text-dark text-sm">
                            Comment <strong class="text-red-500">*</strong>
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
                        id="comment"
                        rows="3"
                        name="comment"
                        ></textarea>
                        @error('comment')
                            <div class="text-red-600 py-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="datepicker relative form-floating mb-3 xl:w-96">
                        <input type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Select a date" />
                        <label for="floatingInput" class="text-gray-700">Repair date</label>
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
                            <option selected disabled>Select status</option>
                            @foreach($status as $val)
                                <option value="{{ $val }}" {{$val == $val[0] ? 'selected' : ''}}>{{ rtrim($val, "_") }}</option>
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
                            <option selected disabled>Select service typpe</option>
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
      </div>
    </div>
  </div>
  {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
      $(
          function() {
            $('#addStaffBtn').on('click', function(e){
                e.preventDefault();
                $('#spinner').addClass('inline-block').removeClass('hidden');
                $('#title').addClass('hidden').removeClass('inline-block');
                $('#staffAlert').removeClass('bg-green-100 text-green-700 border-green-700 inline-flex bg-red-100 text-red-700 border-red-700').addClass('hidden')
                $('#alertText').empty()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "post",
                    url: "http://127.0.0.1:8000/staff/store",
                    data: {
                        staff_id: $('[name=staff_id]').val(),
                        firstname:$('[name=firstname]').val(),
                        lastname: $('[name=lastname]').val(),
                        department_id:  $('[name=department]').val(),
                        location_id: $('[name=location]').val(),
                    },
                    success: function(res){
                        if(res.status == true) {
                            $('#staffAlert').addClass('bg-green-100 text-green-700 border-green-700 inline-flex').removeClass('hidden')
                            $('#alertText').append(res.message)
                        }
                        else {
                            $('#staffAlert').addClass('bg-red-100 text-red-700 border-red-700 inline-flex').removeClass('hidden')
                        }
                        $('#title').addClass('inline-block').removeClass('hidden');
                        $('#spinner').addClass('hidden').removeClass('inline-block');
                        $('#alertText').append(res.message)
                    }
                })
            })
          }
      )
  </script> --}}