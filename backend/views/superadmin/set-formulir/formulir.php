
<?php use kartik\select2\Select2; ?>

<?=Select2::widget([
    'name' => 'formulir',
    'value' => $value,
    'disabled' => false,
    'data' => $formulir,
    'options' => ['multiple' => true, 'placeholder' => 'Pilih Dokumen']
]);?>