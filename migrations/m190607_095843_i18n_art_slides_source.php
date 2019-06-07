<?php

use artsoft\db\SourceMessagesMigration;

class m190607_095843_i18n_art_slides_source extends SourceMessagesMigration
{

    public function getCategory()
    {
        return 'art/slides';
    }

    public function getMessages()
    {
        return [
            'Data Transition' => 1,
            'Data Slotamount' => 1,
            'Data Masterspeed' => 1,
            'Data Delay' => 1,
            'Img Src' => 1,
            'Img Alt' => 1,
            'Data Lazyload' => 1,
            'Data Fullwidthcentering' => 1,
            'Data Bgfit' => 1,
            'Data Bgposition' => 1,
            'Data Bgrepeat' => 1,
            'Slides ID' => 1,
            'Class' => 1,
            'Data X' => 1,
            'Data Y' => 1,
            'Data Customin' => 1,
            'Data Customout' => 1,
            'Data Hoffset' => 1,
            'Data Voffset' => 1,
            'Data Speed' => 1,
            'Data Start' => 1,
            'Data Easing' => 1,
            'Data Splitin' => 1,
            'Data Splitout' => 1,
            'Data Elementdelay' => 1,
            'Data Endelementdelay' => 1,
            'Data End' => 1,
            'Data Endspeed' => 1,
            'Data Endeasing' => 1,
            'Data Captionhidden' => 1,
            'Style' => 1,
            'Btn Flag' => 1,
            'Url' => 1,
            'Btn Icon' => 1,
            'Btn Name' => 1,
            'Btn Class' => 1,
            'Slides' => 1,
            'Copy' => 1,
            'The item will be copied. Are you sure?' => 1,
            'Your item has been copied.' => 1,
            'Add Layers' => 1,
        ];
    }
}