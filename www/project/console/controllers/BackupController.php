<?php

namespace console\controllers;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use ZipArchive;

class BackupController extends Controller
{
    public string $path = '@backend/runtime/backup';

    /**
     * @var mixed[]
     */
    public array $databases = ['db'];

    /**
     * @var mixed
     */
    private $docker_db_host = 'mysql';

    /**
     * @var mixed[]
     *
     * add folders to zip
     * [
     *    'images' => '@app/web/images',
     * ],
     */
    private array $folders = [];

    public function actionIndex(): void
    {
        echo 'Start Dump DB';
        $path = Yii::getAlias($this->path . DIRECTORY_SEPARATOR . time());

        if (!is_dir($path) && !mkdir($path, 0777)) {
            die("Unable to create backup folder in $path. \nCheck permissions and try again.");
        }

        foreach ($this->databases as $database) {
            echo "backup DB: $database\n";
            $this->dumpDatabase($database, $path);
        }

        if ($this->folders) {
            foreach ($this->folders as $name => $folder) {
                $this->zipFolder($name, $folder, $path);
            }
        }

        $this->stdout("\n  Backup created.\n\n", Console::FG_GREEN);
    }

    private function dumpDatabase(string $database_handle, string $path): void
    {
        $database = Yii::$app->$database_handle->createCommand("SELECT DATABASE()")->queryScalar();

        exec('mysqldump --user=' . Yii::$app->$database_handle->username.' --password=' .
            Yii::$app->$database_handle->password . ' --host=' . $this->docker_db_host .
            ' --default-character-set=utf8 ' . $database . ' > ' . $path.DIRECTORY_SEPARATOR.$database .
        '.sql 2> /dev/null');
    }

    private function zipFolder(string $name, string $folder, string $path): void
    {
        if ($path) {
            $filename = $path.DIRECTORY_SEPARATOR.$name;
            $zip = new ZipArchive();
            $zip->open($filename, ZipArchive::CREATE);

            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(Yii::getAlias($folder)),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) { //phpcs:ignore
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen(Yii::getAlias($folder)) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();
        }
    }
}
