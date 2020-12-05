<div class="modal fade  centered-modal" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">@if(!empty($subSubCategory)) {{trans('label.update_sub_sub_category')}} @else {{trans('label.create_sub_sub_category')}} @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEditForm" method="post" action="{{ isset($subSubCategory->id) ? route('subSubCategory.update', $subSubCategory->id) : route('subSubCategory.store') }}" enctype="multipart/form-data">
                @csrf
                @if(!empty($subSubCategory)) @method('PATCH') @endif

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{trans('label.sub_sub_category_name')}}</label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ isset($subCategory->name) ? $subCategory->name : '' }}" />
                        </div>
                    </div>

                    <div class="position-relative form-group"><label for="category" class="">{{trans('label.sub_categories')}}</label>
                        <select name="sub_category_id" id="category" class="form-control">
                            <option>{{trans('label.select_sub_category')}}</option>
                            @foreach($category as $cat)
                            <option value="{{$cat->id}}" @if(!empty($subCategory)) @if($subCategory->sub_category_id ==  $cat->id) selected @endif @endif>{{ $cat->name }}</option>
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