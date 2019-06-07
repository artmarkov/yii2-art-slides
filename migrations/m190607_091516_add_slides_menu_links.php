<?php

use yii\db\Migration;

class m190607_091516_add_slides_menu_links extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link}}', ['id' => 'slides', 'menu_id' => 'admin-menu', 'link' => '/slides/default/index', 'created_by' => 1, 'order' => 1]);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'slides', 'label' => 'Slides', 'language' => 'en-US']);
    }

    public function down()
    {
        $this->delete('{{%menu_link}}', ['like', 'id', 'slides']);
    }
}