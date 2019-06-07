<?php

namespace artsoft\slides\models;

use Yii;
use artsoft\models\OwnerAccess;
use artsoft\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use artsoft\db\ActiveRecord;
use himiklab\sortablegrid\SortableGridBehavior;

/**
 * This is the model class for table "{{%slides}}".
 *
 * @property int $id
 * @property string $name
 * @property string $data_transition
 * @property int $data_slotamount
 * @property int $data_masterspeed
 * @property string $data_delay
 * @property string $img_src
 * @property string $img_alt
 * @property string $data_lazyload
 * @property string $data_fullwidthcentering
 * @property string $data_bgfit
 * @property string $data_bgposition
 * @property string $data_bgrepeat  * 
 * @property int $status
 * @property int $sortOrder
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property SectionSlidesLayers[] $sectionSlidesLayers
 */
class Slides extends ActiveRecord implements OwnerAccess
{
    public $sort_list;
    
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%slides}}';
    }

     /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),  
            'grid-sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sortOrder',
            ], 
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_transition', 'data_slotamount', 'data_masterspeed', 'name'], 'required'],
            [['status', 'sortOrder'], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['data_slotamount', 'data_masterspeed'], 'integer'],
            [['data_transition', 'data_bgfit', 'data_bgposition', 'data_bgrepeat'], 'string', 'max' => 32],
            [['img_src', 'img_alt', 'data_lazyload', 'data_fullwidthcentering', 'data_delay'], 'string', 'max' => 127],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art', 'ID'),
            'name' => Yii::t('art', 'Name'),
            'data_transition' => Yii::t('art/slides', 'Data Transition'),
            'data_slotamount' => Yii::t('art/slides', 'Data Slotamount'),
            'data_masterspeed' => Yii::t('art/slides', 'Data Masterspeed'),
            'data_delay' => Yii::t('art/slides', 'Data Delay'),            
            'img_src' => Yii::t('art/slides', 'Img Src'),
            'img-alt' => Yii::t('art/slides', 'Img Alt'),
            'data_lazyload' => Yii::t('art/slides', 'Data Lazyload'),
            'data_fullwidthcentering' => Yii::t('art/slides', 'Data Fullwidthcentering'),
            'data_bgfit' => Yii::t('art/slides', 'Data Bgfit'),
            'data_bgposition' => Yii::t('art/slides', 'Data Bgposition'),
            'data_bgrepeat' => Yii::t('art/slides', 'Data Bgrepeat'),           
            'status' => Yii::t('art', 'Status'),
            'sortOrder' => Yii::t('art', 'Sort'),
            'created_at' => Yii::t('art', 'Created'),
            'updated_at' => Yii::t('art', 'Updated'),
            'created_by' => Yii::t('art', 'Created By'),
            'updated_by' => Yii::t('art', 'Updated By'),
        ];
    }

    
     public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedDatetime()
    {
        return "{$this->createdDate} {$this->createdTime}";
    }

    public function getUpdatedDatetime()
    {
        return "{$this->updatedDate} {$this->updatedTime}";
    }
    
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
     /**
     * getStatusList
     * @return array
     */
    public static function getStatusList()
    {
        return array(
            self::STATUS_ACTIVE => Yii::t('art', 'Active'),
            self::STATUS_INACTIVE => Yii::t('art', 'Inactive'),
        );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlidesLayers()
    {
        return $this->hasMany(SlidesLayers::className(), ['slides_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \artsoft\slides\models\query\SlidesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \artsoft\slides\models\query\SlidesQuery(get_called_class());
    }
    
    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getSlidesList()
    {
        $data = self::find()
                ->andWhere(['in', 'status', self::STATUS_ACTIVE])
                ->orderBy(['sortOrder' => SORT_ASC])
                ->asArray()->all(); 

      return $data; 
    }
    
     /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullSlidesAccess';
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }
    /**
     * 
     * @return type array
     */
     public static function getSlidesData()
    {
        $items = self::getSlidesList();         
        $i = 0;
        foreach ($items as $item) {
            
            $data[$i] = [
                'options' =>
                [
                    'data' => [
                        'transition' => $item['data_transition'],
                        'slotamount' => $item['data_slotamount'],
                        'masterspeed' => $item['data_masterspeed'],                       
                    ],
                ],
                'image' => [
                    'options' =>
                    [
                        'alt' => $item['img_alt'],                        
                    ],
                ],
                'layers' => \artsoft\slides\models\SlidesLayers::getSlidesLayersData($item['id']),
            ];
            !empty($item['img_src']) ? $data[$i]['image']['src'] = $item['img_src'] : $data[$i]['image']['src'] = '/images/dummy.png';
            !empty($item['data_delay']) ? $data[$i]['options']['data']['delay'] = $item['data_delay'] : NULL;
            !empty($item['data_lazyload']) ? $data[$i]['image']['options']['data']['lazyload'] = $item['data_lazyload'] : NULL;
            !empty($item['data_fullwidthcentering']) ? $data[$i]['image']['options']['data']['fullwidthcentering'] = $item['data_fullwidthcentering'] : NULL;
            !empty($item['data_bgfit']) ? $data[$i]['image']['options']['data']['bgfit'] = $item['data_bgfit'] : NULL;
            !empty($item['data_bgposition']) ? $data[$i]['image']['options']['data']['bgposition'] = $item['data_bgposition'] : NULL;
            !empty($item['data_bgrepeat']) ? $data[$i]['image']['options']['data']['bgrepeat']= $item['data_bgrepeat'] : NULL;
            
            $i++;
        }
        return $data; 
    }
}

