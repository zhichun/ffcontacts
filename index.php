<?php
    require_once __DIR__ . '/init.php';


    F3::set('CACHE', FALSE);
    F3::set('DEBUG', 1);


    F3::route('GET /', function() {
        global $twig;
        echo $twig->render('base.html');
    });


    F3::route('POST /search', function() {
        global $twig;
        $success = true;
        $msg = '';
        $users = [];
        $first = filter_var($_POST['first'], FILTER_SANITIZE_STRING);
        $last = filter_var($_POST['last'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        $query = 'SELECT * FROM users WHERE';
        $query .= ' LOWER(firstname) LIKE LOWER("%'.$first.'%")';
        $query .= ' OR LOWER(lastname) LIKE lower("%'.$last.'%")';


        if (isset($phone) && $phone !== '' && isset($query)) {
            if (preg_match('/^\+?\d+$/', $phone)) {
                $query .=  ' AND phone="'.$phone.'"';
            } else {
                $success = false;
                $msg = 'Please enter a correct phone number';
            }
        }

        DB::sql($query);
        $users = F3::get('DB->result');

        echo json_encode(array(
            'success' => $success,
            'message' => $msg,
            'users' => $users
        ));
    });


    F3::route('GET /u/@uid', function() {
        global $twig;
        $uid = F3::get('PARAMS["uid"]');
        if (is_numeric($uid)) {
            DB::sql("SELECT * FROM users where id=".$uid);
            $user = F3::get('DB->result');
            if ($user)
                $user = $user[0];
            else
                $user = null;

            echo $twig->render("user.html", array('user' => $user));
        } else {
            header('Location: /yellow/');
        }
    });


    F3::run();