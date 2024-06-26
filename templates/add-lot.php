<?= renderTemplate('./templates/nav.php', []);?>
<?php   $lotName  = isset( $lot['lot-name'] ) ? $lot['lot-name'] : '';
        // $category = isset( $lot['category'] ) ? $lot['category'] : '';
        $message  = isset( $lot['message' ] ) ? $lot['message' ] : '';
        $lotRate  = isset( $lot['lot-rate'] ) ? $lot['lot-rate'] : '';
        $lotStep  = isset( $lot['lot-step'] ) ? $lot['lot-step'] : '';
        $lotDate  = isset( $lot['lot-date'] ) ? $lot['lot-date'] : '';
        $error_classname = isset($errors) && count($errors) > 0 ? 'form__error': '';
?>
<form class="form form--add-lot container <?= $error_classname ?>" action="add-lot.php" method="post" enctype="multipart/form-data">
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <?php
            $error_classname = isset($errors['lot-name']) ? 'form__item--invalid' : '';
        ?>
        <div class="form__item <?= $error_classname ?>"> <!-- form__item--invalid -->
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text" name="lot-name" value="<?= $lotName ?>" placeholder="Введите наименование лота" required>
            <!-- <span class="form__error">Введите наименование лота</span> -->
            <?php
                if(isset($errors['lot-name'])){
                    echo('<span class="form__error">'.$errors['lot-name'].'</span>');
                }
            ?>
        </div>

        <?php
                $error_classname = isset($errors['category']) ? 'form__item--invalid' : '';
        ?>
        <div class="form__item <?= $error_classname ?>">
            <label for="category">Категория</label>
            <select id="category" name="category_id" required>
                <option value="-1">Выберите категорию</option>
                <?php foreach($categories as $key => $value): ?>
                    <option value="<?= $value['id'] ?>" ><?= $value['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <!-- <span class="form__error">Выберите категорию</span> -->
            <?php
                if(isset($errors['category'])){
                    echo('<span class="form__error">'.$errors['category'].'</span>');
                }
            ?>
        </div>
    </div>

    <?php
        $error_classname = isset($errors['message']) ? 'form__item--invalid' : '';
    ?>
    <div class="form__item form__item--wide <?= $error_classname ?>">
        <label for="message">Описание</label>
        <textarea id="message" name="message" placeholder="Напишите описание лота" required><?= $message ?></textarea>
        <!-- <span class="form__error">Напишите описание лота</span> -->
        <?php
            if(isset($errors['message'])){
                echo('<span class="form__error">'.$errors['message'].'</span>');
            }
        ?>
    </div>

    <?php
        $error_classname = isset($errors['file-upload']) ? 'form__item--invalid' : '';
    ?>
    <div class="form__item form__item--file <?= $error_classname ?>"> <!-- form__item--uploaded -->
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="lot-img" name="lot-img" value="">
            <label for="lot-img">
                <span>+ Добавить</span>
            </label>
        </div>
        <?php
            if(isset($errors['file-upload'])){
                echo('<span class="form__error">'.$errors['file-upload'].'</span>');
            }
        ?>
    </div>

    <div class="form__container-three">
        <?php
            $error_classname = isset($errors['lot-rate']) ? 'form__item--invalid' : '';
        ?>
        <div class="form__item form__item--small <?= $error_classname ?>">
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?= $lotRate ?>" required>
            <!-- <span class="form__error">Введите начальную цену</span> -->
            <?php
                if(isset($errors['lot-rate'])){
                    echo('<span class="form__error">'.$errors['lot-rate'].'</span>');
                }
            ?>
        </div>

        <?php
            $error_classname = isset($errors['lot-step']) ? 'form__item--invalid' : '';
        ?>
        <div class="form__item form__item--small <?= $error_classname ?>">
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?= $lotStep ?>" required>
            <!-- <span class="form__error">Введите шаг ставки</span> -->
            <?php
                if(isset($errors['lot-step'])){
                    echo('<span class="form__error">'.$errors['lot-step'].'</span>');
                }
            ?>
        </div>

        <?php
            $error_classname = isset($errors['lot-date']) ? 'form__item--invalid' : '';
        ?>
        <div class="form__item <?= $error_classname ?>">
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?= $lotDate ?>" required>
            <!-- <span class="form__error">Введите дату завершения торгов</span> -->
            <?php
                if(isset($errors['lot-date'])){
                    echo('<span class="form__error">'.$errors['lot-date'].'</span>');
                }
            ?>
        </div>
    </div>
    <!-- <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span> -->
    <button type="submit" class="button">Добавить лот</button>
</form>
