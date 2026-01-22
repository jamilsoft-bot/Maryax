<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

final class Auth
{
    public function __construct(private PDO $db)
    {
    }

    public function attempt(string $email, string $password): bool
    {
        $statement = $this->db->prepare('SELECT id, password, organization_id FROM users WHERE email = :email LIMIT 1');
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        Session::set('user_id', (int) $user['id']);
        Session::set('organization_id', $user['organization_id'] ? (int) $user['organization_id'] : null);
        Session::regenerate();

        return true;
    }

    public function userId(): ?int
    {
        $id = Session::get('user_id');

        return $id ? (int) $id : null;
    }

    public function logout(): void
    {
        Session::forget('user_id');
        Session::forget('organization_id');
        Session::regenerate();
    }
}
