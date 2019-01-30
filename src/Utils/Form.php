<?php

namespace Napoleon\IPay88\Utils;

class Form
{
    protected $fields;

    protected $request;

    public function __construct()
    {
        $this->request = new Request;
    }

    public function create($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function html()
    {
        $html = $this->open();

        foreach ($this->fields as $field => $value) {
            $html .= "<input type='hidden' name='{$field}' value='{$value}'>";
        }

        $html .= "</form>";

        return $html;
    }

    private function open()
    {
        $action = $this->request->postUrl()->getPostingUrl();

        return "<form method='POST' action='{$action}' name='my-form-name'>";
    }
}
