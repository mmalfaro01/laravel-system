<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found - Tropical Burger</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/faviccon.png') }}">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container text-center">
        <h1 style="font-size: 5em; color: #8bc34a;">404</h1>
        <p>Oups! Page not found.</p>
        <p>You're not lost. You're simply seeing this 404 because the page you requested could not be found. We're working on it.</p>
        <nav>
            <a href="{{ url('/catalog') }}">Catalog</a> |
            <a href="{{ url('/shop') }}">Our Shop</a> |
            <a href="{{ url('/wholesale') }}">Wholesale</a> |
            <a href="{{ url('/contacts') }}">Contacts</a>
        </nav>
    </div>
</body>
</html>
