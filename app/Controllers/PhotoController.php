<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PhotoController extends BaseController
{
  public function uploaded()
  {
    $file = $this->request->getPostGet('file');
    if (!$file || !is_file(WRITEPATH . $file)) {
      $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST, 'File not found');
      return $this->response;
    }

    $filePath = WRITEPATH . trim($file, '/\\');

    // We print out the file without using file_get_contents
    // to avoid memory issues with large files

    $response = $this->response;
    $response->setHeader('Content-Type', mime_content_type($filePath));
    $response->setHeader('Content-Length', filesize($filePath));
    $response->setHeader('Content-Disposition', 'inline; filename="' . basename($filePath) . '"');

    $file = fopen($filePath, 'rb');
    if ($file) {
      while (!feof($file))
        $response->appendBody(fread($file, 12192));
      fclose($file);
    } else {
      $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, 'Could not open file');
      return $this->response;
    }

    return $response;
  }
}
