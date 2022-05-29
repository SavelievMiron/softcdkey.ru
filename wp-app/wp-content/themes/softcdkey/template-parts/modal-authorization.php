<?php

/** Authorization modal */

?>
<div class="modal modal--authorization hide">
    <form class="modal__container">
        <div class="modal__header">
            <h2>Авторизация</h2>
        </div>
        <div class="modal__content">
            <div class="form-field">
                <input type="email" class="input-field" name="email" placeholder="Эл.почта" required>
                <p class="error-message"></p>
            </div>
            <div class="form-field form-field__password">
                <input type="password" class="input-field" name="password" placeholder="Пароль" required>
                <button type="button" class="show-pass" title="Показать пароль">
                </button>
                <p class="error-message"></p>
            </div>
            <p class="form-message form-message--success">
            </p>
            <div class="form-field-group">
                <label class="custom-checkbox" for="remember">
                    <input type="checkbox" name="remember" value="true" id="remember">
                    <span class="checkmark"></span>
                    Запомнить меня
                </label>
                <a href="<?= wp_lostpassword_url(); ?>" class="link-grey">
                    Забыли пароль?
                </a>
            </div>
        </div>
        <div class="modal__footer">
            <button type="submit" class="btn btn-purple" title="Войти">
                Войти
            </button>
            <button type="button" class="user-sign-up btn btn-outline" title="Регистрация">
                Регистрация
            </button>
        </div>
        <button type="button" class="modal__close">&times;</button>
        
        <? wp_nonce_field( 'wp_rest', '_wpnonce', false ); ?>
    </form>
</div>
