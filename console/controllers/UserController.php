<?php

namespace console\controllers;

use common\helpers\RoleHelper;
use common\helpers\UserHelper;
use common\models\User;
use Exception;
use Throwable;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Manage users
 * @package console\controllers
 */
final class UserController extends Controller
{
    /**
     * Create admin. string $login, string $email, string $passwor
     * @param string $login
     * @param string $email
     * @param string $password
     * @throws Exception
     */
    public function actionCreateAdmin(string $login, string $email, string $passwor)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $admin = $this->creatUser($login, $email, $passwor);
            $this->assignRole($admin, RoleHelper::ROLE_ADMIN);
            $transaction->commit();
            $this->stdout(
                $this->ansiFormat('Success!' . PHP_EOL, Console::FG_GREEN)
            );
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (Throwable $e) {
            $transaction->rollBack();
        }
    }

    /**
     * Create librarian. string $login, string $email, string $passwor
     * @param string $login
     * @param string $email
     * @param string $password
     * @throws Exception
     */
    public function actionCreateLibrarian(string $login, string $email, string $passwor)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $librarian = $this->creatUser($login, $email, $passwor);
            $this->assignRole($librarian, RoleHelper::ROLE_LIBRARIAN);
            $transaction->commit();
            $this->stdout(
                $this->ansiFormat('Success!' . PHP_EOL, Console::FG_GREEN)
            );
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (Throwable $e) {
            $transaction->rollBack();
        }
    }

    /**
     * @param string $login
     * @param string $email
     * @param string $password
     * @return User
     */
    private function creatUser(string $login, string $email, string $password): User
    {
        $user = new User();
        $user->username = $login;
        $user->auth_key = UserHelper::generateAuthKey();
        $user->password_hash = UserHelper::generatePasswordHash($password);
        $user->email = $email;
        $user->status = User::STATUS_ACTIVE;
        $user->verification_token = UserHelper::generateEmailVerificationToken();
        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @param string $role
     */
    private function assignRole(User $user, string $role)
    {
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole($role), $user->getId());
    }
}
