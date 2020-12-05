<div class="modal fade  centered-modal" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">@if(empty($category)) Create Category @else Update Category @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEditForm" method="post" action="{{ isset($category->id) ? route('category.update', $category->id) : route('category.store') }}" enctype="multipart/form-data">
                @csrf
                @if(!empty($category)) @method('PATCH') @endif

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ isset($category->name) ? $category->name : '' }}" />
                        </div>
                    </div>

                    <div class="position-relative form-group">
                        <label for="banner" class="">Banner</label>
                        <div class="preview-zone" style="width: 200px; height: 150px;">
                          <div class="box box-solid">
                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                              <i class="fa fa-times"></i>
                            </button>
                            <div class="box-body banner-img">
                                <img src="{{ isset($category->banner) ? asset($category->banner) : asset('avatar.jpg') }}"  width='200' height='150'/>
                            </div>
                          </div>
                        </div><br>
                        <div class="dropzone-wrapper">
                          <input type="file" class="dropzone1" name="banner" id="banner">
                        </div>
                    </div>

                    <div class="position-relative form-group">
                        <label for="icon" class="">Icon</label>
                        <div class="preview-zone" style="width: 200px; height: 150px;">
                          <div class="box box-solid">
                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                              <i class="fa fa-times"></i>
                            </button>
                            <div class="box-body icon-img">
                                <img src=" {{ isset($category->icon) ? asset($category->icon) : asset('avatar.jpg') }}"  width='200' height='150'/>
                            </div>
                          </div>
                        </div><br>
                        <div class="dropzone-wrapper">
                          <input type="file" class="dropzone2" name="icon" id="icon">
                        </div>
                    </div>

                    <div class="position-relative form-group"><label for="featured" class="">Featured</label>
                        <select name="featured" id="featured" class="form-control">
                            <option value="1" @if(isset($category->featured) && ($category->featured == 1)) selected @endif>Active</option>
                            <option value="0" @if(isset($category->featured) && ($category->featured == 0)) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{trans('label.close')}}
                    </button>
                    <button type="submit" class="btn btn-primary">@if(empty($category)) Save changes @else Update @endif</button>
                </div>
            </form>
        </div>
    </div>
</div>