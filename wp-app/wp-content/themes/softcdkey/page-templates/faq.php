<?php

/** Template Name: FAQ */

get_header();
?>
<div class="page-faq">
    <div class="container">
        <div class="row">
            <h1 class="page-heading">
                Часто задаваемые вопросы
                <!-- <span class="page-heading__shadow">Часто задаваемые вопросы</span> -->
            </h1>
            <div class="page-content">
                <?php
                $topics = carbon_get_theme_option( 'topics' );
                
                if (!empty($topics)):
                ?>
                <h2 class="h-2">
                    Горячые темы
                </h2>
                <div class="hot-topics">
                    <?
                    foreach ($topics as $k => $topic):
                    ?>
                    <div class="hot-topic <? if ($k === 0): ?>is-active<? endif; ?>" data-id="<?= $k; ?>">
                        <div class="hot-topic__header">
                            <h4><?= $topic['name'] ?></h4>
                            <span><?= count($topic['entries']); ?> вопросов</span>
                        </div>
                        <div class="hot-topic__content">
                            <?= $topic['desc']; ?>
                        </div>
                    </div>
                    <?
                    endforeach;
                    ?>
                </div>
                <hr class="section-break">
                <div class="faq__questions">
                    <h2 class="h-2 faq__questions--header">
                        <?= $topics[0]['name']; ?>
                    </h2>
                    <div class="faq__questions--content">
                        <?
                        if (count($topics[0]['entries']) !== 0):
                            foreach ($topics[0]['entries'] as $entry):
                        ?>
                                <button class="faq__question">
                                    <i class="fas fa-angle-down"></i>
                                    <span>
                                        <?= $entry['question']; ?>
                                    </span>
                                </button>
                                <div class="faq__answer">
                                    <p>
                                        <?= $entry['answer']; ?>
                                    </p>
                                </div>
                        <?
                            endforeach;
                        else:
                        ?>
                        <p>
                            По этой теме ещё ни одного вопроса не зарегистрировано
                        </p>
                        <?
                        endif;
                        ?>
                    </div>
                </div>
                <?
                else:
                ?>
                <p class="text-center my-3">
                    Пока ни одного вопроса не зарегистрировано
                </p>
                <?
                endif;
                ?>
            </div>
            <div class="no-answers">
                <button class="btn btn-primary btn-shadow" title="Задать вопрос">
                    Не нашли ответов на свой вопрос?
                </button>
                <span>
                    Оставьте вопрос, наша команда обязательно ответит вам в ближайшее время
                </span>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();
