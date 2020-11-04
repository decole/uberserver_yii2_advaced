<?php

use yii\db\Migration;

/**
 * Class m201104_080613_insert_starter_data
 */
class m201104_080613_insert_starter_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('decole_weight', ['weight', 'created_at', 'updated_at'], [
            ['90.10', 1599244960, 1599244960],
            ['89.40', 1600104688, 1600104688],
            ['89.30', 1600105504, 1600105504],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('location', ['id', 'location'], [
            [1, 'дом'],
            [2, 'огород'],
            [3, 'пристройка'],
            [4, 'низа'],
            [5, 'теплица'],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('module_type', ['id', 'name', 'created_at', 'updated_at'], [
            [1, 'температура', 1597955219, 1597955219],
            [2, 'влажность', 1597955219, 1597955219],
            [3, 'реле', 1597955219, 1597955219],
            [4, 'протечка', 1599162241, 1599162252],
            [5, 'датчик движения', 1599162271, 1599162271],
            [6, 'датчик задымленности', 1599162281, 1599162281],
            [7, 'клапан', 1599162293, 1599162293],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('user', ['id', 'username', 'auth_key', 'password_hash',
            'password_reset_token', 'email', 'status', 'created_at', 'updated_at', 'verification_token'], [
            [2, 'decole', 'ONUUq8Wg_CpPYivMJeFa-5p7NbE23K7d', Yii::$app->getSecurity()->generatePasswordHash('qwerty12345'), NULL, 'decole.satiadarshi@gmail.com', 10, 1601191685, 1601191685, 'K8mBHEOt4s2SfZ21xm4rwbYPY86eMD3g_1601191685'],
        ])->execute();

        /**
         * INSERT INTO 'module_fire_system' ('id', 'name', 'topic', 'normal_condition', 'alarm_condition', 'message_info',
         'message_ok', 'message_warn', 'type', 'location', 'created_at', 'updated_at', 'notifying', 'active') VALUES
        (1, 'Дом и пристройка', 'home/firesensor/fire_state', '0', '1', 'Пожарная система - {value}',
         * 'Пожарная система, состояние - {value}', 'Внимание! Состояние пожарной системы - {value}', 6, 1, 1599163554, 1601129129, 1, 1);
         */
        Yii::$app->db->createCommand()->batchInsert('module_fire_system', ['id', 'name', 'topic', 'normal_condition', 'alarm_condition', 'message_info',
            'message_ok', 'message_warn', 'type', 'location', 'created_at', 'updated_at', 'notifying', 'active'], [
            [1, 'Дом и пристройка', 'home/firesensor/fire_state', '0', '1', 'Пожарная система - {value}',
                'Пожарная система,состояние - {value}', 'Внимание! Состояние пожарной системы - {value}',
                6, 1, 1599163554, 1601129129, 1, 1
            ],
        ])->execute();
        
        /**
         * INSERT INTO 'module_leakage' ('id', 'name', 'topic', 'check_up', 'check_down', 'message_info', 'message_ok', 'message_warn', 'type', 'location', 'notifying', 'active', 'created_at', 'updated_at') VALUES
        (1, 'Датчик протечки в низах', 'water/leakage', '1', '0', 'Датчик протечки в низах', 'Датчик протечки, состояние: {value}', 'Протечка в низах! состояние: {value}', 4, 4, 1, 1, 1600537975, 1600538582);
         */
        Yii::$app->db->createCommand()->batchInsert('module_leakage', ['id', 'name', 'topic', 'check_up', 'check_down', 'message_info', 'message_ok', 'message_warn', 'type', 'location', 'notifying', 'active', 'created_at', 'updated_at'], [
            [1, 'Датчик протечки в низах', 'water/leakage', '1', '0', 'Датчик протечки в низах', 'Датчик протечки, состояние: {value}', 'Протечка в низах! состояние: {value}', 4, 4, 1, 1, 1600537975, 1600538582],
        ])->execute();

        /**
         * INSERT INTO 'module_relay' ('id', 'name', 'topic', 'check_topic', 'command_on', 'command_off', 'check_command_on', 'check_command_off', 'last_command', 'message_info', 'message_ok', 'message_warn', 'type', 'location', 'created_at', 'updated_at', 'notifying', 'active') VALUES
        (1, 'Лампа в пристройке', 'margulis/lamp01', 'margulis/check/lamp01', 'on', 'off', '1', '0', 'on', 'Лампа в пристройке', 'Лампа в пристройке - {value}', 'Состояние лампы в пристройке неизвестно - {value}', 3, 3, 1597955219, 1601146406, 1, 1),
        (2, 'Дом Реле 01', 'home/ralay01', 'home/check/ralay01', 'on', 'off', '1', '0', 'off', 'Реле 01 в доме', 'Реле 01 в доме - команда выполнена успешно', 'Реле 01 в доме - команда неизвестно - {value}', 3, 1, 1600974870, 1601128873, 1, 1),
        (3, 'Главный клапан', 'water/major', 'water/check/major', '1', '0', '1', '0', '0', 'Главный клапан', 'Главный клапан - {value}', 'Состояние главного клапана неизвестно - {value}', 7, 2, 1601128940, 1601128940, 1, 1),
        (4, 'Клапан 1', 'water/1', 'water/check/1', '1', '0', '1', '0', '0', 'Клапан 1', 'Клапан 1 - {value}', 'Состояние клапана 1 неизвестно - {value}', 7, 2, 1601128982, 1601128982, 1, 1),
        (5, 'Клапан 2', 'water/2', 'water/check/2', '1', '0', '1', '0', '0', 'Клапан 2', 'Клапан 2 - {value}', 'Состояние клапана 2 неизвестно - {value}', 7, 2, 1601129019, 1601129019, 1, 1),
        (6, 'Клапан 3', 'water/3', 'water/check/3', '1', '0', '1', '0', '0', 'Клапан 3', 'Клапан 3 - {value}', 'Состояние клапана 3 неизвестно - {value}', 7, 2, 1601129065, 1601129065, 1, 1);
         */
        Yii::$app->db->createCommand()->batchInsert('module_relay', ['id', 'name', 'topic', 'check_topic', 'command_on', 'command_off', 'check_command_on', 'check_command_off', 'last_command', 'message_info', 'message_ok', 'message_warn', 'type', 'location', 'created_at', 'updated_at', 'notifying', 'active'], [
            [1, 'Лампа в пристройке', 'margulis/lamp01', 'margulis/check/lamp01', 'on', 'off', '1', '0', 'on', 'Лампа в пристройке', 'Лампа в пристройке - {value}', 'Состояние лампы в пристройке неизвестно - {value}', 3, 3, 1597955219, 1601146406, 1, 1],
            [2, 'Дом Реле 01', 'home/ralay01', 'home/check/ralay01', 'on', 'off', '1', '0', 'off', 'Реле 01 в доме', 'Реле 01 в доме - команда выполнена успешно', 'Реле 01 в доме - команда неизвестно - {value}', 3, 1, 1600974870, 1601128873, 1, 1],
            [3, 'Главный клапан', 'water/major', 'water/check/major', '1', '0', '1', '0', '0', 'Главный клапан', 'Главный клапан - {value}', 'Состояние главного клапана неизвестно - {value}', 7, 2, 1601128940, 1601128940, 1, 1],
            [4, 'Клапан 1', 'water/1', 'water/check/1', '1', '0', '1', '0', '0', 'Клапан 1', 'Клапан 1 - {value}', 'Состояние клапана 1 неизвестно - {value}', 7, 2, 1601128982, 1601128982, 1, 1],
            [5, 'Клапан 2', 'water/2', 'water/check/2', '1', '0', '1', '0', '0', 'Клапан 2', 'Клапан 2 - {value}', 'Состояние клапана 2 неизвестно - {value}', 7, 2, 1601129019, 1601129019, 1, 1],
            [6, 'Клапан 3', 'water/3', 'water/check/3', '1', '0', '1', '0', '0', 'Клапан 3', 'Клапан 3 - {value}', 'Состояние клапана 3 неизвестно - {value}', 7, 2, 1601129065, 1601129065, 1, 1],
        ])->execute();

        /**
         * INSERT INTO 'module_secure_system' ('id', 'name', 'topic', 'normal_condition', 'alarm_condition', 'trigger', 'current_command', 'message_info', 'message_ok', 'message_warn', 'type', 'location', 'created_at', 'updated_at', 'notifying', 'active') VALUES
        (1, 'прихожка дома', 'home/security/margulis/1', '0', '1', 0, 'off', 'датчик движения в прихожке', 'датчик движения в прихожке - {value}', 'обнаружено движение в прихожке - {value}', 5, 1, 1599161683, 1599162550, 1, 1),
        (2, 'холодная прихожка', 'home/security/margulis/2', '0', '1', 0, 'off', 'датчик движения в холодной прихожке', 'датчик движения в холодной прихожке - {value}', 'обнаружено движение в холодной прихожке - {value}', 5, 1, 1599162716, 1599162716, 1, 1);
         */
        Yii::$app->db->createCommand()->batchInsert('module_secure_system', ['id', 'name', 'topic', 'normal_condition', 'alarm_condition', 'trigger', 'current_command', 'message_info', 'message_ok', 'message_warn', 'type', 'location', 'created_at', 'updated_at', 'notifying', 'active'], [
            [1, 'прихожка дома', 'home/security/margulis/1', '0', '1', 0, 'off', 'датчик движения в прихожке', 'датчик движения в прихожке - {value}', 'обнаружено движение в прихожке - {value}', 5, 1, 1599161683, 1599162550, 1, 1],
            [2, 'холодная прихожка', 'home/security/margulis/2', '0', '1', 0, 'off', 'датчик движения в холодной прихожке', 'датчик движения в холодной прихожке - {value}', 'обнаружено движение в холодной прихожке - {value}', 5, 1, 1599162716, 1599162716, 1, 1],
        ])->execute();

        /**
         * INSERT INTO 'module_sensor' ('id', 'name', 'topic', 'message_info', 'message_ok', 'message_warn', 'type', 'location', 'created_at', 'updated_at', 'to_condition', 'from_condition', 'notifying', 'active') VALUES
        (1, 'Пристройка - температура', 'margulis/temperature', 'температура в пристройке', 'температура в пристройке - {value} °C', 'температура в пристройке - {value} °C. Возможно пожар.', 1, 3, 1597955219, 1601151398, 12, 35, 1, 1),
        (3, 'Пристройка - влажность', 'margulis/humidity', 'сенсор влажности в пристройке DHT11', 'Влажность в пристройе {value} %', 'Критическое влажность в пристройе {value} %', 2, 3, 1598897998, 1598897998, 20, 90, 1, 1),
        (4, 'Холодная прихожка - температура', 'holl/temperature', 'температура в холодной прихожке', 'температура в холодной прихожке - {value} °C', 'Внимание! температура в холодной прихожке - {value} °C.', 1, 1, 1601128123, 1601128123, 6, 40, 1, 1),
        (5, 'Низа - температура', 'underflor/temperature', 'температура в низах', 'температура в низах - {value} °C', 'Внимание! температура в низах - {value} °C.', 1, 1, 1601128257, 1601128257, 6, 28, 1, 1),
        (6, 'Тамбур в низа - температура', 'underground/temperature', 'температура тамбура в низах', 'температура тамбура в низах - {value} °C', 'Внимание! температура тамбура в низа - {value} °C.', 1, 1, 1601128310, 1601128310, 4, 35, 1, 1),
        (7, 'Туалет - температура', 'home/restroom/temperature', 'температура в туалете', 'температура в туалете - {value} °C', 'Внимание! температура в туалете - {value} °C', 1, 1, 1601128347, 1601128347, 14, 35, 1, 1),
        (8, 'Кухня - температура', 'home/kitchen/temperature', 'температура на кухне', 'температура на кухне - {value} °C', 'Внимание! температура на кухне - {value} °C. ', 1, 1, 1601128395, 1601128405, 14, 45, 1, 1),
        (9, 'Зал - температура', 'home/hall/temperature', 'температура в зале', 'температура в зале - {value} °C', 'Внимание! температура в зале - {value} °C', 1, 1, 1601128436, 1601128436, 19, 37, 1, 1),
        (10, 'Холодная прихожка - влажность', 'holl/humidity', 'сенсор влажности в холодная прихожке DHT11', 'Влажность в холодная прихожке {value} %', 'Внимание! Влажность в холодная прихожке {value} %', 2, 1, 1601128514, 1601128514, 12, 90, 1, 1),
        (11, 'Низа - влажность', 'underflor/humidity', 'сенсор влажности в низах DHT11- {value} %', 'Влажность в низах {value} %', 'Критическое влажность в низах {value} %', 2, 1, 1601128557, 1601128557, 20, 90, 1, 1),
        (12, 'Тамбур в низа - влажность', 'underground/humidity', 'Влажность в тамбуре в низа {value} %', 'Влажность в тамбуре в низа {value} %', 'Критическое влажность в тамбуре в низа {value} %', 2, 1, 1601128611, 1601128611, 20, 90, 1, 1),
        (13, 'Теплица - температура', 'greenhouse/temperature', 'температура в теплице', 'температура в теплице - {value} °C', 'предельная температура в теплице - {value} °C', 1, 5, 1601128649, 1601128678, 6, 60, 1, 1);
         */
        Yii::$app->db->createCommand()->batchInsert('module_sensor', ['id', 'name', 'topic', 'message_info', 'message_ok', 'message_warn', 'type', 'location', 'created_at', 'updated_at', 'to_condition', 'from_condition', 'notifying', 'active'], [
            [1, 'Пристройка - температура', 'margulis/temperature', 'температура в пристройке', 'температура в пристройке - {value} °C', 'температура в пристройке - {value} °C. Возможно пожар.', 1, 3, 1597955219, 1601151398, 12, 35, 1, 1],
            [3, 'Пристройка - влажность', 'margulis/humidity', 'сенсор влажности в пристройке DHT11', 'Влажность в пристройе {value} %', 'Критическое влажность в пристройе {value} %', 2, 3, 1598897998, 1598897998, 20, 90, 1, 1],
            [4, 'Холодная прихожка - температура', 'holl/temperature', 'температура в холодной прихожке', 'температура в холодной прихожке - {value} °C', 'Внимание! температура в холодной прихожке - {value} °C.', 1, 1, 1601128123, 1601128123, 6, 40, 1, 1],
            [5, 'Низа - температура', 'underflor/temperature', 'температура в низах', 'температура в низах - {value} °C', 'Внимание! температура в низах - {value} °C.', 1, 1, 1601128257, 1601128257, 6, 28, 1, 1],
            [6, 'Тамбур в низа - температура', 'underground/temperature', 'температура тамбура в низах', 'температура тамбура в низах - {value} °C', 'Внимание! температура тамбура в низа - {value} °C.', 1, 1, 1601128310, 1601128310, 4, 35, 1, 1],
            [7, 'Туалет - температура', 'home/restroom/temperature', 'температура в туалете', 'температура в туалете - {value} °C', 'Внимание! температура в туалете - {value} °C', 1, 1, 1601128347, 1601128347, 14, 35, 1, 1],
            [8, 'Кухня - температура', 'home/kitchen/temperature', 'температура на кухне', 'температура на кухне - {value} °C', 'Внимание! температура на кухне - {value} °C. ', 1, 1, 1601128395, 1601128405, 14, 45, 1, 1],
            [9, 'Зал - температура', 'home/hall/temperature', 'температура в зале', 'температура в зале - {value} °C', 'Внимание! температура в зале - {value} °C', 1, 1, 1601128436, 1601128436, 19, 37, 1, 1],
            [10, 'Холодная прихожка - влажность', 'holl/humidity', 'сенсор влажности в холодная прихожке DHT11', 'Влажность в холодная прихожке {value} %', 'Внимание! Влажность в холодная прихожке {value} %', 2, 1, 1601128514, 1601128514, 12, 90, 1, 1],
            [11, 'Низа - влажность', 'underflor/humidity', 'сенсор влажности в низах DHT11- {value} %', 'Влажность в низах {value} %', 'Критическое влажность в низах {value} %', 2, 1, 1601128557, 1601128557, 20, 90, 1, 1],
            [12, 'Тамбур в низа - влажность', 'underground/humidity', 'Влажность в тамбуре в низа {value} %', 'Влажность в тамбуре в низа {value} %', 'Критическое влажность в тамбуре в низа {value} %', 2, 1, 1601128611, 1601128611, 20, 90, 1, 1],
            [13, 'Теплица - температура', 'greenhouse/temperature', 'температура в теплице', 'температура в теплице - {value} °C', 'предельная температура в теплице - {value} °C', 1, 5, 1601128649, 1601128678, 6, 60, 1, 1],
        ])->execute();
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201104_080613_insert_starter_data cannot be reverted.\n";
        Yii::$app->db->createCommand()->checkIntegrity(false)->execute();

        Yii::$app->db->createCommand()->truncateTable('decole_weight')->execute();
        Yii::$app->db->createCommand()->truncateTable('location')->execute();
        Yii::$app->db->createCommand()->truncateTable('module_type')->execute();
        Yii::$app->db->createCommand()->truncateTable('user')->execute();
        Yii::$app->db->createCommand()->truncateTable('module_fire_system')->execute();
        Yii::$app->db->createCommand()->truncateTable('module_leakage')->execute();
        Yii::$app->db->createCommand()->truncateTable('module_relay')->execute();
        Yii::$app->db->createCommand()->truncateTable('module_secure_system')->execute();
        Yii::$app->db->createCommand()->truncateTable('module_sensor')->execute();
    }
}
