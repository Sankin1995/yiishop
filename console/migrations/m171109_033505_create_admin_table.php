<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171109_033505_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(50)->notNull()->unique()->comment('用户名'),
            'password_hash'=>$this->string(32)->notNull()->comment('密码'),
            'auth_key'=>$this->string(32)->notNull()->comment('登录令牌'),
            'email'=>$this->string()->notNull()->unique()->comment('邮箱'),
            'create_at'=>$this->integer()->notNull()->comment('创建时间'),
            'last_login_at'=>$this->integer()->comment('最后登录时间'),
            'last_login_ip'=>$this->string(15)->null()->comment('登录ip')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
