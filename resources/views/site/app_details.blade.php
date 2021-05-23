@extends('layouts.site')
@section('title')
    {{ ucwords($app->translation('title', app()->getLocale())) }}
@endsection
@section('content')

    <style>.day_list {
            padding: 15px
        }

        .day_list li {
            width: auto;
            border-bottom: 1px solid #f2f2f2;
            clear: both;
            height: 65px;
            padding: 5px 5px 10px
        }

        .day_list_number {
            float: left;
            width: 20px;
            height: 20px;
            background: #e7e7e7;
            margin-top: 27px;
            text-align: center;
            line-height: 20px;
            font-size: 14px;
            font-weight: 600
        }

        .day_list li:nth-child(1) .day_list_number {
            background: url("https://static.apkpure.com/www/static/imgs/day_list_number.png") top center;
            color: #FFF;
            margin-top: 25px;
            height: 24px
        }

        .day_list li:nth-child(2) .day_list_number {
            background: url("https://static.apkpure.com/www/static/imgs/day_list_number.png") center;
            color: #FFF;
            margin-top: 25px;
            height: 24px
        }

        .day_list li:nth-child(3) .day_list_number {
            background: url("https://static.apkpure.com/www/static/imgs/day_list_number.png") bottom center;
            color: #FFF;
            margin-top: 25px;
            height: 24px
        }

        .day_list dl {
            display: block;
            position: relative;
            height: 65px;
            overflow: hidden;
            width: 270px;
            float: right
        }

        .day_list dl dt {
            float: left;
            width: 85px;
            height: 75px;
            text-align: center
        }

        .day_list dl dt img {
            width: 60px;
            padding-top: 5px
        }

        .day_list dl dd {
            color: #666;
            overflow: hidden;
            line-height: 22px;
            font-size: 13px;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .day_list dl dd a {
            color: #666;
            font-size: 13px;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .day_list dl .title-dd a {
            font-size: 14px;
            font-weight: 600
        }

        .day_list li:hover {
            background: #f5f7fa
        }

        .day_list li:hover .title-dd a {
            color: #00A6ED
        }

        .day_list li:hover .down {
            bottom: 0px;
            -webkit-transition: all 0.1s ease;
            -moz-transition: all 0.1s ease;
            transition: all 0.1s ease
        }

        .day_list dl .down {
            position: absolute;
            bottom: -30px;
            left: 85px;
            z-index: 1
        }

        .day_list dl .down a {
            display: block;
            min-width: 100px;
            padding: 0 5px;
            color: #FFF;
            text-align: center;
            height: 24px;
            line-height: 24px;
            background: #24cd77
        }

        .day_list dl .down a:hover {
            background: #24dc83;
            color: #fff
        }

        .day_list_more {
            padding: 17px 0 2px 0;
            text-align: center
        }

        .day_list_more a {
            color: #666
        }

        .day_list_more a:hover {
            color: #00A6ED
        }

        .day_list-s li {
            padding: 0;
            height: 80px
        }

        .day_list-s li a {
            display: block;
            padding: 5px 5px 10px;
            overflow: hidden;
            color: #666
        }

        .day_list-s li a:hover {
            background: #f5f7fa
        }

        .day_list-s li a:hover .title-dd {
            color: #00A6ED
        }

        .day_list-s dl .title-dd {
            font-size: 14px;
            font-weight: 600
        }

        .ar_fix .day_list_number {
            float: right
        }

        .ar_fix .day_list dl dt {
            float: right
        }

        .ar_fix .day_list dl .down {
            left: auto;
            right: 85px
        }

        @media only screen and (max-width: 1300px) {
            .day_list dl {
                width: 240px
            }
        }

        .index-left-ul li {
            border-bottom: 1px solid #eee;
            padding: 10px;
            clear: both;
            position: relative;
            overflow: hidden
        }

        .index-left-ul li:last-child {
            border-bottom: 0
        }

        .index-left-ul li .app-icon {
            float: left;
            width: 70px
        }

        .index-left-ul li .app-icon img {
            width: 70px
        }

        .index-left-ul li .app-text {
            float: right;
            width: 230px;
            height: 70px;
            line-height: 21px;
            font-size: 13px;
            overflow: hidden
        }

        .index-left-ul li .app-text p {
            padding: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .index-left-ul li .app-text .price-new {
            font-size: 14px;
            padding-right: 5px;
            color: #24cd77
        }

        .index-left-ul li .app-text .price-old {
            text-decoration: line-through
        }

        .index-left-ul li .app-text .app-text-title {
            font-size: 14px;
            font-weight: 600;
            overflow: hidden;
            height: 21px
        }

        .index-left-ul li .app-text .app-text-title a {
            height: 21px;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .index-left-ul li .app-text a {
            color: #666
        }

        .index-left-ul li .app-text a:hover {
            color: #00A6ED
        }

        .index-left-ul li .item-sort {
            width: 36px;
            height: 36px;
            position: absolute;
            top: 0;
            left: 0
        }

        .index-left-ul li .item-sort .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-top: 36px solid #999;
            border-right: 36px solid transparent;
            opacity: 0.85;
            filter: alpha(opacity=85)
        }

        .index-left-ul li .item-sort .redbg {
            border-top: 36px solid #FA8B15;
            opacity: 0.9;
            filter: alpha(opacity=90)
        }

        .index-left-ul li .item-sort .text {
            position: absolute;
            color: #fff;
            top: 0;
            left: 0;
            width: 21px;
            height: 21px;
            line-height: 21px;
            font-weight: 600;
            font-size: 14px;
            display: block;
            text-align: center;
            font-style: italic
        }

        .index-left-ul li div .down {
            padding-top: 3px
        }

        .index-left-ul li div .down a {
            display: inline-block;
            min-width: 90px;
            padding: 0 5px;
            background: #efefef;
            height: 22px;
            font-size: 12px;
            line-height: 22px;
            color: #666;
            text-align: center;
            border: 1px solid #ccc
        }

        .index-left-ul li div .down a:hover {
            background: #eaeaea
        }

        .index-left-ul-s li {
            padding: 0
        }

        .index-left-ul-s li a {
            display: block;
            padding: 10px;
            overflow: hidden;
            color: #666
        }

        .index-left-ul-s li .app-text-developer {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .index-left-ul-s li a:hover {
            background: #f5f7fa
        }

        .index-left-ul-s li a:hover .app-text-title {
            color: #00A6ED
        }

        .ar_fix .index-left-ul li .app-icon {
            float: right
        }

        .ar_fix .index-left-ul li .app-text {
            float: left
        }

        .ar_fix .index-left-ul li .app-text .price-new {
            padding-right: 0;
            padding-left: 5px
        }

        @media only screen and (max-width: 1300px) {
            .index-left-ul li .app-text {
                width: 200px
            }
        }

        .tag {
            padding: 20px
        }

        .tag h2 {
            margin-bottom: 15px;
            font-size: 16px
        }

        .tag_list {
            overflow: hidden;
            line-height: 20px
        }

        .tag_list li {
            margin: 5px 8px 6px 0;
            padding: 0;
            background-color: transparent;
            vertical-align: middle;
            display: inline-block
        }

        .tag_list li a {
            display: block;
            padding: 4px 10px;
            border: 1px solid #00A6ED;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            color: #00A6ED
        }

        li.tag_add {
            background: url("https://static.apkpure.com/www/static/imgs/tag_add.png");
            width: 28px;
            height: 28px;
            margin: 0;
            padding: 0;
            cursor: pointer;
            border: 1px solid #00A6ED;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            color: #00A6ED
        }

        .ar_fix .tag_list li {
            margin: 5px 0 6px 8px
        }

        .ver-info {
            display: none
        }

        .ver-info-top strong {
            font-size: 18px
        }

        .ver-info-m {
            margin-top: 20px;
            overflow: hidden;
            background: #F1F5FA;
            border: 1px solid #e0e7f0;
            font-size: 13px;
            padding: 10px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            line-height: 21px;
            color: #808285
        }

        .ver-info-m .down {
            color: #fff;
            background: #24cd77;
            padding: 3px 18px;
            margin-top: 10px;
            display: block;
            text-align: center;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            float: left;
            margin-right: 10px
        }

        .ver-info-m .down:hover {
            background: #24dc83
        }

        .ver-info-m .down .fsize {
            display: inline-block;
            direction: ltr;
            margin-left: 3px
        }

        .ver-info-m p {
            padding: 0;
            margin: 0;
            line-height: 26px;
            word-wrap: break-word
        }

        .ver-whats-new {
            border: 1px solid #e0e7f0;
            display: none;
            background: #FFFFFF;
            padding: 10px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px
        }

        .ver-popup {
            position: relative;
            background: #FFF;
            padding: 25px !important;
            width: auto;
            max-width: 550px !important;
            margin: 20px auto;
            border-radius: 4px
        }

        .mfp-hide {
            display: none
        }

        .ar_fix .ver-info-m .down {
            float: right;
            margin-left: 10px;
            margin-right: 0
        }

        .ver-title {
            color: #666;
            height: 55px;
            line-height: 55px;
            font-weight: 400;
            position: relative
        }

        .ver-title .tit {
            font-size: 18px;
            line-height: 20px;
            height: 55px;
            padding-right: 45px;
            vertical-align: middle;
            display: table-cell
        }

        .ver-title .more {
            position: absolute;
            z-index: 1;
            right: 0;
            top: 18px;
            height: 20px;
            line-height: 20px;
            text-align: right
        }

        .ver-title .more a {
            color: #666;
            font-size: 14px
        }

        .ver-title .more a:hover {
            color: #00A6ED
        }

        .ver {
            margin-bottom: 5px
        }

        .ver-beta {
            margin-left: 10px
        }

        .ver-wrap {
            margin-left: -10px
        }

        .ver-wrap > li {
            width: 33.33333%;
            margin-bottom: 15px;
            float: left
        }

        .ver-wrap > li > a {
            display: block;
            margin-left: 10px
        }

        .ver-item {
            border-radius: 6px;
            background: #ffffff;
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.15);
            -webkit-transition: all .2s linear;
            transition: all .2s linear;
            height: 140px;
            padding: 15px;
            position: relative
        }

        .ver-item:hover {
            -webkit-box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            -webkit-transform: translate3d(0, -1px, 0);
            transform: translate3d(0, -1px, 0)
        }

        .ver-item-n {
            margin-bottom: 15px;
            padding-right: 45px;
            color: #545454;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
            font-weight: 400;
            font-size: 20px
        }

        .ver-item-a p {
            color: #888;
            margin-top: 7px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            line-height: 30px
        }

        .ver-item-a .update-on {
            margin-top: 0
        }

        .ver-item-s {
            position: absolute;
            bottom: 13px;
            left: 15px;
            color: #545454
        }

        .ver-item-t {
            display: inline-block;
            border: solid 1px #fa8b16;
            color: #fa8b16;
            padding: 0 5px;
            border-radius: 4px
        }

        .ver-item-t.ver-apk {
            border-color: #24cd77;
            color: #24cd77
        }

        .ver-item-t.ver-xapk {
            border-color: #2e9cf2;
            color: #2e9cf2
        }

        .ver-item-m {
            position: absolute;
            top: 10px;
            right: 5px;
            z-index: 20;
            padding: 5px;
            width: 20px;
            height: 20px;
            background: url("https://static.apkpure.com/www/static/imgs/ver-more_v1.svg") no-repeat 5px 5px
        }

        .ver-item-d {
            position: absolute;
            bottom: 10px;
            right: 15px;
            z-index: 20;
            width: 25px;
            height: 25px;
            background: url("https://static.apkpure.com/www/static/imgs/ver-down_v1.svg") no-repeat
        }

        .ver-item-v {
            border-top-right-radius: 6px;
            border-bottom-left-radius: 6px;
            position: absolute;
            top: 0;
            right: 0;
            text-align: center;
            background: #e7e7e7;
            line-height: 16px;
            color: #828282;
            padding: 2px 5px
        }

        .ver-item-v span {
            display: block;
            font-size: 12px
        }

        .ver-item-v span.ver-n {
            font-size: 16px
        }

        .ar_fix .ver-title .tit {
            padding-right: 0;
            padding-left: 45px
        }

        .ar_fix .ver-title .more {
            left: 0;
            right: auto
        }

        .ar_fix .ver-item-n {
            padding-left: 45px;
            padding-right: 0
        }

        .ar_fix .ver-item-m {
            left: 5px;
            right: auto
        }

        .ar_fix .ver-item-d {
            left: 15px;
            right: auto
        }

        .ar_fix .ver-item-s {
            left: auto;
            right: 15px
        }

        .ar_fix .ver-wrap > li {
            float: right
        }

        .addthis-menu {
            position: absolute;
            right: 8px;
            top: 12px
        }

        .addthis-custom span {
            display: none
        }

        .addthis-custom {
            cursor: pointer;
            display: block;
            padding: 0 !important;
            width: 32px !important;
            height: 32px !important;
            border-radius: 4px;
            background: url("https://static.apkpure.com/www/static/imgs/details_share.png") no-repeat center/18px 18px #FF8B2F
        }

        .ar_fix .addthis-menu {
            right: auto;
            left: 8px
        }

        .details-how a {
            font-size: 12px;
            margin-top: 10px;
            color: #666;
            display: inline-block
        }

        .details-how a:hover {
            color: #00b6ff
        }

        #qrnil {
            display: block;
            background: url("https://static.apkpure.com/www/static/imgs/qrnil.png");
            width: 36px;
            height: 36px
        }

        #qrcode {
            display: none
        }

        .aegon-link {
            text-align: center;
            padding: 12px 20px;
            line-height: 20px;
            background: linear-gradient(to bottom, #fff 0%, #f8f8f8 47%, #f2f5f9 100%);
            border-top: 1px solid #e8e8e8
        }

        .aegon-link a {
            color: #656565
        }

        .anchor-download {
            height: 0
        }

        .anchor-download a {
            height: 0;
            font-size: 0
        }

        .details-share {
            margin-top: 15px;
            margin-bottom: 20px;
            height: 32px
        }

        .title-like {
            margin-top: 2.5px;
            font-size: 24px;
            line-height: 32px;
            color: #999;
            margin-bottom: 10px
        }

        .title-like h1 {
            font-size: 30px;
            color: #333;
            display: inline;
            font-weight: normal
        }

        .title-like .right-share {
            float: left;
            margin-top: 7px
        }

        .safe-link-version {
            text-decoration: none
        }

        .safe-link {
            text-align: center;
            padding: 16px 20px;
            line-height: 20px
        }

        .safe-link a {
            text-decoration: none;
            font-size: 14px
        }

        .safe-link a:active {
            text-decoration: underline
        }

        .safe-link a img {
            margin-top: -3px
        }

        .safe-link strong {
            font-weight: normal
        }

        .ny-dl {
            padding: 30px 25px;
            overflow: hidden;
            clear: both
        }

        .ny-dl dt {
            float: left;
            text-align: center
        }

        .ny-dl dt .icon {
            height: 170px;
            width: 170px
        }

        .ny-dl dt .icon img {
            width: 170px
        }

        .ny-dl dd {
            margin-left: 195px;
            overflow: hidden
        }

        .ny-dl dd h1 {
            padding-top: 0px
        }

        .details-rating {
            height: 20px
        }

        .details-rating .stars {
            float: left;
            margin-top: 2px
        }

        .details-rating .stars span, .details-rating .stars {
            background-size: 17px;
            height: 17px;
            width: 85px
        }

        .details-rating .rating-info {
            float: left;
            font-size: 13px;
            margin-left: 5px;
            margin-top: 3px
        }

        .details-rating .rating {
            color: #fa8b16
        }

        .details-rating .item {
            display: none
        }

        .details-delimiter {
            margin: 0 5px
        }

        .details-to-bottom {
            display: inline-block
        }

        .details-share {
            text-align: center
        }

        .details-sdk {
            font-size: 15px
        }

        .details-sdk span {
            color: #24cd77
        }

        .details-rating {
            margin: 10px 0
        }

        .details-author {
            margin-bottom: 10px;
            color: #999
        }

        .details-author a {
            font-size: 15px;
            color: #999
        }

        .details-author a:hover {
            color: #24cd77;
            font-size: 15px
        }

        .details-author p, .details-sdk {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden
        }

        .ny-down {
            overflow: hidden
        }

        .ny-down a {
            float: left
        }

        .ny-down .da {
            display: inline-block;
            padding: 0 30px;
            height: 35px;
            line-height: 35px;
            color: #fff;
            text-align: center;
            font-size: 17px;
            background: #24cd77;
            margin: 0 auto
        }

        .ny-down .da:hover {
            background: #24dc83
        }

        .ny-down .gp {
            display: block;
            padding: 0 30px;
            height: 35px;
            line-height: 35px;
            color: #fff;
            text-align: center;
            font-size: 18px;
            background: #555;
            margin: 0 auto
        }

        .ny-down .gp:hover {
            background: #333
        }

        .ny-down .fsize {
            display: inline-block;
            direction: ltr;
            font-size: 12px;
            vertical-align: bottom;
            margin-left: 5px
        }

        .ny-down .safe {
            margin-top: 9px;
            margin-left: 8px
        }

        .ny-down .safe-ver {
            display: inline-block;
            overflow: hidden
        }

        .ny-down .ny-versions, .ny-down .ny-variants {
            border: solid 1px #24cd77;
            box-sizing: border-box;
            height: 35px;
            line-height: 33px;
            display: inline-block;
            padding: 0 15px;
            text-align: center;
            color: #666;
            font-size: 15px
        }

        .ny-down .ny-variants {
            margin: 0 10px;
            border-color: #fa8b16;
            color: #fa8b16
        }

        .ny-down .ny-versions:hover {
            background: #f1fff1
        }

        .ny-down .ny-variants:hover {
            background: #fffef1
        }

        .ny-var .da {
            padding: 0 20px
        }

        .ny-var .ny-versions, .ny-var .ny-variants {
            padding: 0 10px
        }

        .ny-normal {
            margin-top: 10px
        }

        .ny-normal a {
            color: #999
        }

        .ny-normal a:hover {
            color: #24cd77
        }

        .requestupdate img {
            margin-top: -3px;
            margin-left: 3px
        }

        .requpdate {
            display: block;
            border: 1px solid #ccc;
            color: #333;
            font-size: 12px;
            font-weight: 600;
            padding: 0 10px 0 5px;
            height: 26px;
            line-height: 26px;
            margin: 10px auto 0 auto;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px
        }

        .requpdate:hover {
            border-color: #bbb;
            background-color: #d9d9d9;
            background-image: -webkit-linear-gradient(#f8f8f8, #d9d9d9);
            background-image: linear-gradient(#f8f8f8, #d9d9d9)
        }

        .requpdate img {
            width: 26px;
            height: 26px
        }

        #describe {
            margin: 20px 20px 0 20px;
            line-height: 20px;
            height: 200px;
            overflow: hidden;
            position: relative
        }

        #describe.describe-open {
            margin-bottom: 10px;
            height: auto
        }

        #describe p {
            margin-bottom: 10px
        }

        #describe h2, .describe-whatnew h2, .pre-register h2, .additional h2 {
            margin-bottom: 15px;
            font-size: 16px
        }

        .describe {
            clear: both;
            height: auto
        }

        .content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
            font-weight: normal;
            font-size: 16px
        }

        .describe-whatnew {
            line-height: 20px;
            margin: 20px
        }

        .pre-register {
            padding: 20px;
            line-height: 20px
        }

        .pre-register p {
            margin-bottom: 10px
        }

        .translate {
            position: relative
        }

        .translate .translate-btn {
            position: absolute;
            right: 13px;
            top: 13px;
            margin: 0 !important;
            z-index: 9
        }

        .translate-btn {
            display: block;
            border: 1px solid #ccc;
            color: #333;
            font-size: 12px;
            font-weight: 600;
            padding: 0 10px 0 5px;
            height: 26px;
            line-height: 26px;
            margin: 10px auto 0 auto;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px
        }

        .translate-btn:hover {
            border-color: #bbb;
            background-color: #d9d9d9;
            background-image: -webkit-linear-gradient(#f8f8f8, #d9d9d9);
            background-image: linear-gradient(#f8f8f8, #d9d9d9)
        }

        .translate-btn img {
            width: 26px;
            height: 26px
        }

        .additional {
            padding: 20px
        }

        .additional ul {
            width: 100%;
            clear: both;
            overflow: hidden
        }

        .additional li {
            width: 25%;
            float: left;
            margin-top: 10px
        }

        .additional li p {
            padding-bottom: 5px;
            font-size: 12px
        }

        .additional li p strong {
            font-size: 14px;
            font-weight: 600
        }

        .showmore_content {
            position: relative;
            overflow: hidden;
            height: 200px
        }

        .showmore_trigger {
            position: relative;
            display: none;
            margin: 0 20px 20px 20px
        }

        .showmore_trigger span {
            cursor: pointer;
            line-height: 30px;
            padding-right: 15px;
            height: 30px;
            display: inline-block;
            color: #00A6ED;
            text-decoration: none;
            background: url("https://static.apkpure.com/www/static/imgs/read-more.png") no-repeat right 13px
        }

        .showmore_trigger span.active {
            background-position: right -11px
        }

        .show-more-end {
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(100%, #fff));
            background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0), #fff);
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), #fff);
            filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, StartColorStr='#00ffffff', EndColorStr='#ffffff');
            top: -30px;
            height: 30px;
            left: 0;
            position: absolute;
            width: 100%
        }

        .more-version {
            display: none
        }

        .show-more-version span {
            cursor: pointer;
            line-height: 30px;
            height: 30px;
            display: inline-block;
            padding-right: 15px;
            color: #00A6ED;
            text-decoration: none;
            background: url("https://static.apkpure.com/www/static/imgs/read-more.png") no-repeat right 13px
        }

        .show-more-version span.active {
            background-position: right -11px
        }

        .twitter-share-button {
            text-decoration: none
        }

        .describe-img {
            padding: 20px;
            direction: ltr
        }

        .describe-line {
            font-size: 0;
            height: 1px;
            background: #e8e8e8
        }

        #slide-box {
            position: relative;
            width: 100%;
            height: 370px
        }

        #slide-box ul {
            position: absolute;
            list-style: none
        }

        #slide-box a.det-pic-control {
            width: 60px;
            height: 60px;
            display: block;
            position: absolute;
            display: none;
            background: url("https://static.apkpure.com/www/static/imgs/slidebg.png") no-repeat
        }

        #slide-box #prev {
            background-position: left -62px;
            left: 0px;
            top: 145px
        }

        #slide-box #prev:hover {
            background-position: left -186px
        }

        #slide-box #next {
            background-position: left 0;
            right: 0px;
            top: 145px
        }

        #slide-box #next:hover {
            background-position: left -124px
        }

        #slide-box a.go {
            display: block
        }

        #slide-box .det-pic-out {
            overflow: hidden;
            overflow-x: scroll;
            position: relative;
            width: 100%;
            height: 370px
        }

        #slide-box .det-pic-out::-webkit-scrollbar {
            width: 8px;
            height: 8px
        }

        #slide-box .det-pic-out::-webkit-scrollbar-track {
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3) inset;
            border-radius: 8px
        }

        #slide-box .det-pic-out::-webkit-scrollbar-thumb {
            background-color: #7A7A7A;
            border-radius: 8px
        }

        #slide-box .det-pic-out::-webkit-scrollbar-thumb:hover {
            background-color: #525252
        }

        #slide-box li {
            white-space: nowrap
        }

        #slide-box li a {
            text-decoration: none;
            white-space: nowrap;
            padding-right: 5px
        }

        #slide-box li a img {
            background: #f1f1f1
        }

        .details-tube {
            padding-right: 0 !important;
            margin-right: 5px;
            display: inline-block;
            vertical-align: middle;
            position: relative;
            width: 550px;
            height: 355px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            -moz-background-size: cover;
            -webkit-background-size: cover
        }

        .details-tube .tube {
            position: relative;
            -moz-transition: opacity 0.5s cubic-bezier(0, 0, 0.2, 1);
            -webkit-transition: opacity 0.5s cubic-bezier(0, 0, 0.2, 1);
            transition: opacity 0.5s cubic-bezier(0, 0, 0.2, 1);
            width: 550px;
            height: 355px
        }

        .details-tube .play {
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            z-index: 0;
            display: block;
            position: absolute;
            background-position: center;
            background-repeat: no-repeat
        }

        .mfp-hide {
            display: none
        }

        .blue-stack {
            display: inline-block;
            position: relative;
            padding-bottom: 43px
        }

        .blue-stack .play-on {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 35px;
            line-height: 35px;
            color: #fff;
            text-align: center;
            font-size: 17px;
            background: rgba(0, 35, 90, 0.8)
        }

        .blue-stack .play-on.tgb {
            background-color: black
        }

        .blue-stack .play-on.r {
            right: 24px
        }

        .pricing {
            margin-left: 15px;
            display: inline-block;
            line-height: 25px;
            text-align: right
        }

        .price {
            color: #FF8B2F;
            font-size: 20px
        }

        .price.only {
            line-height: 50px
        }

        .price-old {
            text-decoration: line-through
        }

        .fancybox_custom_class .pre_pop_ca {
            padding: 0
        }

        .fancybox_custom_class .pre_pop_so {
            padding: 20px 40px 0;
            width: 880px
        }

        .fancybox_custom_class .fancybox-slide {
            min-width: 900px
        }

        .ar_fix .ny-dl-n dt {
            float: right
        }

        .ar_fix .ny-dl-n dd {
            margin-left: 0;
            margin-right: 195px
        }

        .ar_fix .ny-down {
            right: auto;
            left: 0
        }

        .ar_fix .details-rating .rating-info {
            float: right;
            margin-left: 0;
            margin-right: 5px
        }

        .ar_fix .details-rating .stars {
            float: right
        }

        .ar_fix .translate .translate-btn {
            left: 13px;
            right: auto
        }

        .ar_fix .additional li {
            float: right
        }

        .ar_fix .ny-down a {
            float: right
        }

        .ar_fix .ny-down .fsize {
            margin-left: 0;
            margin-right: 5px
        }

        .ar_fix .ny-down .safe {
            margin-left: 0;
            margin-right: 8px
        }

        .ar_fix .requestupdate img {
            margin-left: 0;
            margin-right: 3px
        }

        .ar_fix .blue-stack .play-on.r {
            right: 0;
            left: 24px
        }

        .ar_fix .pricing {
            margin-right: 15px;
            margin-left: 0;
            text-align: left
        }
    </style>

    <div class="container">
        <div class="col-md-8 col-sm-8">

            <div class="row mt-40">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-container">
                            <h2 class="panel-title p-title">{{ __('common.app_detailes') }}</h2>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="app-details">
                                    <div class="col-md-3 col-sm-4">
                                        <img src="{{ $app->image_file }}" class="img-responsive"
                                             title="{{ $app->translation('title', app()->getLocale()) }}"
                                             alt="{{ $app->translation('title', app()->getLocale()) }}"/>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h1 class="app-head">
                                            {{ $app->translation('title', app()->getLocale()) }}
                                        </h1>
                                        <p class="des">Download APK, faster, free and saving data!</p>
                                        <div class="ratings">
                                            @component('admin.vendors.rate', ['rate' => $app->rate])

                                            @endcomponent
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="app-data">
                                                    <h4>{{ __('common.owner') }}</h4>
                                                    <p> {{ object_get($app, 'owner.name') }} </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="app-data">
                                                    <h4>{{ ucwords(__('common.last_version')) }}</h4>
                                                    <p>{{ $app->versions()->first()->title }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="app-data">
                                                    <h4>{{ __('common.published_at') }}</h4>
                                                    <p>{{ $app->versions()->first()->published_at->format('Y-m-d') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div>
                                                    <a href="{{ route('download', ['version' => $app->versions()->first()->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()))]) }}"
                                                       class="btn btn-info btn-large">
                                                        Download APK ({{ $app->versions()->first()->size }})
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-40">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-container">
                            <h2 class="panel-title p-title">{{ ucwords(__('common.app') . ' ' . __('common.images')) }}
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="describe-img">
                                        <div id="slide-box">
                                            <div class="det-pic-out">
                                                <ul class="pa det-pic-list" style="left: 0px;">
                                                    <li class="amagnificpopup">

                                                        @foreach($app->images as $key => $image)
                                                            <a class="mpopup" data-fancybox="com.tencent.ig" style=""
                                                               target="_blank"
                                                               href="{{$image->image_file}}?fakeurl=1&amp;type=.jpg"
                                                               title="{{ $app->translation('title') . ' ' . ($key + 1)  }}">
                                                                <img alt="{{ $app->translation('title') . ' ' . ($key + 1)  }}"
                                                                     srcset="{{$image->image_file}}?h=710&amp;fakeurl=1&amp;type=.jpg 2x"
                                                                     src="{{$image->image_file}}?h=355&amp;fakeurl=1&amp;type=.jpg"
                                                                     height="355">
                                                            </a>
                                                        @endforeach

                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="javascript:void(0)" class="det-pic-control" id="prev" go=""></a>
                                            <a href="javascript:void(0)" class="det-pic-control go" id="next" go=""></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    {{ $app->translation('description', app()->getLocale()) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-container">
                            <h2 class="panel-title p-title">{{ ucwords(__('common.app') . ' ' . __('common.versions')) }}
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @foreach (object_get($app, 'versions', [[]]) as $version)
                                    @php
                                        $version = $version->load(['app' ,'app.owner' , 'OSVersion'])
                                    @endphp
                                    <div class="col-md-4 col-sm-12 col-xs-12 ">
                                        <div class="row" style="padding: 10px">
                                            <div class="p-panel" style="background-color: #ecebeb; border-radius: 2px">

                                                <div class="col-md-12 col-sm-12 col-xs-12 clr-left"
                                                     style="margin-left: 10px">
                                                    <h2 class="p-head">
                                                        {{ $version->title }}
                                                        <i class="fas fa-align-justify" style="float: right;"
                                                           onclick="showDetails(
                                                           {{$version}}
                                                               )"></i>
                                                    </h2>

                                                    <p class="p-text-sm extension-margin">
                                                        <span class="extension">
                                                            {{ $version->extension }}
                                                        </span>
                                                    </p>
                                                    <p class="p-text-sm">
                                                        {{ $app->translation('title', app()->getLocale()) }}
                                                    </p>
                                                    <p class="p-text-sm">
                                                        {{ $version->published_at->format('Y-m-d') }}
                                                    </p>
                                                    <p class="coming-soon">
                                                        {{ $version->size }}
                                                        <span style="float: right">
                                                            <a
                                                                href="{{ route('download', ['version' => $version->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()) . ' ' . $version->title)]) }}">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                        </span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @component('site.components.sidebar_site')

        @endcomponent
    </div>

    <!-- Modal -->
    <div class="modal fade" id="appVersionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ver-info-m">
                        <p>
                            <strong>{{ ucwords(__('common.publish_date')) }} : </strong>
                            <span id="versionPublishedDate"></span>
                        </p>


                        <p>
                            <strong>{{ ucwords(__('common.vendor')) }} : </strong>
                            <span id="versionVendor"></span>
                        </p>


                        <p>
                            <strong>{{ ucwords(__('common.os_version')) }} : </strong>
                            <span id="versionOsVersion"></span>
                        </p>
                        <p>
                            <strong>{{ ucwords(__('common.signature')) }} : </strong>
                            <span id="versionSignature"></span>

                        </p>
                        <p>
                            <strong> {{ ucwords(__('common.screen_dpi')) }} : </strong>
                            <span id="versionScreenDpi"></span>
                        </p>
                        <p>
                            <strong>{{ ucwords(__('common.architecture')) }} : </strong>
                            <span id="versionArchitecture"></span>
                        </p>

                        <p>
                            <strong> {{ ucwords(__('common.file_hash')) }} : </strong>
                            <span id="versionFileHash"></span>
                        </p>
                        <p>
                            <strong>{{ ucwords(__('common.size')) }} : </strong>
                            <span id="versionSize"></span>
                        </p>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-info" id="versionLink">{{ ucwords(__('common.download')) }}</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#appVersionModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })

        function showDetails(version) {
            let route = '{{ url('download' ) }}' + '/' + version.id + '/' + version.app.title_translation + ` ( ${version.title} ) `;
            $('#appVersionModal').modal('toggle');
            $('#versionPublishedDate').text(version.published_at);
            $('#versionVendor').text(version.app.owner.name);
            $('#versionOsVersion').text(version.o_s_version.version);
            $('#versionSignature').text(version.signature);
            $('#versionScreenDpi').text(version.screen_dpi);
            $('#versionArchitecture').text(version.architecture);
            $('#versionFileHash').text(version.file_hash);
            $('#versionSize').text(version.size);
            $('#exampleModalLongTitle').text(version.app.title_translation + ` ( ${version.title} ) `);
            $('#versionLink').attr('href', route);

        }

    </script>
@endsection
