<div class="modal fade  centered-modal" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">@if(empty($brand)) {{trans('label.create_brand')}} @else {{trans('label.update_brand')}} @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEditForm" method="post" action="{{ isset($brand->id) ? route('brand.update', $brand->id) : route('brand.store') }}" enctype="multipart/form-data">
                @csrf
                @if(!empty($brand)) @method('PATCH') @endif

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{trans('label.brand_name')}}</label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ isset($brand->name) ? $brand->name : '' }}" />
                        </div>
                    </div>

                    <div class="position-relative form-group">
                        <label for="logo" class="">{{trans('label.logo')}}</label>
                        <div class="preview-zone" style="width: 200px; height: 150px;">
                          <div class="box box-solid">
                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                              <i class="fa fa-times"></i>
                            </button>
                            <div class="box-body banner-img">
                                <img src="{{ isset($brand->logo) ? asset($brand->logo) : asset('avatar.jpg') }}"  width='200' height='150'/>
                            </div>
                          </div>
                        </div><br>
                        <div class="dropzone-wrapper">
                          <input type="file" class="dropzone1" name="logo" id="logo">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{trans('label.close')}}
                    </button>
                    <button type="submit" class="btn btn-primary">@if(empty($brand)) {{trans('label.save_changes')}} @else {{trans('label.update')}} @endif</button>
                </div>
            </form>
        </div>
    </div>
</div>