<?php

/**
 * @load system files
 * 
 */
//system url handler
require __DIR__ . "/../config.php";

//DB File Loader
require __DIR__ . "/SystemDBConnector.php";

//Inital DB Executor
require __DIR__ . "/SysInitialDBExecutor.php";

//system Module Manager
require __DIR__ . "/SystemFileProcessor.php";

//system configuration Handler
require __DIR__ . "/SystemConfigurations.php";

//auto load all modules
require __DIR__ . "/SysModuleAutoLoader.php";


//generate backup only if required
if (isset($_GET['backup'])) {

    //check and validate backup requirement
    if ($_GET['backup'] == "true") {

        //generate backup of previous codes
        // Specify the directory and file to check
        $directory = __DIR__ . '/../storage/backups';
        if (!file_exists($directory)) {
            mkdir($directory);
        }
        $filename = "CODE_BackUp_" . date('Ymd') . ".zip";

        // Combine the directory and file to create the full path
        $filepath = $directory . '/' . $filename;

        // Check if the file exists
        if (!file_exists($filepath)) {
            // Define the source directory
            $sourceDir = realpath(__DIR__ . '/..');

            // Define the zip file path
            $zipFilePath = __DIR__ . "/../storage/backups/$filename";

            try {
                // Create a ZipArchive object
                $zip = new ZipArchive();


                // Open or create the zip file
                if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                    throw new Exception("Failed to open or create zip file: $zipFilePath");
                }

                // Create a recursive iterator to get all files and directories
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($sourceDir),
                    RecursiveIteratorIterator::SELF_FIRST
                );

                foreach ($files as $name => $file) {
                    // Skip directories (they will be added automatically)
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($sourceDir) + 1);

                        // Adjust the relative path to include subdirectories
                        $relativePathInZip = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);

                        // Add the current file to the zip archive with the original relative path
                        $zip->addFile($filePath, $relativePath);
                    }
                }

                // Close the zip archive
                $zip->close();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
