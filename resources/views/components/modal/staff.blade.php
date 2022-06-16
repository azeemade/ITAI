<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="newStaffModal" tabindex="-1" aria-labelledby="newStaffModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
      <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
          <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
            Add new staff
          </h5>
          <button type="button"
            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
            data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body relative p-4">
            <div class="flex flex-col space-y-3">
                <x-alert id="staffAlert" class="hidden">
                {{-- @class([
                    'bg-green-100 text-green-700 border-green-700' => true,
                    'bg-red-100 text-red-700 border-red-700' => false
                ])> --}}
                {{-- <x-alert> --}}
                    <span id="alertText"></span>
                </x-alert>

                <div class="form-group" id="staffInputs"> 
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
                <div class="flex justify-between">
                    <div class="form-group mb-4" id="staffInputs"> 
                        <label for="firstname" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                            Firstname
                        </label>
                        <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="firstname" name="firstname">
                    </div>
                    <div class="form-group mb-4" id="staffInputs"> 
                        <label for="lastname" class="form-label font-medium inline-block mb-2 text-dark text-sm">
                            Lastname
                        </label>
                        <input class="form-control block w-full focus:border-primary 
                                border border-solid border-gray-300
                                focus:outline-none appearance-none text-sm 
                                leading-6 text-dark/50 placeholder-dark/50
                                rounded-md pl-7 py-1.5 shadow-sm" 
                            type="text" aria-label="lastname" name="lastname">
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
            </div>
        </div>
        <div
          class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md space-x-2">
            <button type="button"
                class="inline-block px-6 py-2.5 !bg-secondary-50 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:!bg-secondary hover:shadow-lg focus:!bg-secondary focus:shadow-lg focus:outline-none focus:ring-0 active:!bg-secondary active:shadow-lg transition duration-150 ease-in-out"
                data-bs-dismiss="modal">
                Close
            </button>
            <x-button id="addStaffBtn" type="button">
                <span id="title" class="inline-block">Add staff</span>
                <x-slot:spinner>
                    <div class="hidden justify-center items-center" id="spinner">
                        <div class="inline-block spinner-border animate-spin w-4 h-4 border-4 rounded-full" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </x-slot>
            </x-button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
  </script>