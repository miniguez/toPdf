<?php

/**
 * This is the model class for table "archivo".
 *
 * The followings are the available columns in table 'archivo':
 * @property string $id
 * @property string $archivo
 */
class Archivo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Archivo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'archivo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('archivo', 'required'),
			array('archivo', 'length', 'max'=>125),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, archivo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'archivo' => 'Archivo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('archivo',$this->archivo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function guardarArchivo($model, $archivo)
	{
		$model->archivo = $model->id."_archivo".".".$archivo->getExtensionName();
		$model->save();

		$dir = $this->getRuta().'adjuntos/';
		if ($archivo->saveAs($dir.$model->archivo)) {
			$this->toPDF($model);
			return 1;
		}
		return 0;
	}

    /**
    *Funcion para obtener la ruta de archivos
    *return string ruta
    */
	public function getRuta()
	{
		$root = Yii::getPathOfAlias('application');
		$pos = strpos($root, 'protected');
		$ruta = substr($root, 0, $pos);
		return $ruta;
	}

	public function toPDF($model)
	{	
		exec("toPdf ".$this->getRuta()."adjuntos/"." ".$model->archivo);
    }

}
