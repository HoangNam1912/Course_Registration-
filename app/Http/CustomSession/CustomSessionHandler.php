<?php

namespace App\Http\CustomSession;

use SessionHandlerInterface;
use Illuminate\Http\Request;

// class CustomSessionHandler implements SessionHandlerInterface 
// {
// //     // Implement the required methods here
// //     private $savePath;

// //     public function open($savePath, $sessionName): bool
// //     {
// //         $this->savePath = $savePath;
// //         if (!is_dir($this->savePath)) {
// //             mkdir($this->savePath, 0777);
// //         }
// //         return true;
// //     }

// //     public function close(): bool
// //     {
// //         return true;
// //     }

// //     public function read($id): bool
// // {
// //     $data = @file_get_contents("$this->savePath/sess_$id");
// //     if ($data === false) {
// //         error_log("Failed to read session data for ID $id");
// //         return '';
// //     }
// //     return (string) $data;
// // }

// //     public function write($id, $data): bool
// //     {
// //         return file_put_contents("$this->savePath/sess_$id", $data) !== false;
// //     }

// //     public function destroy($id): bool
// //     {
// //         $file = "$this->savePath/sess_$id";
// //         if (file_exists($file)) {
// //             unlink($file);
// //         }
// //         return true;
// //     }

// //     public function gc($maxLifetime): bool
// // {
// //     foreach (glob("$this->savePath/sess_*") as $file) {
// //         if (filemtime($file) + $maxLifetime < time() && file_exists($file)) {
// //             if (!unlink($file)) {
// //                 error_log("Failed to delete session file $file");
// //             }
// //         }
// //     }
// //     return true;
// // }
// }


// $handler = new CustomSessionHandler();
// session_set_save_handler($handler, true);
// session_start();