<?php

/** Search Modal */
?>
<div class="modal modal--search hide">
    <form class="modal__container">
        <div class="modal__header">
            <h2>Поиск товара</h2>
        </div>
        <div class="modal__content">
            <div class="search-field">
                <div class="form-field">
                    <input type="search" name="search" id="search">
                </div>
                <input type="submit" class="btn" value="Поиск"></input>
            </div>
            <div id="data-container">

            </div>
        </div>

        <button type="button" class="modal__close">&times;</button>

        <input type="hidden" name="_wpnonce" value="<?= wp_create_nonce('softcdkey-get_products'); ?>">
    </form>
</div>
