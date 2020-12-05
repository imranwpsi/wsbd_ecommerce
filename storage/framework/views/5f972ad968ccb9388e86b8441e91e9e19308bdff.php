<div class="modal fade  centered-modal" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"><?php if(!empty($subCategory)): ?> <?php echo e(trans('label.update_sub_category')); ?> <?php else: ?> <?php echo e(trans('label.create_sub_category')); ?> <?php endif; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEditForm" method="post" action="<?php echo e(isset($subCategory->id) ? route('subCategory.update', $subCategory->id) : route('subCategory.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(!empty($subCategory)): ?> <?php echo method_field('PATCH'); ?> <?php endif; ?>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"><?php echo e(trans('label.category_name')); ?></label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo e(isset($subCategory->name) ? $subCategory->name : ''); ?>" />
                        </div>
                    </div>

                    <div class="position-relative form-group">
                        <label for="banner" class=""><?php echo e(trans('label.banner')); ?></label>
                        <div class="preview-zone" style="width: 200px; height: 150px;">
                          <div class="box box-solid">
                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                              <i class="fa fa-times"></i>
                            </button>
                            <div class="box-body banner-img">
                                <img src="<?php echo e(isset($subCategory->banner) ? asset($subCategory->banner) : asset('avatar.jpg')); ?>"  width='200' height='150'/>
                            </div>
                          </div>
                        </div><br>
                        <div class="dropzone-wrapper">
                          <input type="file" class="dropzone1" name="banner" id="banner">
                        </div>
                    </div>

                    <div class="position-relative form-group"><label for="category" class=""><?php echo e(trans('label.categories')); ?></label>
                        <select name="category_id" id="category" class="form-control">
                            <option><?php echo e(trans('label.select_category')); ?></option>
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php if(!empty($subCategory)): ?> <?php if($subCategory->category_id ==  $cat->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($cat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="position-relative form-group"><label for="brand" class=""><?php echo e(trans('label.brands')); ?></label>
                        <select name="brand_id[]" id="brand" class="form-control select2" multiple="true">
                            <option><?php echo e(trans('label.select_brand')); ?></option>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brand->id); ?>" <?php if(!empty($subCategory)): ?> <?php if(in_array($brand->id, $brandArr) ==  $brand->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($brand->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <?php echo e(trans('label.close')); ?>

                    </button>
                    <button type="submit" class="btn btn-primary"><?php if(!empty($subCategory)): ?> <?php echo e(trans('label.update')); ?> <?php else: ?> <?php echo e(trans('label.save_changes')); ?> <?php endif; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
       $('.select2').select2({width: '100%'});
    });
</script><?php /**PATH E:\xampp\htdocs\ecommerce\resources\views/admin/subCategory/addEdit.blade.php ENDPATH**/ ?>