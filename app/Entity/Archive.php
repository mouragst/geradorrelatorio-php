<?php

namespace App\Entity;

class Archive {

    private $directory;
    private $files;
    private $itemsPerPage;
    private $currentPage;
    private $filterFileName;
    private $filterFileType;

    public function __construct($directory = '', $itemsPerPage = 5, $filterFileName = '', $filterFileType = ''){
        $this->directory = $directory;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->files = glob($this->directory . "/*.*");
        if ($this->files === false) {
            $this->files = [];
        }
        $this->filterFileName = $filterFileName;
        $this->filterFileType = $filterFileType;
    }

    public function getFiles() {
        return $this->files;
    }
    
    public function getTotalPages() {
        $filteredFiles = $this->applyFilters($this->files);
        return ceil(count($filteredFiles) / $this->itemsPerPage);
    }

    public function getOffset() {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }
    
    private function applyFilters($files) {
        return array_filter($files, function($file) {
            $fileName = basename($file);
            $fileType = pathinfo($file, PATHINFO_EXTENSION);

            $nameMatch = empty($this->filterFileName) || stripos($fileName, $this->filterFileName) !== false;
            $typeMatch = empty($this->filterFileType) || $fileType === $this->filterFileType;

            return $nameMatch && $typeMatch;
        });
    }

    public function getPaginatedFiles() {
        $filteredFiles = $this->applyFilters($this->files);
        $totalItems = count($filteredFiles);
        $totalPages = ceil($totalItems / $this->itemsPerPage);
        $offset = ($this->currentPage - 1) * $this->itemsPerPage;
        return array_slice($filteredFiles, $offset, $this->itemsPerPage);
    }

    public function deleteFile($fileName) {
        $fileToDelete = $this->directory . '/' . basename($fileName);
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
            return true;
        }
        return false;
    }

    public function renderFiles() {
        $results = '';
        $paginatedItems = $this->getPaginatedFiles();

        if (count($paginatedItems) > 0) {
            $offset = $this->getOffset();
            foreach ($paginatedItems as $index => $file) {
                $fileName = basename($file);
                $fileDate = date("d/m/Y - H:i", filemtime($file));
                $loja = explode('_', $fileName)[1];
                $loja = explode('-', $loja)[0];

                $results .= '<tr>
                                <td>' . ($offset + $index + 1) . '</td> 
                                <td>' . htmlspecialchars($loja) . '</td> 
                                <td>' . htmlspecialchars($fileName) . '</td>
                                <td>' . htmlspecialchars($fileDate) . '</td>
                                <td>
                                    <a href="baixar.php?file=' . urlencode($fileName) . '" class="btn btn-primary">Baixar</a>
                                    <form action="" method="post" style="display:inline-block;">
                                        <input type="hidden" name="delete_file" value="' . htmlspecialchars($fileName) . '">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este arquivo?\')">Excluir</button>
                                    </form>
                                </td>
                            </tr>';
            }
        } else {
            $results .= '<tr><td colspan="5" class="text-center h5">Nenhum arquivo encontrado.</td></tr>';
        }
        return $results;
    }


    public function renderPagination() {
        $totalPages = $this->getTotalPages();
        $pagination = '<nav><ul class="pagination">';

        if ($totalPages > 1) {
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i == $this->currentPage) ? 'active' : '';
                $pagination .= '<li class="page-item ' . $activeClass . '">
                                    <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                                 </li>';
            }
        }

        $pagination .= '</ul></nav>';
        return $pagination;
    }

    public function getUniqueFileName($directory, $baseFileName) {
        $filePath = $directory . '/' . $baseFileName;
        $count = 1;
        
        // Verificar se o arquivo já existe e gerar um novo nome se necessário
        while (file_exists($filePath)) {
            // Adicionar um contador ao nome do arquivo
            $filePath = $directory . '/' . pathinfo($baseFileName, PATHINFO_FILENAME) . "_{$count}." . pathinfo($baseFileName, PATHINFO_EXTENSION);
            $count++;
        }
        
        return $filePath;
      }

}
