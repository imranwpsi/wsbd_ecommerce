<div class="modal fade  centered-modal" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"><?php if(empty($brand)): ?> <?php echo e(trans('label.create_brand')); ?> <?php else: ?> <?php echo e(trans('label.update_brand')); ?> <?php endif; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEditForm" method="post" action="<?php echo e(isset($brand->id) ? route('brand.update', $brand->id) : route('brand.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(!empty($brand)): ?> <?php echo method_field('PATCH'); ?> <?php endif; ?>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"><?php echo e(trans('label.brand_name')); ?></label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo e(isset($brand->name) ? $brand->name : ''); ?>" />
                        </div>
                    </div>

                    <div class="position-relative form-group">
                        <label for="logo" class=""><?php echo e(trans('label.logo')); ?></label>
                        <div class="preview-zone" style="width: 200px; height: 150px;">
                          <div class="box box-solid">
                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                              <i class="fa fa-times"></i>
                            </button>
                            <div class="box-body banner-img">
                                <img src="<?php echo e(isset($brand->logo) ? asset($brand->logo) : asset('avatar.jpg')); ?>"  width='200' height='150'/>
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
                        <?php echo e(trans('label.close')); ?>

                    </button>
                    <button type="submit" class="btn btn-primary"><?php if(empty($brand)): ?> <?php echo e(trans('label.save_changes')); ?> <?php else: ?> <?php echo e(trans('label.update')); ?> <?php endif; ?></button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH E:\xampp\htdocs\ecommerce\resources\views/admin/brand/addEdit.blade.php ENDPATH**/ ?>