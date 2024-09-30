<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use Exception;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nama;
    public $alamat;
    public $no_hp;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Username telah digunakan.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'E-mail telah digunakan.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 8],

            ['nama', 'trim'],
            ['nama', 'required'],
            ['nama', 'string', 'max' => 50],

            ['alamat', 'trim'],
            ['alamat', 'required'],
            ['alamat', 'string', 'max' => 255],

            ['no_hp', 'trim'],
            ['no_hp', 'required'],
            ['no_hp', 'string', 'max' => 20],

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->nama = $this->nama;
            $user->alamat = $this->alamat;
            $user->no_hp = $this->no_hp;
            $user->save();
            $this->sendEmail($user);

            $transaction->commit();
        } catch (Exception $e) {
            Yii::error($e->getMessage());

            Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat melakukan pendaftaran.');

            $transaction->rollBack();

            return false;
        }

        return true;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Pendaftaran akun di ' . Yii::$app->name)
            ->send();
    }
}
