<?php
if (isset($_SESSION["username"])) { ?>
<a href="/blog/update/<?php echo($slug); ?>" />Update </a>
<br/>
<a href="/blog/" />View All posts </a>
<?php
}
?>
<main>
<?php echo($content); ?>
</main>
<aside>
<p>Authored by: <a href = "mail to: <?php echo($author); ?>"><?php echo($author); ?> </a> </p>
</aside>