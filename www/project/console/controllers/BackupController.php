<?php

namespace console\controllers;

ini_set('memory_limit', '512M');

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
        sleep(10);

        $this->send();

        $this->stdout("\n  Backup send in Owncloud server.\n\n", Console::FG_GREEN);
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

    private function send(): void
    {
        $this->stdout("\n  Start sending.\n\n", Console::FG_GREEN);
        $path = Yii::getAlias($this->path);
        $list = [];
        $folders = $this->getSource($path);

        foreach ($folders as $folder) {
            $files = $this->getSource($path. '/' . $folder);

            foreach ($files as $file) {
                $list[$folder] = $path. '/' . $folder . '/' . $file;
            }
        }

        foreach ($list as $folder => $filePath) {
            $this->put($filePath, str_replace('/', '_', $filePath));
            unlink($filePath);
            rmdir($path = Yii::getAlias($this->path) . '/' . $folder);
        }
    }

    /**
     * @return string[]
     */
    private function getSource(string $path): array
    {
        return array_diff(scandir($path), ['..', '.']);
    }

    private function put(string $filePath, string $name): void
    {
        $username = Yii::$app->params['cloud_user'];
        $password = Yii::$app->params['cloud_password'];
        $filename = $filePath;
        $url = 'https://cl4y.ru/owncloud/remote.php/dav/files/decole/backup/uberserver/' . $name . '.sql';

        // Manually create the body
        $requestBody = '';
        $separator = '-----'.md5(microtime()).'-----';
        $file = fopen($filename, 'r');
        $size = filesize($filename);
        $filecontent = fread($file, $size);
        $requestBody .= "--$separator\r\n"
            . "Content-Disposition: form-data; name=\"$filename\"; filename=\"$filename\"\r\n"
            . "Content-Length: ".strlen($filecontent)."\r\n"
            . "Content-Type: image/png\r\n"
            . "Content-Transfer-Encoding: binary\r\n"
            . "\r\n"
            . "$filecontent\r\n";

        $requestBody .= "--$separator--";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data; boundary="'.$separator.'"']);

        $response = curl_exec($ch);
    }
}
