<div class="modal fade  centered-modal" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"><?php if(!empty($subSubCategory)): ?> <?php echo e(trans('label.update_sub_sub_category')); ?> <?php else: ?> <?php echo e(trans('label.create_sub_sub_category')); ?> <?php endif; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEditForm" method="post" action="<?php echo e(isset($subSubCategory->id) ? route('subSubCategory.update', $subSubCategory->id) : route('subSubCategory.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(!empty($subSubCategory)): ?> <?php echo method_field('PATCH'); ?> <?php endif; ?>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"><?php echo e(trans('label.sub_sub_category_name')); ?></label>
                        <div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo e(isset($subCategory->name) ? $subCategory->name : ''); ?>" />
                        </div>
                    </div>

                    <div class="position-relative form-group"><label for="category" class=""><?php echo e(trans('label.sub_categories')); ?></label>
                        <select name="sub_category_id" id="category" class="form-control">
                            <option><?php echo e(trans('label.select_sub_category')); ?></option>
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php if(!empty($subCategory)): ?> <?php if($subCategory->sub_category_id ==  $cat->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($cat->name); ?></option>
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
</script><?php /**PATH E:\xampp\htdocs\ecommerce\resources\views/admin/subSubCategory/addEdit.blade.php ENDPATH**/ ?>