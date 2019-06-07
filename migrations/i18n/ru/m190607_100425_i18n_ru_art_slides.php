<?php

use artsoft\db\TranslatedMessagesMigration;

class  m190607_100425_i18n_ru_art_slides extends TranslatedMessagesMigration
{

    public function getLanguage()
    {
        return 'ru';
    }

    public function getCategory()
    {
        return 'art/slides';
    }

    public function getTranslations()
    {
        return [
            'Data Transition' => '',
            'Data Slotamount' => '',
            'Data Masterspeed' => '',
            'Data Delay' => '',
            'Img Src' => '',
            'Img Alt' => '',
            'Data Lazyload' => '',
            'Data Fullwidthcentering' => '',
            'Data Bgfit' => '',
            'Data Bgposition' => '',
            'Data Bgrepeat' => '',
            'Slides ID' => '',
            'Class' => '',
            'Data X' => '',
            'Data Y' => '',
            'Data Customin' => '',
            'Data Customout' => '',
            'Data Hoffset' => '',
            'Data Voffset' => '',
            'Data Speed' => '',
            'Data Start' => '',
            'Data Easing' => '',
            'Data Splitin' => '',
            'Data Splitout' => '',
            'Data Elementdelay' => '',
            'Data Endelementdelay' => '',
            'Data End' => '',
            'Data Endspeed' => '',
            'Data Endeasing' => '',
            'Data Captionhidden' => '',
            'Style' => '',
            'Btn Flag' => '',
            'Url' => '',
            'Btn Icon' => '',
            'Btn Name' => '',
            'Btn Class' => '',
            'Slides' => 'Слайды',
            'Copy' => 'Копировать',
            'The item will be copied. Are you sure?' => 'Элемент будет скопирован. Вы уверены?',
            'Your item has been copied.' => 'Элемент был скопирован.',
            'Add Layers' => 'Добавить слой',
        ];        
    }
}