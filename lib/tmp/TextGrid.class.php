<?php



class TextGrid extends \Struct
{
    private $columns = array(); // holds an associative array of column objects
    private $cells   = array(); // holds an associative array of cell data objects

    public $columnCount = 0;

    public $width         = 80;
    public $expandToWidth = true;

    /**
     * setColumn - Sets the column specified in parameter 1 with the object in parameter 2
     *
     * @method setColumn
     * @param  integer     $columnNumberRaw The column number, must be >= 1
     * @param  TextColumn $column          The TextColumn object to be set
     */
    public function setColumn($columnNumberRaw, TextColumn $column)
    {
        $columnNumber = (integer)$columnNumberRaw;
        if($columnNumber <= 0) {
            throw new Exception( implode(' ', array(
                 __CLASS__.'::'.__FUNCTION__
                ,' - The column number provided ['.(string)$columnNumberRaw.'] is invalid.  This must be an integer >= 1'
            )));
        }
        else if($columnNumber > $this->width) {
            throw new Exception( implode(' ', array(
                 __CLASS__.'::'.__FUNCTION__
                ,' - The column number ['.(string)$columnNumber.'] is greater than the grid maximum width value ['.(string)$this->width.'].'
            )));
        }


        if(isset($columns[(integer)$columnNumber])) {
            $this->columns[$columnNumber] = $column;
            return;
        }

        for($i=1; $i<$columnNumber; $i++) {
            if(!isset($this->columns[$i])) {
                $this->columns[$i] = new \TextColumn();
            }
        }

        $this->columns[$columnNumber] = $column;
        $this->columnCount = count($this->columns);
        return;
    }


    /**
     * setCell - Sets the cell specified in parameter 1/2 with the TextCell object in parameter 3
     *
     * @method setCell
     * @param  integer   $columnNumberRaw The column number, must be >= 1
     * @param  integer   $rowNumberRaw    The row number, must be >= 1
     * @param  TextCell $cell            The TextCell object to be set
     */
    public function setCell($columnNumberRaw, $rowNumberRaw, TextCell $cell)
    {
        $columnNumber = (integer)$columnNumberRaw;
        if($columnNumber <= 0) {
            throw new Exception( implode(' ', array(
                 __CLASS__.'::'.__FUNCTION__
                ,' - The column number provided ['.(string)$columnNumberRaw.'] is invalid.  This must be an integer >= 1'
            )));
        }

        $rowNumber = (integer)$rowNumberRaw;
        if($rowNumber <= 0) {
            throw new Exception( implode(' ', array(
                 __CLASS__.'::'.__FUNCTION__
                ,' - The row number provided ['.(string)$rowNumberRaw.'] is invalid.  This must be an integer >= 1'
            )));
        }


        if(!isset($this->columns[$columnNumber])) {
            $column = new \TextColumn();
            $this->setColumn($columnNumber, $column);
        }

        if(!isset($this->cells[$rowNumber][$columnNumber])) {
            for($r=1; $r<=$rowNumber; $r++) {
                foreach($this->columns as $c => $column) {
                    if(!isset($this->cells[$r][$c])) {
                        $this->cells[$r][$c] = null;
                    }
                }
            }
        }

        $this->cells[$rowNumber][$columnNumber] = $cell;
        if($cell->columnSpan > 1) {
            for($c=($columnNumber+1); $c<($columnNumber+$cell->columnSpan); $c++) {

                if(!isset($this->columns[$c])) {
                    $this->columns[$c] = new \TextColumn();
                }

                $this->cells[$rowNumber][$c] = null;
            }
        }

        return;
    }



