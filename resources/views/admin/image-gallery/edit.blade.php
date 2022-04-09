@extends('layouts.load')

@section('content')


    <div class="add-product-content p-0 shadow-none">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area shadow-none">
                    @include('includes.admin.form-error')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdataedit"  action="{{ route('image.gallery.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="galleryId" id="galleryId" value="{{ $data->id}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Language') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="language_id" id="album_update_language_id">
                                        <option value="">{{__('Please Select a Language')}}</option>
                                        @foreach ($languages as $language)
                                            <option value="{{$language->id}}" {{ $data->language_id == $language->id ? 'selected' : ''}}>{{$language->language}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Album') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="image_album_id" id="image_update_album_id">
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Category') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="image_category_id" id="image_category_id">
                                        <option value="">{{__('Please Select Your Category')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                  <div class="left-area">
                                      <h4 class="heading">{{__('Current Gallery Image')}} *</h4>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="img-upload">
                                      <div id="image-preview" class="img-preview" style="background: url({{$data->gallery ? asset('assets/images/image-gallery/'.$data->gallery) : asset('assets/admin/images/upload.png') }});">
                                          <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>Upload Image</label>
                                          <input type="file" name="gallery" class="img-upload" id="image-upload">
                                        </div>
                                        <p class="text">{{__('Prefered Size: (600x600) or Square Sized Image')}}</p>
                                  </div>
                                </div>
                              </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn"
                                        type="submit">{{ __('Update Image Gallery') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{asset('assets/admin/js/gallary.js')}}"></script>
@endsection
