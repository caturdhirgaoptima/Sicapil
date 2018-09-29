
<?php use kartik\select2\Select2; ?>

<?=Select2::widget([
    'name' => 'dokumen',
    'value' => $value,
    'disabled' => false,
    'data' => $dokumen,
    'options' => ['multiple' => true, 'placeholder' => 'Pilih Dokumen']
]);?>