<?= renderTemplate('./templates/nav.php', []); ?>
<?php
$email = isset($user['email']) ? $user['email'] : '';

// $form_error = (isset($errors) && count($errors) == 0) ? '': 'form__error';

// $email_error = isset($errors['email']) ? $errors['email'] : '';
// $password_error = isset($errors['password']) ? $errors['password'] : '';

// print_r($email_error);
// print_r($password_error);
?>

<form class="form container" action="login.php" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <?php
        $error_classname = isset($errors['email']) ? 'form__item--invalid' : '';
    ?>
    <div class="form__item <?=$error_classname?>"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $email ?>" required>
        <?php
            if (isset($errors['email'])) {
                echo ('<span class="form__error">' . $errors['email'] . '</span>');
            }
        ?>
    </div>

    <?php
        $error_classname = isset($errors['password']) ? 'form__item--invalid' : '';
    ?>
    <div class="form__item form__item--last <?=$error_classname?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль" required>
        <?php
            if (isset($errors['password'])) {
                echo ('<span class="form__error">' . $errors['password'] . '</span>');
            }
        ?>
    </div>
    <button type="submit" class="button">Войти</button>
</form>
