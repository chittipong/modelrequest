<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $tableid
 * @property integer $id
 * @property string $n_number_request
 * @property string $rd_status_app
 * @property string $rd_developin
 * @property string $internation_receive
 * @property string $internation_receivedate
 * @property string $internation_name
 * @property integer $sync_cloud_status
 * @property string $sync_cloud_date
 * @property string $cloud_uuid
 * @property string $checked
 * @property integer $user_id
 * @property string $user_name
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'checked', 'user_id', 'user_name'], 'required'],
            [['id', 'sync_cloud_status', 'user_id'], 'integer'],
            [['internation_receivedate', 'sync_cloud_date'], 'safe'],
            [['n_number_request', 'rd_status_app', 'rd_developin', 'internation_receive', 'internation_name', 'cloud_uuid'], 'string', 'max' => 250],
            [['checked'], 'string', 'max' => 1],
            [['user_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tableid' => Yii::t('app', 'Tableid'),
            'id' => Yii::t('app', 'ID'),
            'n_number_request' => Yii::t('app', 'N Number Request'),
            'rd_status_app' => Yii::t('app', 'Rd Status App'),
            'rd_developin' => Yii::t('app', 'Rd Developin'),
            'internation_receive' => Yii::t('app', 'Internation Receive'),
            'internation_receivedate' => Yii::t('app', 'Internation Receivedate'),
            'internation_name' => Yii::t('app', 'Internation Name'),
            'sync_cloud_status' => Yii::t('app', 'Sync Cloud Status'),
            'sync_cloud_date' => Yii::t('app', 'Sync Cloud Date'),
            'cloud_uuid' => Yii::t('app', 'Cloud Uuid'),
            'checked' => Yii::t('app', 'Checked'),
            'user_id' => Yii::t('app', 'User ID'),
            'user_name' => Yii::t('app', 'User Name'),
        ];
    }
}