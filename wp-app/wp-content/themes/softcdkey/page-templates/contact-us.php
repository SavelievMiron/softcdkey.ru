<?php

/** Template Name: Contact Us */

get_header();

$social_icons = [
    'vkontakte' => 'fab fa-vk',
    'facebook'  => 'fab fa-facebook-f',
    'instagram' => 'fab fa-instagram',
    'twitter'   => 'fab fa-twitter',
    'skype'     => 'fab fa-skype',
    'telegram'  => 'fab fa-telegram-plane',
	'email'     => 'fa-solid fa-envelope',
	'phone'     => 'fa-solid fa-circle-phone'
];

$contacts = cmb2_get_option( 'softcdkey_settings', 'softcdkey_contacts' );
?>

<div class="page-contact-us">
    <div class="container">
        <h1 class="page-heading">
            Контакты
            <!-- <span class="page-heading__shadow">Контакты</span> -->
        </h1>
        <div class="page-content">
            <div class="contact-us__form">
                <h2>Обратная связь</h2>
                <?= do_shortcode( '[contact-form-7 id="24" title="Contact Us"]' ); ?>
            </div>
            <div class="contact-us__links">
                <h2>Контакты</h2>
				<?php
                if ( ! empty( $contacts ) ) :
                    foreach ( $contacts as $item ) :
                ?>
                        <a href="<?= $item['link']; ?>" class="contact-link">
                            <div class="contact-link__icon">
                                <i class="<?= $social_icons[ $item['icon'] ]; ?>"></i>
                            </div>
                            <div class="contact-link__content">
                                <span class="contact-link__title"><?= $item['name']; ?></span>

                                <span class="contact-link__link" title="<?= $item['name']; ?>">
                                    <?= preg_replace("(^https?://)", "", $item['link'] ); ?>
                                </span>
                            </div>
                            <i class="fas fa-link"></i>
                        </a>
					<?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
