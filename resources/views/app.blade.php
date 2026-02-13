<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="Saeed Rahmani">
    <meta name="_token" content="{{ csrf_token() }}">
    {{--    <link rel="shortcut icon" href="{{ $setting->icon }}">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('front-assets/css/front-style.css')}}">
    <link rel="stylesheet" href="{{ asset('front-assets/font/icon-fonts.min.css')}}">
    <script src="{{asset('front-assets/external/jquery/jquery-2.1.4.min.js')}}"></script>

    <script>
        function nav_over(e) {
            var item = (e);
            id = item.dataset.id;
            if (document.getElementById('nav_info' + id).innerText != null) {
                var info = document.getElementById('nav_info' + id).innerHTML;
                var a = document.getElementById('category-chiled').innerHTML = info;

            }
        }
    </script>
    <div class="extra_css">
        @yield('extra_css')
    </div>
</head>
<body class="loaded">

@include('partials._mobil-nav')
@include('partials.header')


<div id="pageContent">
    <img alt="" src="{{ asset('admin-assets/5.gif') }}" class="center preview ajax-load"
                 style="display: none">

    <div class="container" id="content-load">
        @yield('content')
<div id="app"></div>

    </div>
</div>

<!-- modalLoginForm-->
<div class="modal  fade" id="modalTrackOrder" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md-small">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="icon icon-clear"></span></button>
                <h4 class="modal-title text-center text-uppercase">Track Order</h4>
            </div>

            <div class="modal-body">
                <!--modal-add-login-->
                <div class="modal-login">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                        <span class="input-group-addon">
                           <span class="icon icon-art_track"></span>
                        </span>
                                <input type="hidden" value="" name="input">
                                <input type="text" maxlength="8" minlength="8" pattern="\d*" name="code" id="track_code"
                                       class="form-control" placeholder="Tracking Code:" required>
                                <i>ONLY NUMBERS</i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-full">
                            <span class="icon icon-track_changes"></span>
                            Track
                        </button>
                    </form>
                </div>
                <!--/modal-add-login-->
            </div>

        </div>
    </div>
</div>

@include('partials.footer')


<script src="{{asset('front-assets/js/front-js.js')}}"></script>


<script src="{{asset('front-assets/js/add_to_cart.js')}}"></script>

<script src="{{ asset('front-assets/js/typeahead.js') }}"></script>

<script>
    jQuery(document).ready(function() {
        /* jQuery(".load_page").one('click', function (e) {
             var route = $(this).attr('href');
             var pjax = new Pjax({
                 selectors: ["title","meta[name=keywords]", "#extra_css", "#content-load", "#extra_js"]
             });
             pjax.loadUrl(route);
         });*/
        //SEND DATA FOR auto complete SEARCH
        {{--var path = "{{ route('front.search.autoComplete') }}";--}}
        $('input.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, { query: query }, function(data) {
                    return process(data);
                });
            }
        });
    });
</script>
<!-- EXTRA JS -->
<div class="extra_js">
    @yield('extra_js')
</div>
<!-- /EXTRA JS -->
</body>
</html>
