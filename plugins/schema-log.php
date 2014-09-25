<?php


class AdminerSchemaLog
{

  protected $dir = 'schema-log';

  public function __construct() {
    if (!is_dir($this->dir)) {
      mkdir('schema-log', 0755, true);
    }
  }

  public function messageQuery($query, $time) {
    $isMatched = preg_match('/(alter|create)\s+table\s+/i', $query);
    if (!$isMatched) {
      return;
    }
    if ($this->filename == "") {
      $adminer        = adminer();
      $this->filename = implode(".", array(
        $adminer->database(),
        date('Y-m-d'),
        'sql'
      )); // no database goes to ".sql" to avoid collisions
    }
    $fp = fopen($this->dir . '/' . $this->filename, "a");
    flock($fp, LOCK_EX);
    fwrite($fp, '/* ========= ' . date('Y-m-d H:i:s') . ' =========*/' . "\n");
    fwrite($fp, $query);
    fwrite($fp, "\n\n");
    flock($fp, LOCK_UN);
    fclose($fp);
  }

}