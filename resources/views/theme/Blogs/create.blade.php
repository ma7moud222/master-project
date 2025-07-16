@extends('theme.master')
@section('title' , 'Register')



@section('content')
@include('theme.partials.hero',['title' => 'Add New Blog'])


<!-- ================ contact section start ================= -->
<section class="section-margin--small section-margin">
  <div class="container">
    <div class="row">
      <div class="col-12">
        @if (session('blogCreatestatus'))
        <div class="alert alert-success">
          {{ session('blogCreatestatus') }}
        </div>
        @endif
        <form action="{{route('blogs.store')}}" class="form-contact contact_form" method="post" novalidate="novalidate" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <input class="form-control border" name="name" type="text" placeholder="Enter your Blog title" value="{{ old('name') }}">

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>

          <div class="form-group">
            <input class="form-control border" name="image" type="file" placeholder="Enter your Blog title" value="{{ old('name') }}">

            <x-input-error :messages="$errors->get('image')" class="mt-2" />
          </div>

          <div class="form-group">
            <select class="form-control border" name="category_id" type="text" placeholder="Enter your Blog title" value="{{ old('category_id') }}">
              <option value="">Select Category</option>
              @if(count($Categories) > 0)
              @foreach($Categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}
              </option>
              @endforeach
              @endif
            </select>

            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
          </div>




          <div class="form-group">
            <textarea class="form-control border custom-textarea"
              name="description"
              placeholder="Enter your Blog title">{{ old('description') }}</textarea>

            <x-input-error :messages="$errors->get('description')" class="mt-2" />
          </div>


          <div class="form-group text-center text-md-right mt-3">
            <button type="submit" class="button button--active button-contactForm">submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- ================ contact section end ================= -->
<!-- ================ contact section end ================= -->
@endsection