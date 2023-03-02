<?php

namespace App\Imports\Filters;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

/**
 * Class ChunkReadFilter
 *
 * @package App\Imports\Filters
 */
final class ChunkReadFilter implements IReadFilter
{
    private int $startRow = 0;

    private int $endRow   = 0;

    /**
     * Set the list of rows that we want to read
     *
     * @param $startRow
     * @param $chunkSize
     * @return void
     */
    public function setRows($startRow, $chunkSize): void
    {
        $this->startRow = $startRow;

        $this->endRow   = $startRow + $chunkSize;
    }

    /**
     * @inheritDoc
     */
    public function readCell($columnAddress, $row, $worksheetName = ''): bool
    {
        //Only read the heading row, and the configured rows
        return (($row == 1) || ($row >= $this->startRow && $row < $this->endRow));
    }
}
