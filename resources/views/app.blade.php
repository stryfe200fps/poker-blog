<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <meta property="og:description" content="{{ $page['props']['description'] ?? 'Description' }}" >
         <link rel="icon" sizes="16x16" href="/favicon.ico" />

        <title inertia>{{ $page['props']['title'] ?? 'Life Of Poker'  }}</title>

        <meta name="description" content="{{ $page['props']['description'] ?? 'Life Of Poker'  }}" >

        <meta property="og:locale" content="en_PH">
        <meta property="og:title" content="{{ $page['props']['title'] ?? 'Life Of Poker' }}" >
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image" content="{{ $page['props']['image'] ?? 'Image' }}" >
        <meta property="og:site_name" content="Life of poker">
        <meta property="og:description" content="{{ $page['props']['description'] ?? 'Life Of Poker'  }}" />
        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@lifeofpoker" />
        <meta name="twitter:title"  content="{{ $page['props']['title'] ?? 'Life Of Poker'  }}">
        <meta name="twitter:image" content="{{ $page['props']['image'] ?? 'Life Of Poker'  }}" />

        <meta name="twitter:description" content="{{ $page['props']['description'] ?? 'Life Of Poker'  }}" />


        @routes
        @vite('resources/js/app.js')


        @inertiaHead
      
        <!-- Google tag (gtag.js) -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-L913NS2HT0"></script>

<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-L913NS2HT0'); </script>
<script defer src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script defer src="https://www.instagram.com/embed.js"></script>
    </head>
    <body class="font-sans antialiased">

    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0&appId=671463846988197&autoLogAppEvents=1" nonce="5ZNysrfX"></script>

    @inertia
       
    </body>

</html>