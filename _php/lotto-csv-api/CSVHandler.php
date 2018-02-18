<?php 

class CSVHandler { 
  private $fileName = 'drawresults.csv'; 
  public $writeToCSV = 'writeToCSV';

  function pp($var, $name = ''){
    // prettyprint
    echo "<pre>";
    echo '<strong>'.$name.': </strong>'; 
    print_r($var);
    echo "</pre>";    
  }

  // Working line end fix: Thanks to soapergem
  // http://php.net/manual/en/function.fputcsv.php#90883
  function mssafe_csv($filepath, $data, $header = array()) 
  { 
      if ( $fp = fopen($filepath, 'a') ) { 
          $show_header = true; 
          if ( empty($header) ) { 
              $show_header = false; 
              reset($data); 
              $line = current($data); 
              if ( !empty($line) ) { 
                  reset($line); 
                  $first = current($line); 
                  if ( substr($first, 0, 2) == 'ID' && !preg_match('/["\\s,]/', $first) ) { 
                      array_shift($data); 
                      array_shift($line); 
                      if ( empty($line) ) { 
                          fwrite($fp, "\"{$first}\"\r\n"); 
                      } else { 
                          fwrite($fp, "\"{$first}\","); 
                          fputcsv($fp, $line); 
                          fseek($fp, -1, SEEK_CUR); 
                          fwrite($fp, "\r\n"); 
                      } 
                  } 
              } 
          } else { 
              reset($header); 
              $first = current($header); 
              if ( substr($first, 0, 2) == 'ID' && !preg_match('/["\\s,]/', $first) ) { 
                  array_shift($header); 
                  if ( empty($header) ) { 
                      $show_header = false; 
                      fwrite($fp, "\"{$first}\"\r\n"); 
                  } else { 
                      fwrite($fp, "\"{$first}\","); 
                  } 
              } 
          } 
          if ( $show_header ) { 
              fputcsv($fp, $header); 
              fseek($fp, -1, SEEK_CUR); 
              fwrite($fp, "\r\n"); 
          } 
          foreach ( $data as $line ) { 
              fputcsv($fp, $line); 
              fseek($fp, -1, SEEK_CUR); 
              fwrite($fp, "\r\n"); 
          } 
          fclose($fp); 
      } else { 
          return false; 
      } 
      return true; 
  } 

  function writeToCSV($csvLine) { 
    $csvHeader = [];
    foreach ($csvLine as $key => $value) {
      // Collect JSON keys as header names to be used if this is a new file
      array_push($csvHeader, $key);
      // If any of the values is an array, convert to string
      if (is_array($value)) {
        $csvLine[$key] = implode (", ",  $csvLine[$key]);
      }
    }
    // If there is already data in the file we don't need the headers
    if (file_exists($this->fileName) && filesize($this->fileName) != 0) {
      $csvHeader = [];
    }
    //write to file as CSV using EOL fix by soapergem and return result
    return $this->mssafe_csv($this->fileName, [$csvLine], $csvHeader);
  } 

  function getFromCSV($linesToGet = 1) {
    $lines = [];
    return $lines;
  }

  function getCSV() {

  }

} 
