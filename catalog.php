<?php
include("syntax.php");

$pageTitle = "Full Catalog";
$section = null;

if (isset($_GET["cat"])) {
    if ($_GET["cat"] == "books") {
        $pageTitle = "Books";
        $section = 'books';
    } elseif ($_GET["cat"] == "movies") {
        $pageTitle = "Movies";
        $section = 'movies';
    } elseif ($_GET["cat"] == "music") {
        $pageTitle = "Music";
        $section = 'music';
    }
}

include("inc/header.php"); ?>

<div class="section page">
    <h1><?= "$pageTitle" ?></h1>
</div>

<?php include("inc/footer.php"); ?>
