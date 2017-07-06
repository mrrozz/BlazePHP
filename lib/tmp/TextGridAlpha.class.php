<?php



class TextGrid extends \Struct
{
    private $columns = array(); // holds an associative array of column objects
    private $data    = array();

    public $columnCount = 0;

    public $border       = false;
    public $borderTop    = true;
    public $borderBottom = true;
    public $borderLeft   = true;
    public $borderRight  = true;

    public  $overflow = 'hide'; // hide, wrap
    public  $width  = 80;

    private static $debugLevel = 0;  //used for recusive debugging

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



    public function setCell($columnNumber, $rowNumberRaw, TextCell $cell)
    {
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

        if(!isset($this->data[$rowNumber][$columnNumber])) {
            for($r=1; $r<=$rowNumber; $r++) {
                foreach($this->columns as $c => $column) {
                    if(!isset($this->data[$r][$c])) {
                        $this->data[$r][$c] = null;
                    }
                }
            }
        }

        $this->data[$rowNumber][$columnNumber] = $cell;
        if($cell->columnSpan > 1) {
            for($c=($columnNumber+1); $c<($columnNumber+$cell->columnSpan); $c++) {

                if(!isset($this->columns[$c])) {
                    $this->columns[$c] = new \TextColumn();
                }

                $this->data[$rowNumber][$c] = null;
            }
        }

        return;
    }



