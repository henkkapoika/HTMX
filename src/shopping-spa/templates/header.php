<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Jacket Store" ?></title>
    <script src="https://unpkg.com/htmx.org@2.0.1" integrity="sha384-QWGpdj554B4ETpJJC9z+ZHJcA/i59TyjxEPXiiUgN2WmTyV5OEZWCD6gQhgkdpB/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/shopping-spa/public/main.css">
</head>
<body hx-boost="true">
    <header id="main-header">
        <div id="main-title">
            <a href="/shopping-spa/public">
                <img src="/shopping-spa/public/logo.png" alt="Jacket logo">
                <h1>Jacket Store</h1>
            </a>
        </div>
    </header>
    