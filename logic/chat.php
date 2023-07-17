<?php
require  '../vendor/autoload.php';

$options = array(
    'cluster' => 'eu',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    'd53e5e5280a3ec950d5e',
    'cad76e9c88b8d76134f2',
    '1632207',
    $options
);

$data['message'] = $_POST['chatMessage'];
$data['id'] = $_POST['userID'];
$data['admin'] = false;
if(isset($_POST['admin'])){
    $data['admin'] = $_POST['admin'];
}
$pusher->trigger('chatApp', 'response', $data);