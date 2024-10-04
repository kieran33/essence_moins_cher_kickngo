<!DOCTYPE html>
<html lang="en">
<head>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6227275716170910" crossorigin="anonymous"></script>
<meta name="google-site-verification" content="B6TKDhLsga_MM8O3D8oHoynw_84We-QkJiQikh0zN6I" />
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Site Title -->
<title>@yield('head_title', getcong('site_name'))</title>

<!-- Meta Tags -->
<meta name="author" content="">
<link rel="canonical" href="@yield('head_url', url('/'))">
<meta name="description" content="@yield('head_description', getcong('site_description'))" />
<meta name="keywords" content="" />
<meta property="og:type" content="article" />
<meta property="og:title" content="@yield('head_title',  getcong('site_name'))" />
<meta property="og:description" content="@yield('head_description', getcong('site_description'))" />
<meta property="og:image" content="@yield('head_image', url('/upload/'.getcong('site_logo')))" />
<meta property="og:url" content="@yield('head_url', url('/'))" />
<meta property="og:image:width" content="1024" />
<meta property="og:image:height" content="1024" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="@yield('head_image', url('/upload/'.getcong('site_logo')))">
<link rel="image_src" href="@yield('head_image', url('/upload/'.getcong('site_logo')))" title="logo_white">

<!-- Favicon -->
<link rel="icon" href="{{ URL::asset('upload/'.getcong('site_favicon')) }}">


 <!-- Icon Font Stylesheet -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Load CSS Files -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap_fruit.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/style_fruit.css')}}">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700&amp;display=swap" rel="stylesheet">
</head>


<!-- Start Per Loader -->
<div class="loader-container">
  <div class="loader-ripple">
      <div></div>
      <div></div>
      <div></div>
  </div>
</div>
<!-- End Per Loader -->

 
<body>
  @include("common.header")
 
    @yield("content")
  @include("common.footer")

<!-- Load JS Files -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="{{ URL::asset('assets/js/animated-headline.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ URL::asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.MultiFile.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/rating-script.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.lazy.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom-main.js') }}"></script>

<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () { 
      if ($(".elm1_editor").length > 0) {
        tinymce.init({
          selector: "textarea.elm1_editor",           
          height: 300,
          plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
           toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor",
          style_formats: [
            { title: 'Bold text', inline: 'b' },
            { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
            { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
            { title: 'Example 1', inline: 'span', classes: 'example1' },
            { title: 'Example 2', inline: 'span', classes: 'example2' },
            { title: 'Table styles' },
            { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
          ]
        });
      }
    });
</script>
<script type="text/javascript">
$(document).ready(function(e) {    
   $("#category").change(function(){
       var cat=$("#category").val();
    $.ajax({
    type: "GET",
     url: "{{ URL::to('ajax_subcategories') }}/"+cat,
     //data: "cat=" + cat,
     success: function(result){
         //$("#sub_category").html(result);
         $("#sub_category").html(result).selectpicker('refresh');
      }
    });    
  });
  //$("#inputTag").tagsinput('items');
});
</script> 
{{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/tags/jquery.tagsinput.css') }}" /> 
<script type="text/javascript" src="{{ URL::asset('assets/tags/jquery.tagsinput.js') }}"></script> --}}
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" />

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
    function onAddTag(tag) {
      alert("Added a amenities: " + tag);
    }
    function onRemoveTag(tag) {
      alert("Removed a amenities: " + tag);
    }
    function onChangeTag(input,tag) {
      alert("Changed a amenities: " + tag);
    }
    $(function() {
      $('#amenities_tags').tagsInput({width:'auto'});
    });
</script>
 
</body>
</html>