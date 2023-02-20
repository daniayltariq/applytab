@php
    $messengerColor='#ffead3';
@endphp
<style>
    :root {
        --messengerColor: {{ $messengerColor }},
    }
/* NProgress background */
#nprogress .bar{
	background: transparent/* {{ $messengerColor }} */ !important;
}
#nprogress .peg {
    box-shadow: 0 0 10px {{ $messengerColor }}, 0 0 5px {{ $messengerColor }} !important;
}
#nprogress .spinner-icon {
  border-top-color: {{ $messengerColor }} !important;
  border-left-color: {{ $messengerColor }} !important;
}

.m-header svg{
    color: {{ $messengerColor }};
}

.m-list-active,
.m-list-active:hover,
.m-list-active:focus{
	background: {{ $messengerColor }};
}

.m-list-active b{
	background: #fff !important;
	color: {{ $messengerColor }} !important;
}

.messenger-list-item td b{
    background: {{ $messengerColor }};
}

.messenger-infoView nav a{
    color: {{ $messengerColor }};
}

.messenger-infoView-btns a.default{
	color: {{ $messengerColor }};
}

.mc-sender p{
  background: {{ $messengerColor }} !important;
  color: rgb(106 106 106) !important;
}

.messenger-sendCard button svg{
    color: {{ $messengerColor }};
}

.messenger-listView-tabs a,
.messenger-listView-tabs a:hover,
.messenger-listView-tabs a:focus{
    color: {{ $messengerColor }};
}

.active-tab{
	border-bottom: 2px solid {{ $messengerColor }};
}

.lastMessageIndicator{
    color: {{ $messengerColor }} !important;
}

.messenger-favorites div.avatar{
    box-shadow: 0px 0px 0px 2px {{ $messengerColor }};
}

.dark-mode-switch{
    color: {{ $messengerColor }};
}
.m-list-active .activeStatus{
    border-color: {{ $messengerColor }} !important;
}

.messenger [type='text']:focus {
    outline: 1px solid {{ $messengerColor }};
    border-color: {{ $messengerColor }} !important;
    border-color: {{ $messengerColor }};
    box-shadow: 0 0 2px {{ $messengerColor }};
}
.fullpage-loader{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: none;
    z-index: 9999;
    background: #000000eb;
}

.fullpage-loader .loader-wrapper{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    z-index: 9999;
    text-align: center;
}
</style>
