<?php
namespace PH7\Api;

require_once dirname(__DIR__) . '/endpoints/User.php';

// Switch statement to determine which action to take
// match is a new feature in PHP 8.0
// enum is a new feature in PHP 8.1
enum UserAction: string {
    case CREATE = 'create';
    case RETRIEVE_ALL = 'retrieveAll';
    case RETRIEVE = 'retrieve';
    case UPDATE = 'update';
    case REMOVE = 'remove';
    public function getResponse(): string {
        // Null coalescing operator (??) is used to check if the user_id is set in the URL
        $userId = $_GET['user_id'] ?? 0;
        // $action = $_GET['action'] ?? null;  //  TODO: Remove if not needed

        // TODO: Remove this hardcoded user data
        $user = new User('Jean', 'jeandevilliers@me.com', '1234567890');
        $response = match ($this) {
            self::CREATE => $user->create(),
            self::RETRIEVE_ALL => $user->retrieveAll(),
            self::RETRIEVE => $user->retrieve($userId),
            self::UPDATE => $user->update(),
            self::REMOVE => $user->remove(),
        };

        return json_encode($response);
    }
}


$action = $_GET['action'] ?? null;
$userAction = match ($action) {
    'create' => UserAction::CREATE,  // send 201 Created status code
    'retrieveAll' => UserAction::RETRIEVE_ALL,  // send 200 OK status code
    'retrieve' => UserAction::RETRIEVE,  // send 200 OK status code
    'update' => UserAction::UPDATE,  // send 200 OK status code
    'remove' => UserAction::REMOVE,  // send 204 No Content status code
    default => UserAction::RETRIEVE_ALL  // send 200 OK status code
};
echo $userAction->getResponse();

