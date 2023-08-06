@php
    $theme = \App\Models\Theme::first();
@endphp
<style>
    .banner-area {
        background-size: cover;
        position: relative; 
        background: url({{ asset('storage/' . $theme->banner) }}) center no-repeat;
    }
    .organic-breadcrumb {
        background-size: cover;
        padding-top: 130px; 
        background: url({{ asset('storage/' . $theme->commonBanner) }}) center no-repeat;
    }
    @media (max-width: 991px) {
        .organic-breadcrumb {
            padding-top: 80px; 
        } 
    }
    .header_area .navbar .nav .nav-item:hover .nav-link, .header_area .navbar .nav .nav-item.active .nav-link {
        color: {{ $theme->colorPrimary }}; 
    }
    .gradient-bg, .primary-btn, .add-bag .add-btn, .single-product .product-details .prd-bottom .social-info span:after, .grid-btn:hover, .list-btn:hover, .grid-btn.active, .list-btn.active, .pagination a.active, .s_Product_carousel .owl-dots div.active, .s_product_text .card_area .icon_btn:after, .product_description_area .nav.nav-tabs li a.active, .blog-pagination .page-item.active .page-link, .single-footer-widget .click-btn {
        background: -webkit-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: -moz-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: -o-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%); 
    }

    .gradient-bg-reverse, #search_input_box {
        background: -webkit-linear-gradient(270deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: -moz-linear-gradient(270deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: -o-linear-gradient(270deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: linear-gradient(270deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%); 
    }

    .gradient-color, .s_product_text h2, .s_product_text .list li a.active, .product_description_area .tab-content .total_rate .box_total h4, .single-footer-widget .bb-btn {
        background: -webkit-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: -moz-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: -o-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        background: linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent; 
    }
    body {
        line-height: 24px;
        font-size: 14px;
        font-weight: 400;
        color: #777777;
        background: #fff; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: #222222;
        font-weight: 500;
        line-height: 1.2 !important; 
        font-family: "{{ $theme->fontSecondary }}", sans-serif;
    }
    .add-bag .add-text {
        padding-left: 15px;
        font-size: 12px;
        font-weight: 500;
        color: #222222; 
        font-family: "{{ $theme->fontSecondary }}", sans-serif;
    }
    .single-product .product-details .prd-bottom .social-info .hover-text {
        position: absolute;
        left: 0;
        top: 3px;
        width: 100px;
        left: -40px;
        text-transform: uppercase;
        font-weight: 500;
        font-size: 12px;
        color: #222222;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        opacity: 0;
        visibility: hidden; 
        font-family: "{{ $theme->fontSecondary }}", sans-serif;
    }
    .jewellery-single-product .desc h6 {
        font-weight: 400;
        margin-bottom: 8px; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .jewellery-single-product .desc h5 {
      -webkit-transition: all 0.3s ease 0s;
      -moz-transition: all 0.3s ease 0s;
      -o-transition: all 0.3s ease 0s;
      transition: all 0.3s ease 0s;
      font-weight: 700;
      margin-bottom: 8px; 
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .hot_p_item .product_text h4 {
      margin-top: 26px;
      margin-left: 26px;
      color: #222222;
      font-weight: 500;
      font-size: 30px; 
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .cat_widgets .list li a {
        font-size: 14px;
        color: #222222; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .p_filter_widgets h4 {
        color: #222222;
        font-size: 14px;
        font-weight: normal;
        margin-bottom: 22px;
        margin-top: 10px; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .p_filter_widgets .list li a {
        padding-left: 30px;
        font-size: 14px;
        font-weight: normal;
        color: #777777;
        position: relative; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .p_filter_widgets .range_item label {
        display: inline-block;
        font-size: 14px;
        font-weight: normal;
        color: #777777;
        margin-top: 15px; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .p_filter_widgets .range_item input {
        display: inline-block;
        border: none;
        width: 100px;
        font-size: 14px;
        color: #777777;
        margin-top: 9px;
        padding-left: 3px; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .p_filter_widgets .range_item input.placeholder {
        font-size: 14px;
        color: #777777;
        font-family: "{{ $theme->fontPrimary }}", sans-serif; 
    }
    .p_filter_widgets .range_item input:-moz-placeholder {
        font-size: 14px;
        color: #777777;
        font-family: "{{ $theme->fontPrimary }}", sans-serif; 
    }
    .p_filter_widgets .range_item input::-moz-placeholder {
        font-size: 14px;
        color: #777777;
        font-family: "{{ $theme->fontPrimary }}", sans-serif; 
    }
    .p_filter_widgets .range_item input::-webkit-input-placeholder {
        font-size: 14px;
        color: #777777;
        font-family: "{{ $theme->fontPrimary }}", sans-serif; 
    }
    .product_top_bar .left_dorp .sorting span {
      font-size: 14px;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      color: #555555; 
    }
    .product_top_bar .left_dorp .sorting .list li {
        font-size: 14px;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        color: #555555; 
    }
    .product_top_bar .left_dorp .show span {
      font-size: 14px;
      color: #555555; 
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .product_top_bar .left_dorp .show .list li {
        font-size: 14px;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        color: #555555; 
    }
    .cat_page .pagination li a {
        height: 40px;
        width: 40px;
        border-radius: 0px;
        background: #fff;
        padding: 0px;
        text-align: center;
        line-height: 38px;
        border-color: #eeeeee;
        border-radius: 0px !important;
        font-size: 14px;
        color: #222222;
        font-weight: normal;
        font-family: "{{ $theme->fontPrimary }}", sans-serif; 
    }
    .s_product_text .list li a {
      font-size: 14px;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal;
      color: #555555; 
    }
    .product_count label {
        font-size: 14px;
        color: #777777;
        font-weight: normal;
        padding-right: 10px; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .product_description_area .tab-content .total_rate .rating_list h3 {
        font-size: 18px;
        color: #222222;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        font-weight: 500;
        margin-bottom: 10px; 
    }
    .product_description_area .tab-content .table tbody tr td h5 {
          font-size: 14px;
          font-weight: normal;
          color: #777777;
          margin-bottom: 0px;
          white-space: nowrap; 
          font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .review_item .media .media-body h4 {
        margin-bottom: 0px;
        font-size: 14px;
        color: #222222;
        margin-bottom: 8px; 
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
    }
    .review_item .media .media-body .reply_btn {
        border: 1px solid #e0e0e0;
        padding: 0px 28px;
        display: inline-block;
        line-height: 32px;
        border-radius: 16px;
        font-size: 14px;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        color: #222222;
        position: absolute;
        right: 0px;
        top: 14px;
        @icnlude transition; 
    }
    .cart_inner .table thead tr th {
        border-top: 0px;
        font-size: 14px;
        font-weight: 500;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        color: #777777;
        border-bottom: 0px !important; 
    }
    .cart_inner .table tbody tr td h5 {
        font-size: 14px;
        color: #222222;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        margin-bottom: 0px; 
    }
    .cart_inner .table tbody tr.bottom_button td .cupon_text input {
        width: 200px;
        padding: 0px 15px;
        border-radius: 3px;
        border: 1px solid #eeeeee;
        height: 40px;
        font-size: 14px;
        color: #cccccc;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        font-weight: normal;
        margin-right: -3px;
        outline: none;
        box-shadow: none; 
    }
    .cart_inner .table tbody tr.bottom_button td .cupon_text input.placeholder {
      font-size: 14px;
      color: #cccccc;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; }
    .cart_inner .table tbody tr.bottom_button td .cupon_text input:-moz-placeholder {
      font-size: 14px;
      color: #cccccc;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; }
    .cart_inner .table tbody tr.bottom_button td .cupon_text input::-moz-placeholder {
      font-size: 14px;
      color: #cccccc;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; }
    .cart_inner .table tbody tr.bottom_button td .cupon_text input::-webkit-input-placeholder {
      font-size: 14px;
      color: #cccccc;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; 
    }
    .cart_inner .table tbody tr.shipping_area .shipping_box h6 {
        font-size: 14px;
        font-weight: normal;
        color: #222222;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        margin-top: 20px;
        margin-bottom: 20px; 
    }
    .check_title h2 {
        font-size: 14px;
        font-weight: normal;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        background: #e8f0f2;
        line-height: 40px !important;
        padding-left: 30px;
        margin-bottom: 0px; 
    }
    .returning_customer .contact_form .form-group input {
      border: 1px solid #eeeeee;
      height: 40px;
      border-radius: 3px;
      font-size: 14px;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      color: #777777;
      font-weight: normal; }
      .returning_customer .contact_form .form-group input.placeholder {
        font-size: 14px;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        color: #777777;
        font-weight: normal; }
      .returning_customer .contact_form .form-group input:-moz-placeholder {
        font-size: 14px;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        color: #777777;
        font-weight: normal; }
      .returning_customer .contact_form .form-group input::-moz-placeholder {
        font-size: 14px;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        color: #777777;
        font-weight: normal; }
      .returning_customer .contact_form .form-group input::-webkit-input-placeholder {
        font-size: 14px;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        color: #777777;
        font-weight: normal; 
    }
    .returning_customer .contact_form .form-group .lost_pass {
      display: block;
      margin-top: 20px;
      font-size: 14px;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      color: #777777;
      font-weight: normal; 
    }
    .tp_btn {
        border: 1px solid #eeeeee;
        display: inline-block;
        line-height: 38px;
        padding: 0px 40px;
        color: #222222;
        text-transform: uppercase;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        font-weight: 500;
        border-radius: 3px; 
    }
    .billing_details .contact_form .form-group .country_select .list li {
        font-size: 14px;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        font-weight: normal; 
    }
    .order_d_inner .details_item .list li a {
      font-size: 14px;
      color: #222222;
      font-family: "{{ $theme->fontPrimary }}", sans-serif; 
    }
    .order_details_table .table thead tr th {
      border-bottom: 1px solid #ddd;
      font-size: 14px;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; 
    }
    .login_form .form-group a {
        font-size: 14px;
        color: #777777;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        margin-top: 20px;
        display: block; 
    }
    .tracking_box_area .tracking_box_inner .tracking_form .form-group input {
    height: 40px;
    border: 1px solid #eee;
    padding: 0px 15px;
    outline: none;
    box-shadow: none;
    border-radius: 0px;
    font-size: 14px;
    color: #777777;
    font-family: "{{ $theme->fontPrimary }}", sans-serif;
    font-weight: normal; }
    .tracking_box_area .tracking_box_inner .tracking_form .form-group input.placeholder {
      font-size: 14px;
      color: #777777;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; }
    .tracking_box_area .tracking_box_inner .tracking_form .form-group input:-moz-placeholder {
      font-size: 14px;
      color: #777777;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; }
    .tracking_box_area .tracking_box_inner .tracking_form .form-group input::-moz-placeholder {
      font-size: 14px;
      color: #777777;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; }
    .tracking_box_area .tracking_box_inner .tracking_form .form-group input::-webkit-input-placeholder {
      font-size: 14px;
      color: #777777;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-weight: normal; 
    }
    .radion_btn label {
        display: block;
        position: relative;
        font-weight: 300;
        font-size: 1.35em;
        padding: 0px 25px 21px 25px;
        height: 14px;
        z-index: 9;
        cursor: pointer;
        -webkit-transition: all 0.25s linear;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        font-weight: 500;
        color: #222222;
        font-size: 13px;
        letter-spacing: .25px;
        text-transform: uppercase; 
    }
    .causes_item .causes_text h4 {
      color: #222222;
      font-family: "{{ $theme->fontPrimary }}", sans-serif;
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 15px;
      cursor: pointer; 
    }
    .causes_item .causes_bottom a {
        width: 50%;
        border: 1px solid #c5322d;
        text-align: center;
        float: left;
        line-height: 50px;
        background: #c5322d;
        color: #fff;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        font-size: 14px;
        font-weight: 500; 
    }
    .blog_info .post_tag a {
      font: 300 14px/21px "{{ $theme->fontPrimary }}", sans-serif;
      color: #222222; 
    }
    .blog_info .blog_meta li a {
        font: 300 14px/20px "{{ $theme->fontPrimary }}", sans-serif;
        color: #777777;
        vertical-align: middle;
        padding-bottom: 12px;
        display: inline-block; 
    }
    .contact_info .info_item h6 {
        font-size: 16px;
        line-height: 24px;
        color: "{{ $theme->fontPrimary }}", sans-serif;
        font-weight: bold;
        margin-bottom: 0px;
        color: #222222; 
    }
    .contact_form .form-group .form-control {
        font-size: 13px;
        line-height: 26px;
        color: #999;
        border: 1px solid #eeeeee;
        font-family: "{{ $theme->fontPrimary }}", sans-serif;
        border-radius: 0px;
        padding-left: 20px; 
    }
    b, sup, sub, u, del {
        color: {{ $theme->colorPrimary }}; 
    }
    .genric-btn.primary {
        color: #fff;
        background: {{ $theme->colorPrimary }};
        border: 1px solid transparent; 
    }
    .genric-btn.primary:hover {
        background: #fff; 
        border: 1px solid {{ $theme->colorPrimary }};
        color: {{ $theme->colorPrimary }};
    }
    .genric-btn.primary-border {
        background: #fff; 
        color: {{ $theme->colorPrimary }};
        border: 1px solid {{ $theme->colorPrimary }};
    }
    .genric-btn.primary-border:hover {
      color: #fff;
      background: {{ $theme->colorPrimary }};
      border: 1px solid transparent; 
    }
    .generic-blockquote {
        padding: 30px 50px 30px 30px;
        background: #f9f9ff;
        border-left: 2px solid {{ $theme->colorPrimary }}; 
    }
    .unordered-list li:before {
        background: #fff;
        top: 4px;
        left: 0;
        border-radius: 50%; 
        content: "";
        position: absolute;
        width: 14px;
        height: 14px;
        border: 3px solid {{ $theme->colorPrimary }};
    }
    .ordered-list li {
        list-style-type: decimal-leading-zero;
        font-weight: 500;
        line-height: 1.82em !important; 
        color: {{ $theme->colorPrimary }};
    }
    .ordered-list-alpha li {
        margin-left: 30px;
        list-style-type: lower-alpha;
        font-weight: 500;
        line-height: 1.82em !important; 
        color: {{ $theme->colorPrimary }};
    }
    .ordered-list-roman li {
        margin-left: 30px;
        list-style-type: lower-roman;
        font-weight: 500;
        line-height: 1.82em !important; 
        color: {{ $theme->colorPrimary }};
    }
    .single-input-primary:focus {
        outline: none;
        border: 1px solid {{ $theme->colorPrimary }}; 
    }
    .default-switch input + label {
      position: absolute;
      top: 1px;
      left: 1px;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      -webkit-transition: all 0.2s;
      -moz-transition: all 0.2s;
      -o-transition: all 0.2s;
      transition: all 0.2s;
      box-shadow: 0px 4px 5px 0px rgba(0, 0, 0, 0.2);
      cursor: pointer; 
      background: {{ $theme->colorPrimary }};
    }
    .primary-switch input:checked + label:before {
      background: {{ $theme->colorPrimary }}; 
    }
    .default-select .nice-select .list .option.selected {
        background: transparent; 
        color: {{ $theme->colorPrimary }};
    }
    .default-select .nice-select .list .option:hover {
        background: transparent; 
        color: {{ $theme->colorPrimary }};
    }
    .form-select .nice-select .list .option.selected {
        background: transparent; 
        color: {{ $theme->colorPrimary }};
    }
    .form-select .nice-select .list .option:hover {
        background: transparent; 
        color: {{ $theme->colorPrimary }};
    }
    .header_area .navbar .nav .nav-item.submenu ul .nav-item.active {
        background: {{ $theme->colorPrimary }}; 
    }
    .header_area .navbar .nav .nav-item.submenu ul .nav-item:hover .nav-link {
        color: #fff; 
        background: {{ $theme->colorPrimary }};
    }
    @media (max-width: 767px) {
    .organic-breadcrumb {
      background: none;
      background: -webkit-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
      background: -moz-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
      background: -o-linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%);
      background: linear-gradient(90deg, {{ $theme->colorPrimary }} 0%, {{ $theme->colorSecondary }} 100%); 
      } 
    }
    .single-related-product:hover .desc a {
        color: {{ $theme->colorPrimary }}; 
    }
    .review-overall .main-review {
        font-size: 48px;
        font-weight: 700;
        padding: 15px 0; 
        color: {{ $theme->colorPrimary }};
    }
    .sidebar-categories .main-nav-list a:hover {
        color: {{ $theme->colorPrimary }}; 
    }
    .pixel-radio:checked {
        border: 7px solid {{ $theme->colorPrimary }}; 
    }

    .pixel-radio:checked::after {
        -webkit-animation: click-wave 0.65s;
        -moz-animation: click-wave 0.65s;
        animation: click-wave 0.65s;
        content: '';
        display: block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        position: relative;
        z-index: 2;
        opacity: 0; 
        background: {{ $theme->colorPrimary }};
    }
    .price-range-area .noUi-horizontal .noUi-handle {
        width: 16px;
        height: 16px;
        left: -8px;
        top: -5px;
        border-radius: 50%;
        border: 0px;
        box-shadow: none;
        cursor: pointer;
        -webkit-transition: ease 0.1s;
        -moz-transition: ease 0.1s;
        -o-transition: ease 0.1s;
        transition: ease 0.1s; 
        background: {{ $theme->colorPrimary }};
    }
    .price-range-area .noUi-horizontal .noUi-handle:hover {
        background: #fff; 
        border: 3px solid {{ $theme->colorPrimary }};
    }
    .hot_p_item .product_text a:hover {
        color: {{ $theme->colorPrimary }}; 
    }
    .feature_p_slider .owl-dots .owl-dot.active {
      width: 30px;
      height: 8px;
      border-radius: 4px; 
      background: {{ $theme->colorPrimary }};
    }
    .f_p_item .f_p_img .p_icon a:hover {
        color: #fff;
        background: {{ $theme->colorPrimary }}; 
    }
    .f_p_item h4:hover {
      color: {{ $theme->colorPrimary }}; 
    }
    .p_filter_widgets .list li.active a:before, .p_filter_widgets .list li:hover a:before {
        background: {{ $theme->colorPrimary }};
        border-color: {{ $theme->colorPrimary }}; 
    }
    .p_filter_widgets .range_item .ui-slider .ui-slider-handle {
        height: 16px;
        width: 16px;
        border-radius: 50%;
        border: none;
        outline: none !important;
        box-shadow: none;
        top: -6px;
        cursor: pointer; 
        background: {{ $theme->colorPrimary }};
    }
    .cat_page .pagination li:hover a, .cat_page .pagination li.active a {
        color: #fff;
        background: {{ $theme->colorPrimary }};
        border-color: {{ $theme->colorPrimary }}; 
    }
    .review_item .media .media-body .reply_btn:hover {
        color: #fff; 
        background: {{ $theme->colorPrimary }};
        border-color: {{ $theme->colorPrimary }};
    }
    .cart_inner .table tbody tr.shipping_area .shipping_box .list li a:after {
        content: "";
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        position: absolute;
        right: 3px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0; 
        background: {{ $theme->colorPrimary }};
    }
    .tp_btn:hover {
        color: #fff;
        background: {{ $theme->colorPrimary }};
        border-color: {{ $theme->colorPrimary }}; 
    }
    .billing_details .contact_form .form-group .creat_account a {
        color: {{ $theme->colorPrimary }}; 
    }
    .order_box .payment_item.active h4:before {
        background: {{ $theme->colorPrimary }};
        border-color: {{ $theme->colorPrimary }}; 
    }
    .radion_btn input[type=radio]:checked ~ .check {
        border: 1px solid {{ $theme->colorPrimary }};
        background: {{ $theme->colorPrimary }}; 
    }
    .blog_info .post_tag a.active {
        color: {{ $theme->colorPrimary }}; 
    }
    .blog_info .blog_meta li a:hover {
        color: {{ $theme->colorPrimary }}; 
    }
    .blog_right_sidebar .widget_title {
        font-size: 18px;
        line-height: 25px;
        text-align: center;
        color: #fff;
        padding: 8px 0px;
        margin-bottom: 30px; 
        background: {{ $theme->colorPrimary }};
    }
    .blog_right_sidebar .search_widget .input-group .form-control {
        font-size: 14px;
        line-height: 29px;
        border: 0px;
        width: 100%;
        font-weight: 300;
        color: #fff;
        padding-left: 20px;
        border-radius: 45px;
        z-index: 0;
        background: {{ $theme->colorPrimary }}; 
    }
    .blog_right_sidebar .popular_post_widget .post_item .media-body h3:hover {
        color: {{ $theme->colorPrimary }}; 
    }
    .blog_right_sidebar .post_category_widget .cat-list li:hover {
        border-color: {{ $theme->colorPrimary }}; 
    }
    .blog_right_sidebar .post_category_widget .cat-list li:hover a {
        color: {{ $theme->colorPrimary }}; 
    }
    .blog_right_sidebar .newsletter_widget .bbtns {
        color: #fff;
        font-size: 12px;
        line-height: 38px;
        display: inline-block;
        font-weight: 500;
        padding: 0px 24px 0px 24px;
        border-radius: 0; 
        background: {{ $theme->colorPrimary }};
    }
    .blog_right_sidebar .tag_cloud_widget ul li a:hover {
        color: #fff; 
        background: {{ $theme->colorPrimary }};
    }
    .contact_info .info_item i {
        position: absolute;
        left: 0;
        top: 0;
        font-size: 20px;
        line-height: 24px;
        font-weight: 600; 
        color: {{ $theme->colorPrimary }};
    }
    .contact_form .primary-btn {
        color: #fff;
        margin-top: 20px;
        border: none;
        border-radius: 0; 
        background: {{ $theme->colorPrimary }};
    }
    .modal-message .modal-dialog .modal-content .modal-header h2 {
      display: block;
      text-align: center;
      padding-bottom: 10px;
      color: {{ $theme->colorPrimary }};
      font-family: "{{ $theme->fontPrimary }}", sans-serif; 
    }
    .copy-right-text i,
    .copy-right-text a {
        color: {{ $theme->colorPrimary }}; 
    }
    .footer-social a:hover i {
        color: {{ $theme->colorPrimary }}; 
    }
    .footer-text a,
    .footer-text i {
        color: {{ $theme->colorPrimary }}; 
    }

</style>