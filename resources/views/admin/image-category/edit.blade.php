@extends('layouts.load')

@section('content')

<div class="content-area">

    <div class="add-product-content p-0 shadow-none">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area shadow-none">
                    @include('includes.admin.form-error')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdataedit" action="{{ route('image.category.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="categoryId" id="categoryId" value="{{ $data->id}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Language') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="language_id" id="image_category_language_edit_id">
                                        <option value="">{{__('Please Select Your Language')}}</option>
                                        @foreach ($languages as $languages)
                                            <option value="{{$languages->id}}" {{ $data->language_id == $languages->id ? 'selected' : ''}}>{{$languages->language}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Language') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="image_album_id" id="image_album_id">
                                        <option value="">{{__('Please Select Your Album')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Category Name') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" name="name" placeholder="{{__('Enter Category Name')}}" class="input-field" value="{{ $data->name}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn"
                                        type="submit">{{ __('Update Category') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('assets/admin/js/image_category_edit.js')}}"></script>
@endsection
