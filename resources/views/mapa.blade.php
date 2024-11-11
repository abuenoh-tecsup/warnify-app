@extends('layouts.layout')

@section('title', 'Mapa')

@section('content')
    <div class="flex-grow h-full grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 bg-blue-500 p-4">
            <p>Columna 1 (1/3)</p>
        </div>
        <div class="col-span-1 md:col-span-2 bg-green-500 p-4">
            <p>Columna 2 (2/3)</p>
            <form>
                <div class="flex items-center space-x-6 mb-4">

                  <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" onchange="loadFile(event)" class="block w-full text-sm text-slate-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-full file:border-0
                      file:text-sm file:font-semibold
                      file:bg-violet-50 file:text-violet-700
                      hover:file:bg-violet-100
                    "/>
                  </label>
                </div>
              </form>
              <div class="shrink-0 mb-4">

                <img id='preview_img' class="w-full h-48 object-cover rounded-full" src="https://lh3.googleusercontent.com/a-/AFdZucpC_6WFBIfaAbPHBwGM9z8SxyM1oV4wB4Ngwp_UyQ=s96-c" alt="Current profile photo" />


              </div>

              <script>
                      var loadFile = function(event) {

                          var input = event.target;
                          var file = input.files[0];
                          var type = file.type;

                         var output = document.getElementById('preview_img');


                          output.src = URL.createObjectURL(event.target.files[0]);
                          output.onload = function() {
                              URL.revokeObjectURL(output.src) // free memory
                          }
                      };
              </script>
        </div>
    </div>
@endsection
