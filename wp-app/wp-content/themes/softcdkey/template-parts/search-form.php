<?php

/** Search Form */

$categories = get_terms( 'product_cat', [
    'orderby' => 'name',
    'order' => 'asc',
    'fields' => 'all',
    'exclude' => 15,
    'hide_empty' => false
]);

?>
<form action="" class="search-form">
    <div class="search__field ">
        <input class="search-autocomplete" type="text" name="search" id="search"
            placeholder="Введите название товара...">
    </div>
    <div class="search__category">
        <select name="category" id="category">
            <option value="" selected>None</option>
            <?
            if (!empty($categories)):
                foreach ($categories as $category):
                ?>
                <option value='<?= $category->slug; ?>'><?= $category->name; ?></option>;
                <?
                endforeach;
            endif;
            ?>
        </select>
    </div>
</form>