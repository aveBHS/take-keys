<?php
/**
 * @var array $vars
 */

?>

<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/an-old-hope.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
<script>
    hljs.highlightAll();
</script>

<?php foreach ($vars as $key => $value) { ?>
    <b><?=$key?></b>
    <pre><code class="language-php"><?=var_export($value, true)?></code></pre>
    </br>
<?php } ?>
