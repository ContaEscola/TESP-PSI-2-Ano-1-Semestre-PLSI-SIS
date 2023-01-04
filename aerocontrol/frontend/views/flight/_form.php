<?php
/** @var yii\web\View $this */
/** @var \frontend\models\FlightForm $model */
/** @var \common\models\Airport[] $airports */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin([
    'action' => ['search'],
    'errorCssClass' => 'invalid',
    'requiredCssClass' => 'invalid',
    'successCssClass' => 'valid',
    'validateOnType' => true,
    'validationDelay' => 500,
    'method' => 'get',
    'fieldConfig' => ['radioTemplate' => '{beginLabel}{input}{labelTitle}{endLabel}'],
    'options' => [
        'class' => '[ flight-search-form ] [ box-shadow-1  flow border-radius-1 ]',
        'data-flow-space' => 'small',
    ]
]) ?>
    <div class="even-columns gap-2">
        <div class="[ form__group ] [ flex-flow-row gap-2 justify-content-space-between-sm ]">
            <?=
            $form->field($model, 'two_way_trip')
                ->radioList(
                    [
                        '0' => 'Só Ida',
                        '1' => 'Ida e Volta'
                    ],
                    [
                        'item' => function($index, $label, $name, $checked, $value) {
                            if ($checked) $return = '<label class="radio-button-pill button"  data-type="primary-outline" data-active="true">';
                            else $return = '<label class="radio-button-pill button" data-type="primary-outline" data-active="false">';
                            $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>';
                            $return .= $label;
                            $return .= '</label>';

                            return $return;
                        }
                    ]
                )
                ->label(false);
            ?>
        </div>
    </div>

    <datalist id="airports">
        <?php
        foreach ($airports as $airport) {
            echo '<option value=\''.$airport->name.'\'>';
        }
        ?>
    </datalist>

    <div class="even-columns gap-2">
            <?= $form->field($model, 'origin', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50 '
                ],
                'options' => ['class' => 'form__group gap-0'],
            ])
                ->label(null, [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input',
                    'list' => 'airports',
                ]) ?>

            <?= $form->field($model, 'destiny', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50'
                ],
                'options' => ['class' => 'form__group gap-0'],
            ])
                ->label(null, [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input',
                    'list' => 'airports',
                ]) ?>
    </div>

    <div class="even-columns gap-1">
            <?= $form->field($model, 'origin_departure_date', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50'
                ],
                'options' => ['class' => 'form__group gap-0'],
            ])
                ->label(null, [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input',
                    'type' => 'date'
                ]) ?>

            <?= $form->field($model, 'destiny_departure_date', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50'
                ],
                'options' => ['class' => 'form__group gap-0'],
            ])
                ->label(null, [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input',
                    'type' => 'date'
                ]) ?>

            <?= $form->field($model, 'passengers', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50'
                ],
                'options' => ['class' => 'form__group gap-0'],
            ])
                ->label(null,[
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input',
                    'type' => 'number'
                ]) ?>
    </div>

    <?= Html::submitButton('Pesquisar', ['class' => '[ form__submit-button button ] [ fill-sm  d-block push-to-right ]']) ?>
<?php ActiveForm::end(); ?>

