<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Demo</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://unpkg.com/htmx.org@2.0.1" integrity="sha384-QWGpdj554B4ETpJJC9z+ZHJcA/i59TyjxEPXiiUgN2WmTyV5OEZWCD6gQhgkdpB/" crossorigin="anonymous"></script>
    <script>
        function toggleChatbox(){
            // Näytetään chat ja piilotetaan nappi
            const chatbox = document.getElementById('chat');
            const toggleButton = document.getElementById('show');
            chatbox.classList.toggle('open'); // lisää, jos ei ole luokkaa, tai poistaa
            toggleButton.classList.add('hidden'); // Lisää aina
        }
        function closeChatbox(){
            // Näytetään nappi ja piilotetaan chat
            const chatbox = document.getElementById('chat');
            const toggleButton = document.getElementById('show');
            chatbox.classList.toggle('open'); // lisää, jos ei ole luokkaa, tai poistaa
            toggleButton.classList.remove('hidden'); // Lisää aina

        }
    </script>
</head>
</head>
<body>
    <!-- Tässä on verkkosivun muu sisältö -->
    <?php include("chatbox.php"); ?>
</body>
</html>
