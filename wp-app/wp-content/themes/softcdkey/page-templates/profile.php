<?php

/** Template Name: Profile */

get_header();
?>
<div class="page-profile">
    <div class="container">
        <div class="row">
            <div id="profile" class="profile page-content">
                <div class="profile-sidebar">
                    <div class="profile-sidebar__info">
                        <div class="profile-sidebar__info--left">
                            <img class="profile__user-photo" src="<?= get_template_directory_uri(); ?>/assets/img/user.jpg" alt="profile picture" />
                        </div>
                        <div class="profile-sidebar__info--right">
                            <span>example@example.com</span>
                        </div>
                    </div>
                    <div class="profile-sidebar__tabs">
                        <button class="profile-sidebar__tab is-active" data-tab="notifications" title="Уведомления">
                            <span class="profile-sidebar__tab--icon">
                                <i class="fas fa-bell"></i>
                                <!-- <i class="far fa-envelope"></i> -->
                            </span>
                            Уведомления
                            <span class="profile-sidebar__tab--number">3</span>
                        </button>
                        <button class="profile-sidebar__tab" data-tab="orders" title="Заказы">
                            <span class="profile-sidebar__tab--icon">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            Заказы
                        </button>
                        <button class="profile-sidebar__tab" data-tab="tickets" title="Заказы">
                            <span class="profile-sidebar__tab--icon">
                                <i class="fas fa-headset"></i>
                            </span>
                            Тикеты
                            <span class="profile-sidebar__tab--number">3</span>
                        </button>
                        <button class="profile-sidebar__tab" data-tab="favourites" title="Избранное">
                            <span class="profile-sidebar__tab--icon">
                                <i class="fas fa-heart"></i>
                            </span>
                            Избранное
                            <span class="profile-sidebar__tab--number">2</span>
                        </button>
                        <button class="profile-sidebar__tab" data-tab="settings" title="Настройки">
                            <span class="profile-sidebar__tab--icon">
                                <i class="fas fa-cog"></i>
                            </span>
                            Настройки
                        </button>
                        <a href="<?= wp_logout_url('/'); ?>" class="logout btn btn-primary" title="Выйти">
                            Выйти
                        </a>
                    </div>
                </div>
                <div class="profile-panel">
                    <div class="profile-panel__header">
                        <div class="profile-panel__tabs is-active" data-panel="notifications">
                            <button class="profile-panel__tab is-active" data-panel_tab="sent" title="Входящие">
                                Уведомления
                            </button>
                        </div>
                        <div class="profile-panel__tabs" data-panel="orders">
                            <button class="profile-panel__tab is-active" data-panel_tab="orders_history" title="История покупок">
                                История покупок
                            </button>
                            <button class="profile-panel__tab" data-panel_tab="testimonials_history" title="История отзывов">
                                История отзывов
                            </button>
                        </div>
                        <div class="profile-panel__tabs" data-panel="favourites">
                            <button class="profile-panel__tab is-active" data-panel_tab="favourites" title="Тикеты">
                                Тикеты
                            </button>
                        </div>
                        <div class="profile-panel__tabs" data-panel="tickets">
                            <button class="profile-panel__tab is-active" data-panel_tab="tickets" title="Тикеты">
                                Тикеты
                            </button>
                        </div>
                        <div class="profile-panel__tabs" data-panel="chat">
                            <button class="profile-panel__tab is-active" data-panel_tab="chat" title="Тикеты">
                                Чат
                            </button>
                        </div>
                        <div class="profile-panel__tabs" data-panel="settings">
                            <button class="profile-panel__tab is-active" data-panel_tab="personal_data" title="Личные данные">
                                Личные данные
                            </button>
                            <button class="profile-panel__tab" data-panel_tab="change_password" title="Изменить пароль">
                                Изменить пароль
                            </button>
                        </div>
                    </div>
                    <div class="profile-panel__container">
                        <div class="profile-panel__content is-active" data-tab-content="notifications">
                            <div class="profile-panel__tab-content is-active" data-panel-content="sent">
                                Notifications
                            </div>
                        </div>
                        <div class="profile-panel__content" data-tab-content="orders">
                            <div class="profile-panel__tab-content is-active" data-panel-content="orders_history">
                                <table class="orders">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>К-во товара</th>
                                            <th>Сумма</th>
                                            <th>Дата</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="order">
                                            <td class="order__number">1</td>
                                            <td class="order__amount">9 шт.</td>
                                            <td class="order__total">2445 руб.</td>
                                            <td class="order__date">10.10.2015</td>
                                            <td class="order__details">
                                                <button title="Детали">Детали</button>
                                            </td>
                                        </tr>
                                        <tr class="order">
                                            <td class="order__number">2</td>
                                            <td class="order__amount">9 шт.</td>
                                            <td class="order__total">2445 руб.</td>
                                            <td class="order__date">10.10.2015</td>
                                            <td class="order__details">
                                                <button title="Детали">Детали</button>
                                            </td>
                                        </tr>
                                        <tr class="order">
                                            <td class="order__number">3</td>
                                            <td class="order__amount">9 шт.</td>
                                            <td class="order__total">2445 руб.</td>
                                            <td class="order__date">10.10.2015</td>
                                            <td class="order__details">
                                                <button title="Детали">Детали</button>
                                            </td>
                                        </tr>
                                        <tr class="order">
                                            <td class="order__number">4</td>
                                            <td class="order__amount">9 шт.</td>
                                            <td class="order__total">2445 руб.</td>
                                            <td class="order__date">10.10.2015</td>
                                            <td class="order__details">
                                                <button title="Детали">Детали</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="profile-panel__tab-content" data-panel-content="testimonials_history">
                                Testimonials History
                            </div>
                        </div>
                        <div class="profile-panel__content" data-tab-content="tickets">
                            <div class="profile-panel__tab-content is-active" data-panel-content="tickets_list">
                                Tickets List
                            </div>
                        </div>
                        <div class="profile-panel__content settings" data-tab-content="settings">
                            <div class="profile-panel__tab-content is-active" data-panel-content="personal_data">
                                <form action="">
                                    <div class="form-field">
                                        <label for="avatar"> Аватар </label>
                                        <input type="file" accept="image/jpg, image/jpeg, image/png" name="avatar" />
                                    </div>
                                    <div class="form-field">
                                        <label for="username"> Никнейм </label>
                                        <input type="text" class="input-field" name="username" placeholder="Ваш Username" value="Thomas Jefferson" disabled />
                                    </div>
                                    <div class="form-field">
                                        <label for="email"> Email </label>
                                        <input type="email" class="input-field" name="email" placeholder="Ваш Email" value="example@example.com" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>
                                </form>
                            </div>
                            <div class="profile-panel__tab-content" data-panel-content="change_password">
                                <form action="">
                                    <div class="form-field">
                                        <label for="password"> Password </label>
                                        <input type="password" class="input-field" name="password" placeholder="Новый пароль" />
                                    </div>
                                    <div class="form-field">
                                        <label for="password"> Confirm Password </label>
                                        <input type="password" class="input-field" name="password_confirmation" placeholder="Повторите пароль" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Изменить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();
