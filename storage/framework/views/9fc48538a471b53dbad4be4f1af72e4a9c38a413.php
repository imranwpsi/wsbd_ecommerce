<div class="modal fade  centered-modal" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"><?php if(empty($category)): ?> Create Category <?php else: ?> Update Category <?php endif; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEditForm" method="post" action="<?php echo e(isset($category->id) ? route('category.update', $category->id) : route('category.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(!empty($category)): ?> <?php echo method_field('PATCH'); ?> <?php endif; ?>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo e(isset($category->name) ? $category->name : ''); ?>" />
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
                                <img src="<?php echo e(isset($category->banner) ? asset($category->banner) : asset('avatar.jpg')); ?>"  width='200' height='150'/>
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
                                <img src=" <?php echo e(isset($category->icon) ? asset($category->icon) : asset('avatar.jpg')); ?>"  width='200' height='150'/>
                            </div>
                          </div>
                        </div><br>
                        <div class="dropzone-wrapper">
                          <input type="file" class="dropzone2" name="icon" id="icon">
                        </div>
                    </div>

                    <div class="position-relative form-group"><label for="featured" class="">Featured</label>
                        <select name="featured" id="featured" class="form-control">
                            <option value="1" <?php if(isset($category->featured) && ($category->featured == 1)): ?> selected <?php endif; ?>>Active</option>
                            <option value="0" <?php if(isset($category->featured) && ($category->featured == 0)): ?> selected <?php endif; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <?php echo e(trans('label.close')); ?>

                    </button>
                    <button type="submit" class="btn btn-primary"><?php if(empty($category)): ?> Save changes <?php else: ?> Update <?php endif; ?></button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH E:\xampp\htdocs\ecommerce\resources\views/admin/category/addEdit.blade.php ENDPATH**/ ?>