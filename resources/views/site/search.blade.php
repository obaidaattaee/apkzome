@extends('layouts.site')
@section('title')
    {{ ucwords(__('common.search')) }}
@endsection
@section('content')

    <style>.index-left-ul li {
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

        .day_list {
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

        .search-dl {
            border-bottom: 1px solid #eee;
            height: 130px;
            padding: 20px 0px;
            margin: 0px 20px
        }

        .search-dl:last-child {
            border-bottom: 0
        }

        .search-dl dt {
            float: left;
            width: 130px
        }

        .search-dl dt img {
            width: 130px
        }

        .search-dl dd {
            padding-left: 150px;
            width: 100%;
            box-sizing: border-box
        }

        .search-dl dd p {
            font-size: 12px;
            margin: 10px 0 0 0;
            padding: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .search-dl dd .stars {
            margin-top: 12px;
            clear: none
        }

        .search-dl dd .search-title a {
            font-size: 16px;
            color: #666;
            font-weight: 600
        }

        .search-dl dd .search-title a:hover {
            font-size: 16px;
            color: #00A6ED
        }

        .search-dl dd .more-down {
            background: #00A6ED;
            color: #FFF;
            line-height: 30px;
            padding: 5px 15px;
            margin-right: 10px
        }

        .search-dl dd .more-down:hover {
            background: #149dc8
        }

        .search-dl dd .more-down1 {
            background: #24cd77;
            color: #FFF;
            line-height: 30px;
            padding: 5px 15px;
            margin-right: 10px
        }

        .search-dl dd .more-down1:hover {
            background: #24dc83
        }

        .main {
            margin-top: 20px
        }

        .developer-have {
            float: left;
            font-weight: normal;
            font-size: 14px
        }

        .developer-have-right {
            float: right
        }

        .developer-bg {
            background-repeat: no-repeat;
            position: fixed;
            top: 0;
            bottom: 0;
            background-size: cover;
            background-position: top center;
            width: 100%;
            z-index: -2
        }

        .developer-header {
            position: relative;
            padding: 17px 16px 19px;
            border-radius: 5px;
            z-index: 2;
            background: #fff;
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
            margin: 188px auto 30px;
            width: 645px
        }

        .developer-header .developer-image {
            -webkit-border-radius: 77px;
            border-radius: 77px;
            -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
            background-color: #f5f5f5;
            border: 5px solid #f5f5f5;
            height: 144px;
            left: 50%;
            margin-left: -77px;
            position: absolute;
            top: -141px;
            width: 144px
        }

        .developer-name {
            font-size: 28px;
            font-weight: 400;
            line-height: 40px;
            text-align: center
        }

        .text-wrap {
            text-align: center
        }

        .text-wrap p {
            line-height: 1.6;
            margin-top: 16px;
            font-size: 16px;
            text-align: left
        }

        .ar_fix .developer-have {
            float: right
        }

        .ar_fix .developer-have-right {
            float: left
        }

        .ar_fix .search-dl dt {
            float: right
        }

        .ar_fix .search-dl dd {
            padding-left: 0;
            padding-right: 150px
        }

        .hashtag-wrap {
            padding: 10px
        }

        .hashtag-wrap li {
            padding: 5px;
            line-height: 1.3
        }

        .hashtag-wrap li a, .hashtag-wrap li i {
            color: #797979
        }

        .hashtag-wrap li a:hover {
            color: #24cd77
        }

        .f32 .flag {
            display: inline-block;
            height: 32px;
            width: 32px;
            vertical-align: middle;
            line-height: 32px;
            background: url("https://static.apkpure.com/www/static/imgs/flags32.png") no-repeat
        }

        .f32 ._African_Union {
            background-position: 0 -32px
        }

        .f32 ._Arab_League {
            background-position: 0 -64px
        }

        .f32 ._ASEAN {
            background-position: 0 -96px
        }

        .f32 ._CARICOM {
            background-position: 0 -128px
        }

        .f32 ._CIS {
            background-position: 0 -160px
        }

        .f32 ._Commonwealth {
            background-position: 0 -192px
        }

        .f32 ._England {
            background-position: 0 -224px
        }

        .f32 ._European_Union, .f32 .eu {
            background-position: 0 -256px
        }

        .f32 ._Islamic_Conference {
            background-position: 0 -288px
        }

        .f32 ._Kosovo {
            background-position: 0 -320px
        }

        .f32 ._NATO {
            background-position: 0 -352px
        }

        .f32 ._Northern_Cyprus {
            background-position: 0 -384px
        }

        .f32 ._Northern_Ireland {
            background-position: 0 -416px
        }

        .f32 ._Olimpic_Movement {
            background-position: 0 -448px
        }

        .f32 ._OPEC {
            background-position: 0 -480px
        }

        .f32 ._Red_Cross {
            background-position: 0 -512px
        }

        .f32 ._Scotland {
            background-position: 0 -544px
        }

        .f32 ._Somaliland {
            background-position: 0 -576px
        }

        .f32 ._Tibet {
            background-position: 0 -608px
        }

        .f32 ._United_Nations {
            background-position: 0 -640px
        }

        .f32 ._Wales {
            background-position: 0 -672px
        }

        .f32 .ad {
            background-position: 0 -704px
        }

        .f32 .ae {
            background-position: 0 -736px
        }

        .f32 .af {
            background-position: 0 -768px
        }

        .f32 .ag {
            background-position: 0 -800px
        }

        .f32 .ai {
            background-position: 0 -832px
        }

        .f32 .al {
            background-position: 0 -864px
        }

        .f32 .am {
            background-position: 0 -896px
        }

        .f32 .ao {
            background-position: 0 -928px
        }

        .f32 .aq {
            background-position: 0 -960px
        }

        .f32 .ar {
            background-position: 0 -992px
        }

        .f32 .as {
            background-position: 0 -1024px
        }

        .f32 .at {
            background-position: 0 -1056px
        }

        .f32 .au {
            background-position: 0 -1088px
        }

        .f32 .aw {
            background-position: 0 -1120px
        }

        .f32 .ax {
            background-position: 0 -1152px
        }

        .f32 .az {
            background-position: 0 -1184px
        }

        .f32 .ba {
            background-position: 0 -1216px
        }

        .f32 .bb {
            background-position: 0 -1248px
        }

        .f32 .bd {
            background-position: 0 -1280px
        }

        .f32 .be {
            background-position: 0 -1312px
        }

        .f32 .bf {
            background-position: 0 -1344px
        }

        .f32 .bg {
            background-position: 0 -1376px
        }

        .f32 .bh {
            background-position: 0 -1408px
        }

        .f32 .bi {
            background-position: 0 -1440px
        }

        .f32 .bj {
            background-position: 0 -1472px
        }

        .f32 .bm {
            background-position: 0 -1504px
        }

        .f32 .bn {
            background-position: 0 -1536px
        }

        .f32 .bo {
            background-position: 0 -1568px
        }

        .f32 .br {
            background-position: 0 -1600px
        }

        .f32 .bs {
            background-position: 0 -1632px
        }

        .f32 .bt {
            background-position: 0 -1664px
        }

        .f32 .bw {
            background-position: 0 -1696px
        }

        .f32 .by {
            background-position: 0 -1728px
        }

        .f32 .bz {
            background-position: 0 -1760px
        }

        .f32 .ca {
            background-position: 0 -1792px
        }

        .f32 .cd {
            background-position: 0 -1824px
        }

        .f32 .cf {
            background-position: 0 -1856px
        }

        .f32 .cg {
            background-position: 0 -1888px
        }

        .f32 .ch {
            background-position: 0 -1920px
        }

        .f32 .ci {
            background-position: 0 -1952px
        }

        .f32 .ck {
            background-position: 0 -1984px
        }

        .f32 .cl {
            background-position: 0 -2016px
        }

        .f32 .cm {
            background-position: 0 -2048px
        }

        .f32 .cn {
            background-position: 0 -2080px
        }

        .f32 .co {
            background-position: 0 -2112px
        }

        .f32 .cr {
            background-position: 0 -2144px
        }

        .f32 .cu {
            background-position: 0 -2176px
        }

        .f32 .cv {
            background-position: 0 -2208px
        }

        .f32 .cy {
            background-position: 0 -2240px
        }

        .f32 .cz {
            background-position: 0 -2272px
        }

        .f32 .de {
            background-position: 0 -2304px
        }

        .f32 .dj {
            background-position: 0 -2336px
        }

        .f32 .dk {
            background-position: 0 -2368px
        }

        .f32 .dm {
            background-position: 0 -2400px
        }

        .f32 .do {
            background-position: 0 -2432px
        }

        .f32 .dz {
            background-position: 0 -2464px
        }

        .f32 .ec {
            background-position: 0 -2496px
        }

        .f32 .ee {
            background-position: 0 -2528px
        }

        .f32 .eg {
            background-position: 0 -2560px
        }

        .f32 .eh {
            background-position: 0 -2592px
        }

        .f32 .er {
            background-position: 0 -2624px
        }

        .f32 .es {
            background-position: 0 -2656px
        }

        .f32 .et {
            background-position: 0 -2688px
        }

        .f32 .fi {
            background-position: 0 -2720px
        }

        .f32 .fj {
            background-position: 0 -2752px
        }

        .f32 .fm {
            background-position: 0 -2784px
        }

        .f32 .fo {
            background-position: 0 -2816px
        }

        .f32 .fr {
            background-position: 0 -2848px
        }

        .f32 .bl, .f32 .cp, .f32 .mf, .f32 .yt {
            background-position: 0 -2848px
        }

        .f32 .ga {
            background-position: 0 -2880px
        }

        .f32 .gb {
            background-position: 0 -2912px
        }

        .f32 .sh {
            background-position: 0 -2912px
        }

        .f32 .gd {
            background-position: 0 -2944px
        }

        .f32 .ge {
            background-position: 0 -2976px
        }

        .f32 .gg {
            background-position: 0 -3008px
        }

        .f32 .gh {
            background-position: 0 -3040px
        }

        .f32 .gi {
            background-position: 0 -3072px
        }

        .f32 .gl {
            background-position: 0 -3104px
        }

        .f32 .gm {
            background-position: 0 -3136px
        }

        .f32 .gn {
            background-position: 0 -3168px
        }

        .f32 .gp {
            background-position: 0 -3200px
        }

        .f32 .gq {
            background-position: 0 -3232px
        }

        .f32 .gr {
            background-position: 0 -3264px
        }

        .f32 .gt {
            background-position: 0 -3296px
        }

        .f32 .gu {
            background-position: 0 -3328px
        }

        .f32 .gw {
            background-position: 0 -3360px
        }

        .f32 .gy {
            background-position: 0 -3392px
        }

        .f32 .hk {
            background-position: 0 -3424px
        }

        .f32 .hn {
            background-position: 0 -3456px
        }

        .f32 .hr {
            background-position: 0 -3488px
        }

        .f32 .ht {
            background-position: 0 -3520px
        }

        .f32 .hu {
            background-position: 0 -3552px
        }

        .f32 .id {
            background-position: 0 -3584px
        }

        .f32 .mc {
            background-position: 0 -3584px
        }

        .f32 .ie {
            background-position: 0 -3616px
        }

        .f32 .il {
            background-position: 0 -3648px
        }

        .f32 .im {
            background-position: 0 -3680px
        }

        .f32 .in {
            background-position: 0 -3712px
        }

        .f32 .iq {
            background-position: 0 -3744px
        }

        .f32 .ir {
            background-position: 0 -3776px
        }

        .f32 .is {
            background-position: 0 -3808px
        }

        .f32 .it {
            background-position: 0 -3840px
        }

        .f32 .je {
            background-position: 0 -3872px
        }

        .f32 .jm {
            background-position: 0 -3904px
        }

        .f32 .jo {
            background-position: 0 -3936px
        }

        .f32 .jp {
            background-position: 0 -3968px
        }

        .f32 .ke {
            background-position: 0 -4000px
        }

        .f32 .kg {
            background-position: 0 -4032px
        }

        .f32 .kh {
            background-position: 0 -4064px
        }

        .f32 .ki {
            background-position: 0 -4096px
        }

        .f32 .km {
            background-position: 0 -4128px
        }

        .f32 .kn {
            background-position: 0 -4160px
        }

        .f32 .kp {
            background-position: 0 -4192px
        }

        .f32 .kr {
            background-position: 0 -4224px
        }

        .f32 .kw {
            background-position: 0 -4256px
        }

        .f32 .ky {
            background-position: 0 -4288px
        }

        .f32 .kz {
            background-position: 0 -4320px
        }

        .f32 .la {
            background-position: 0 -4352px
        }

        .f32 .lb {
            background-position: 0 -4384px
        }

        .f32 .lc {
            background-position: 0 -4416px
        }

        .f32 .li {
            background-position: 0 -4448px
        }

        .f32 .lk {
            background-position: 0 -4480px
        }

        .f32 .lr {
            background-position: 0 -4512px
        }

        .f32 .ls {
            background-position: 0 -4544px
        }

        .f32 .lt {
            background-position: 0 -4576px
        }

        .f32 .lu {
            background-position: 0 -4608px
        }

        .f32 .lv {
            background-position: 0 -4640px
        }

        .f32 .ly {
            background-position: 0 -4672px
        }

        .f32 .ma {
            background-position: 0 -4704px
        }

        .f32 .md {
            background-position: 0 -4736px
        }

        .f32 .me {
            background-position: 0 -4768px
        }

        .f32 .mg {
            background-position: 0 -4800px
        }

        .f32 .mh {
            background-position: 0 -4832px
        }

        .f32 .mk {
            background-position: 0 -4864px
        }

        .f32 .ml {
            background-position: 0 -4896px
        }

        .f32 .mm {
            background-position: 0 -4928px
        }

        .f32 .mn {
            background-position: 0 -4960px
        }

        .f32 .mo {
            background-position: 0 -4992px
        }

        .f32 .mq {
            background-position: 0 -5024px
        }

        .f32 .mr {
            background-position: 0 -5056px
        }

        .f32 .ms {
            background-position: 0 -5088px
        }

        .f32 .mt {
            background-position: 0 -5120px
        }

        .f32 .mu {
            background-position: 0 -5152px
        }

        .f32 .mv {
            background-position: 0 -5184px
        }

        .f32 .mw {
            background-position: 0 -5216px
        }

        .f32 .mx {
            background-position: 0 -5248px
        }

        .f32 .my {
            background-position: 0 -5280px
        }

        .f32 .mz {
            background-position: 0 -5312px
        }

        .f32 .na {
            background-position: 0 -5344px
        }

        .f32 .nc {
            background-position: 0 -5376px
        }

        .f32 .ne {
            background-position: 0 -5408px
        }

        .f32 .ng {
            background-position: 0 -5440px
        }

        .f32 .ni {
            background-position: 0 -5472px
        }

        .f32 .nl {
            background-position: 0 -5504px
        }

        .f32 .bq {
            background-position: 0 -5504px
        }

        .f32 .no {
            background-position: 0 -5536px
        }

        .f32 .bv, .f32 .nq, .f32 .sj {
            background-position: 0 -5536px
        }

        .f32 .np {
            background-position: 0 -5568px
        }

        .f32 .nr {
            background-position: 0 -5600px
        }

        .f32 .nz {
            background-position: 0 -5632px
        }

        .f32 .om {
            background-position: 0 -5664px
        }

        .f32 .pa {
            background-position: 0 -5696px
        }

        .f32 .pe {
            background-position: 0 -5728px
        }

        .f32 .pf {
            background-position: 0 -5760px
        }

        .f32 .pg {
            background-position: 0 -5792px
        }

        .f32 .ph {
            background-position: 0 -5824px
        }

        .f32 .pk {
            background-position: 0 -5856px
        }

        .f32 .pl {
            background-position: 0 -5888px
        }

        .f32 .pr {
            background-position: 0 -5920px
        }

        .f32 .ps {
            background-position: 0 -5952px
        }

        .f32 .pt {
            background-position: 0 -5984px
        }

        .f32 .pw {
            background-position: 0 -6016px
        }

        .f32 .py {
            background-position: 0 -6048px
        }

        .f32 .qa {
            background-position: 0 -6080px
        }

        .f32 .re {
            background-position: 0 -6112px
        }

        .f32 .ro {
            background-position: 0 -6144px
        }

        .f32 .rs {
            background-position: 0 -6176px
        }

        .f32 .ru {
            background-position: 0 -6208px
        }

        .f32 .rw {
            background-position: 0 -6240px
        }

        .f32 .sa {
            background-position: 0 -6272px
        }

        .f32 .sb {
            background-position: 0 -6304px
        }

        .f32 .sc {
            background-position: 0 -6336px
        }

        .f32 .sd {
            background-position: 0 -6368px
        }

        .f32 .se {
            background-position: 0 -6400px
        }

        .f32 .sg {
            background-position: 0 -6432px
        }

        .f32 .si {
            background-position: 0 -6464px
        }

        .f32 .sk {
            background-position: 0 -6496px
        }

        .f32 .sl {
            background-position: 0 -6528px
        }

        .f32 .sm {
            background-position: 0 -6560px
        }

        .f32 .sn {
            background-position: 0 -6592px
        }

        .f32 .so {
            background-position: 0 -6624px
        }

        .f32 .sr {
            background-position: 0 -6656px
        }

        .f32 .st {
            background-position: 0 -6688px
        }

        .f32 .sv {
            background-position: 0 -6720px
        }

        .f32 .sy {
            background-position: 0 -6752px
        }

        .f32 .sz {
            background-position: 0 -6784px
        }

        .f32 .tc {
            background-position: 0 -6816px
        }

        .f32 .td {
            background-position: 0 -6848px
        }

        .f32 .tg {
            background-position: 0 -6880px
        }

        .f32 .th {
            background-position: 0 -6912px
        }

        .f32 .tj {
            background-position: 0 -6944px
        }

        .f32 .tl {
            background-position: 0 -6976px
        }

        .f32 .tm {
            background-position: 0 -7008px
        }

        .f32 .tn {
            background-position: 0 -7040px
        }

        .f32 .to {
            background-position: 0 -7072px
        }

        .f32 .tr {
            background-position: 0 -7104px
        }

        .f32 .tt {
            background-position: 0 -7136px
        }

        .f32 .tv {
            background-position: 0 -7168px
        }

        .f32 .tw {
            background-position: 0 -7200px
        }

        .f32 .tz {
            background-position: 0 -7232px
        }

        .f32 .ua {
            background-position: 0 -7264px
        }

        .f32 .ug {
            background-position: 0 -7296px
        }

        .f32 .us {
            background-position: 0 -7328px
        }

        .f32 .uy {
            background-position: 0 -7360px
        }

        .f32 .uz {
            background-position: 0 -7392px
        }

        .f32 .va {
            background-position: 0 -7424px
        }

        .f32 .vc {
            background-position: 0 -7456px
        }

        .f32 .ve {
            background-position: 0 -7488px
        }

        .f32 .vg {
            background-position: 0 -7520px
        }

        .f32 .vi {
            background-position: 0 -7552px
        }

        .f32 .vn {
            background-position: 0 -7584px
        }

        .f32 .vu {
            background-position: 0 -7616px
        }

        .f32 .ws {
            background-position: 0 -7648px
        }

        .f32 .ye {
            background-position: 0 -7680px
        }

        .f32 .za {
            background-position: 0 -7712px
        }

        .f32 .zm {
            background-position: 0 -7744px
        }

        .f32 .zw {
            background-position: 0 -7776px
        }

        .f32 .sx {
            background-position: 0 -7808px
        }

        .f32 .cw {
            background-position: 0 -7840px
        }

        .f32 .ss {
            background-position: 0 -7872px
        }

        @keyframes bgShakeSearch {
            from, to {
                background-position: center 5px
            }
            25% {
                background-position: 37px center
            }
            50% {
                background-position: center 9px
            }
            75% {
                background-position: 33px center
            }
        }

        .search-results .formsearch .ss {
            -webkit-animation-name: bgShakeSearch;
            animation-name: bgShakeSearch
        }

        .search-results {
            background: #fbfbfb;
            padding-top: 20px;
            padding-bottom: 20px
        }

        .search-results input {
            border: 0
        }

        .search-results .search-bg {
            background: #eee;
            margin: 0 25px;
            height: 44px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px
        }

        .search-results .text-box {
            width: 698px;
            float: left;
            margin-top: 2px;
            padding-left: 1px
        }

        .search-results .text-box input {
            height: 41px;
            width: 667px;
            background: #fff;
            padding: 0px 15px;
            font-size: 14px;
            line-height: 41px;
            color: #666;
            border-bottom-left-radius: 5px;
            border-top-left-radius: 5px
        }

        .search-results .text-btn {
            width: 100px;
            float: left
        }

        .search-results .text-btn input {
            width: 100px;
            height: 44px;
            background: #24cd77 url("https://static.apkpure.com/www/static/imgs/search.png") center no-repeat;
            cursor: pointer;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 5px
        }

        .search-results .text-btn input:hover {
            background: #24dc83 url("https://static.apkpure.com/www/static/imgs/search.png") center no-repeat
        }

        .search-results .tt-hint {
            color: #999 !important
        }

        .search-results .tt-menu {
            background-color: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            margin-top: 6px;
            padding: 8px 0;
            width: 100%
        }

        .search-results .tt-suggestion {
            font-size: 16px;
            line-height: 24px;
            padding: 3px 20px;
            word-break: break-all
        }

        .search-results .tt-suggestion:hover {
            cursor: pointer;
            color: #fff;
            background-color: #24cd77
        }

        .search-results .tt-suggestion.tt-cursor {
            background-color: #24cd77;
            color: #FFFFFF
        }

        .regions {
            clear: both;
            overflow: hidden;
            display: none;
            background: #F1F1F1;
            margin: 0 25px 25px 25px;
            padding: 10px;
            position: relative;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px
        }

        .regions .r {
            height: 38px;
            line-height: 38px;
            display: block;
            text-decoration: none;
            width: 20%;
            float: left;
            color: #367DA3;
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .regions .r:hover {
            color: #00A6ED
        }

        .regions .r.hover {
            color: #00A6ED
        }

        .regions .r span {
            margin-right: 5px
        }

        .regions h2 {
            margin: 0;
            padding: 0;
            font-size: 16px;
            color: #24cd77
        }

        .search-text {
            position: absolute;
            right: 20px;
            line-height: 50px;
            color: #888
        }

        .search-text span {
            font-size: 16px;
            font-weight: 600
        }

        .search-text .sr {
            float: right;
            padding: 0 5px 0 8px;
            margin: 0 1px 0 5px;
            color: #fff;
            background: #24cd77;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px
        }

        .search-text .sr .cl {
            text-decoration: none;
            color: #fff;
            display: inline-block;
            padding: 3px
        }

        .search-text .sr .cl:hover {
            color: #000
        }

        .search-text .advanced {
            display: block;
            background: #e8e8e8;
            float: right;
            text-decoration: none;
            padding: 3px 8px;
            color: #333;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px
        }

        .search-text .advanced i {
            display: inline-block;
            vertical-align: middle;
            margin-left: 5px;
            margin-top: -3px;
            width: 7px;
            height: 4px;
            background: no-repeat center url("data:image/gif;base64,R0lGODlhBwAKAJEAAImJif///////wAAACH5BAEHAAIALAAAAAAHAAoAAAIPlGEJq8sOk5wHvliR1KIAADs=");
            background-position: 0 -6px
        }

        .search-text .advanced i.hover {
            background-position: 0 0
        }

        .search-tabs {
            border-bottom: 1px solid #eee;
            border-top: 1px solid #eee;
            padding: 0 20px;
            position: relative
        }

        .search-tabs li {
            float: left;
            margin: 0 10px
        }

        .search-tabs li:first-child {
            margin-left: 0
        }

        .search-tabs li a span {
            color: #bbb
        }

        .search-tabs li a.on {
            color: #24cd77;
            border-bottom-color: #24cd77
        }

        .search-tabs li a {
            text-align: center;
            display: block;
            padding: 12px 10px 8px;
            border-bottom: 4px solid transparent;
            font-size: 16px;
            line-height: 26px;
            color: #666
        }

        .search-list dl {
            border-bottom: 1px solid #eee;
            height: 60px;
            padding: 15px 0;
            margin: 0 20px
        }

        .search-list dl:last-child {
            border-bottom: 0
        }

        .search-list dl dt {
            float: left;
            width: 60px
        }

        .search-list dl dt div {
            border-radius: 4px;
            width: 60px;
            height: 60px;
            line-height: 60px;
            color: white;
            text-align: center;
            font-size: 25px
        }

        .search-list dl dt img {
            width: 60px;
            border-radius: 50%
        }

        .search-list dl dd {
            padding-left: 80px;
            width: 100%;
            box-sizing: border-box
        }

        .search-list dl dd a {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            font-size: 16px;
            color: #666;
            font-weight: 500;
            line-height: 20px;
            margin-top: 20px;
            display: inline-block;
            max-width: 450px
        }

        .search-list dl dd a:hover {
            color: #00A6ED
        }

        .search-empty {
            text-align: center;
            padding: 80px 0
        }

        .search-empty img {
            width: 140px;
            height: 140px
        }

        .search-empty .tip {
            font-size: 18px;
            color: #949494
        }

        .index-so-box {
            padding-bottom: 1px
        }

        .index_r_hot {
            width: 300px;
            margin: 0 auto;
            padding: 10px 0px;
            height: 125px;
            overflow: hidden
        }

        .index_r_hot a {
            display: inline-block;
            margin-bottom: 10px;
            padding: 0px 10px;
            margin-right: 10px;
            background: #f2f5f9;
            line-height: 24px;
            height: 24px;
            font-size: 13px;
            color: #5d5d5d;
            border-radius: 4px
        }

        .index_r_hot a:hover {
            background: #24cd77;
            color: #fff
        }

        .index_r_hot a:hover .search-icon-hot {
            background-position: 0 15px
        }

        .search-icon-hot {
            background-image: url("https://static.apkpure.com/www/static/imgs/search_hot.png");
            background-size: 15px;
            width: 15px;
            height: 15px;
            background-position: 0 0;
            display: inline-block;
            vertical-align: sub;
            margin-right: 5px
        }

        .ar_fix .search-icon-hot {
            margin-right: 0;
            margin-left: 5px
        }

        .ar_fix .search-text .advanced {
            float: left
        }

        .ar_fix .search-text .advanced i {
            margin-left: 0;
            margin-right: 5px
        }

        .ar_fix .regions .r span {
            margin-right: 0;
            margin-left: 5px
        }

        .ar_fix .regions .r {
            float: right
        }

        .ar_fix .search-tabs li {
            float: right
        }

        .ar_fix .search-list dl dt {
            float: right
        }

        .ar_fix .search-list dl dd {
            padding-right: 80px;
            padding-left: 0
        }

        .ar_fix .search-tabs li:first-child {
            margin-left: 10px;
            margin-right: 0
        }

        .ar_fix .search-text {
            left: 20px;
            right: auto
        }

        @media only screen and (max-width: 1300px) {
            .index-so-box {
                padding-bottom: 8px
            }

            .index_r_hot {
                height: 118px
            }

            .index_r_hot a {
                margin-bottom: 12px;
                padding: 0px 5px;
                margin-right: 5px;
                line-height: 22px;
                height: 22px
            }

            .index_r_hot {
                width: 270px
            }

            .search-results .text-box {
                width: 576px
            }

            .search-results .text-box input {
                width: 545px
            }
        }

        .stars span.score {
            display: block;
            background: url(https://static.apkpure.com/www/static/imgs/stars.svg) repeat-x;
            height: 15px;
            width: 75px;
        }

        .details-rating .stars span, .details-rating .stars {
            background-size: 17px;
            height: 17px;
            width: 85px;
        }

        .mb-5, .my-5 {
            margin-bottom: 3rem !important
        }

        .stars {
            background: url(https://static.apkpure.com/www/static/imgs/stars_fill.svg) repeat-x;
            height: 15px;
            width: 75px;
            clear: both;
            direction: ltr;
            position: relative;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8" x-data="searchApps()">
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-container">
                                {{--                                <h2 class="panel-title p-title">{{ $searchType->translation('title' , app()->getLocale()) }}</h2>--}}
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="btn-group">
                                            <a href="{{ url()->current() . "?sort=" . __('search.download')  }}"
                                               type="button" class="btn {{ request()->input('sort') == __('search.download') ? 'btn-info' : 'btn-default' }} ">{{ __('search.download') }}</a>
                                            <a href="{{ url()->current() . "?sort=" .  __('search.arival') }}"
                                               type="button"
                                               class="btn {{ request()->input('sort') == __('search.arival') ? 'btn-info' : 'btn-default' }} ">{{ __('search.arival') }}</a>
                                            <a href="{{ url()->current() . "?sort=" .  __('search.rating')  }}"
                                               type="button"
                                               class="btn {{ request()->input('sort') == __('search.rating') ? 'btn-info' : 'btn-default' }} ">{{ __('search.rating') }}</a>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($apps as $app)
                                    <div class="row mb-5">
                                        <dl class="search-dl">
                                            <dt>
                                                <a title="{{ $app->translation('title' , app()->getLocale()) }}"
                                                   target="_blank"
                                                   href="{{ route('apps.details' , ['app' => $app->id , 'title' => $app->translation('title' , app()->getLocale()) ]) }}">
                                                    <img title="{{ $app->translation('title' , app()->getLocale()) }}"
                                                         srcset="{{ $app->image_file }}?w=340&amp;fakeurl=1 2x"
                                                         src="{{ $app->image_file }}?w=170&amp;fakeurl=1">
                                                </a>
                                            </dt>
                                            <dd>
                                                <p class="search-title">
                                                    <a title="{{ $app->translation('title' , app()->getLocale()) }}"
                                                       target="_blank"
                                                       href="{{ route('apps.details' , ['app' => $app->id , 'title' => $app->translation('title' , app()->getLocale()) ]) }}">
                                                        {{ $app->translation('title' , app()->getLocale()) }}</a>
                                                </p>
                                                <div class="stars">
                                                    <span class="score"
                                                          title="{{ $app->translation('title' , app()->getLocale()) }}"
                                                          style="width:{{ ($app->rate/5) * 75 }}px"></span>
                                                    <span
                                                        class="star">{{ $app->rate }}</span>
                                                </div>
                                                <p>{{ ucwords(__('common.developer')) }}
                                                    : {{ object_get($app , 'owner.name') }}
                                                </p>
                                                <p>
                                                    <a target="_blank" class="more-down"
                                                       href="{{ route('apps.details' , ['app' => $app->id , 'title' => $app->translation('title' , app()->getLocale()) ]) }}">
                                                        {{ ucwords(__('common.read_more')) }}</a>
                                                </p>
                                            </dd>
                                        </dl>
                                    </div>
                                @endforeach
                                <template x-for="app in apps" :key="app.id">
                                    <div>
                                        <div class="row mb-5">
                                            <dl class="search-dl">
                                                <dt>
                                                    <a x-bind:title="app.title_translation" target="_blank"
                                                       x-bind:href="'{{ url('details/') . '/' }}'+ app.id + '/' +app.title_translation">
                                                        <img x-bind:title="app.title_translation"
                                                             x-bind:srcset="app.image_file"
                                                             x-bind:src="app.image_file">
                                                    </a>
                                                </dt>
                                                <dd>
                                                    <p class="search-title">
                                                        <a x-bind:title="app.title_translation" target="_blank"
                                                           x-bind:href="'{{ url('details/') . '/' }}'+ app.id + '/' +app.title_translation">
                                                            <span x-text="app.title_translation"></span>
                                                        </a>
                                                    </p>
                                                    <div class="stars">
                                                    <span class="score"
                                                          x-bind:title="app.title_translation"
                                                          :style="`width: ${ app.rate /5 * 75 }px`"></span>
                                                        <span class="star" x-text="app.rate"></span>
                                                    </div>
                                                    <p>{{ ucwords(__('common.developer')) }}: <span
                                                            x-text="app.owner.name"></span>
                                                    </p>
                                                    <p>
                                                        <a target="_blank" class="more-down"
                                                           href="/pubg-mobile/com.pubg.krmobile">Read More</a>
                                                    </p>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </template>

                            </div>
                            <div class="row">
                                <template x-if="showLoadMore">
                                    <button class="btn btn-info p-btn "
                                            style="display: flex;justify-content: center;margin: auto"
                                            x-on:click="getApps()">{{ ucwords(__('common.load_more')) }}</button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('site.components.sidebar_site')

        </div>

    </div>
    </div>
    <script>
        function searchApps() {
            return {
                apps: [],
                nextPage: {{ $apps->currentPage() }} + 1,
                showLoadMore: true,
                getApps: function () {
                    axios.get('{{ $apps->path() }}', {
                        params: {
                            page: this.nextPage
                        }
                    }).then((response) => {
                        this.nextPage = response.data.current_page + 1;
                        this.showLoadMore = response.data.next_page_url ? true : false;
                        this.apps = this.apps.concat(response.data.data);
                    });
                }
            }
        }

    </script>
@endsection
