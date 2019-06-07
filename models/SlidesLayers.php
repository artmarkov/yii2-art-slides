<?php

namespace artsoft\slides\models;

use Yii;
use artsoft\helpers\Html;

/**
 * This is the model class for table "{{%slides_layers}}".
 *
 * @property int $id
 * @property int $slides_id
 * @property string $content
 * @property string $class
 * @property string $data_x
 * @property string $data_y
 * @property string $data_customin
 * @property string $data_customout
 * @property int $data_hoffset
 * @property int $data_voffset
 * @property int $data_speed
 * @property int $data_start
 * @property string $data_easing
 * @property string $data_splitin
 * @property string $data_splitout
 * @property string $data_elementdelay
 * @property string $data_endelementdelay
 * @property string $data_end
 * @property int $data_endspeed
 * @property string $data_endeasing
 * @property string $data_captionhidden
 * @property string $style
 * @property int $btn_flag
 * @property string $btn_url
 * @property string $btn_icon
 * @property string $btn_name
 * @property string $btn_class
 *
 * @property SectionSlides $slides
 */
class SlidesLayers extends \artsoft\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%slides_layers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slides_id', 'content'], 'required'],
            [['slides_id', 'data_hoffset', 'data_voffset', 'data_speed', 'data_start', 'data_endspeed', 'btn_flag'], 'integer'],
            [['content'], 'string'],
            [['class', 'data_x', 'data_y', 'data_easing', 'data_splitin', 'data_splitout', 'data_elementdelay', 'data_endelementdelay', 'data_end', 'data_endeasing', 'style', 'btn_url', 'btn_icon', 'btn_name', 'btn_class'], 'string', 'max' => 127],
            [['data_customin', 'data_customout'], 'string', 'max' => 512],
            [['data_captionhidden'], 'string', 'max' => 32],
            [['slides_id'], 'exist', 'skipOnError' => true, 'targetClass' => Slides::className(), 'targetAttribute' => ['slides_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art', 'ID'),
            'slides_id' => Yii::t('art/slides', 'Slides ID'),
            'content' => Yii::t('art', 'Content'),
            'class' => Yii::t('art/slides', 'Class'),
            'data_x' => Yii::t('art/slides', 'Data X'),
            'data_y' => Yii::t('art/slides', 'Data Y'),
            'data_customin' => Yii::t('art/slides', 'Data Customin'),            
            'data_customout' => Yii::t('art/slides', 'Data Customout'),
            'data_hoffset' => Yii::t('art/slides', 'Data Hoffset'),
            'data_voffset' => Yii::t('art/slides', 'Data Voffset'),
            'data_speed' => Yii::t('art/slides', 'Data Speed'),
            'data_start' => Yii::t('art/slides', 'Data Start'),
            'data_easing' => Yii::t('art/slides', 'Data Easing'),
            'data_splitin' => Yii::t('art/slides', 'Data Splitin'),
            'data_splitout' => Yii::t('art/slides', 'Data Splitout'),
            'data_elementdelay' => Yii::t('art/slides', 'Data Elementdelay'),
            'data_endelementdelay' => Yii::t('art/slides', 'Data Endelementdelay'),
            'data_end' => Yii::t('art/slides', 'Data End'),
            'data_endspeed' => Yii::t('art/slides', 'Data Endspeed'),
            'data_endeasing' => Yii::t('art/slides', 'Data Endeasing'),
            'data_captionhidden' => Yii::t('art/slides', 'Data Captionhidden'),
            'style' => Yii::t('art/slides', 'Style'),
            'btn_flag' => Yii::t('art/slides', 'Btn Flag'),
            'btn_url' => Yii::t('art/slides', 'Url'),
            'btn_icon' => Yii::t('art/slides', 'Btn Icon'),
            'btn_name' => Yii::t('art/slides', 'Btn Name'),
            'btn_class' => Yii::t('art/slides', 'Btn Class'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlides()
    {
        return $this->hasOne(Slides::className(), ['id' => 'slides_id']);
    }
    /**
     * @param $programm_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getSlidesLayersList($slides_id)
    {
        $data = self::find()            
            ->innerJoin('slides', 'slides.id = slides_layers.slides_id')
            ->andWhere(['in', 'slides_layers.slides_id' , $slides_id])
            ->orderBy('slides_layers.id')
            ->asArray()->all(); 

      return $data; 
    }

    /**
     * 
     * @param type $slides_id
     * @return array
     */
    public static function getSlidesLayersData($slides_id)
    {
        $items = self::getSlidesLayersList($slides_id);         
        $i=0;
        foreach ($items as $item) {
            
            if ($item['btn_flag'] == 1) {
                $layerHtml = '';
                $layerHtml .= Html::beginTag('a', ['href' => $item['btn_url'], 'class' => $item['btn_class']]);
                $layerHtml .= '<i class="' . $item['btn_icon'] . '"></i>' . Yii::t('art/slides', '' . $item['btn_name'] . '') . '</span>';
                $layerHtml .= Html::endTag('a');
            } else {
                $layerHtml = $item['content'];
            }
            $data[$i] = [
                'options' =>
                [
                    'class' => $item['class'],
                    'data' => [
                        'x' => $item['data_x'],
                        'y' => $item['data_y'],
                        'speed' => $item['data_speed'],
                        'start' => $item['data_start'],
                        'easing' => $item['data_easing'],
                    ],
                    'style' => $item['style'],
                ],
                'content' => $layerHtml,
            ];
            
            !empty($item['data_customin']) ? $data[$i]['options']['data']['customin'] = $item['data_customin'] : NULL;
            !empty($item['data_customout']) ? $data[$i]['options']['data']['customout'] = $item['data_customout'] : NULL;
            !empty($item['data_hoffset']) ? $data[$i]['options']['data']['hoffset'] = $item['data_hoffset'] : NULL;
            !empty($item['data_voffset']) ? $data[$i]['options']['data']['voffset'] = $item['data_voffset'] : NULL;
            !empty($item['data_splitin']) ? $data[$i]['options']['data']['splitin'] = $item['data_splitin'] : NULL;
            !empty($item['data_splitout']) ? $data[$i]['options']['data']['splitout'] = $item['data_splitout'] : NULL;
            !empty($item['data_elementdelay']) ? $data[$i]['options']['data']['elementdelay'] = $item['data_elementdelay'] : NULL;
            !empty($item['data_endelementdelay']) ? $data[$i]['options']['data']['endelementdelay'] = $item['data_endelementdelay'] : NULL;
            !empty($item['data_end']) ? $data[$i]['options']['data']['end'] = $item['data_end'] : NULL;
            !empty($item['data_endspeed']) ? $data[$i]['options']['data']['endspeed'] = $item['data_endspeed'] : NULL;
            !empty($item['data_endeasing']) ? $data[$i]['options']['data']['endeasing'] = $item['data_endeasing'] : NULL;
            !empty($item['data_captionhidden']) ? $data[$i]['options']['data']['captionhidden'] = $item['data_captionhidden'] : NULL;


            $i++;
        }
        return $data; 
    }
}
