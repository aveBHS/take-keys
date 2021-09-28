<?php
/**
 * @var array $url
 */

$parts = [];
foreach($url as $breadcrumb){
    if(is_array($breadcrumb)){
        array_push($parts, "<a href='{$breadcrumb[1]}'>{$breadcrumb[0]}</a>");
    } else {
        array_push($parts, strval($breadcrumb));
    }
}
?>
<div class="container">
    <div class="breadcrumbs h-48">
        <?=join(" / ", $parts);?>
    </div>
</div>