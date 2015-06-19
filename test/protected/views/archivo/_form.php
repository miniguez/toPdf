<?php
/* @var $this ArchivoController */
/* @var $model Archivo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'archivo-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=> array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php
			$this->widget(
				'CMultiFileUpload',
				array(
					'name'=>'archivo',
					'value'=>'archivo',
					'accept'=>'doc,docx,xls,xlsx',
					'denied'=>'formato invalido',
					'max'=>1,
					'htmlOptions'=>array('class'=>'uploadfiles')
				)
			);
		?>
		<?php echo $form->labelEx($model,'archivo'); ?>
		<?php echo $form->textField($model,'archivo',array('size'=>60,'maxlength'=>125)); ?>
		<?php echo $form->error($model,'archivo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
