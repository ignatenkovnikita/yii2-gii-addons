<?php

/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

/**
 * This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name} {$labels[$column->name]}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
    <?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
    <?php endforeach; ?>
<?php endif; ?>
*/
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
    private $called_class_namespace;

    public function __construct()
    {
        $this->called_class_namespace = substr(get_called_class(), 0, strrpos(get_called_class(), '\\'));
        parent::__construct();
    }

<?php $behaviors = []; ?>
<?php foreach ($tableSchema->columns as $column) : ?>
    <?php
    switch ($column->name) {
        case 'created_at':
            $behaviors['timestamp'] = '\yii\behaviors\TimestampBehavior::class';
            break;
        case 'created_by':
            $behaviors['author']= '\yii\behaviors\BlameableBehavior::class';
            break;
    } ?>
<?php endforeach; ?>
<?php if ($behaviors) :?>

    /**
     * @inheritdoc
    */
    public function behaviors()
    {
        return [
<?php foreach ($behaviors as $key => $value) :?>
            '<?=$key;?>' => <?=$value;?>,
<?php endforeach; ?>
        ];
    }
<?php endif; ?>

    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }
<?php if ($generator->db !== 'db'): ?>

    /**
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
        return \Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [<?= "\n            " . implode(",\n            ", $rules) . ",\n        " ?>];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
    <?php foreach ($labels as $name => $label): ?>
        <?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
    <?php endforeach; ?>
        ];
    }
<?php foreach ($relations as $name => $relation): ?>

    <?php $processedRelation = str_replace($relation[1] . '::className()', '$this->called_class_namespace . \'\\' . $relation[1] . '\'', $relation[0]);?>
    /**
     * @return \yii\db\ActiveQuery
     * @throws \Exception
    */
    public function get<?= $name ?>()
    {
        <?= $processedRelation . "\n" ?>
    }
<?php endforeach; ?>
<?php if ($queryClassName): ?>
    <?php
    $queryClassFullName = ($generator->ns === $generator->queryNs) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
    echo "\n";
    ?>
    /**
     * @inheritdoc
     * @return <?= $queryClassFullName ?> the active query used by this AR class.
    */
    public static function find()
    {
        return new <?= str_replace('\generated', '',$queryClassFullName) ?>(get_called_class());
    }
<?php endif; ?>
}
