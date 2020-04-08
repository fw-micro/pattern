<?php


namespace fw_micro\pattern\CoR;


class ErrorParser
{
    private $line;
    private $message;
    private $file;
    private $trace;

    public function __construct(\Throwable $e)
    {
        $this->line = $e->getLine();
        $this->message = $e->getMessage();
        $this->file = $e->getFile();
        $this->trace = $e->getTraceAsString();
    }

    public function getData(): array
    {
        return [
            'line' => $this->line,
            'file' => $this->file,
            'message' => $this->message,
            'trace' => $this->trace
        ];
    }
}