<?php

/** Template Name: About Us */

get_header();

?>
<div class="page-about-us">
    <section id="about">
        <div class="container">
            <div class="about-us">
                <h1 class="page-heading">О нас</h1>

                <section id="about-banner" class="about-banner">
                    <div class="container">
                        <div class="row position-relative">

                            <? get_template_part('template-parts/banner', 'about'); ?>

                        </div>
                    </div>
                </section>

                <div class="page-content">
                    <h2 class="h-2">Наша ценность</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error
                        praesentium ipsum facilis aspernatur possimus reiciendis odit
                        perspiciatis voluptatum iusto quae asperiores earum rem magni
                        repellendus ea quisquam nulla dicta dolor, veritatis, vero
                        quaerat optio! Omnis dolore iure aspernatur delectus quas?
                    </p>
                    <h2 class="h-2">Наши цели</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptate alias voluptatum pariatur consequuntur, nemo ullam
                        ab enim adipisci, at esse beatae, repellendus sit saepe
                        aliquam mollitia ratione consectetur odio a iste. Incidunt
                        velit perspiciatis quia iusto maiores alias aliquid deleniti?
                    </p>
                    <ul class="square-list">
                        <li>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Quisquam, quibusdam.
                        </li>
                        <li>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Quisquam, quibusdam.
                        </li>
                        <li>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Quisquam, quibusdam.
                        </li>
                    </ul>
                </div>
                <div class="about-us__partners">
                    <h2 class="h-2">Наши партнеры</h2>
                    <ul>
                        <li>
                            <img src="https://via.placeholder.com/120x80" alt="partner logo" />
                        </li>
                        <li>
                            <img src="https://via.placeholder.com/120x80" alt="partner logo" />
                        </li>
                        <li>
                            <img src="https://via.placeholder.com/120x80" alt="partner logo" />
                        </li>
                        <li>
                            <img src="https://via.placeholder.com/120x80" alt="partner logo" />
                        </li>
                        <li>
                            <img src="https://via.placeholder.com/120x80" alt="partner logo" />
                        </li>
                        <li>
                            <img src="https://via.placeholder.com/120x80" alt="partner logo" />
                        </li>
                        <li>
                            <img src="https://via.placeholder.com/120x80" alt="partner logo" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
<?php

get_footer();
