<?php

use yii\db\Migration;

class m190607_091146_create_slides_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%slides}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'data_transition' => $this->string(),
            'data_slotamount' => $this->integer(),
            'data_masterspeed' => $this->integer(),
            'data_delay' => $this->string(),
            'img_src' => $this->string(),
            'img_alt' => $this->string(),
            'data_lazyload' => $this->string(),
            'data_fullwidthcentering' => $this->string(),
            'data_bgfit' => $this->string(),
            'data_bgposition' => $this->string(),
            'data_bgrepeat' => $this->string(),
            'status' => $this->tinyInteger()->notNull()->defaultValue('0'),
            'sortOrder' => $this->integer()->defaultValue('0'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('created_by', '{{%slides}}', 'created_by');
        $this->createIndex('updated_by', '{{%slides}}', 'updated_by');
        $this->addForeignKey('slides_ibfk_1', '{{%slides}}', 'created_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('slides_ibfk_2', '{{%slides}}', 'updated_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        
         $this->createTable('{{%slides_layers}}', [
            'id' => $this->primaryKey(),
            'slides_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'class' => $this->string(),
            'data_x' => $this->string(),
            'data_y' => $this->string(),
            'data_customin' => $this->string(),
            'data_customout' => $this->string(),
            'data_hoffset' => $this->smallInteger(),
            'data_voffset' => $this->smallInteger(),
            'data_speed' => $this->smallInteger(),
            'data_start' => $this->smallInteger(),
            'data_easing' => $this->string(),
            'data_splitin' => $this->string(),
            'data_splitout' => $this->string(),
            'data_elementdelay' => $this->string(),
            'data_endelementdelay' => $this->string(),
            'data_end' => $this->string(),
            'data_endspeed' => $this->smallInteger(),
            'data_endeasing' => $this->string(),
            'data_captionhidden' => $this->string(),
            'style' => $this->string(),
            'btn_flag' => $this->tinyInteger()->notNull()->defaultValue('0'),
            'btn_url' => $this->string(),
            'btn_icon' => $this->string(),
            'btn_name' => $this->string(),
            'btn_class' => $this->string(),
        ], $tableOptions);

        $this->createIndex('slides_id', '{{%slides_layers}}', 'slides_id');
    }

    public function down()
    {
        $this->dropTable('{{%slides_layers}}');
        $this->dropTable('{{%slides}}');
    }
}