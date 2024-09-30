<?php

namespace frontend\traits;

use Yii;
use JasperPHP\JasperPHP;

trait Jasper
{
    /**
     * Konfigurasi database untuk JasperPHP
     */
    private $db;

    /**
     * Konfigurasi directory path default untuk output files
     */
    private $outputDir = '/web/reports';

    /**
     * Set up konfigurasi database untuk Jasper
     */
    public function setUpConnection()
    {
        // Get database configuration
        $db = require(Yii::getAlias('@common') . '/config/main-local.php');

        // Extract DSN information
        $dsn = explode(';', $db['components']['db']['dsn']);
        $host = explode('=', $dsn[0])[1];
        $database = explode('=', $dsn[2])[1];

        $this->db = [
            'driver' => 'postgres',
            'username' => $db['components']['db']['username'],
            'password' => $db['components']['db']['password'],
            'host' => $host,
            'database' => $database,
            'charset' => $db['components']['db']['charset'],
        ];
    }

    /**
     * Download PDF file.
     */
    public function download($file, $params, $fileName, $hasLogo = true)
    {
        $output = $this->generatePdf($file, $params, $fileName, $hasLogo);

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename=' . str_replace('/', '', $fileName) . '.pdf');

        readfile($output . '.pdf');
        unlink($output . '.pdf');
    }

    /**
     * Generate PDF.
     */
    public function generatePdf($reportFile, $params, $fileName, $hasLogo)
    {
        $this->setUpConnection();

        $output = Yii::$app->basePath . $this->outputDir . '/' . $fileName;

        $jasper = new JasperPHP();

        if ($hasLogo) {
            $params['image'] = Yii::$app->basePath . '/web/images/logo.png';
        }
        
        // dd($jasper->process($reportFile, $output, ['pdf'], $params, $this->db)->output());

        $jasper->process($reportFile, $output, ['pdf'], $params, $this->db)->execute();

        return $output;
    }
}
