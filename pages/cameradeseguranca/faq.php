<?php
$cameraFaq = $cameraV2Content["faq"];
?>
<section class="security-v2__faq" aria-labelledby="security-v2-faq-title">
    <div class="security-v2__container">
        <div class="security-v2__faq-inner">
            <h2 id="security-v2-faq-title"><?= cameraV2Text('faq_header.title') ?></h2>
            <div class="security-v2__faq-list">
                <?php foreach ($cameraFaq as $faqIndex => $faqItem): ?>
                    <details name="security-v2-faq">
                        <summary><?= cameraV2Text("faq.$faqIndex.question") ?><span class="security-v2__faq-toggle" aria-hidden="true"></span></summary>
                        <div class="security-v2__faq-answer">
                            <?php if (!empty($faqItem['answer_html'])): ?>
                                <?= $faqItem['answer_html'] ?>
                            <?php else: ?>
                                <?php foreach ($faqItem['answers'] as $answerIndex => $paragraph): ?>
                                    <p><?= cameraV2Text("faq.$faqIndex.answers.$answerIndex") ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
            <div class="security-v2__faq-cta">
                <h3><?= cameraV2Text('faq_cta.title') ?></h3>
                <p><?= cameraV2Text('faq_cta.description') ?></p>
                <?php cameraCta(cameraV2Raw('faq_cta.button'), 'Olá! Quero solicitar meu Diagnóstico de Proteção AserNet.'); ?>
            </div>
        </div>
    </div>
</section>
