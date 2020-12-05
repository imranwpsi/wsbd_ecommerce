<div class="modal fade  centered-modal" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">@if(!empty($subCategory)) {{trans('label.update_sub_category')}} @else {{trans('label.create_sub_category')}} @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEditForm" method="post" action="{{ isset($subCategory->id) ? route('subCategory.update', $subCategory->id) : route('subCategory.store') }}" enctype="multipart/form-data">
                @csrf
                @if(!empty($subCategory)) @method('PATCH') @endif

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{trans('label.category_name')}}</label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ isset($subCategory->name) ? $subCategory->name : '' }}" />
                        </div>
                    </div>

                    <div class="position-relative form-group">
                        <label for="banner" class="">{{trans('label.banner')}}</label>
                        <div class="preview-zone" style="width: 200px; height: 150px;">
                          <div class="box box-solid">
                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                              <i class="fa fa-times"></i>
                            </button>
                            <div class="box-body banner-img">
                                <img src="{{ isset($subCategory->banner) ? asset($subCategory->banner) : asset('avatar.jpg') }}"  width='200' height='150'/>
                            </div>
                          </div>
                        </div><br>
                        <div class="dropzone-wrapper">
                          <input type="file" class="dropzone1" name="banner" id="banner">
                        </div>
                    </div>

                    <div class="position-relative form-group"><label for="category" class="">{{trans('label.categories')}}</label>
                        <select name="category_id" id="category" class="form-control">
                            <option>{{trans('label.select_category')}}</option>
                            @foreach($category as $cat)
                            <option value="{{$cat->id}}" @if(!empty($subCategory)) @if($subCategory->category_id ==  $cat->id) selected @endif @endif>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="position-relative form-group"><label for="brand" class="">{{trans('label.brands')}}</label>
                        <select name="brand_id[]" id="brand" class="form-control select2" multiple="true">
                            <option>{{ trans('label.select_brand') }}</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}" @if(!empty($subCategory)) @if(in_array($brand->id, $brandArr) ==  $brand->id) selected @endif @endif>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{trans('label.close')}}
                    </button>
                    <button type="submit" class="btn btn-primary">@if(!empty($subCategory)) {{trans('label.update')}} @else {{ trans('label.save_changes')}} @endif</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
       $('.select2').select2({width: '100%'});
    });
</script>