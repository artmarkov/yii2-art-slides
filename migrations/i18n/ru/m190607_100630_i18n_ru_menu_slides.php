<?php

use yii\db\Migration;

class m190607_100630_i18n_ru_menu_slides extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'slides', 'label' => 'Суперслайдер', 'language' => 'ru']);
    }

}