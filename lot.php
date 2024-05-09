<?php
require_once './vendor/autoload.php'; //libraries loader
require_once './functions.php';
// require_once './mock-data.php';
require_once './auth.php';
require_once './data-api.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //TODO make bet
    if(!isAuthorized()){
        header('HTTP/1.0 403 Forbidden');
        exit();
    }

    $lotId = $_POST['id'];
    $winnerId = $_SESSION['user']['id'];
    $winnerEmail = $_SESSION['user']['email'];
    $winnerName = $_SESSION['user']['name'];

    //set winnerID for lot info, close lot
    closeLot($lotId, $winnerId);

    // //send email to winner!

    //1. Swift_Mailer
    // $transport = new Swift_SmtpTransport('smtp.gmail.com', 465);
    // $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465))
    //     ->setUsername('doingsdone@gmail.com')
    //     ->setPassword('rds7BgcL')
    //     ->setEncryption('SSL');

    // $message = new Swift_Message('Вы выиграли!');
    // $message->setTo(['eugeny.vlasov@gmail.com' => 'eugeny vlasov']);
    // $message->setBody('Вы выиграли! лот http://localhost/lot.php?id='.$lotId.' Просьба связаться с нами и забрать приз!');
    // $message->setFrom('mail@yeticave.ru', 'Yeticave');

    // $mailer = new Swift_Mailer($transport);
    // $mailer->send($message);

    //2. PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.mail.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'doingsdone@gmail.com';
        $mail->Password = 'rds7BgcL';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->Port = 587;

        // Recipients
        $mail->setFrom('doingsdone@gmail.com', 'Yeti');
        $mail->addAddress($winnerEmail, $winnerName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Поздравляем!';
        $mail->Body    = 'Вы выиграли! лот http://localhost/lot.php?id='.$lotId.' <br/> Просьба связаться с нами и забрать приз!';

        // Send the email
        $mail->send();

        $page_content = renderTemplate('./templates/winner.php', ['id' => $lotId]);

    } catch (Exception $e) {
        $page_content = renderTemplate('./templates/error.php', ['error' => $mail->ErrorInfo]);
    }
}
else {
    if (!isset($_GET['id'])) {
        http_response_code(404);
        $page_content = renderTemplate('./templates/error.php', ['error' => 'Ошибка 404. Страница не найдена']);
    } else {
        $id = $_GET['id'];
        $lot = getLotById($id);
        $bets = getBetsByLotId($id);

        if ($mysqli_error) {
            http_response_code(404);
            $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
        } else {
            $page_content = renderTemplate('./templates/lot.php', ['id' => $id, 'lot' => $lot, 'bets' => $bets, 'is_auth' => $is_auth]);

            //добавляем просмотренный лот в историю просмотров в cookie
            $h_ids = [];
            if (isset($_COOKIE['history'])) {
                $h_ids = json_decode($_COOKIE['history']);
            }

            if (!in_array($id, $h_ids)) {
                $h_ids[] = $id; //добавляем новый $id, если его ещё не было
            }
            //$_COOKIE['history'] = json_encode($h_ids);
            $name = 'history';
            $value = json_encode($h_ids);
            $expire = time() + 7 * 24 * 60 * 60;
            $path = '/';
            setcookie($name, $value, $expire, $path);
        }
    }
}

$title = 'Информация о лоте';
$categories = getCategories();
if ($mysqli_error) {
    $page_content = renderTemplate('./templates/error.php', ['error' => $mysqli_error]);
}

$layout_content = renderTemplate(
    './templates/layout.php',
    [
        'categories' => $categories,
        'title' => $title,
        'content' => $page_content,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]
);

print($layout_content);