    /**
     * build - Builds and returns the grid TextGrid
     * @method build
     * @param  boolean  $returnAsLinesArray Set to TRUE to return all lines in one array, indexed by line number_of_days
     * @return mixed                      Array of lines if parameter 1 is TRUE, String if parameter 1 is FALSE
     */
    public function build($returnAsLinesArray=false)
    {
        // printre('made it');
        // Measure the data and determine the cell widths
        $columnSpanSpaceConsumption = array();
        foreach($this->cells as $rowNumber => $row) {
            foreach($row as $columnNumber => $cell) {
                if(isset($cell->data)) {

                    // Format the data as described in the cell->type first, then fall back on teh column->type
                    $cellType = $cell->getType();
                    // printre(!empty($cellType->prefix));
                    if($cellType !== null) {

                        if(!empty($cellType->prefix)) {
                            $cellType->prefix = $cellType->prefix;
                        }
                        else if(!empty($cell->prefix)) {
                            $cellType->prefix = $cell->prefix;
                        }
                        else {
                            $cellType->prefix = $this->columns[$columnNumber]->prefix;
                        }

                        if(!empty($cellType->suffix)) {
                            $cellType->suffix = $cellType->suffix;
                        }
                        else if(!empty($cell->suffix)) {
                            $cellType->suffix = $cell->suffix;
                        }
                        else {
                            $cellType->suffix = $this->columns[$columnNumber]->suffix;
                        }


                        $cell->data = $cellType->make($cell->data);

                    }
                    else {
                        $columnType = $this->columns[$columnNumber]->getType();
                        $cell->data = $columnType->make($cell->data);
                    }


                    // printre($cell);

                    if($cell->columnSpan == 1) {
                        // printre(strlen($cell->data));
                        $this->columns[$columnNumber]->maxCharWidth = ($this->columns[$columnNumber]->maxCharWidth < strlen($cell->data))
                            ? strlen($cell->data)
                            : $this->columns[$columnNumber]->maxCharWidth;
                    }
                    elseif($cell->columnSpan > 1) {

                        $stringPartLength = ceil((strlen($cell->data) / $cell->columnSpan));

                        for($c=$columnNumber; $c<($columnNumber + $cell->columnSpan); $c++) {

                            // if(!in_array($c, $columnSpanSpaceConsumption)) {
                            //     $columnSpanSpaceConsumption[] = $c;
                            // }

                            $this->columns[$c]->maxCharWidth = ($this->columns[$c]->maxCharWidth < $stringPartLength)
                                ? $stringPartLength
                                : $this->columns[$c]->maxCharWidth;
                        }
                    }
                }
            }
        }

        // printr($columnSpanSpaceConsumption);
        // printr($this->columns);
        // printre($this->cells);

        $columnCount   = count($this->columns);
        $columnSpacing = ($columnCount - 1);

        // Verify that the columns plus the column spacing does not exceed the max width.  This will not render because
        // the mininum column width is one single character.
        if(($columnCount + $columnSpacing) > $this->width) {
            throw new Exception( implode(' ', array(
                 __CLASS__.'::'.__FUNCTION__
                ,' - The grid\'s maximum width ['.(string)$this->width.'] is exceeded by the number of '
                ,'columns ['.(string)$columnCount.'] plus the column spacing ['.(string)$columnSpacing.']'
            )));
        }


        // Generate the values for total with of all columns plus column spacing and
        // sort the column keys by length of data in DESC order
        $totalColumnsWidth = $columnSpacing;
        $columnWidths      = array();
        foreach($this->columns as $columnNumber => $column) {
            $totalColumnsWidth += ($column->maxCharWidth > (integer)$column->minCharWidth) ? $column->maxCharWidth : (integer)$column->minCharWidth;
            $columnWidths[$columnNumber] = ($column->maxCharWidth > (integer)$column->minCharWidth) ? $column->maxCharWidth : (integer)$column->minCharWidth;
        }

        // printre(array($totalColumnsWidth, $columnWidths));


        // If the total column width plus spacing is greater than the grid with, start chopping
        // printr($columnWidths);
        if($totalColumnsWidth < $this->width && $this->expandToWidth === true) {
            asort($columnWidths); // sort the widths, maintain keys
            $expandLength = ($this->width - $totalColumnsWidth);
            $paddedLength = 0;
            $columns      = array_keys($columnWidths);
            while($paddedLength < $expandLength) {
                $itterationLength = $columnWidths[$columns[0]];
                foreach($columnWidths as $column => $width) {
                    if($columnWidths[$column] == $itterationLength) {
                        $columnWidths[$column] = ($width + 1);
                        $paddedLength++;
                        if($paddedLength >= $expandLength) {
                            break;
                        }
                    }
                }
            }
        }
        else if($totalColumnsWidth > $this->width) {
            // printre(array($totalColumnsWidth, $this->width));
            arsort($columnWidths); // sort the widths, maintain keys
            // printr($columnWidths);
            $chopLength    = ($totalColumnsWidth - $this->width);
            $severedLength = 0;
            $columns       = array_keys($columnWidths);
            while($severedLength < $chopLength) {
                $itterationLength = (isset($itterationLength)) ? ($itterationLength - 1) : $columnWidths[$columns[0]];
                foreach($columnWidths as $column => $width) {
                    if($columnWidths[$column] == $itterationLength) {
                        // printre(array($this->columns[$column]->minCharWidth, $width));
                        if(!is_null($this->columns[$column]->minCharWidth) && $this->columns[$column]->minCharWidth >= $width) {
                            continue; // skip this as it's already as narrow as it can be
                        }
                        $columnWidths[$column] = ($width - 1);
                        $severedLength++;
                        if($severedLength >= $chopLength) {
                            break;
                        }
                    }
                }
            }
            // printre($columnWidths);


            // Loop through the cells and chop the length to what is specified above. Take the remaining
            // text and create a new row below, holding the same cell attributes per column for wrapping.
            $orgCells    = $this->cells;
            $this->cells = array();
            $newRow      = 1;
            // printre($orgCells);
            foreach($orgCells as $row => $cells) {

                $maxRowsAdded = 1;

                foreach($cells as $column => $cell) {

                    // printr($cell);

                    $addRow       = 0;



                    if(!is_null($cell) && $cell->columnSpan == 1 && strlen($cell->data) <= $columnWidths[$column]) {
                        // printr($cell);
                        $this->setCell($column, $newRow, $cell);
                    }
                    else if(!is_null($cell) && $cell->columnSpan == 1 && strlen($cell->data) > $columnWidths[$column]) {
                        // printr($cell);
                        $splitBy  = '~'.md5(microtime()).'~';
                        $partsRaw = explode($splitBy, chunk_split($cell->data, $columnWidths[$column], $splitBy));
                        // printre($partsRaw);
                        $loopTotal = (count($partsRaw)-1);
                        for($i=0; $i<$loopTotal; $i++) {
                            $part = $partsRaw[$i];
                            $newCell = clone($cell);
                            $newCell->data = $part;
                            // printr($newCell);
                            $this->setCell($column, ($newRow + $addRow++), $newCell);
                        }
                        $maxRowsAdded = ($maxRowsAdded < $addRow) ? $addRow : $maxRowsAdded;
                    }
                    else if(!is_null($cell) && $cell->columnSpan > 1) {
                        // printr($cell);
                        // find the max width for this column (sum of columns it consumes plus the spacing)
                        $maxWidth = ($cell->columnSpan - 1);
                        for($i=$column; $i<($column + $cell->columnSpan); $i++) {
                            $maxWidth += $columnWidths[$i];
                        }

                        $splitBy  = '~'.md5(microtime()).'~';
                        $partsRaw = explode($splitBy, chunk_split($cell->data, $maxWidth, $splitBy));
                        // printre($partsRaw);
                        $loopTotal = (count($partsRaw)-1);
                        for($i=0; $i<$loopTotal; $i++) {
                            $part = $partsRaw[$i];
                            $newCell = clone($cell);
                            $newCell->data = $part;
                            $this->setCell($column, ($newRow + $addRow++), $newCell);
                        }
                        $maxRowsAdded = ($maxRowsAdded < $addRow) ? $addRow : $maxRowsAdded;
                    }
                }
                $newRow += $maxRowsAdded;

                // printre($this->cells);
                // exit;
            }
        }


        // printre($this->cells);
        // Build the grid
        $gridLines = array();
        foreach($this->cells as $row => $cells) {
            $line          = array();
            $skipCellCount = 0; // for column spans > 1
            foreach($cells as $column => $cell) {

                if($skipCellCount > 0) {
                    $skipCellCount--;
                    continue;
                }

                $col =& $this->columns[$column];
                // if($rowNumber == 2) {printre($col);}

                $padType = (!empty($cell->align)) ? $cell->align : $col->align;
                switch($padType) {
                    case 'right':
                        $pad = STR_PAD_LEFT;
                        break;

                    case 'center':
                        $pad = STR_PAD_BOTH;
                        break;

                    case 'left':
                    default;
                        $pad = STR_PAD_RIGHT;
                        break;
                }

                if(!is_null($cell) && $cell->columnSpan > 1) {
                    $padWidth      = ($cell->columnSpan - 1);
                    $skipCellCount = ($cell->columnSpan - 1);
                    for($i=$column; $i<($column + $cell->columnSpan); $i++) {
                        $padWidth += $columnWidths[$i];
                    }
                }
                else {
                    $padWidth = $columnWidths[$column];
                }

                $data      = (isset($cell->data))      ? $cell->data : '';
                $padString = (!empty($data) || strlen($data) > 0)
                    ? (!empty($cell->padString)) ? $cell->padString : $col->padString
                    : ' ';
                    // if(!empty($data)) {
                    //     printr(array($data, $padString, $cell->padString, $col));
                    // }
                $data      = str_pad($data, $padWidth, $padString, $pad);

                // printre(array($this->columns[$column], $cell));
                $line[] = $data;
            }
            // printre($line);
            $gridLines[] = implode(' ', $line);
        }

        if($returnAsLinesArray === true) {
            return $gridLines;
        }
        else {
            return implode("\n", $gridLines);
        }
    }

}










