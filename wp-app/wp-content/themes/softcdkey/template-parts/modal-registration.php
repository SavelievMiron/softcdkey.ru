<?php

/** Registration Modal */
?>
<div class="modal modal--registration hide">
    <form class="modal__container">
        <div class="modal__header">
            <h2>Регистрация</h2>
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
            <div class="form-field form-field__password">
                <input type="password" class="input-field" name="password_confirmation"
                    placeholder="Повторите пароль" required>
                <button type="button" class="show-pass" title="Показать пароль">
                </button>
                <p class="error-message"></p>
            </div>
            <div class="form-field privacy-policy">
                <label class="custom-checkbox" for="policy_consent">
                    <input type="checkbox" name="policy_consent" id="policy_consent" required>
                    <span class="checkmark"></span>
                    Я согласен с <a href="/#">политикой конфиденциальности</a>
                </label>
            </div>
        </div>
        <div class="form-message"></div>
        <div class="modal__footer">
            <button type="submit" class="btn btn-green" title="Зарегистрироваться">
                Зарегистрироваться
            </button>
        </div>
        <button type="button" class="modal__close">&times;</button>

        <input type="hidden" name="_wpnonce" value="<?= wp_create_nonce('wp_rest'); ?>">
    </form>
</div>
