<?php

/** Template Name: Warranty */

get_header();

?>
<div class="page-warranty">
    <div class="container">
        <div class="row">
            <div class="warranty">
                <h1 class="page-heading">
                    Гарантии
                    <!-- <span class="page-heading__shadow">Гарантии</span> -->
                </h1>
                <div class="warranty__boxes">
                    <div class="warranty__boxes-header">
                        <h2>
                            За что нас выбирают
                        </h2>
                        <p>
                            Наши клиенты &mdash; наша гарантия
                        </p>
                        <span class="warranty__boxes-header_shadow">
                            За что нас выбирают
                        </span>
                    </div>
                    <div class="warranty__boxes-wrapper">
                        <div class="warranty__box">
                            <h3 class="warranty__box-heading">
                                Безопасные сделки
                            </h3>
                            <p class="warranty__box-content">
                                Ваши данные и контакты никогда не попадут к другим
                            </p>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/shield.png" alt="shield icon">
                        </div>
                        <div class="warranty__box">
                            <h3 class="warranty__box-heading">
                                Мгновенная доставка
                            </h3>
                            <p class="warranty__box-content">
                                Вы не будете ждать вашу покупку
                            </p>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/rocket.png" alt="support icon">
                        </div>
                        <div class="warranty__box">
                            <h3 class="warranty__box-heading">
                                Компетентная поддержка
                            </h3>
                            <p class="warranty__box-content">
                                Ответим на все ваши вопросы
                            </p>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/question.png" alt="question icon">
                        </div>
                        <div class="warranty__box">
                            <h3 class="warranty__box-heading">
                                Положительные отзывы
                            </h3>
                            <p class="warranty__box-content">
                                Нам доверяют множество покупателей
                            </p>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/smile.png" alt="question icon">
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <h2>
                        Безопасные сделки
                    </h2>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores reiciendis quo
                        magni iure velit necessitatibus ipsa a facilis quisquam? Nobis, adipisci maiores.
                        Consequuntur quod provident pariatur quam officiis optio, totam suscipit dolorem
                        distinctio? Laborum placeat a suscipit? Optio alias possimus minima est nobis iure
                        veritatis iusto obcaecati dolorem mollitia. Eum!
                    </p>
                    <h2>
                        Мгновенная доставка
                    </h2>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores reiciendis quo
                        magni iure velit necessitatibus ipsa a facilis quisquam? Nobis, adipisci maiores.
                        Consequuntur quod provident pariatur quam officiis optio, totam suscipit dolorem
                        distinctio? Laborum placeat a suscipit? Optio alias possimus minima est nobis iure
                        veritatis iusto obcaecati dolorem mollitia. Eum!
                    </p>
                    <h2>
                        Компетентная поддержка
                    </h2>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores reiciendis quo
                        magni iure velit necessitatibus ipsa a facilis quisquam? Nobis, adipisci maiores.
                        Consequuntur quod provident pariatur quam officiis optio, totam suscipit dolorem
                        distinctio? Laborum placeat a suscipit? Optio alias possimus minima est nobis iure
                        veritatis iusto obcaecati dolorem mollitia. Eum!
                    </p>
                    <h2>
                        Положительные отзывы
                    </h2>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores reiciendis quo
                        magni iure velit necessitatibus ipsa a facilis quisquam? Nobis, adipisci maiores.
                        Consequuntur quod provident pariatur quam officiis optio, totam suscipit dolorem
                        distinctio? Laborum placeat a suscipit? Optio alias possimus minima est nobis iure
                        veritatis iusto obcaecati dolorem mollitia. Eum!
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
<section id="about-banner" class="about-banner">
    <div class="container">
        <div class="row position-relative">
            
            <? get_template_part('template-parts/banner', 'about'); ?>

        </div>
    </div>
</section>
<div class="container">
    <a class="btn btn-shadow btn-warranty" href="#" title="Перейти на Отзывы">
        Убедитесь сами
    </a>
</div>
<?php

get_footer();