    public function build($returnAsLinesArray=false, $skipDataTyping=false, $debugLevel=0)
    {
        printr($debugLevel);
        // Measure the data and determine the cell widths
        $columnSpanSpaceConsumption = array();
        foreach($this->data as $rowNumber => $row) {
            foreach($row as $columnNumber => $cell) {
                if(isset($cell->data)) {

                    // Format the data as described in the cell->type first, then fall back on teh column->type
                    if($skipDataTyping !== true) {
                        $cellType = $cell->getType();
                        if($cellType !== null) {
                            $cell->data = $cellType->make($cell->data);
                        }
                        else {
                            $columnType = $this->columns[$columnNumber]->getType();
                            $cell->data = $columnType->make($cell->data);
                        }
                    }

                    if($cell->columnSpan == 1) {
                        // printre(strlen($cell->data));
                        $this->columns[$columnNumber]->maxCharWidth = ($this->columns[$columnNumber]->maxCharWidth < strlen($cell->data))
                            ? strlen($cell->data)
                            : $this->columns[$columnNumber]->maxCharWidth;
                    }
                    elseif($cell->columnSpan > 1) {

                        $stringPartLength = ceil((strlen($cell->data) / $cell->columnSpan));

                        for($c=$columnNumber; $c<($columnNumber + $cell->columnSpan); $c++) {

                            if(!in_array($c, $columnSpanSpaceConsumption)) {
                                $columnSpanSpaceConsumption[] = $c;
                            }

                            $this->columns[$c]->maxCharWidth = ($this->columns[$c]->maxCharWidth < $stringPartLength)
                                ? $stringPartLength
                                : $this->columns[$c]->maxCharWidth;
                        }
                    }
                }
            }
        }

        // printre($this);
        // printre($columnSpanSpaceConsumption);


        // Determine whether or not the columns fit inside of the $width
        $columnCount       = count($this->columns);
        $columnSpanSpaceDeduction = (count($columnSpanSpaceConsumption) > 0) ? (count($columnSpanSpaceConsumption) - 1) : 0;
        $columnSpacing     = ($columnCount - 1 - $columnSpanSpaceDeduction);
        // printre($columnSpacing);
        // $borderWidth       = ($this->border === true) ? ($columnCount + 1) : 0;

        if(($columnCount + $columnSpacing) > $this->width) {
            throw new Exception( implode(' ', array(
                 __CLASS__.'::'.__FUNCTION__
                ,' - The grid\'s maximum width ['.(string)$this->width.'] is exceeded by the number of '
                ,'columns ['.(string)$columnCount.'] plus the column spacing ['.(string)$columnSpacing.']'
            )));
        }

        $totalColumnsWidth = $columnSpacing;
        $columnWidths      = array();
        // printre($this->columns);
        foreach($this->columns as $columnNumber => $column) {
            $totalColumnsWidth += $column->maxCharWidth;
            $columnWidths[$columnNumber] = $column->maxCharWidth;
        }
        arsort($columnWidths); // sort the widths, maintain keys

        if($debugLevel > 0) {
            // printr($columnWidths);
            // printre($totalColumnsWidth);
        }

        // Create the line breaks/hidden text where needed for over flowing cells
        // printre(array($this->width, $columnSpacing));
        if($totalColumnsWidth > $this->width) {
            $keys            = array_keys($columnWidths);
            $subtractedCount = 0;

            $continue = true;
            do {
                $itterationValue = $columnWidths[$keys[0]];
                // printr($itterationValue);
                foreach($columnWidths as $columnNumber => $width) {
                    if($itterationValue == $width) {
                        $columnWidths[$columnNumber]--;
                        $subtractedCount++;
                    }

                    if(($totalColumnsWidth - $subtractedCount) <= $this->width) {
                        $continue = false;
                        break;
                    }
                    else {
                        $continue = true;
                    }
                }

            }
            while($continue === true);

            // printre(array($totalColumnsWidth, $subtractedCount, $columnWidths, $this->width));

            // Create the line breaks if $overflow=wrap || truncate the data to fit
            $dataOut         = array();
            $dataOutRowCount = 0;
            $reprocessDataAfterWrap = false;
            if($this->overflow === 'wrap') {
                $rowBuffer = array();
                // printre($this->data);
                foreach($this->data as $rowNumber => $row) {
                    // echo $rowNumber, ' ';
                    $dataOutRowCount++;
                    $skipColumns = 0;
                    foreach($row as $columnNumber => $cell) {
                        // if($skipColumns > 0) {
                        //     $skipColumns--;
                        //     continue;
                        // }
                        $cell = (empty($cell)) ? new \TextCell() : $cell;

                        $rowBuffer[$columnNumber] = null;
                        $dataOut[$dataOutRowCount][$columnNumber] = $cell;

                        // if($cell->overflow == 'nowrap' || ($this->columns[$columnNumber]->overflow == 'nowrap' && $cell->overflow == null)) {
                        //     continue;
                        // }

                        // Break up the data
                        $splitBy = '~'.md5(microtime()).'~';



                        // $length = ($col->maxCharWidth+$columnPadding+$addOnePad);
                        // printre($columnWidths);
                        $length  = $columnWidths[$columnNumber];
                        if($cell->columnSpan > 1) {
                            $skipColumns = ($cell->columnSpan - 1);
                            // printr($length);
                            for($c = ($columnNumber + 1); $c <= ($columnNumber + $skipColumns); $c++) {
                                $length += $columnWidths[$c];
                                // printr($colCharWidth);
                            }
                            $length += ($cell->columnSpan -1);
                            // printr($length);
                        }
                        // printr(array($cell->data, $length, $splitBy));
                        // $partsRaw = ($length > 0) ? explode($splitBy, chunk_split($cell->data, $length, $splitBy)) : array();
                        $partsRaw = explode($splitBy, chunk_split($cell->data, $length, $splitBy));

                        // Clean out any empty trailing parts
                        $parts = array();
                        foreach($partsRaw as $part) {
                            if(strlen((string)$part) > 0) {
                                $parts[] = (string)$part;
                            }
                        }
                        // printre($parts);

                        // Take the part for this cell
                        $dataOut[$dataOutRowCount][$columnNumber]->data = array_shift($parts);

                        if(count($parts) > 0) {
                            $rowBuffer[$columnNumber] = $parts;
                            $reprocessDataAfterWrap   = true;
                        }
                    }

                    // printr($rowBuffer);

                    // printre($dataOut);

                    do {
                        $newRow   = array();
                        $continue = false;
                        foreach($rowBuffer as $columnNumber => $data) {
                            $newRow[$columnNumber] = new \TextCell();
                            // printre($data);
                            if(is_array($data)) {

                                $newRow[$columnNumber] = isset($this->data[$rowNumber][$columnNumber])
                                    ? clone $this->data[$rowNumber][$columnNumber]
                                    : new \TextCell();

                                $newRow[$columnNumber]->data = array_shift($rowBuffer[$columnNumber]);

                                // printre($newRow);

                                if(strlen((string)$newRow[$columnNumber]->data) > 0) {
                                    $continue = true;
                                }
                            }
                        }

                        if($continue === true) {
                            $dataOutRowCount++;
                            $dataOut[$dataOutRowCount] = $newRow;
                        }
                    }
                    while($continue === true);

                    // printre($dataOut);

                }

                if($reprocessDataAfterWrap === true) {
                    // printre('made it');
                    $this->data = $dataOut;
                    $columnNumbers = array_keys($this->columns);

                    foreach($columnNumbers as $cn) {
                        $this->columns[$cn]->maxCharWidth = 0;
                    }
                    self::$debugLevel++;
                    return $this->build($returnAsLinesArray, true, self::$debugLevel);
                }

            }
            else {
                foreach($this->data as $rowNumber => $row) {
                    foreach($row as $columnNumber => $cell) {
                        $this->data[$rowNumber][$columnNumber]->data = (strlen($cell->data) > $columnWidths[$columnNumber])
                            ? substr($cell->data, 0, $columnWidths[$columnNumber])
                            : $cell->data;
                    }
                }
            }
        }


        $output = array();

        // printre(array($totalColumnsWidth, $this->width));
        if($totalColumnsWidth <= $this->width && $this->border !== true) {
            // Determine the padding to be added to each column
            $columnPadding  = ceil(($this->width - ($columnCount - 1) - $totalColumnsWidth) / $columnCount);
            $addOnePadCount = ($this->width - ($columnCount - 1)  - $totalColumnsWidth - ($columnPadding*$columnCount));
            // printre($addOnePadCount);

            foreach($this->data as $rowNumber => $row) {
                // if($rowNumber == 2 ) {
                //     printre($row);
                // }
                $output[$rowNumber] = '';
                $onePadCount        = $addOnePadCount;
                $skipColumns        = 0;
                foreach($row as $columnNumber => $cell) {
                    if($skipColumns > 0) {
                        $skipColumns--;
                        continue;
                    }
                    $cell = (empty($cell)) ? new TextCell() : $cell;

                    // Add in the leftover padding distributed across the last columns
                    $addOnePad = 0;
                    if($columnNumber >= ($this->columnCount-$addOnePadCount)) {
                        $addOnePad = 1;
                    }

                    // printre($this->columns[$columnNumber]);
                    $col =& $this->columns[$columnNumber];
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

                    $colCharWidth = ($col->maxCharWidth+$columnPadding+$addOnePad);
                    if($cell->columnSpan > 1) {
                        $skipColumns = ($cell->columnSpan - 1);
                        // printr($colCharWidth);
                        for($c = ($columnNumber + 1); $c <= ($columnNumber + $skipColumns); $c++) {
                            $addOnePad = 0;
                            if($c >= ($this->columnCount-$addOnePadCount)) {
                                $addOnePad = 1;
                            }
                            // printr(array(
                            //      $this->columns[$c]->maxCharWidth+$columnPadding
                            //     ,$addOnePad
                            //     ,$cell->columnSpan
                            // ));
                            $colCharWidth += $this->columns[$c]->maxCharWidth+$columnPadding+$addOnePad;
                            // printr($colCharWidth);
                        }
                        $colCharWidth += $cell->columnSpan;

                        // printr($colCharWidth);
                    }

                    $cell->data = str_pad($cell->data, $colCharWidth, ' ', $pad);



                    // $output[$rowNumber][] = '>'.$cell->data.'<';
                    $output[$rowNumber][] = $cell->data;

                    // if($rowNumber == 2) {printr($output);}
                }
            }

            // printre($output);


            // printre($output);
            $returnLines = array();
            foreach($output as $row) {
                $returnLines[] = implode(' ', $row);
            }

            if($returnAsLinesArray === true) {
                return $returnLines;
            }
            else {
                return implode("\n", $returnLines);
            }
        }
        else {
            // printre($this->data);
            throw new Exception( implode(' ', array(
                 __CLASS__.'::'.__FUNCTION__
                ,' - Borders have not been implemented yet =('
            )));
        }


        // printre($totalColumnsWidth);
        //
        // printre($this->columns);
    }
}




class TextColumn extends \Struct
{
    private $type;

    public $header       = null;
    public $prefix       = null;
    public $suffix       = null;
    public $maxCharWidth = 0;
    public $align        = 'left';
    public $overflow   = null;

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
    public $align      = 'left';
    public $overflow   = null;

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
    // Just used for type casting
}

class TextTypeString extends \TextType
{
    public function __construct()
    {

    }

    public function make($data)
    {
        return $data;
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
        return number_format((double)$data, $this->decimals, $this->dec_point, $this->thousands_sep);
    }
}



class TextTypeMoney extends \TextTypeNumber
{
    public $prefix = '$';
    public $suffix = '';
    public $decimals = 2;

    public function __constrct()
    {
        parent::__construct();
        // $this->decimals = 2;
    }

    public function make($data)
    {
        return $this->prefix . parent::make($data) . $this->suffix;
    }
}
