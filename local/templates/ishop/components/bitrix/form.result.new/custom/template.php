<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var array $arParams */
?>
<?php if ($arResult['isFormNote'] === 'Y'): ?>
    <div class="contact-form__note" style="color:#16a34a;font-weight:600;padding:12px 0;">
        Спасибо, сообщение отправлено. Мы свяжемся с вами.
    </div>
<?php else: ?>
    <?= $arResult['FORM_HEADER'] ?>

    <?php if ($arResult['isFormErrors'] === 'Y'): ?>
        <div class="contact-form__note" style="color:#dc2626;padding:12px 0;">
            <?= $arResult['FORM_ERRORS_TEXT'] ?>
        </div>
    <?php endif; ?>

    <?php foreach ($arResult['QUESTIONS'] as $FIELD_SID => $arQuestion): ?>
        <div class="contact-form__group">
            <label class="contact-form__label">
                <?= $arQuestion['CAPTION'] ?>
                <?= $arQuestion['REQUIRED'] === 'Y' ? ' *' : '' ?>
            </label>
            <?php
            $html = str_replace(
                ['class="inputtext"', 'class="inputtextarea"'],
                ['class="contact-form__input"', 'class="contact-form__textarea"'],
                $arQuestion['HTML_CODE']
            );
            echo $html;
            ?>
        </div>
    <?php endforeach; ?>

    <?php if ($arResult['isUseCaptcha'] === 'Y'): ?>
        <div class="contact-form__group">
            <label class="contact-form__label">Введите код с картинки *</label>
            <input type="hidden" name="captcha_sid" value="<?= $arResult['CAPTCHACode'] ?>">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHACode'] ?>" alt="CAPTCHA">
            <input type="text" name="captcha_word" class="contact-form__input" required>
        </div>
    <?php endif; ?>

    <button type="submit" class="btn btn--primary btn--full" name="web_form_submit" value="Y">
        Отправить сообщение
    </button>
    <p class="contact-form__note">Нажимая кнопку, вы соглашаетесь с обработкой персональных данных</p>

    <?= $arResult['FORM_FOOTER'] ?>
<?php endif; ?>