class TextColumn extends \Struct
{
    private $type;

    public $maxCharWidth = 0;
    public $minCharWidth = null;
    public $padString    = ' ';
    public $align        = 'left';
    public $overflow     = 'hide';

    public $prefix        = null;
    public $suffix        = null;
    public $decimals      = null;
    public $dec_point     = null;
    public $thousands_sep = null;

    public function __construct(\TextType $type=null)
    {
        $this->type = ($type === null) ? $this->type = new \TextTypeString() : $type;
    }

    public function getType()
    {
        return $this->type;
    }
}





class TextCell extends \Struct
{
    private $type;

    public $columnSpan = 1; // column width of the cell
    public $data       = null;
    public $align      = null;
    public $padString  = null;
    public $overflow   = null;

    public $prefix        = null;
    public $suffix        = null;
    public $decimals      = null;
    public $dec_point     = null;
    public $thousands_sep = null;

    public function __construct($data=null, \TextType $type=null)
    {
        $this->type = $type;
        $this->data = $data;
    }

    public function getType()
    {
        return $this->type;
    }
}






abstract class TextType extends \Struct
{
    public $prefix        = null;
    public $suffix        = null;
    public $decimals      = null;
    public $dec_point     = null;
    public $thousands_sep = null;

    public function make($data)
    {
        return $this->prefix . $data . $this->suffix;
    }
}

class TextTypeString extends \TextType
{
    public function __construct()
    {

    }

    public function make($data)
    {
        return parent::make($data);
    }
}



class TextTypeNumber extends \TextType
{
    public $decimals      = 0;
    public $dec_point     = '.';
    public $thousands_sep = ',';

    public function __construct()
    {

    }

    public function make($data)
    {
        return parent::make(number_format((double)$data, $this->decimals, $this->dec_point, $this->thousands_sep));
    }
}



class TextTypeMoney extends \TextTypeNumber
{
    public $prefix = '$';
    public $decimals = 2;

    public function __constrct()
    {
        parent::__construct();
        // $this->decimals = 2;
    }

    public function make($data)
    {
        return parent::make($data);
    }
}
