
<?php

// Užduotis 1. 
//Atspausdint PHP asociatyvų masyvą kaip ASCII lentelę.

const spaceX   = 1;
const spaceY   = 0;
const plus  = '+';
const minus = '-';
const slash = '|';

$table = array(
    array(
        'Name'    => 'Trikse',
        'Color'   => 'Green',
        'Element' => 'Earth',
        'Likes'   => 'Flowers'
    ),
    array(
        'Name'    => 'Vardenis',
        'Element' => 'Air',
        'Likes'   => 'Singning',
        'Color'   => 'Blue'
    ),
    array(
        'Element' => 'Water',
        'Likes'   => 'Dancing',
        'Name'    => 'Jonas',
        'Color'   => 'Pink'
    ),
);

function draw_table($table)
{

    $nl = "\n";
    $columns_headers = columns_headers($table);
    $columns_lengths = columns_lengths($table, $columns_headers);
    $row_separator = row_seperator($columns_lengths);
    $row_spacer = row_spacer($columns_lengths);
    $row_headers = row_headers($columns_headers, $columns_lengths);

    echo '<pre>';

    echo $row_separator . $nl;
    echo str_repeat($row_spacer . $nl, spaceY);
    echo $row_headers . $nl;
    echo str_repeat($row_spacer . $nl, spaceY);
    echo $row_separator . $nl;
    echo str_repeat($row_spacer . $nl, spaceY);
    foreach ($table as $row_cells) {
        $row_cells = row_cells($row_cells, $columns_headers, $columns_lengths);
        echo $row_cells . $nl;
        echo str_repeat($row_spacer . $nl, spaceY);
    }
    echo $row_separator . $nl;

    echo '</pre>';

}

function columns_headers($table)
{
    return array_keys(reset($table));
}

function columns_lengths($table, $columns_headers)
{
    $lengths = [];
    foreach ($columns_headers as $header) {
        $header_length = strlen($header);
        $max = $header_length;
        foreach ($table as $row) {
            $length = strlen($row[$header]);
            if ($length > $max) {
                $max = $length;
            }
        }

        if (($max % 2) != ($header_length % 2)) {
            $max += 1;
        }

        $lengths[$header] = $max;
    }

    return $lengths;
}

function row_seperator($columns_lengths)
{
    $row = '';
    foreach ($columns_lengths as $column_length) {
        $row .= plus . str_repeat(minus, (spaceX * 2) + $column_length);
    }
    $row .= plus;

    return $row;
}

function row_spacer($columns_lengths)
{
    $row = '';
    foreach ($columns_lengths as $column_length) {
        $row .= slash . str_repeat(' ', (spaceX * 2) + $column_length);
    }
    $row .= slash;

    return $row;
}

function row_headers($columns_headers, $columns_lengths)
{
    $row = '';
    foreach ($columns_headers as $header) {
        $row .= slash . str_pad($header, (spaceX * 2) + $columns_lengths[$header], ' ', STR_PAD_BOTH);
    }
    $row .= slash;

    return $row;
}

function row_cells($row_cells, $columns_headers, $columns_lengths)
{
    $row = '';
    foreach ($columns_headers as $header) {
        $row .= slash . str_repeat(' ', spaceX) . str_pad($row_cells[$header], spaceX + $columns_lengths[$header], ' ', STR_PAD_RIGHT);
    }
    $row .= slash;

    return $row;
}

draw_table($table);

/*
Output:
+----------+-------+---------+-----------+
|   Name   | Color | Element |   Likes   |
+----------+-------+---------+-----------+
| Trikse   | Green | Earth   | Flowers   |
| Vardenis | Blue  | Air     | Singning  |
| Jonas    | Pink  | Water   | Dancing   |
+----------+-------+---------+-----------+
 */
