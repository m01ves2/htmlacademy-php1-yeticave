<?= renderTemplate('./templates/nav.php', []);?>
<section class="lot-item container">
    <h2><?= $lot['name']; ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?= $lot['img']; ?>" width="730" height="548" alt="<?= $lot['name']; ?>">
            </div>
            <p class="lot-item__category">Категория:
                <span><?= $lot['category']; ?></span>
            </p>
            <p class="lot-item__description"><?= $lot['description']; ?></p>
        </div>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <?php $time_remaining = getLotTimeLeft($lot['enddate']); ?>
                <div class="lot-item__timer timer
                        <?php if ($time_remaining[0] < 1) {
                            echo 'timer--finishing';
                        } ?>">
                    <?= sprintf("%02d", $time_remaining[0]) . ':' . sprintf("%02d", $time_remaining[1]); ?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?= formatPrice($lot['price']);?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= formatPrice($lot['price'] + $lot['step']) ?></span>
                    </div>
                </div>

                <?php if($is_auth): ?>
                    <form class="lot-item__form" action="lot.php" method="post" autocomplete="off">
                        <?php
                            $class_invalid = isset($error['bet_price']) ? 'form__item--invalid' : '';
                        ?>
                        <p class="lot-item__form-item form__item <?=$class_invalid?>">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="text" name="cost" placeholder="<?= $lot['price'] + $lot['step'] ?>">
                            <?php if(isset($error['bet_price'])):?>
                                <span class="form__error">Введите наименование лота</span>
                            <?php endif;?>
                        </p>
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
                <?php else:?>
                    <span class="user-menu__item"><a href="login.php">Войдите в личный кабинет, чтобы участвовать в аукционе</a></span>
                <?php endif;?>
            </div>
            <div class="history">
                <h3>История ставок (<span><?=count($bets)?></span>)</h3>
                <table class="history__list">
                    <?php foreach($bets as $bet): ?>
                        <tr class="history__item">
                            <td class="history__name"><?= $bet['name'] ?></td>
                            <td class="history__price"><?=formatPrice($bet['price'])?></td>
                            <td class="history__time"><?= $bet['date'] ?></td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</section>
