@extends('admin.layouts.master')
@section('content')
<style>
    @import url(https://fonts.googleapis.com/css?family=VT323);

    @keyframes scroll {
        0% { height: 0 }
        100% { height: 100%; }
    }

    @keyframes type { 
    from { width: 0; } 
    } 

    @keyframes type2 {
    0%{width: 0;}
    50%{width: 0;}
    100%{ width: 100; } 
    } 

    @keyframes blink {
    to{opacity: .0;}
    }

    @keyframes scan {
        from { top: 0 }
        to { top: 100% }
    }

    /* @keyframes flicker {
        0%{opacity: 1;}
        100% { opacity: 1 }
    } */

    @keyframes flicker {
		0% { opacity: 0.15795 }
		5% { opacity: 0.31511 }
		10% { opacity: 0.94554 }
		15% { opacity: 0.2469 }
		20% { opacity: 0.62031 }
		25% { opacity: 0.0293 }
		30% { opacity: 0.00899 }
		35% { opacity: 0.5344 }
		40% { opacity: 0.12778 }
		45% { opacity: 0.52042 }
		50% { opacity: 0.3823 }
		55% { opacity: 0.2198 }
		60% { opacity: 0.9383 }
		65% { opacity: 0.86615 }
		70% { opacity: 0.68695 }
		75% { opacity: 0.55749 }
		80% { opacity: 0.96984 }
		85% { opacity: 0.0361 }
		90% { opacity: 0.24467 }
		95% { opacity: 0.08351 }
		100% { opacity: 0.54813 }
	}

    ::-webkit-scrollbar {
    display: none;
    }
    * {
    box-sizing: border-box;
    }
        
    html,
    body {
        background: #383838;
        color: #00dd00; 
        font-family: 'VT323', Courier;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    h1, h2, h3 h4, h5, h6 { 
        font-weight: normal;
        margin: 0;
        text-transform: uppercase;
    }
    h4 b {
    color: #00dd00;
    }
    a {
        /* color: white;	 */
        text-decoration: none;	
    }

    a:hover {
        color: red;
    }

    p { 
        line-height: 100%;
        margin: 0; 
    }
        
    span { animation: blink 1s infinite }

    ul {
        list-style: none;
    }

    .laradrop a:before, ul a:before,
    p a:before {
        color: #00dd00;
        content: ' [ ';
    }

    .laradrop a:after, ul a:after,
    p a:after {
        color: #00dd00;
        content: ' ] ';	
    }

    header.site {
        margin: 0 0 40px 0;
        text-transform: uppercase;
    }

    nav.site { 
        margin: 0 0 40px 0;
    position: relative;
    width: 100%;
    z-index: 10;
    }

    nav.site ul {
        padding: 0;
    }

    nav.site ul li {
    display: inline-block;
    padding: 0 10px;
    min-width: 250px;
    width: auto;
    }

    .overlay {
        height: 1px;
        position: absolute;
        top: 0;
        left: 0;
        width: 1px;
    }

    .overlay:before {
        background: linear-gradient(#101010 50%, rgba(16, 16, 16, 0.2) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.03), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.03));
        background-size: 100% 3px, 6px 100%;
        content: "";
        display: block;
        pointer-events: none;
        position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        z-index: 2;
    }
        
    .overlay:after {
        animation: flicker 0.30s infinite;
        background: rgba(16, 16, 16, 0.2);
        content: "";
        display: block;
        pointer-events: none;
        position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        z-index: 2;
    }

    .col {
        float: left;
        padding: 0 20px;
    }

    .col.two { width: auto; }

    .wrapper {
        animation: scroll 5s 1;
        margin: 0;
        overflow: hidden;
        padding: 0;
        scrollbar-width: none;
        -ms-overflow-style: none;
        font-size: 20px;
    }

    .content { 
        animation: scroll 3s 1;
        overflow: hidden;
        padding: 40px; 
        position: relative;
        width: 95%;
    }

    #logo-v {
        display: block;
        height: auto;
        margin: 0 auto;
        width: 200px;
    }

    img.pip-hero {
        display: block;
        float: left;
        height: auto;
        margin: 5px 10px 5px 0;
        width: 120px;
    }

    form {}

    label {
        clear: left;
        display: block;
        float: left;
        margin-right: 10px;
        padding-top: 5px;
    }

    input[type=text],

    input[type=text]:focus,
    textarea:focus,
    input[type=submit]:focus,
    a.button:focus {
        outline: 0;
    }

    input[type=submit],
    a.button {
        background: transparent;
        border: 1px solid #00dd00;
        clear: both;
        color: #00dd00;
        cursor: hand;
        display: inline-block;
        font-family: 'VT323', Courier;
        font-size: 1em;
        margin-bottom: 20px;
        padding: 10px 100px;
        position: relative;
        text-decoration: none;
        text-transform: uppercase;
        z-index: 10;
    }

    input[type=submit]:hover,
    a.button:hover {
        background: #00dd00;
        color: #383838;
        opacity: 0.8;
    }

    .expandingArea { position: relative }
        
    .scanline {
        animation: scroll 10s 5s infinite;
        background: -moz-linear-gradient(top,  rgba(0,221,0,0) 0%, rgba(0,221,0,1) 50%, rgba(0,221,0,0) 100%);
        background: -webkit-linear-gradient(top,  rgba(0,221,0,0) 0%,rgba(0,221,0,1) 50%,rgba(0,221,0,0) 100%);
        background: linear-gradient(to bottom,  rgba(0,221,0,0) 0%,rgba(0,221,0,1) 50%,rgba(0,221,0,0) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0000dd00', endColorstr='#0000dd00',GradientType=0 );
        display: block;
        height: 20px;
        opacity: 0.05;
        position: absolute;
            left: 0;
            right: 0;
            top: -5%;
        z-index: 2;
    }

    .clear {
        clear: both;
    }

    .clearfix {
    overflow: auto;
    zoom: 1;
    }

    .upper { text-transform: uppercase; }
    .scrollable-div {
            min-height: 200px; /* Minimum height */
            max-height: 300px; /* Optional: Limit the max height */
            overflow-y: scroll; /* Enable vertical scrolling */
            border: 1px solid #ccc; /* Optional: Add a border */
            padding: 10px; /* Optional: Add padding */
        }
</style>

<!-- <div class="overlay"></div> -->
<!-- <div class="scanline"></div> -->
<div class="wrapper">
  <div class="content clearfix">

    <header class="site clearfix">
      <div class="col one">
        <img src="{{asset('packages/larapress/src/Assets/admin/img/larapress.png')}}" alt="591 Systems" width="740" height="729" id="logo-v" />
      </div>
      <div class="col two">
        <h4>LaraPress (tm) <br /> <b>H</b>euristically <b>E</b>ncrypted <b>R</b>ealtime <b>O</b>perating <b>S</b>ystem (HEROS)</h4>
        <p>----------------------------------------</p>
        <p>Current LaraPress CMS v{{$CurrentLaraPressVersion ?? "Not Available"}}</p>
        <p>(c)2021 - {{date('Y')}} LaraPress CMS</p>
        <p>- Auth: Md Shahinur Islam -</p>
      </div>
    </header>

    <!-- <nav class="site clear">
      <ul>
        <li><a href="#" title="">Return Home</a></li>
        <li><a href="#" title="">Our Clients</a></li>
        <li><a href="#" title="">Contact Us</a></li>
      </ul>
    </nav> -->
@if($lara_status == true)
    <p class="text-dark">Welcome to LaraPress CMS (Content Management System)</p>
    <p class="text-dark">{{$lara_version}}</p>

@if($lara_version !== 'LaraPress is up-to-date.')
    <p class="clear"><br /></p>
    <p class="text-dark">Are you sure to update your system?</p><br />
    <form action="{{ route('update-larapress') }}" method="GET">     
        @csrf
        <button type="submit" class="btn btn-primary">Install Update</button>
        <a class="btn btn-primary" alt="" href="{{ url('/dashboard/about') }}">Cancel</a>
    </form>    
    <p class="clear"><br /></p>        
    <div id="update_status" class="scrollable-div">
        Waiting for update...        
    </div>
    <a href="{{url('/dashboard/about')}}" class="d-none" id="havefaun">LaraPress successfully updated!! click hare.</a>
        <script>
            $(document).ready(function() {
            pollStatus();           

            function pollStatus() {
                $.get('{{url('/update-status')}}', function(response) {
                   // console.log(response.status);
                    let statusHtml = '';
                    response.status.forEach(function(message) {
                        if (message) {
                            statusHtml += '<p>' + message + '</p>';
                        }
                    });
                    $('#update_status').html(statusHtml);
                    // $('#status').text(response.status);
                    // Continue polling every 2 seconds if the update isn't complete
                    if (!response.status.includes('LaraPress core has been successfully updated.') && !response.status.includes('Error updating LaraPress core.')) {
                        setTimeout(pollStatus, 2000);
                        scrollToBottom();                        
                    }

                    if (response.status.includes('LaraPress core has been successfully updated.') ) {
                        havfun();                       
                    }

                }).fail(function() {
                    $('#update_status').text('Error fetching update status.');
                    scrollToBottom();
                });
            }
        });

        function scrollToBottom() {
            var contentDiv = document.getElementById('update_status');
            contentDiv.scrollTop = contentDiv.scrollHeight;
        }

        function havfun(){
            var linkElement = document.getElementById('havefaun');
            //console.log(linkElement);
            // Remove the 'd-none' class
            linkElement.classList.remove('d-none');
            // Optionally, set the display to block
            linkElement.style.display = 'block';
        }
        </script>    
@endif
@endif

  </div>
</div>
@endsection
