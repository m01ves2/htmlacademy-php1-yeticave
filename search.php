<?php
    require_once './functions.php';
    // require_once './mock-data.php';
    require_once './auth.php';
    require_once './data-api.php';

    $keywords = $_GET['search'] ?? '';

    // $lots = getLotsByKeyWords($keywords);
    $categories = getCategories();

    $currentPage = $_GET['page'] ?? 1;
    $pageItems = 3;
    $itemsCount = getLotsByKeyWordsCount($keywords);

    $pagesCount = ceil($itemsCount / $pageItems);
    $offset = ($currentPage - 1) * $pageItems;
    $pages = range(1, $pagesCount); //page numbers 1,2,.., pagesCount

    $lots = getLotsByKeyWordsLimited($keywords, $pageItems, $offset);

    if($mysqli_error){
        $page_content = renderTemplate('./templates/error.php', [ 'error' => $mysqli_error] );
    }
    else{
        $page_content = renderTemplate('./templates/search.php', ['lots' => $lots, 'search' => $keywords, 'pages' => $pages, 'current_page' => $currentPage]);
    }

    $title = 'Поиск по лотам';

    $layout_content = renderTemplate('./templates/layout.php',
        [
            'categories' => $categories,
            'title' => $title,
            'content' => $page_content,
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'user_avatar' => $user_avatar
        ]);
    print($layout_content);
?>
