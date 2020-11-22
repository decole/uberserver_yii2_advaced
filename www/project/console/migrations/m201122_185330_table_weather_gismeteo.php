<?php

use yii\db\Migration;

/**
 * Class m201122_185330_table_weather_gismeteo
 */
class m201122_185330_table_weather_gismeteo extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%weather_gismeteo}}', [
            'id' => $this->primaryKey(),
            'temperature_comfort' => $this->decimal(5, 2),
            'temperature_air' => $this->decimal(5, 2),
            'pressure' => $this->string(),
            'humidity' => $this->string(),
            'wind_speed' => $this->string(),
            'wind_scale' => $this->integer(2)->unsigned(),
            'description' => $this->string(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-weather_gismeteo-created_at',
            '{{%weather_gismeteo}}',
            'created_at'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'idx-weather_gismeteo-created_at',
            '{{%weather_gismeteo}}'
        );

        $this->dropTable('{{%weather_gismeteo}}');
    }
}
