<?php
function full_catalog_array()
{
    include("connection.php");

    try {
        $results = $db->query(
            "SELECT media_id, title, category, img 
            FROM Media
            ORDER BY 
            REPLACE(
                REPLACE(
                    REPLACE(title,'The ',''),
                    'An ',
                    ''
                    ),
                    'A ',
                    ''
                    )"
        );
    } catch (Exception $e) {
        echo "Unable to retrieve results";
        exit;
    }

    $catalog = $results->fetchAll();

    return $catalog;
}

function category_catalog_array($category)
{
    include("connection.php");
    $category = strtolower($category);
    try {
        $results = $db->prepare(
            "SELECT media_id, title, category,img 
         FROM Media
         WHERE LOWER(category) = ?
         ORDER BY 
         REPLACE(
           REPLACE(
              REPLACE(title,'The ',''),
              'An ',
              ''
           ),
           'A ',
           ''
         )"
        );
        $results->bindParam(1, $category, PDO::PARAM_STR);
        $results->execute();
    } catch (Exception $e) {
        echo "Unable to retrieved results";
        exit;
    }

    $catalog = $results->fetchAll();
    return $catalog;
}

function rand_catalog_array()
{
    include("connection.php");

    try {
        $results = $db->query(
            "SELECT media_id, title, category, img 
            FROM Media
            ORDER BY RAND()
            LIMIT 4"
        );
    } catch (Exception $e) {
        echo "Unable to retrieve results";
        exit;
    }

    $catalog = $results->fetchAll();

    return $catalog;
}

function single_item_array($id)
{
    include("connection.php");

    try {
        $results = $db->prepare(
            "SELECT Media.media_id, title, category, img, format, year, genre , publisher, isbn
            FROM Media
            JOIN Genres ON Media.genre_id = Genres.genre_id
            LEFT OUTER JOIN Books ON Media.media_id = Books.media_id
            WHERE MEDIA.media_id=?"
        );
        $results->bindParam(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Unable to retrieve results";
        // echo $e->getMessage();

        exit;
    }

    $item = $results->fetch();

    if (empty($item)) return $item; // early return
    try {
        $results = $db->prepare(
            "SELECT fullname, role
            FROM Media_People
            JOIN People ON Media_People.people_id = People.people_id
            WHERE Media_People.media_id=?"
        );
        $results->bindParam(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Unable to retrieve results";
        // echo $e->getMessage();

        exit;
    }
    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        $item[$row["role"]][] = $row["fullname"];
    }
    return $item;
}

function get_item_html($item)
{
    $output = "<li><a href='details.php?id="
        . $item["media_id"] . "'><img src='"
        . $item["img"] . "' alt='"
        . $item["title"] . "' />"
        . "<p>View Details</p>"
        . "</a></li>";
    return $output;
}

function array_category($catalog, $category)
{
    $output = array();

    foreach ($catalog as $id => $item) {
        if ($category == null or strtolower($category) == strtolower($item["category"])) {
            $sort = $item["title"];
            $sort = ltrim($sort, "The ");
            $sort = ltrim($sort, "A ");
            $sort = ltrim($sort, "An ");
            $output[$id] = $sort;
        }
    }

    asort($output);
    return array_keys($output);
}
