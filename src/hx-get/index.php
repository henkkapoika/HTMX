<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/htmx.org@2.0.1"></script>
</head>
<body>
    <header>
        <img src="logo.png" alt="">
        <h1>Developing solutions</h1>
    </header>
    <main>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates culpa mollitia reprehenderit asperiores consequuntur quaerat aut iure deserunt. Consequuntur veniam ullam repellendus
             laboriosam magni suscipit ratione quod saepe dolore perspiciatis.
        </p>
        <button hx-get="db.php" hx-trigger="click once" hx-target="main" hx-swap="beforeend">Info</button>
    </main>
</body>
</html>