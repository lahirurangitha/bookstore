<?php
require_once 'core/init.php';

include_once 'auth.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
            ),
            'isbn' => array(
                'required' => true
            ),
            'count' => array(
                'required' => true
            )
        ));
        if ($validation->passed()) {
            $book = new Book();

            $book->create(array(
                'name' => ucwords(Input::get('name')),
                'isbn' => Input::get('isbn'),
                'count' => Input::get('count'),
                'created_by' => $user->id
            ));

            if (empty($error)) {
                Session::put('messages', 'Successfully uploaded.');
                Session::put('m_type', 'success');
            } else {
                Session::put('messages', 'Failed to upload.');
                Session::put('m_type', 'error');
            }

        } else {
            $str = "";
            foreach ($validate->errors() as $error) {
                $str .= ucfirst($error);
                $str .= '<br>';
            }
            Session::put('messages', $str);
            Session::put('m_type', 'error');
        }
    }
    Redirect::to('upload_books.php');
}


