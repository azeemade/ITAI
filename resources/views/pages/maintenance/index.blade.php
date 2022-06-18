@extends('layouts.app')
@section('content')
    <div class="mt-16">
        <div class="flex justify-end mb-6">
            <a href="" class="inline-block px-6 py-2.5 bg-primary-50 text-white font-medium 
                                    text-sm leading-tight rounded shadow-md 
                                    hover:bg-primary hover:shadow-lg transition duration-150 ease-in-out">
                <i class="bi bi-plus mr-2"></i>
                New asset
            </a>
        </div>
        <div class="flex justify-around p-4 bg-white border-gray-300 border rounded shadow">
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
                            type="text" aria-label="Search" placeholder="Search">
                </form>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label inline-block font-medium mb-2 text-dark text-sm">
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
                    focus:text-gray-700 focus:bg-white focus:border-primary focus:shadow-gray-50 focus:outline-none" aria-label="Default select example">
                    <option selected>All</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
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
                    focus:text-gray-700 focus:bg-white focus:border-primary focus:outline-none" aria-label="Default select example">
                    <option selected>All</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div>

        </div>
    </div>
@stop