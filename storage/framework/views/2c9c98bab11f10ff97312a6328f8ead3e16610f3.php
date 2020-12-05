<?php $__env->startSection('style'); ?>
<style>
    .centered-modal.show {
        display: flex !important;
    }
    .centered-modal .modal-dialog {
        margin: auto;
        width: inherit;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="col-lg-12">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">
                <?php echo app('translator')->get('label.sub_sub_category'); ?>
            </h5>
        	<button type="button" class="btn mr-2 mb-2 btn-primary float-right addModalBtn" url="<?php echo e(route('subSubCategory.create')); ?>">
        	    <?php echo e(trans('label.create_sub_sub_category')); ?>

        	</button>
            <table class="mb-0 table table-hover table-bordered">
                <thead>
                <tr>
                    <th><?php echo e(trans('label.name')); ?></th>
                    <th class="text-center"><?php echo e(trans('label.sub_category')); ?></th>
                    <th class="text-center"><?php echo e(trans('label.brand')); ?></th>
                    <th colspan="2" class="text-center"><?php echo e(trans('label.action')); ?></th>
                </tr>
                </thead>
                <tbody>
            	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($category->name); ?></td>
                    <td class="text-center"><?php echo e($category->subCategory->name??''); ?></td>
                    <td class="text-center">fff</td>
                    <td class="text-center">
					<button class="mb-2 mr-2 btn-icon btn-icon-only btn btn-warning btn-xs editModalBtn" url="<?php echo e(route('subCategory.edit',$category->id)); ?>"><i class="lnr-pencil btn-icon-wrapper"></i></button>
                    <form action="<?php echo e(route('subCategory.destroy',$category->id)); ?>" method="post" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
					   <button class="mb-2 mr-2 btn-icon btn-icon-only btn btn-danger btn-xs"><i class="pe-7s-trash btn-icon-wrapper"></i></button>
                    </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="dynamicData"></div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.addModalBtn').click(function(event) {
        $('#dynamicData').html('');
        var url = $(this).attr('url');
        $.ajax({
            url: url,
            type: 'GET',
        })
        .done(function(data) {
            //console.log(data);
            $('#dynamicData').html(data);
            $('#addEditModal').appendTo("body").modal('show');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });

    $('.editModalBtn').click(function(event) {
        $('#dynamicData').html('');

        var url = $(this).attr('url');

        $.ajax({
            url: url,
            type: 'GET',
        })
        .done(function(data) {
            $('#dynamicData').html(data);
            $('#addEditModal').appendTo("body").modal('show');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });

    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
        $('.banner-img').html('');
    });


    function readFile(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          var htmlPreview =
          '<img width="200" height="150px" src="' + e.target.result + '" />'

          var wrapperZone = $(input).parent();
          var previewZone = $(input).parent().parent().find('.preview-zone');
          var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

          wrapperZone.removeClass('dragover');
          previewZone.removeClass('hidden');
          boxZone.empty();
          boxZone.append(htmlPreview);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    $(document).on('change', '.dropzone2', function() {
      readFile(this);
    });

    function reset(e) {
      e.wrap('<form>').closest('form').get(0).reset();
      e.unwrap();
    }

    $(document).on('click', '.remove-preview', function() {
      var boxZone = $(this).parents('.preview-zone').find('.box-body');
      var previewZone = $(this).parents('.preview-zone');
      var dropzone2 = $(this).parents('.form-group').find('.dropzone2');
      boxZone.empty();
      previewZone.addClass('hidden');
      reset(dropzone2);
    });

    var imagesPreview = function(input, placeToInsertImagePreview) {
      if (input.files) {
        $('.multiple').empty();
        var filesAmount = input.files.length;
        for (i = 1; i < filesAmount; i++) {
          var reader = new FileReader();
          reader.onload = function(event) {
            $($.parseHTML('<img width="200" height="150">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
          }
          reader.readAsDataURL(input.files[i]);
        }
      }
    };

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ecommerce\resources\views/admin/subSubCategory/index.blade.php ENDPATH**/ ?>