<!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

     <title inertia>{{ config('app.name', 'Gatinha Arteira') }}</title>
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

     @vite(['resources/js/app.js', 'resources/css/app.css'])
     @routes
     @inertiaHead

   </head>

   <body>
     @inertia
   </body>

 </html>
