<!doctype html>
<html lang="en">


<!-- Mirrored from demo.dashboardpack.com/architectui-html-pro/dashboards-commerce.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Feb 2020 06:32:15 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{!!  csrf_token()  !!}">
    <title>Commerce Dashboard - This dashboard was created as an example of the flexibility that Architect offers.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="This dashboard was created as an example of the flexibility that Architect offers.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" />
    <link href="{{asset('main.87c0748b313a1dda75f5.css')}}" rel="stylesheet">
  <style>
    .preview-zone {
        border: 1px solid #ddd;
    }
    button.btn.btn-danger.btn-xs.remove-preview {
        /* margin-top: 185px; */
        margin-left: 210px;
        position: absolute;
    }
    input.dropzone1.form-control {
        border: none;
        padding-left: unset;
    }
    .select2-container .select2-selection--single {
        height: 36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 33px;
        padding-left: 18px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 5px;
    }
    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da;
    }
  </style>
  @yield('style')
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('admin.layout.inc.header')
    @include('admin.layout.inc.ui_settings')
    <div class="app-main">
            @include('admin.layout.inc.sidebar')

            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                @include('admin.layout.inc.footer')
            </div>
    </div>
</div>
<div class="app-drawer-overlay d-none animated fadeIn"></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('assets/scripts/main.87c0748b313a1dda75f5.js')}}"></script>
<script>
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

  $(document).on('change', ".dropzone1", function() {
    readFile(this);
  });

  function reset(e) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
  }

  $(document).on('click', '.remove-preview', function() {
    var boxZone = $(this).parents('.preview-zone').find('.box-body');
    var previewZone = $(this).parents('.preview-zone');
    var dropzone1 = $(this).parents('.form-group').find('.dropzone1');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone1);
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

  $(document).ready(function() {
    $('.select2').select2({width: '100%'});
  });

</script>
@yield('script')
</body>

<!-- Mirrored from demo.dashboardpack.com/architectui-html-pro/dashboards-commerce.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Feb 2020 06:32:16 GMT -->
</html>
