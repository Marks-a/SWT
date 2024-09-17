<?php
namespace App\classes;
use App\classes\Database;
class ProductListPage extends AbstractProduct
{
    public function __construct($db)
    {
        parent::__construct($db, '', '', '');

    }
    public function getAttributes(): array
    {
        return [];
    }
    public function validate(): array
    {
        return [];
    }
    public function renderAttributes(): string
    {
        return '';
    }
    public function getSelectors(): array{
        return [];
    }

}

?>