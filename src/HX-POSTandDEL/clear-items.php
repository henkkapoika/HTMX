<?php
session_start();

// Tällä tiedostolla voisi tyhjentää koko listan
session_destroy();

// päivitetään HTML käyttäjlle
exit();
?>