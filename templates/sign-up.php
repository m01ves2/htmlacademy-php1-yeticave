<?php
    $email = isset($user['email']) ? $user['email'] : '';
    $password = isset($user['password']) ? $user['password'] : '';
    $name = isset($user['name']) ? $user['name'] : '';
    $contacts = isset($user['contacts']) ? $user['contacts'] : '';
?>

<?= renderTemplate('./templates/nav.php', []); ?>

<?php
    $error_classname = isset($errors) && count($errors) > 0 ? 'form__error': '';
?>

<form class="form container " action="sign-up.php" method="post"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" required>

        <?php if(isset($errors['email'])):?>
            <span class="form__error"><?=$errors['email']?></span>
        <?php endif;?>
        <?php if(isset($errors['email_occupied'])):?>
            <span class="form__error"><?=$errors['email_occupied']?></span>
        <?php endif;?>

    </div>
    <div class="form__item">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль" required>

        <?php if(isset($errors['password'])):?>
            <span class="form__error"><?=$errors['password']?></span>
        <?php endif;?>
        <?php if(isset($errors['short_password'])):?>
            <span class="form__error"><?=$errors['short_password']?></span>
        <?php endif;?>

    </div>
    <div class="form__item">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="name" placeholder="Введите имя" required>

        <?php if(isset($errors['name'])):?>
            <span class="form__error"><?=$errors['name']?></span>
        <?php endif;?>
    </div>
    <div class="form__item">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="contacts" placeholder="Напишите как с вами связаться" required></textarea>

        <?php if(isset($errors['contacts'])):?>
            <span class="form__error"><?=$errors['contacts']?></span>
        <?php endif;?>
    </div>
    <div class="form__item form__item--file form__item--last">
        <label>Аватар</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="avatar" name="avatar" value="">
            <label for="avatar">
                <span>+ Добавить</span>
            </label>
        </div>
        <?php
            if(isset($errors['file-upload'])){
                echo('<span class="form__error">'.$errors['file-upload'].'</span>');
            }
        ?>
    </div>

    <!-- <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span> -->
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
